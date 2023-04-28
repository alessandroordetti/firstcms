<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\Models\CmsMultiversityUploads;



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
        $filename = $file->getClientOriginalName();

        var_dump($filename);

        // Move the file to the uploads folder
        $file->move(public_path('uploads'), $filename);

        // Read the file data into a variable
        $fileData = file_get_contents(public_path('uploads/' . $filename));

        // Connect to your HeidiSQL database and insert the file data
        $pdo = new \PDO("mysql:host=mariadb;dbname=cms_multiversity", env('DB_USERNAME'), env('DB_PASSWORD'));
        $sql = "INSERT INTO cms_multiversity_uploads (filename, file_data) VALUES (:filename, :fileData)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':filename', $filename);
        $stmt->bindParam(':fileData', $fileData, \PDO::PARAM_LOB);
        $stmt->execute();
        
        // Redirect to a success page or back to the file manager modal
        return redirect()->back()->with('success', 'File uploaded successfully.');
    }

    public function getData() {
        $files = CmsMultiversityUploads::all();
        $pdfs = [];
    
        foreach ($files as $file) {
            // Save file data to a temporary file
            $temp_file_path = tempnam(sys_get_temp_dir(), 'pdf');
            Storage::disk('temporary-files')->put($temp_file_path, $file->file_data);
    
            // Read binary data of file
            $binary_data = file_get_contents($temp_file_path);
    
            // Add binary data to array
            $pdfs[] = $file->filename;
    
            // Remove temporary file
            unlink($temp_file_path);
        }
    
        return view('pages.get-data', ['pdfs' => $pdfs]);
    }
    
    
    
}
