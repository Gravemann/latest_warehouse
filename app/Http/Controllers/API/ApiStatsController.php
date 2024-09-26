<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\Brand\BrandResouce;
use App\Http\Resources\Client\ClientResource;
use App\Http\Resources\Product\ProductResource;
use App\Models\Brand;
use App\Models\Client;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApiStatsController extends Controller
{
    /**
     * Get all data
     **/
    public function getAllData()
    {
        return BrandResouce::collection(Brand::where('user_id', auth()->id())->paginate(25))->additional([
            'products' => ProductResource::collection(Product::where('user_id', auth()->id())->where('quantity', '>', 0)->latest()->paginate(25)),
            'clients' => ClientResource::collection(Client::where('user_id', auth()->id())->latest()->paginate(25)),
        ]);
    }

    /**
     * Get all stats
     **/
    public function getAllStats()
    {
        return [
            'brands' => Brand::where('user_id', auth()->id())->count(), 
            'products' => Product::where('user_id', auth()->id())->count(), 
            'clients' => Client::where('user_id', auth()->id())->count(), 
            'orders' => Order::where('user_id', auth()->id())->count()
        ];
    }

    /**
     * Get all financial stats
     **/
    public function getFinancialStats()
    {
        return [
            'purchase' => Product::where('user_id', auth()->id())->sum(DB::raw('purchase_price * quantity')),
            'sale' => Product::where('user_id', auth()->id())->sum(DB::raw('sale_price * quantity')),
            'ordered' => Order::where('user_id', auth()->id())->sum('quantity'),
            'profit' => Product::where('products.user_id', auth()->id())->join('orders', 'products.id', '=', 'orders.product_id')
                        ->sum(DB::raw('(products.sale_price - products.purchase_price) * orders.quantity')),
            'current_profit' => Product::where('products.user_id', auth()->id())->join('orders', 'products.id', '=', 'orders.product_id')->where('orders.confirmed', 1)
                                ->sum(DB::raw('(products.sale_price - products.purchase_price) * orders.quantity'))
        ];
    }
}
