<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\BrandStoreRequest;
use App\Http\Resources\BrandResouce;
use App\Models\Brand;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ApiBrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return json_encode(BrandResouce::collection(Brand::latest()->paginate(10)));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BrandStoreRequest $request)
    {
        /** @var Illuminate\Filesystem\FilesystemAdapter
         * This allows us to use putFile and pitFileAs methods after implementation of Storage's disk method
         */
        $filesystem = Storage::disk('public');

        $data = $request->validated();
        $image = $data['image'];
        unset($data['image']);

        $image_name = md5(Carbon::now() . '_' . $request->file('image')->hashName()) . '.' . $request->file('image')->extension();
        $image_path = $filesystem->putFileAs('/images/brands', $image, $image_name);
        $image_url = url('/storage/' . $image_path);
        $brand = Brand::firstOrCreate([
            'name' => $data['name']
        ],
        [
            'user_id' => 1,
            'name' => $data['name'],
            'image_path' => $image_path,
            'image_url' => $image_url
        ]);

        return response()->json(['success' => 'The brand added successfully'], 200);
        
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Brand $brand)
    {
        $brand->delete();
        return response()->json(['deleted' => 'The brand was deleted successfully'], 200);
    }
}
