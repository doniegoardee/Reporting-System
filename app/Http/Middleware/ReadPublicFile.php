<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class ReadPublicFile
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Define the path to the folder in the public directory
        $folderPath = public_path('admincss');

        // Check if the folder exists
        if (File::exists($folderPath) && File::isDirectory($folderPath)) {
            // Get all files in the folder
            $files = File::files($folderPath);

            // Process each file
            foreach ($files as $file) {
                $filePath = $file->getPathname();
                $content = File::get($filePath);
                // Log the file path and content for demonstration
                Log::info('File Path: ' . $filePath);
                Log::info('File Content: ' . $content);
            }
        } else {
            Log::warning('Folder does not exist or is not a directory: ' . $folderPath);
        }

        return $next($request);
    }
}

