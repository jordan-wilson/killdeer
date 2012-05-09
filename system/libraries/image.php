<?php

class image 
{

public static function add_image($filepath, $current_params = array(), $thumb_params = array())
    {
        if ( ! file_exists($filepath))
        {
            return false;
        }
        
        // LOAD LIBRARIES
        $file_mover = load_library('file_mover');
        load_helper('image_resizer', FALSE);
        load_helper('image_cropper', FALSE);
            
        // GET FILE, DIRECTORY NAME FROM PATH
        $filename = basename($filepath);
        $directory = dirname($filepath);
        
        // INIT PARAMS
        $current_params['constraint'] = $current_params['constraint'] ? $current_params['constraint'] : 'ratio';
        $thumb_params['constraint']   = $thumb_params['constraint']   ? $thumb_params['constraint']   : 'crop';
        
        // MOVE AND RESIZE ORIGINAL
        $new_file_name = $file_mover->move($filepath, SITE_ROOT . '/files/i/original');
        $image_resizer = new image_resizer(SITE_ROOT . '/files/i/original/' . $new_file_name);
        $image_resizer->resize_by_ratio(IMG_MAX_WIDTH, IMG_MAX_HEIGHT);
        $image_resizer->save();
        
        // COPY ORIGINAL TO CURRENT AND RESIZE OR CROP
        $file_mover->copy(SITE_ROOT . '/files/i/original/' . $new_file_name, SITE_ROOT . '/files/i/current');
        switch ($current_params['constraint'])
        {
            case 'max_width':
                $new_width = $current_params['width'] ? $current_params['width'] : IMG_DEFAULT_CURRENT_WIDTH;
                $image_resizer = new image_resizer(SITE_ROOT . '/files/i/current/' . $new_file_name);
                $image_resizer->resize_by_width($new_width);
                $image_resizer->save();
                break;
            case 'max_height':
                $new_height = $current_params['height'] ? $current_params['height'] : IMG_DEFAULT_CURRENT_HEIGHT;
                $image_resizer = new image_resizer(SITE_ROOT . '/files/i/current/' . $new_file_name);
                $image_resizer->resize_by_height($new_height);
                $image_resizer->save();
                break;
            case 'ratio':
                $new_width = $current_params['width'] ? $current_params['width'] : IMG_DEFAULT_CURRENT_WIDTH;
                $new_height = $current_params['height'] ? $current_params['height'] : IMG_DEFAULT_CURRENT_HEIGHT;
                $image_resizer = new image_resizer(SITE_ROOT . '/files/i/current/' . $new_file_name);
                $image_resizer->resize_by_ratio($new_width, $new_height);
                $image_resizer->save();
                break;
            case 'crop':
            	$new_width = $current_params['width'] ? $current_params['width'] : IMG_DEFAULT_CURRENT_WIDTH;
            	$new_height = $current_params['height'] ? $current_params['height'] : IMG_DEFAULT_CURRENT_HEIGHT;
            	// resize it first
            	$image_resizer = new image_resizer(SITE_ROOT . '/files/i/current/' . $new_file_name);
            	$image_resizer->resize_reverse_ratio($new_width, $new_height);
            	$image_resizer->save();
            	// then crop
            	$image_cropper = new image_cropper(SITE_ROOT . '/files/i/current/' . $new_file_name, TRUE);
            	$image_cropper->crop_to_size($new_width, $new_height);
            	$image_cropper->save();
                break;
            default:
                break;
        }
        
        // COPY CURRENT TO THUMB AND RESIZE
        $file_mover->copy(SITE_ROOT . '/files/i/current/' . $new_file_name, SITE_ROOT . '/files/i/thumb');
        switch ($current_params['constraint'])
        {
            case 'max_width':
                $new_width = $thumb_params['width'] ? $thumb_params['width'] : IMG_DEFAULT_THUMB_WIDTH;
                $image_resizer = new image_resizer(SITE_ROOT . '/files/i/thumb/' . $new_file_name);
                $image_resizer->resize_by_width($new_width);
                $image_resizer->save();
                break;
            case 'max_height':
                $new_height = $thumb_params['height'] ? $thumb_params['height'] : IMG_DEFAULT_THUMB_HEIGHT;
                $image_resizer = new image_resizer(SITE_ROOT . '/files/i/thumb/' . $new_file_name);
                $image_resizer->resize_by_height($new_height);
                $image_resizer->save();
                break;
            case 'ratio':
                $new_width = $thumb_params['width'] ? $thumb_params['width'] : IMG_DEFAULT_THUMB_WIDTH;
                $new_height = $thumb_params['height'] ? $thumb_params['height'] : IMG_DEFAULT_THUMB_HEIGHT;
                $image_resizer = new image_resizer(SITE_ROOT . '/files/i/thumb/' . $new_file_name);
                $image_resizer->resize_by_ratio($new_width, $new_height);
                $image_resizer->save();
                break;
            case 'crop':
                $new_width = $thumb_params['width'] ? $thumb_params['width'] : IMG_DEFAULT_THUMB_WIDTH;
                $new_height = $thumb_params['height'] ? $thumb_params['height'] : IMG_DEFAULT_THUMB_HEIGHT;
                $image_resizer = new image_resizer(SITE_ROOT . '/files/i/thumb/' . $new_file_name);
                $image_resizer->resize_reverse_auto($new_width, $new_height);
                $image_resizer->save();
                $image_cropper = new image_cropper(SITE_ROOT . '/files/i/thumb/' . $new_file_name, TRUE);
                $image_cropper->crop_to_size($new_width, $new_height);
                $image_cropper->save();
                break;
            default:
                break;
        }
        
        return $new_file_name;
    }

}