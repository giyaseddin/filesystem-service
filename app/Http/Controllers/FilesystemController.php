<?php

namespace App\Http\Controllers;

use App\Http\Requests\FilesystemEndpointRequest;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class FilesystemController extends Controller
{
    public function getFile(FilesystemEndpointRequest $request)
    {
        $filePath = $request->input('path');

        $this->checkIfFileValid($filePath);

        return response()->json(false, 500);
    }

    /**
     * @param string $filePath
     * @return bool
     */
    protected function fileExists($filePath)
    {
        return Storage::exists($filePath);
    }

    protected function checkFilePermission($filePath)
    {
        // File permissions for the requesting user goes here.
        return true;
    }

    protected function isInsideForbiddenDir($filePath)
    {
        $path = explode('/', $filePath);
        return $path[0] != '..';
    }

    private function checkIfFileValid($filePath)
    {
        try {
            if (! $this->fileExists($filePath)) {
                throw new NotFoundHttpException();
            }
        } catch (NotFoundHttpException $e) {
            throw $e;
        } catch (\Exception $e) {
            throw new AccessDeniedHttpException("Permission Denied.");
        }

        if (! $this->checkFilePermission($filePath)) {
            throw new AccessDeniedHttpException("Permission Denied.");
        }
    }
}
