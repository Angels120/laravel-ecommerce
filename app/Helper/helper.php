<?php

/*
   Write Helper function here
*/

use App\Models\Product;

class Helper{

    public static function saveFilePondImage($image, $directory)
    {
        $item = json_decode($image);
        if (!$item) {
            return;
        }
        if (!is_dir($directory)) {
            // Create the directory with permissions (0777 is used here, but you can adjust it as needed)
            mkdir($directory, 0777, true);

            // Check if directory creation was successful
            if (!is_dir($directory)) {
                return response()->json(['error' => 'Failed to create the directory.'], 400);
            }
        }

        $allowedFileExtension = ['png', 'jpg', 'jpeg'];

        $filename = $item->name;

        $extensions = explode('.', $filename);
        $extension = end($extensions);
        $ext = $extensions[0];

        $check = in_array($extension, $allowedFileExtension);
        if (!$check) {
            return response()->json(['error' => 'Sorry, this file type is not allowed. Only the following file types are allowed: jpg, png, jpeg'], 400);
        }

        $data = 'data:' . $item->type . ';base64,' . $item->data;
        $image = file_get_contents($data);

        $fileSizeLimit = 3000000; // 3MB in bytes
        if (strlen($image) > $fileSizeLimit) {
            return response()->json(['error' => 'File size exceeds the limit of 3MB. Please select a file having size lesser than 3MB'], 400);
        }

        // Append timestamp to the image name to make it unique
        $microtime = microtime(true);
        $timestamp = round($microtime * 1000); // Convert to milliseconds and round
        $imageName = $ext . '_' . $timestamp . '.' . $extension;
        $destination = $directory . $imageName;
        $file = fopen($destination, 'w+');
        fputs($file, $image);
        fclose($file);

        return $imageName;
    }
}
?>
