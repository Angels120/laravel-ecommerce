<?php

/*
   Write Helper function here
*/

use App\Mail\OrderEmail;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

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
            $errors = [
                'image' => ['Sorry, this file type is not allowed. Only the image file types are allowed: jpg, png, jpeg'],
            ];

            return response()->json(['errors' => $errors], 400);
        }

        $data = 'data:' . $item->type . ';base64,' . $item->data;
        $image = file_get_contents($data);

        $fileSizeLimit = 3000000; // 3MB in bytes
        if (strlen($image) > $fileSizeLimit) {
            return response()->json(['error' => 'Image size exceeds the limit of 3MB. Please select a image having size lesser than 3MB'], 400);
        }

        $microtime = microtime(true);
        $timestamp = round($microtime * 1000);
        $imageName = $ext . '_' . $timestamp . '.' . $extension;
        $destination = $directory . $imageName;
        $file = fopen($destination, 'w+');
        fputs($file, $image);
        fclose($file);

        return $imageName;
    }

    public static function orderEmail($orderId,$userType="customer"){
        $order=Order::where('id',$orderId)->with('items')->first();
        if($userType=='customer'){
            $subject='Thanks for your order';
            $recipientEmail = $order->email ?? Auth::user()->email;
        }
        else{
            $subject='You have recived an order';
            $recipientEmail = env('ADMIN_EMAIL');

        }
        $mailData=[
            'subject'=>$subject,
            'url'=>'http://127.0.0.1:8000/',
            'order'=>$order,
            'userType'=>$userType,
        ];
        Mail::to($recipientEmail)->send(new OrderEmail($mailData));

    }

}
?>
