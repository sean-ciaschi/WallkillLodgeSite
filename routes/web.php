<?php

Route::get('/', function () {
    return view('index');
});

Route::get('storage/app/media/{filename}', function ($filename)
{
    $path = storage_path('app/media/' . $filename);

    if (!File::exists($path)) {
        abort(404);
    }

    $file = File::get($path);
    $type = File::mimeType($path);

    $response = Response::make($file, 200);
    $response->header("Content-Type", $type);

    return $response;
});