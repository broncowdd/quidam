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
function file_curl_contents($url){

    if (function_exists('curl_init')){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,  FALSE);     
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);     
        curl_setopt($ch, CURLOPT_URL, $url);     
        if (!ini_get("safe_mode") && !ini_get('open_basedir') ) {curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);}    
        curl_setopt($ch, CURLOPT_MAXREDIRS, 10); 
        curl_setopt($ch, CURLOPT_REFERER, 'http://oudanstoncul.free.fr');// notez le referer "custom"
        $data = curl_exec($ch);     
        curl_close($ch);     
    }else{
        $data=file_get_contents($url);
    }
    return $data; 
}
