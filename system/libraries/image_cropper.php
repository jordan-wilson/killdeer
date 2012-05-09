<?php

define("ccTOPLEFT",     0);
define("ccTOP",         1);
define("ccTOPRIGHT",    2);
define("ccLEFT",        3);
define("ccCENTRE",      4);
define("ccCENTER",      4);
define("ccRIGHT",       5);
define("ccBOTTOMLEFT",  6);
define("ccBOTTOM",      7);
define("ccBOTTOMRIGHT", 8);


class image_cropper
{
    private $_img_orig   = null;
    private $_img_final  = null;
	private $_ext        = null;
    private $_show_debug = false;
    private $gd_stats    = array();
    private $jpeg_ext;
    private $image_path;
    
    function __construct($image_path, $debug = false)
    {
        $this->set_debugging($debug);
        $this->gd_stats = $this->get_gd_info();
        if (isset($this->gd_stats['JPG Support'])) 
        {
        	$this->jpeg_ext = 'jpg';
        } 
        elseif($this->gd_stats['JPEG Support']) 
        {
        	$this->jpeg_ext = 'jpeg';
        }
        $this->image_path = $image_path;
        $this->load_image();
    }

    //
	// DETERMINES THE DIMENSIONS FOR CROPPING AN IMAGE BY A CERTAIN AMOUNT
    //
    function crop_by_size($x, $y, $position = ccCENTER)
    {
        $nx = (!$x) ? imagesx($this->_imgOrig) : imagesx($this->_imgOrig) - $x;
        $ny = (!$y) ? imagesy($this->_imgOrig) : imagesy($this->_imgOrig) - $y;
        return ($this->_crop_size(-1, -1, $nx, $ny, $position));
    }
    
    

    //
	// DETERMINES THE DIMENSIONS FOR CROPPING AN IMAGE TO A CERTAIN SIZE
	//
    function crop_to_size($x, $y, $position = ccCENTER)
    {
        return ($this->_crop_size(-1, -1, ($x <= 0 ? 1 : $x), ($y <= 0 ? 1 : $y), $position));
    }
    
    

    //
	// USED FOR CROPPING AT A SPECIFIC LOCATION (GIVEN START X/Y AND END X/Y)
	//
    function crop_to_dimensions($sx, $sy, $ex, $ey)
    {
        return ($this->_crop_size($sx, $sy, abs($ex - $sx), abs($ey - $sy), null));
    }
    
    

    //
	// DETERMINES THE DIMENSION FOR CROPPING IMAGE BY A CERTAIN AMOUNT
	//
    function crop_by_percent($px, $py, $position = ccCENTRE)
    {
        $nx = (!$px) ? imagesx($this->_img_orig) : (imagesx($this->_imgOrig) - (($px / 100) * imagesx($this->_img_orig)));
        $ny = (!$py) ? imagesy($this->_img_orig) : (imagesy($this->_imgOrig) - (($py / 100) * imagesy($this->_img_orig)));
        return ($this->_crop_size(-1, -1, $nx, $ny, $position));
    }
    
    

    //
	// DETERMINES THE DIMENSIONS FOR CROPPING IMAGE TO A CERTAIN SIZE
	//
    function crop_to_percent($px, $py, $position = ccCENTRE)
    {
        $nx = (!$px) ? imagesx($this->_img_orig) : (($px / 100) * imagesx($this->_img_orig));
        $ny = (!$py) ? imagesy($this->_img_orig) : (($py / 100) * imagesy($this->_img_orig));
        return ($this->_crop_size(-1, -1, $nx, $ny, $position));
    }
    
    

