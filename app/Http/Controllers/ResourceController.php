<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidateResourceRequest;
use App\Models\Resource;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use App\Services\ResourceService;

class ResourceController extends Controller
{
    public function __construct(protected ResourceService $resourceService)
    {
    }

    public function index()
    {
        $resources = Resource::all();

        return response()->json([
            'resources' => $resources
        ], Response::HTTP_OK);
    }

    public function edit(Resource $resource)
    {
        return response()->json([
            'resource' => $resource
        ], Response::HTTP_OK);
    }

    public function store(ValidateResourceRequest $request)
    {
        $resource = $request->validated();

        if ($request->type === 'pdf' && $request->hasFile('file')) {
            $resource = $this->resourceService->savePDF($resource, $request);
        }

        Resource::create($resource);

        return response()->json([
            'message' => 'Resource created successfully.'
        ], Response::HTTP_CREATED);
    }

    public function update(Resource $resource, ValidateResourceRequest $request)
    {
        $validatedData = $request->validated();

        if ($request->type === 'pdf' && $request->hasFile('file')) {
            // Remove old file
            $this->resourceService->deletePDF($resource);

            // Save new file
            $validatedData = $this->resourceService->savePDF($validatedData, $request);
        }

        $resource->update($validatedData);

        return response()->json([
            'message' => 'Resource updated successfully.'
        ], Response::HTTP_ACCEPTED);
    }

    public function destroy(Resource $resource)
    {
        if ($resource->type === 'pdf') {
            $this->resourceService->deletePDF($resource);
        }

        $resource->delete();

        return response()->json([
            'message' => 'Resource deleted successfully.'
        ], Response::HTTP_OK);
    }

    public function download(Resource $resource)
    {
        if (Storage::exists('public/uploads/' . $resource->file_name)) {
            return Storage::download('public/uploads/' . $resource->file_name);
        }

        return response()->json([
            'message' => 'PDF not found.'
        ], Response::HTTP_NOT_FOUND);
    }
}
