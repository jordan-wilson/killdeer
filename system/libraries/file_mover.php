<?php

class file_mover
{
    
public function move($file_path, $new_directory)
    {
        $new_file = $this->copy($file_path, $new_directory);
        unlink($file_path);
        return $new_file;
    }
    
public function copy($file_path, $new_directory)
    {
    
        // TRIM TRAILING SLASH FROM $new_directory
        if (substr($new_directory, -1) == '/')
        {
            $new_directory = substr($new_directory, 0, -1);
        }
        
        // SEPARATE PARTS OF $file_path
        $path_info = pathinfo($file_path);
        $orig_directory = $path_info['dirname'];
        $file_base = $path_info['filename'];
        $file_ext = $path_info['extension'];
        
        // IF THERE ISN'T ALREADY A FILE IN THE NEW DIRECTORY
        // WITH THE SAME NAME, MOVE THE FILE AND RETURN FILENAME
        if ( ! file_exists($new_directory . '/' . $file_base . '.' . $file_ext))
        {
            if( ! @copy($file_path, $new_directory . '/' . $file_base . '.' . $file_ext)) exit($file_path);
            return $file_base . '.' . $file_ext;
        }
        
        // IF THERE IS A CONFLICT, INCREMENT THE NUMBER AT THE END
        // OF THE FILE NAME UNTIL THERE IS NO CONFLICT
        else
        {
            $i = 1;
            while (file_exists($new_directory . '/' . $file_base . '_' . $i . '.' . $file_ext))
            {
                $i++;
            }
            copy($file_path, $new_directory . '/' . $file_base . '_' . $i . '.' . $file_ext);
            return $file_base . '_' . $i . '.' . $file_ext;
        }
    }
    
}