    //
    // DETERMINES CROPPING DIMENSIONS BASED ON THRESHOLD LEVEL
	//
    function crop_by_auto($threshold = 254)
    {
        if ($threshold < 0) {
            $threshold = 0;
        }
        if ($threshold > 255) {
            $threshold = 255;
        }
        $sizex = imagesx($this->_img_orig);
        $sizey = imagesy($this->_img_orig);
        $sx = $sy = $ex = $ey = -1;
        for ($y = 0; $y < $sizey; $y++) 
        {
            for ($x = 0; $x < $sizex; $x++) 
            {
                if ($threshold >= $this->_get_threshold_value($this->_img_orig, $x, $y)) 
                {
                    if ($sy == -1) 
                        $sy = $y;
                    else 
                        $ey = $y;
                        
                    if ($sx == -1) 
                        $sx = $x;
                    else 
                    {
                        if ($x < $sx) 
                            $sx = $x;
                        else if ($x > $ex) 
                            $ex = $x;
                    }
                }
            }
        }
        return ($this->_crop_size($sx, $sy, abs($ex - $sx), abs($ey - $sy), ccTOPLEFT));
    }

    //
    // DESTROY THE RESOURCES USED BY THE IMAGES
    //
    function flush_images($original = true)
    {
        imagedestroy($this->_img_final);
        $this->_img_final = null;
        if ($original) 
        {
            imagedestroy($this->_img_orig);
            $this->_img_orig = null;
        }
    }

    //
    // CREATES THE CROPPED IMAGE BASED ON PASSED PARAMETERS
	//
    function _crop_size($ox, $oy, $nx, $ny, $position)
    {
        if ($this->_img_orig == null) 
        {
            $this->_debug('The original image has not been loaded.');
            return false;
        }
        if (($nx <= 0) || ($ny <= 0)) 
        {
            $this->_debug('The image could not be cropped because the size given is not valid.');
            return false;
        }
        if (($nx > imagesx($this->_img_orig)) || ($ny > imagesy($this->_img_orig))) 
        {
            $this->_debug('The image could not be cropped because the size given is larger than the original image.');
            return false;
        }
        if ($ox == -1 || $oy == -1) 
        {
            list($ox, $oy) = $this->_get_copy_position($nx, $ny, $position);
        }
        if ($this->gd_stats['Truecolor Support']) 
        {
            $this->_img_final = imagecreatetruecolor($nx, $ny);

			
			// PRESERVE PNG & GIF TRANSPARENCY
			if ($this->_ext == 'gif') 
			{
				// ADD A GREEN BACKGROUND THEM REMOVE IT
				$trnprt_indx = imagecolortransparent($this->_img_orig);
				if ($trnprt_indx >= 0) 
				{
					$trnprt_color = imagecolorsforindex($this->_img_orig, $trnprt_indx);
					$trnprt_indx = imagecolorallocate($this->_img_final, $trnprt_color['red'], $trnprt_color['green'], $trnprt_color['blue']);
					imagefill($this->_img_final, 0, 0, $trnprt_indx); 
					imagecolortransparent($this->_img_final, $trnprt_indx);
				}
			}
			if ($this->_ext == 'png') { 
                imagealphablending($this->_img_final, false); 
            }

            imagecopyresampled($this->_img_final, $this->_img_orig, 0, 0, $ox, $oy, $nx, $ny, $nx, $ny);
        } 
        else 
        {
            $this->_img_final = imagecreate($nx, $ny);
            imagecopyresampled($this->_img_final, $this->_img_orig, 0, 0, $ox, $oy, $nx, $ny, $nx, $ny);
        }
        return true;
    }
    
    

    //
	// DETERMINE POSITION OF THE CROP
	//
    function _get_copy_position($nx, $ny, $position)
    {
        $ox = imagesx($this->_img_orig);
        $oy = imagesy($this->_img_orig);

        switch($position) {
            case ccTOPLEFT:
                return array(0, 0);
            case ccTOP:
                return array(ceil(($ox - $nx) / 2), 0);
            case ccTOPRIGHT:
                return array(($ox - $nx), 0);
            case ccLEFT:
                return array(0, ceil(($oy - $ny) / 2));
            case ccCENTRE:
                return array(ceil(($ox - $nx) / 2), ceil(($oy - $ny) / 2));
            case ccRIGHT:
                return array(($ox - $nx), ceil(($oy - $ny) / 2));
            case ccBOTTOMLEFT:
                return array(0, ($oy - $ny));
            case ccBOTTOM:
                return array(ceil(($ox - $nx) / 2), ($oy - $ny));
            case ccBOTTOMRIGHT:
                return array(($ox - $nx), ($oy - $ny));
        }
        
        return array();
    }
    
    
    

