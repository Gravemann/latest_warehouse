<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Clients\ClientStoreRequest;
use App\Http\Requests\Clients\ClientUpdateRequest;
use App\Http\Resources\Client\ClientResource;
use App\Models\Client;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ApiClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       return ClientResource::collection(Client::where('user_id', auth()->id())->latest('id')->paginate(5));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ClientStoreRequest $request)
    {
        /** @var Illuminate\Filesystem\FilesystemAdapter
         * This allows us to use putFile and pitFileAs methods after implementation of Storage's disk method
         */
        $filesystem = Storage::disk('public');

        $data = $request->validated();
        $image = $data['image'];
        unset($data['image']);

        $image_name = md5(Carbon::now() . '_' . $request->file('image')->hashName()) . '.' . $request->file('image')->extension();
        $image_path = $filesystem->putFileAs('/images/clients', $image, $image_name);
        $image_url = url('/storage/' . $image_path);
        $client = Client::create([
            'user_id' => auth()->id(),
            'name' => $data['name'],
            'surname' => $data['surname'],
            'contact_number' => $data['contact_number'],
            'company' => $data['company'],
            'image_path' => $image_path,
            'image_url' => $image_url,
            
        ]);

        return response()->json(['success' => 'The client added successfully'], 200);
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
    public function update(ClientUpdateRequest $request, Client $client)
    {
        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($client->image_path);

            /** @var Illuminate\Filesystem\FilesystemAdapter
             * This allows us to use putFile and pitFileAs methods after implementation of Storage's disk method
             */
            $filesystem = Storage::disk('public');

            $data = $request->validated();
            $image = $data['image'];
            unset($data['image']);

            $image_name = md5(Carbon::now() . '_' . $request->file('image')->hashName()) . '.' . $request->file('image')->extension();
            $image_path = $filesystem->putFileAs('/images/clients', $image, $image_name);
            $image_url = url('/storage/' . $image_path);

            if ($client->name == $request->name && $client->surname == $request->surname 
                && $client->contact_number == $request->contact_number && $client->company == $request->company) {
                $client->update([
                    'image_path' => $image_path,
                    'image_url' => $image_url
                ]);
            } else {
                $client->update([
                    'name' => $data['name'],
                    'surname' => $data['surname'],
                    'contact_number' => $data['contact_number'],
                    'company' => $data['company'],
                    'image_path' => $image_path,
                    'image_url' => $image_url,
                ]);
            }

            return response()->json(['success' => 'The client updated successfully'], 200);
        } else {
            $data = $request->validated();
            if ($client->name == $request->name && $client->surname == $request->surname 
            && $client->contact_number == $request->contact_number && $client->company == $request->company) {
                return response()->json(['fail' => 'Data remained untouched, nothing to update']);
            } else {
                $client->update([
                    'name' => $data['name'],
                    'surname' => $data['surname'],
                    'contact_number' => $data['contact_number'],
                    'company' => $data['company'],
                ]);
                
                return response()->json(['success' => 'The client updated successfully'], 200);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Client $client)
    {
        Storage::disk('public')->delete($client->image_path);
        $client->delete();
        return response()->json(['deleted' => 'The client deleted successfully'], 200);
    }

    /**
     * Get filtered and sorted data
     **/
    public function getSearchedAndSorted(Request $request)
    {
        return ClientResource::collection(Client::authorized()->filtered($request->keyword)->sorted($request->column, $request->order)->paginate(5));
    }
}

