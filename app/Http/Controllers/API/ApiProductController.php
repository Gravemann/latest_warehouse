<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Products\ProductStoreRequest;
use App\Http\Requests\Products\ProductUpdateRequest;
use App\Http\Resources\Product\ProductResource;
use App\Models\Brand;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ApiProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return ProductResource::collection(Product::where('user_id', auth()->id())->latest('id')->paginate(5));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductStoreRequest $request)
    {
        /** @var Illuminate\Filesystem\FilesystemAdapter
         * This allows us to use putFile and pitFileAs methods after implementation of Storage's disk method
         */
        $filesystem = Storage::disk('public');

        $data = $request->validated();
        $user_id = array('user_id' => auth()->id());
        $data = $user_id + $data;
        $image = $data['image'];
        unset($data['image']);

        $image_name = md5(Carbon::now() . '_' . $request->file('image')->hashName()) . '.' . $request->file('image')->extension();
        $image_path = $filesystem->putFileAs('/images/products', $image, $image_name);
        $image_url = url('/storage/' . $image_path);
        $image_data = array('image_path' => $image_path, 'image_url' => $image_url);
        $data = $data + $image_data;
        $product = Product::create($data);

        return response()->json([$product, 'success' => 'The product added successfully'], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductUpdateRequest $request, Product $product)
    {
        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($product->image_path);

            /** @var Illuminate\Filesystem\FilesystemAdapter
             * This allows us to use putFile and pitFileAs methods after implementation of Storage's disk method
             */
            $filesystem = Storage::disk('public');

            $data = $request->validated();
            $image = $data['image'];
            unset($data['image']);

            $image_name = md5(Carbon::now() . '_' . $request->file('image')->hashName()) . '.' . $request->file('image')->extension();
            $image_path = $filesystem->putFileAs('/images/products', $image, $image_name);
            $image_url = url('/storage/' . $image_path);

            if ($product->name == $request->name && $product->brand_id == $request->brand_id 
                && $product->purchase_price == $request->purchase_price && $product->sale_price == $request->sale_price
                && $product->quantity == $request->quantity) {
                $product->update([
                    'image_path' => $image_path,
                    'image_url' => $image_url
                ]);
            } else {
                $product->update([
                    'brand_id' => $data['brand_id'],
                    'name' => $data['name'],
                    'purchase_price' => $data['purchase_price'],
                    'sale_price' => $data['sale_price'],
                    'quantity' => $data['quantity'],
                    'image_path' => $image_path,
                    'image_url' => $image_url
                ]);
            }

            return response()->json(['success' => 'The brand updated successfully'], 200);
        } else {
            if ($product->name == $request->name && $product->brand_id == $request->brand_id 
                && $product->purchase_price == $request->purchase_price && $product->sale_price == $request->sale_price
                && $product->quantity == $request->quantity) {
                    return response()->json(['fail' => 'Data remained untouched, nothing to update']);
            } else {
                $data = $request->validated();
                $product->update([
                    'brand_id' => $data['brand_id'],
                    'name' => $data['name'],
                    'purchase_price' => $data['purchase_price'],
                    'sale_price' => $data['sale_price'],
                    'quantity' => $data['quantity'],
                ]);

                return response()->json(['success' => 'The product updated successfully'], 200);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        if ($product->orders()->count() > 0) {
            return response()->json(['fail' => 'This product has releated orders, deletion restricted'], 200);
        }
        Storage::disk('public')->delete($product->image_path);
        $product->delete();
        return response()->json(['deleted' => 'The product deleted successfully'], 200);
    }

    /**
     * Get filtered data
     **/
    public function getSearchedAndSorted(Request $request)
    {
        return ProductResource::collection(Product::authorizedJoin()->filtered($request->keyword)->sorted($request->column, $request->order)->paginate(5));
    }
}
