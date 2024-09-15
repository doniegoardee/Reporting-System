<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;

class ReadPublicDirectory
{
    public function handle($request, Closure $next)
    {
        // Get the request path
        $path = $request->path();

        // Check if the request path starts with 'admincss'
        if (Str::startsWith($path, 'public/admincss')) {
            // Allow access to CSS, JavaScript, and other static files
            $allowedExtensions = ['css', 'js', 'jpg', 'jpeg', 'png', 'gif', 'svg'];

            // Get the file extension
            $extension = pathinfo($path, PATHINFO_EXTENSION);

            // Check if the file extension is allowed
            if (!in_array($extension, $allowedExtensions)) {
                // If the extension is not allowed, deny access
                return response()->json(['error' => 'Access to admincss folder is restricted.'], 403);
            }
        }

        // Allow the request to proceed
        return $next($request);
    }
}
