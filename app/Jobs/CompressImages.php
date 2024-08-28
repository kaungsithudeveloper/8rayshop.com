<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class CompressImages implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $filePaths;

    public function __construct(array $filePaths)
    {
        $this->filePaths = $filePaths;
    }

    public function handle()
    {
        foreach ($this->filePaths as $filePath) {
            $originalFilePath = storage_path('app/public/' . $filePath);

            if (file_exists($originalFilePath)) {
                $image = Image::make($originalFilePath);
                $filename = basename($filePath);

                $compressedImage = $image->resize(800, null, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })->encode('jpg', 75);

                $compressedImage->save(public_path('upload/compressed/' . $filename));

                Log::info("Compressed and saved: $filename");
            } else {
                Log::error("File not found: $originalFilePath");
            }
        }
    }
}
