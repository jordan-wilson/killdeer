<?php

class image_resizer
{
    
private $img;
    
function __construct($img_file) 
    {
    
    	//detect image format
    	$this->img["format"]=preg_replace("|.*\.(.*)$|","\\1",$img_file);
    	$this->img["format"]=strtoupper($this->img["format"]);
    	
    	//JPEG
    	if ($this->img["format"]=="JPG" || $this->img["format"]=="JPEG") 
    	{
    		$this->img["format"]="JPEG";
    		$this->img["src"] = ImageCreateFromJPEG ($img_file);
    	} 
        //PNG
    	elseif ($this->img["format"]=="PNG") 
    	{
    		$this->img["format"]="PNG";
    		$this->img["src"] = ImageCreateFromPNG ($img_file);
    	} 
        //GIF
    	elseif ($this->img["format"]=="GIF") 
    	{
    		$this->img["format"]="GIF";
    		$this->img["src"] = ImageCreateFromGIF ($img_file);
    	} 
        //WBMP
    	elseif ($this->img["format"]=="WBMP") 
    	{
    		$this->img["format"]="WBMP";
    		$this->img["src"] = ImageCreateFromWBMP ($img_file);
    	} 
    	else 
    	{
    		return false;
    	}
    	
    	$this->img['orig_path'] 	= $img_file;
    	$this->img['orig_width'] 	= imagesx($this->img['src']);
    	$this->img['new_width'] 	= $this->img['orig_width'];
    	$this->img['orig_height'] 	= imagesy($this->img['src']);
    	$this->img['new_height'] 	= $this->img['orig_height'];
    	$this->img["quality"]		= 90;
    	
    }
    
function set_jpeg_quality($q = 90) 
    {
    	$this->img['quality'] = $q;
    }
    
function resize_by_height($height = 100) 
    {
    	if ($height < $this->img['orig_height']) 
    	{
    		$this->img['new_height'] = $height;
    		$ratio = $this->img['orig_width'] / $this->img['orig_height'];
    		$this->img['new_width'] = ceil($ratio * $this->img['new_height']);
    	}
    }
    
function resize_by_width($width = 100) 
    {
    	if ($width < $this->img['orig_width']) 
    	{
    		$this->img['new_width'] = $width;
    		$ratio = $this->img['orig_height'] / $this->img['orig_width'];
    		$this->img['new_height'] = ceil($ratio * $this->img['new_width']);	
    	} 
    }
    
    
    

// RESIZE THE IMAGE ACCORDING TO WHICH DIMENSION IS LONGER

function resize_auto($length = 100) 
    {
    	if($this->img['orig_height'] > $length || $this->img['orig_width'] > $length) 
    	{
    		if($this->img['orig_height'] > $this->img['orig_width']) 
    		{
    			$this->resize_by_height($length);
    		} 
    		else 
    		{
    			$this->resize_by_width($length);
    		}
    	}
    }
    
    
    
    
//
// RESIZE THE IMAGE ACCORDING TO WHICH DIMENSION IS SHORTER
//
function resize_reverse_auto($length = 100) 
    {
    	if($this->img['orig_height'] > $length || $this->img['orig_width'] > $length) 
    	{
    		if($this->img['orig_height'] > $this->img['orig_width']) 
    		{
    			$this->resize_by_width($length);
    		} 
    		else 
    		{
    			$this->resize_by_height($length);
    		}
    	}
    }
    
    
    
// 
// RESIZE THE IMAGE TO FIT WITHIN THE BOUNDARIES OF THE GIVEN DIMENSIONS
//
function resize_by_ratio($width, $height) 
    {
    	$ratio = $width / $height;
    	$img_ratio = $this->img['orig_width'] / $this->img['orig_height'];
    	if($img_ratio > $ratio) 
    	{
    		$this->resize_by_width($width);
    	} 
    	else 
    	{
    		$this->resize_by_height($height);
    	}
    }
    
    
    
//
// RESIZE THE IMAGE TO BE NOT NOT SMALLER THAN 
// EITHER OF THE GIVEN DIMENSIONS
//
function resize_reverse_ratio($width, $height) 
    {
    	$ratio = $width / $height;
    	$img_ratio = $this->img['orig_width'] / $this->img['orig_height'];
    	if($img_ratio > $ratio) 
    	{
    		$this->resize_by_height($height);
    	} 
    	else 
    	{
    		$this->resize_by_width($width);
    	}
    }
    
    
    
//
// OUTPUT NEW IMAGE
//
function show() 
    {
    	header("Content-Type: image/".$this->img["format"]);
    	$this->img['des'] = @imagecreatetruecolor($this->img['new_width'], $this->img['new_height'])
    		or die("Cannot create image.");
    	imagecopyresampled($this->img['des'], $this->img['src'], 0, 0, 0, 0, $this->img['new_width'], $this->img['new_height'], $this->img['orig_width'], $this->img['orig_height']);
    	
    	//JPEG
    	if ($this->img["format"]=="JPG" || $this->img["format"]=="JPEG") 
    		imageJPEG($this->img["des"],"",$this->img["quality"]);
    		
    	//PNG
    	elseif ($this->img["format"]=="PNG") 
    		imagePNG($this->img["des"]);
    		
    	//GIF
    	elseif ($this->img["format"]=="GIF") 
    		imageGIF($this->img["des"]);
    		
    	//WBMP
    	elseif ($this->img["format"]=="WBMP") 
    		imageWBMP($this->img["des"]);
    }
    
    
    
    
//
// SAVE NEW IMAGE
// if the path ($save) is left blank, this will overwrite the original file
//
function save($save="")
    {
    	//save thumb
    	if (empty($save)) 
    	{
    	   $save=$this->img['orig_path'];
        }
    	$this->img["des"] = ImageCreateTrueColor($this->img["new_width"],$this->img["new_height"]);
    	imagecopyresampled($this->img['des'], $this->img['src'], 0, 0, 0, 0, $this->img['new_width'], $this->img['new_height'], $this->img['orig_width'], $this->img['orig_height']);
    	//JPEG
        if ($this->img["format"]=="JPG" || $this->img["format"]=="JPEG") 
        {
    		imageJPEG($this->img["des"],"$save",$this->img["quality"]);
    	} 
    	//PNG
        elseif ($this->img["format"]=="PNG") 
        {
    		imagePNG($this->img["des"],"$save");
    	} 
    	//GIF
        elseif ($this->img["format"]=="GIF") 
        {
    		imageGIF($this->img["des"],"$save");
    	} 
    	//WBMP
    	elseif ($this->img["format"]=="WBMP") 
    	{
    		imageWBMP($this->img["des"],"$save");
    	}
    }
}


