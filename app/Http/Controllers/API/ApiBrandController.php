<?php

namespace App\Http\Controllers\API;

use App\Exports\BrandExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\Brands\BrandExcelImportRequest;
use App\Http\Requests\Brands\BrandStoreRequest;
use App\Http\Requests\Brands\BrandUpdateRequest;
use App\Http\Resources\Brand\BrandResouce;
use App\Imports\BrandImport;
use App\Models\Brand;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Excel as ExcelExcel;
use Maatwebsite\Excel\Facades\Excel;

class ApiBrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return BrandResouce::collection(Brand::authorized()->latest('id')->paginate(5));        
    }

    /**
     * Export brands table
     */

    public function export()
    {
        return Excel::download(new BrandExport, 'brands.xlsx');
    }

    /**
     * Import brands table
     */

     public function import(BrandExcelImportRequest $request)
     {
        $data = $request->validated();
        
        Excel::import(new BrandImport, $data['excel_import'],'local' , ExcelExcel::XLSX);

        return response()->json(['success' => 'New brands imported successfully'], 200);
     }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BrandStoreRequest $request)
    {
        /** @var Illuminate\Filesystem\FilesystemAdapter
         * This allows us to use putFile and putFileAs methods after implementation of Storage's disk method
         */
        $filesystem = Storage::disk('public');

        $data = $request->validated();
        $image = $data['image'];
        unset($data['image']);

        $image_name = md5(Carbon::now() . '_' . $request->file('image')->hashName()) . '.' . $request->file('image')->extension();
        $image_path = $filesystem->putFileAs('/images/brands', $image, $image_name);
        $image_url = url('/storage/' . $image_path);
        $brand = Brand::create([
            'user_id' => auth()->id(),
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
    public function update(BrandUpdateRequest $request, Brand $brand)
    {
        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($brand->image_path);

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

            if ($brand->name == $request->name) {
                $brand->update([
                    'image_path' => $image_path,
                    'image_url' => $image_url
                ]);
            } else {
                $brand->update([
                    'name' => $data['name'],
                    'image_path' => $image_path,
                    'image_url' => $image_url
                ]);
            }

            return response()->json(['success' => 'The brand updated successfully'], 200);
        } else {
            $data = $request->validated();
            if ($brand->name == $request->name) {
                return response()->json(['fail' => 'Data remained untouched, nothing to update']);
            } else {
                $brand->update([
                    'name' => $data['name'],
                ]);
            }

            return response()->json(['success' => 'The brand updated successfully'], 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Brand $brand)
    {
        if ($brand->products()->count() > 0) {
            return response()->json(['fail' => 'This brand has releated products, deletion restricted'], 200);
        }
        if ($brand->image_path) {
            Storage::disk('public')->delete($brand->image_path);
        }
        $brand->delete();
        return response()->json(['deleted' => 'The brand was deleted successfully'], 200);
    }

    /**
     * Get filtered and sorted data
     **/
    public function getSearchedAndSorted(Request $request)
    {
        return BrandResouce::collection(Brand::authorized()->filtered($request->keyword)->sorted($request->column, $request->order)->paginate(5));
    }
}