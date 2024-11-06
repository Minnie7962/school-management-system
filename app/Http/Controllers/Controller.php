<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    protected function success($message, $data = [])
    {
        return response()->json([
            'status' => 'success',
            'message' => $message,
            'data' => $data
        ]);
    }

    protected function error($message, $code = 400)
    {
        return response()->json([
            'status' => 'error',
            'message' => $message
        ], $code);
    }

    protected function uploadFile($file, $path)
    {
        if ($file) {
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/uploads/' . $path, $filename);
            return $filename;
        }
        return null;
    }

    protected function deleteFile($path)
    {
        if ($path && file_exists(storage_path('app/public/uploads/' . $path))) {
            unlink(storage_path('app/public/uploads/' . $path));
        }
    }
}
