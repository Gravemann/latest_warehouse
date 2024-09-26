<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\DB;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'client_id',
        'product_id',
        'quantity',
        'confirmed',
    ];

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function scopeAuthorized(Builder $query): void
    {
        $query->where('user_id', '=' , auth()->id());
    }

    public function scopeAuthorizedJoin(Builder $query): void
    {
        $query->where('orders.user_id', '=', auth()->id());
    }

    /**
     * @param void|string $value
     */

    public function scopeFiltered(Builder $query, $value): void
    {
        $query->join('clients', 'orders.client_id', '=', 'clients.id')
            ->join('products', 'orders.product_id', '=', 'products.id')
            ->join('brands', 'products.brand_id', '=', 'brands.id')
            ->select('brands.name', 'clients.*', 'products.*', 'orders.*')
            ->when($value, function ($query) use ($value) {
                $query->whereAny(
                    [
                        'clients.name',
                        'clients.surname',
                        'clients.contact_number',
                        'brands.name',
                        'products.name',
                        'products.purchase_price',
                        'products.sale_price',
                        'products.quantity',
                        'orders.quantity',
                        DB::raw('(products.sale_price - products.purchase_price) * orders.quantity')
                    ],
                    'LIKE',
                    '%' . $value . '%'
                );
            });
    }
    
    public function scopeSorted(Builder $builder, $column, $order): void
    {
        $builder->when($column !== 'profit' && !is_null($column), function ($query) use ($column, $order) {
            $query->orderBy($column, $order)->latest('orders.id');
        })
        ->when($column === 'profit', function ($query) use ($order) {
            $query->orderByRaw('(products.sale_price - products.purchase_price) * orders.quantity ' . $order)->latest('orders.id');
        })
        ->when(is_null($column), function ($query) {
            $query->latest('orders.id');
        });
    }
}
