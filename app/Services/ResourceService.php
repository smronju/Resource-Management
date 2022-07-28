<?php

namespace App\Services;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;

class ResourceService
{
    public function savePDF($resource, $request)
    {
        $fileName = time() . '_' . $request->file('file')->getClientOriginalName();
        $filePath = $request->file('file')->storeAs('uploads', $fileName, 'public');
        $resource['file_name'] = $fileName;
        $resource['path'] = '/storage/' . $filePath;

        return Arr::except($resource, ['file']);
    }

    public function deletePDF($resource)
    {
        if (Storage::exists('public/uploads/' . $resource->file_name)) {
            Storage::delete('public/uploads/' . $resource->file_name);
        }
    }
}
