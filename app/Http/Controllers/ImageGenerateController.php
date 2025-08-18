<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Orhanerday\OpenAi\OpenAi;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class ImageGenerateController extends Controller
{
    public function generate(Request $request)
    {
        $imageUrl = null;

        // Check if the form was submitted
        if ($request->has('question')) {
            // Get the question from the request
            $question = $request->input('question');

            // Construct the URL
            $url = 'https://ai.shabox.mobi/ai/imagegenerate';

            // Send the HTTP GET request and get the response
            $response = Http::get($url, [
                'question' => $question
            ]);

            // The response body should contain the base64-encoded image
            $base64Image = $response->body();

            // Decode the base64 image
            $imageData = base64_decode($base64Image);

            // Create a file name and save it to the public directory
            $fileName = 'generated_image_' . time() . '.png';
            $filePath = public_path('images/' . $fileName);

            // Save the image to the public/images folder
            File::ensureDirectoryExists(public_path('images'));
            file_put_contents($filePath, $imageData);

            // Pass the image URL to the view
            $imageUrl = asset('images/' . $fileName); // Generate a URL to the saved file
        }

        return view('generate-image', ['imageUrl' => $imageUrl, 'question' => $request->input('question', '')]);
    }
}
