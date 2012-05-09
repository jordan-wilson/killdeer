<?php

$path = realpath('.') . '/' . $_FILES['Filedata']['name'];

if(move_uploaded_file($_FILES['Filedata']['tmp_name'], $path)) {
    echo json_encode(array('code' => 'success', 'file' => $_FILES['Filedata']['name']));
    exit;
} else {
    echo json_encode(array('code'=>'error', 'message'=>'Error uploading file'));
    exit;
}
	
?>