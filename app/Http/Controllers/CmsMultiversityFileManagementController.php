<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;



class CmsMultiversityFileManagementController extends Controller
{
    public function upload(Request $request)
    {
        // Validate the file input
        $validator = Validator::make($request->all(), [
            'file' => 'required|mimes:jpeg,png,jpg,pdf|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        if (!File::exists(public_path('uploads'))) {
            File::makeDirectory(public_path('uploads'));
        }
        
        // Get the file from the request
        $file = $request->file('file');

        // Generate a unique file name for the uploaded file
        $filename = uniqid() . '_' . $file->getClientOriginalName();

        // Move the file to the uploads folder
        $file->move(public_path('uploads'), $filename);
        
        // Redirect to a success page or back to the file manager modal
        return redirect()->back()->with('success', 'File uploaded successfully.');
    }
}