    //
    // DETERMINES THE INTENSITY VALUE OF A PIXEL AT THE PASSED CO-ORDINATES
	//
    function _get_threshold_value($im, $x, $y)
    {
        $rgb = imagecolorat($im, $x, $y);
        $r = ($rgb >> 16) & 0xFF;
        $g = ($rgb >> 8) & 0xFF;
        $b = $rgb & 0xFF;
        return (($r + $g + $b) / 3);
    }
    
    

    //
    // GET THE EXTENSION OF A FILE NAME
	//
    function _get_extension($file)
    {
        $ext = '';
        if (strrpos($file, '.')) 
        {
            $ext = strtolower(substr($file, (strrpos($file, '.') ? strrpos($file, '.') + 1 : strlen($file)), strlen($file)));
        }
        return $ext;
    }

    //
    // VALIDATE WHETHER IMAGE READING/WRITING ROUTINES ARE VALID
	//
    function _is_supported($file_name, $extension, $function, $write = false)
    {
        $giftype = ($write) ? ' Create Support' : ' Read Support';
        $support = strtoupper($extension) . ($extension == 'gif' ? $giftype : ' Support');

        if ($extension == 'jpeg' || $extension == 'jpg') 
        {
			if (!isset($this->gd_stats['JPG Support']) && !isset($this->gd_stats['JPEG Support'])) 
			{
            	$request = ($write) ? 'saving' : 'reading';
            	$this->_debug("Support for $request the file type '$extension' cannot be found.");
            	return false;
            }
		} 
		elseif (!isset($this->gd_stats[$support]) || $this->gd_stats[$support] == false) 
		{
            $request = ($write) ? 'saving' : 'reading';
            $this->_debug("Support for $request the file type '$extension' cannot be found.");
            return false;
        }
        if (!function_exists($function)) 
        {
            $request = ($write) ? 'save' : 'read';
            $this->_debug("The '$function' function required to $request the '$file_name' file cannot be found.");
            return false;
        }

        return true;
    }

    //
    // GATHERS THE GD VERSION INFORMATION
    //
    function get_gd_info($just_version = false)
    {
        $gd_stats = array();

        if (function_exists('gd_info')) 
        {
            $gd_stats = gd_info();
        } 
        else 
        {
            $gd = array(
                    'GD Version'         => '',
                    'FreeType Support'   => false,
                    'FreeType Linkage'   => '',
                    'T1Lib Support'      => false,
                    'GIF Read Support'   => false,
                    'GIF Create Support' => false,
                    'JPG Support'        => false,
                    'PNG Support'        => false,
                    'WBMP Support'       => false,
                    'XBM Support'        => false
                    );
            ob_start();
            phpinfo();
            $buffer = ob_get_contents();
            ob_end_clean();
            foreach (explode("\n", $buffer) as $line) 
            {
                $line = array_map('trim', (explode('|', strip_tags(str_replace('</td>', '|', $line)))));
                if (isset($gd[$line[0]])) 
                {
                    if (strtolower($line[1]) == 'enabled') 
                    {
                        $gd[$line[0]] = true;
                    } 
                    else {
                        $gd[$line[0]] = $line[1];
                    }
                }
            }
            $gd_stats = $gd;
        }

        if (isset($gd_stats['JIS-mapped Japanese Font Support'])) 
        {
            unset($gd_stats['JIS-mapped Japanese Font Support']);
        }
        if (function_exists('imagecreatefromgd')) 
        {
            $gd_stats['GD Support'] = true;
        }
        if (function_exists('imagecreatefromgd2')) 
        {
            $gd_stats['GD2 Support'] = true;
        }
        if (preg_match('/^(bundled|2)/', $gd_stats['GD Version'])) 
        {
            $gd_stats['Truecolor Support'] = true;
        } 
        else 
        {
            $gd_stats['Truecolor Support'] = false;
        }
        if ($gd_stats['GD Version'] != '') 
        {
            $match = array();
            if (preg_match('/([0-9\.]+)/', $gd_stats['GD Version'], $match)) 
            {
                $foo = explode('.', $match[0]);
                $gd_stats['Version'] = array('major' => $foo[0], 'minor' => $foo[1], 'patch' => $foo[2]);
            }
        }

        return ($just_version) ? $gd_stats['Version'] : $gd_stats;
    }
    
    
    function set_debugging($do = false)
    {
        $this->_show_debug = ($do === true) ? true : false;
    }
    
