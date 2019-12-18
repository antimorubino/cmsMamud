<?php
// include composer autoload
require '../vendor/autoload.php';

// import the Intervention Image Manager Class
use Intervention\Image\ImageManagerStatic as Image;

// open an image file
Image::configure(array('driver' => 'gd'));
$img = Image::make('../storage/FerMetalSud_2.png');

// resize the image to a width of 300 and constrain aspect ratio (auto height)
$img->resize(300, null, function ($constraint) {
    $constraint->aspectRatio();
});

// now you are able to resize the instance
//$img->resize(320, 240);

// and insert a watermark for example
//$img->insert('public/watermark.png');

// finally we save the image as a new file
$img->save('../storage/content/FerMetalSud_2.png');
?>
