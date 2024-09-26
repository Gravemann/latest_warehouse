<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Orders\OrderStoreRequest;
use App\Http\Requests\Orders\OrderUpdateRequest;
use App\Http\Resources\Order\OrderResource;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class ApiOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return OrderResource::collection(Order::where('user_id', auth()->id())->latest('id')->paginate(5));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(OrderStoreRequest $request)
    {
        $data = $request->validated();
        unset($data['product_quantity']);
        $user_id = array('user_id' => auth()->id());
        $data = $user_id + $data;
        $order = Order::create($data);
        return response()->json([$order, 'success' => 'The order added successfully'], 200);

    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(OrderUpdateRequest $request, Order $order)
    {
        $data = $request->validated();
        if ($order->client_id == $request->client_id 
        && $order->product_id == $request->product_id 
        && $order->quantity == $request->quantity) {
            return response()->json(['fail' => 'Data remained untouched, nothing to update']);
        } else {
            $order->update($data);
            return response()->json([$order, 'success' => 'The order updated successfully'], 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        $order->delete();
        return response()->json(['deleted' => 'The order deleted successfully'], 200);
    }

    /**
     * Confirm the order.
     */
    public function confirm(Order $order)
    {
        $product = Product::findOrFail($order->product_id);
        if ($order->quantity > $product->quantity) {
            return response()->json(['fail' => 'Insufficient stock quantity, order can not be confirmed'], 200);
        } else {
            $product->update([
                'quantity' => $product->quantity - $order->quantity
            ]);
            $order->update([
                'confirmed' => true
            ]);
            return response()->json([$product, $order, 'success' => 'The order confirmed successfully'], 200);
        }    
    }

    /**
     * Unconfirm the order.
     */
    public function unconfirm(Order $order)
    {
        $product = Product::findOrFail($order->product_id);
        $product->update([
            'quantity' => $product->quantity + $order->quantity
        ]);
        $order->update([
            'confirmed' => false
        ]);
        return response()->json([$product, $order, 'success' => 'The order unconfirmed successfully'], 200);
    }

    /**
     * Get filtered data
     **/
    public function getSearchedAndSorted(Request $request)
    {
        return OrderResource::collection(Order::authorizedJoin()->filtered($request->keyword)->sorted($request->column, $request->order)->paginate(5));
    }
}
