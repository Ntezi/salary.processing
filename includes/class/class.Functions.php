<?php

/**
 * Created by PhpStorm.
 * User: MARIUS
 * Date: 09-Feb-15
 * Time: 00:57
 */
class Functions
{


    public function __construct()
    {

    }


    public function redirect($location = null)
    {
        if ($location != null) {
            header('Location: ' . $location);
            exit;
        }
    }

    public function message($msg)
    {
        echo $msg;
    }

    public function makeDir($name_path, $main_dir)
    {
        if (file_exists($main_dir)) {
            if (file_exists($name_path) == false) {
                mkdir($name_path, 0777, true);
            }
        } else {
            mkdir($main_dir, 0777, true);
        }
    }

    public function createRandomPassword()
    {
        $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
        $password = array();
        $alpha_length = strlen($alphabet) - 1;
        for ($i = 0; $i < 8; $i++) {
            $random = rand(0, $alpha_length);
            $password[] = $alphabet[$random];
        }

        $random_password = implode($password);

        return $random_password;

    }

    public function compressImage($image_location, $thumb_destination)
    {

//        $compression_type = Imagick::COMPRESSION_JPEG;
        $compression_type = 8;
        $im = new Imagick($image_location);
        $thumbnail = $im->clone();

        $thumbnail->setImageCompression($compression_type);
        $thumbnail->setImageCompressionQuality(40);
        $thumbnail->stripImage();
        $thumbnail->thumbnailImage(100, null);
        $thumbnail->writeImage($thumb_destination);
    }

    public function parseToXML($htmlStr)
    {

        $xmlStr = str_replace('<', '&lt;', $htmlStr);
        $xmlStr = str_replace('>', '&gt;', $xmlStr);
        $xmlStr = str_replace('"', '&quot;', $xmlStr);
        $xmlStr = str_replace("'", '&apos;', $xmlStr);
        $xmlStr = str_replace("&", '&amp;', $xmlStr);

        return $xmlStr;
    }

    public function curPageURL()
    {
        $pageURL = 'http';
//                  if($_SERVER["https"] == "on") {
//                        $pageURL .= "s";
//                  }
        $pageURL .= "://";
        if ($_SERVER["SERVER_PORT"] != "80") {
            $pageURL .= $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . $_SERVER["REQUEST_URI"];
        } else {
            $pageURL .= $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
        }

        return $pageURL;
    }

    public function checkMobile()
    {
        if (preg_match("/Mobile|Android|BlackBerry|iPhone|Windows Phone/", $_SERVER['HTTP_USER_AGENT'])) {
            $location = 'http://m.rwandaguide.info/';
            $this->redirect($location);
        }
    }

    public function getRandomPic($imagesDir)
    {
        $images = glob($imagesDir . '*.{jpg,jpeg,png,gif}', GLOB_BRACE);
        //$im = new Imagick($images);
        //$im->optimizeImageLayers();
        $randomImage = $images[array_rand($images)];

        //$im->writeImages($randomImage, true);
        return $randomImage;
    }

    public function visitorLog($current_page)
    {
        date_default_timezone_set('Africa/Cairo');
        $ip_address = getenv('REMOTE_ADDR');
        $date = date("d-m-Y H:i:s");
        $file = fopen("visitor_log.txt", "a");
        $details = json_decode(file_get_contents("http://ipinfo.io/{$ip_address}/json"));
        $logs = $date . " ; " . $ip_address . " ; " . $details->country . " ; " . $details->region . " ; " . $details->city . " ; " . $current_page . "\n";
        fwrite($file, $logs) or die("Could not write to file!");
        fclose($file);
    }

    public function imageResize($file, $new, $path, $height, $width)
    {
        $this->makeDir($new, $path);
        $target = $new;

        $handle = opendir($path);

        if ($file != "." && $file != ".." && !is_dir($path . $file)) {

            $thumb = $path . $file;

            $imageDetails = getimagesize($thumb);

            $originalWidth = $imageDetails[0];

            $originalHeight = $imageDetails[1];

            if ($originalWidth > $originalHeight) {

                $thumbHeight = $height;

                $thumbWidth = ($originalWidth / ($originalHeight / $thumbHeight));

            } else {

                $thumbWidth = $width;

                $thumbHeight = ($originalHeight / ($originalWidth / $thumbWidth));

            }

            $originalImage = ImageCreateFromJPEG($thumb);

            $thumbImage = ImageCreateTrueColor($thumbWidth, $thumbHeight);

            ImageCopyResized($thumbImage, $originalImage, 0, 0, 0, 0, $thumbWidth,
                $thumbHeight, $originalWidth, $originalHeight);

            $filename = $file;

            imagejpeg($thumbImage, $target . $filename, 50);

        }

        closedir($handle);

    }

    public function getResized($source, $w, $h)
    {
        $new = $source . "new/";
        $directory = opendir($source);
        while (($file = readdir($directory)) != false) {
            $this->imageResize($file, $new, $source . '/', $w, $h);
        }
        echo $this->getRandomPic($new);
    }

    public function sendEmail($message, $to, $subject){

        $mail = new SimpleMail();
        $mail->setTo($to, '')
            ->setSubject($subject)
            ->setFrom('bamurangesandrine@gmail.com', 'Sandrine BAMURANGE')
            ->addGenericHeader('Content-Type', 'text/html; charset="utf-8"')
            ->setMessage($message)
            ->setWrap(78);
        $send = $mail->send();

        return $send;

    }

}