    function load_image()
    {
        $file_name = $this->image_path;
        
        $ext = strtolower($this->_get_extension($file_name));
        if ($ext == 'jpg' || $ext == 'jpeg') 
        {
        	$ext = $this->jpeg_ext;
        }
		$this->_ext = $ext;
        $func = 'imagecreatefrom' . $ext;
        if (!$this->_is_supported($file_name, $ext, $func, false)) 
        {
            return false;
        }

        $this->_img_orig = $func($file_name);
        if ($this->_img_orig == null) 
        {
            $this->_debug("The image could not be created from the '$file_name' file using the '$func' function.");
            return false;
        }

        return true;
    }
    
    //
    // SAVE AN IMAGE
    //
    function save($quality = 90, $force_type = '')
    {
        $file_name = $this->image_path;
        if ($this->_img_final == null) 
        {
            $this->_debug('There is no cropped image to save.');
            return false;
        }

        $ext  = ($force_type == '') ? $this->_get_extension($file_name) : strtolower($force_type);
        $func = 'image' . ($ext == 'jpg' ? 'jpeg' : $ext);
        if (!$this->_is_supported($file_name, $ext, $func, true)) 
        {
            return false;
        }

        $saved = false;
        switch($ext) 
        {
            case 'gif':
                if ($this->gd_stats['Truecolor Support'] && imageistruecolor($this->_img_final)) 
                {
                    imagetruecolortopalette($this->_img_final, false, 255);
                }
            case 'png':
                // PRESERVE PNG TRANSPARENCY
				imagesavealpha($this->_img_final, true); 
                $saved = $func($this->_img_final, $file_name);
                break;
            case 'jpg':
                $saved = $func($this->_img_final, $file_name, $quality);
                break;
            case 'jpeg':
                $saved = $func($this->_img_final, $file_name, $quality);
                break;
        }

        if ($saved == false) 
        {
            $this->_debug("The image could not be saved to the '$file_name' file as the file type '$ext' using the '$func' function.");
            return false;
        }

        return true;
    }
    
    

    //
    // SHOWS THE MASKED IMAGE WITHOUT ANY SAVING
    //
    function show_image($type = 'png', $quality = 90)
    {
        if ($this->_img_final == null) 
        {
            $this->_debug('There is no cropped image to show.');
            return false;
        }

        $type = strtolower($type);
        $func = 'image' . ($type == 'jpg' ? 'jpeg' : $type);
        $head = 'image/' . ($type == 'jpg' ? 'jpeg' : $type);
        
        if (!$this->_is_supported('[showing file]', $type, $func, false)) 
        {
            return false;
        }

        header("Content-type: $head");
        switch($type) {
            case 'gif':
                if ($this->gdInfo['Truecolor Support'] && imageistruecolor($this->_imgFinal)) {
                    imagetruecolortopalette($this->_imgFinal, true, 255);
                }
            case 'png':
                $func($this->_imgFinal);
                break;
            case 'jpg':
                $func($this->_imgFinal, '', $quality);
                break;
        }

        return true;
    }
    
    

    

    //
    // DISPLAY SOME SIMPLE TEXTUAL DEBUGGING
    //
    function _debug($string)
    {
        if ($this->_show_debug) 
        {
            echo '<p class="debug">', $string, "</p>\n";
        }
    }
}

