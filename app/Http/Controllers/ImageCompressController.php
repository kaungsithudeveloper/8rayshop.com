<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jobs\CompressImages;
use Illuminate\Support\Facades\Log;
use Intervention\Image\Facades\Image;

class ImageCompressController extends Controller
{
    public function showCompressForm()
    {
        return view('backend.employees.8ray.imagecompress');
    }

    public function compressImage(Request $request)
{
    $request->validate([
        'compressimage.*' => 'required|image|mimes:jpeg,png,jpg,gif,webp',
    ]);

    $compressedImages = [];
    foreach ($request->file('compressimage') as $file) {
        $img = Image::make($file);

        // Compress and save image
        $compressedImage = public_path('upload/compressed/' . $file->getClientOriginalName());
        $img->save($compressedImage, 75); // 75% quality
        $compressedImages[] = $compressedImage;
    }

    return redirect()->back()->with('success', 'Images compressed successfully!')
                            ->with('compressedImages', $compressedImages);
}

}
