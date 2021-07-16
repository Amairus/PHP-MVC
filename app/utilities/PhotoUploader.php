<?php

namespace App\Utilities;

use App\Libraries\Exception;

/**
 * PhotoUploader takes responsibility to upload a photo
 */
class PhotoUploader
{
    /**
     * uploadImage
     * @access public
     * @param array,string
     * @return void
     * @since 1.0.1
     */
    public static function uploadImage($file, $target_dir)
    {
         //Variables initalization
         $target_file = $target_dir . basename($file["name"]);
         $uploadOk = 1;
         $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
         $foo = new \Verot\Upload\Upload($file);

         //Checks if file_exists;
         if (file_exists($_SERVER['DOCUMENT_ROOT'].'php-mvc-master/public/image/'.$file['name'])) {
             echo "Sorry, file already exists.";
             $uploadOk = 0;
           }
         // Check file size
         if ($file["size"] > 500000) {
             echo "Sorry, your file is too large.";
             $uploadOk = 0;
         }

         // Allow certain file formats
         if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
         && $imageFileType != "gif" ) {
             echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
             $uploadOk = 0;
         }
         if ($uploadOk) {
             if ($foo->uploaded) {
                 // save uploaded image with no changes
                 $foo->process($target_dir);
                 if (!$foo->processed)
                     Exception::throwError('Image failed to upload. Try again later!');
            }
        }
    }

}

?>