<?php

namespace App\Http\Controllers;

use App\Http\Requests\FilesystemEndpointRequest;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class FilesystemController extends Controller
{
    public function getFile(FilesystemEndpointRequest $request)
    {
        $filePath = $request->input('path');

        if (! $this->fileExists($filePath)) {
            throw new NotFoundHttpException();
        }

        return response()->json(false, 500);
    }

    /**
     * @param string $filePath
     * @return bool
     */
    protected function fileExists($filePath)
    {
        return false;
    }
}
