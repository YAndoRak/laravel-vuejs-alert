<?php

namespace App\Http\Controllers;

class UploadController extends Controller
{
    public function UploadVideo(){
        $fileRoute = "/uploads/videos/";
        $allowedExts = array("mp4", "webm", "ogg");
        $allowedMimeTypes = array("video/mp4", "video/webm", "video/ogg");
        $this->Uploading($fileRoute, $allowedExts, $allowedMimeTypes);
    }

    public function UploadImage(){
        $fileRoute = "/uploads/images/";
        $allowedExts = array("gif", "jpeg", "jpg", "png", "svg", "blob");
        $allowedMimeTypes = array("image/gif", "image/jpeg", "image/pjpeg", "image/x-png", "image/png", "image/svg+xml");
        $this->Uploading($fileRoute, $allowedExts, $allowedMimeTypes);
    }

    public function UploadFile(){
        $fileRoute = "/uploads/files/";
        $allowedExts = array("txt", "pdf", "doc","json","html");
        $allowedMimeTypes = array("text/plain", "application/msword", "application/x-pdf", "application/pdf", "application/json","text/html");
        $this->Uploading($fileRoute, $allowedExts, $allowedMimeTypes);
    }
    private function Uploading($fileRoute, $allowedExts, $allowedMimeTypes){
        try {
            $fileRoute;
            //(File)(Route)

            $fieldname = "file";

            // Get filename.
            $filename = explode(".", $_FILES[$fieldname]["name"]);

            // Validate uploaded files.
            // Do not use $_FILES["file"]["type"] as it can be easily forged.
            $finfo = finfo_open(FILEINFO_MIME_TYPE);

            // Get temp file name.
            $tmpName = $_FILES[$fieldname]["tmp_name"];

            // Get mime type.
            $mimeType = finfo_file($finfo, $tmpName);

            // Get extension. You must include fileinfo PHP extension.
            $extension = end($filename);

            // Allowed extensions.
            $allowedExts;

            // Allowed mime types.
            $allowedMimeTypes;

            // Validate image.
            if (!in_array(strtolower($mimeType), $allowedMimeTypes) || !in_array(strtolower($extension), $allowedExts)) {
                throw new \Exception("File does not meet the validation.");
            }

            // Generate new random name.
            $name = sha1(microtime()) . "." . $extension;
            $fullNamePath = $_SERVER["DOCUMENT_ROOT"]. $fileRoute . $name;

            // Check server protocol and load resources accordingly.
            if (isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] != "off") {
                $protocol = "https://";
            } else {
                $protocol = "http://";
            }

            // Save file in the uploads folder.
            move_uploaded_file($tmpName, $fullNamePath);


            // Generate response.
            $response = new \StdClass;
            $response->link = $protocol.$_SERVER["HTTP_HOST"].$fileRoute . $name;

            // Send response.
            echo stripslashes(json_encode($response));

        } catch (Exception $e) {
            // Send error response.
            echo $e->getMessage();
            http_response_code(404);
        }
    }
}