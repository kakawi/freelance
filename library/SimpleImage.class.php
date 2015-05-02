<?php
class SimpleImage {
   var $image;
   var $image_type;
   function load($filename) {
      $image_info = getimagesize($filename);
      $this->image_type = $image_info[2];
      if( $this->image_type == IMAGETYPE_JPEG ) {
         $this->image = imagecreatefromjpeg($filename);
      } elseif( $this->image_type == IMAGETYPE_GIF ) {
         $this->image = imagecreatefromgif($filename);
      } elseif( $this->image_type == IMAGETYPE_PNG ) {
         $this->image = imagecreatefrompng($filename);
      }
   }

   function save($filename, $image_type=IMAGETYPE_JPEG, $compression=75, $permissions=null) {
      if( $image_type == IMAGETYPE_JPEG ) {
         imagejpeg($this->image,$filename,$compression);
      } elseif( $image_type == IMAGETYPE_GIF ) {
         imagegif($this->image,$filename);
      } elseif( $image_type == IMAGETYPE_PNG ) {
         imagepng($this->image,$filename);
      }
      if( $permissions != null) {
         chmod($filename,$permissions);
      }
   }

   function output($image_type=IMAGETYPE_JPEG) {
      if( $image_type == IMAGETYPE_JPEG ) {
         imagejpeg($this->image);
      } elseif( $image_type == IMAGETYPE_GIF ) {
         imagegif($this->image);
      } elseif( $image_type == IMAGETYPE_PNG ) {
         imagepng($this->image);
      }
   }

   function getWidth() {
      return imagesx($this->image);
   }
   function getHeight() {
      return imagesy($this->image);
   }

   function resizeToHeight($height) {
      $ratio = $height / $this->getHeight();
      $width = $this->getWidth() * $ratio;
      $this->resize($width,$height);
   }

   function resizeToWidth($width) {
      $ratio = $width / $this->getWidth();
      $height = $this->getHeight() * $ratio;
      $this->resize($width,$height);
   }

   function scale($scale) {
      $width = $this->getWidth() * $scale/100;
      $height = $this->getHeight() * $scale/100;
      $this->resize($width,$height);
   }

   function resize($width,$height) {
      $new_image = imagecreatetruecolor($width, $height);
      imagecopyresampled($new_image, $this->image, 0, 0, 0, 0, $width, $height, $this->getWidth(), $this->getHeight());
      $this->image = $new_image;
   }

   function grey() {
	   $new_img = imageCreate($this->getWidth(),$this->getHeight());
       for ($c = 0; $c < 256; $c++) {
           ImageColorAllocate($new_img, $c,$c,$c);
       }
	   ImageCopyMerge($new_img,$this->image,0,0,0,0, $this->getWidth(), $this->getHeight(), 100);
	   $this->image = $new_img;
   }
   
   function crop($width) {

	        if($this->getHeight() > $this->getWidth())
	        {
	            $im2 = imagecreatetruecolor($this->getWidth(), $this->getWidth());
                imagecopyresampled($im2,$this->image,0,(-(($this->getHeight() - $this->getWidth())/2)),0,0,$this->getWidth(),$this->getHeight(),$this->getWidth(),$this->getHeight());
                $this->image = $im2;
	        } else {
	            $im2 = imagecreatetruecolor($this->getHeight(), $this->getHeight());
                imagecopyresampled($im2,$this->image,(-(($this->getWidth() - $this->getHeight())/2)),0,0,0,$this->getWidth(),$this->getHeight(),$this->getWidth(),$this->getHeight());
                $this->image = $im2;
	        }
        $this->resizeToWidth($width);
   }
   
   function cropTo($w,$h) {
       $this->resizeToWidth($w);
	   if($this->getHeight() > $this->getWidth()) {
           $im2 = imagecreatetruecolor($w,$h);
           imagecopyresampled($im2,$this->image,0,0,0,($this->getHeight()-$h)/2,$this->getWidth(),$this->getHeight(),$this->getWidth(),$this->getHeight());
           $this->image = $im2;
	   } else {
           $im2 = imagecreatetruecolor($w, $h);
           imagecopyresampled($im2,$this->image,0,0,0,($this->getHeight()-$h)/2,$this->getWidth(),$this->getHeight(),$this->getWidth(),$this->getHeight());
           $this->image = $im2;
	   }
   }
}