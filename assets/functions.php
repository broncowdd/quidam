<?php
function addSlash($string){
    if (substr($string,strlen($string)-1,1)!='/'&&!empty($string)){return $string.'/';}else{return $string;}
}
function _baseName($file=''){
    $array=explode('/',$file);
    if (is_array($array)){return end($array);}else{return $file;}
}
function clearTemp(){
	$temp='temp/';
	$temp_content=glob($temp.'*');
	foreach ($temp_content as $temp_item) {
		if (filemtime($temp_item)+TEMP_DURATION<time()){
			if (is_file($temp_item)){
				unlink($temp_item);
			}else{
				deleteDir($temp_item);
			}
		}
	}
	
}
function deleteDir($dir){
    # delete a folder and its content
    if (is_dir($dir)) { 
        $objects = scandir($dir); 
        foreach ($objects as $object) { 
            if ($object != "." && $object != "..") { 
                if (filetype($dir."/".$object) == "dir") deleteDir($dir."/".$object); else unlink($dir."/".$object); 
            } 
        } 
        reset($objects); 
        rmdir($dir); 
    }       
}