<?php 
class zip{
	
	private $zip_file;

	public function __construct(){

	}

	###########################
	# METHODS #################
	###########################

	# create
	###########################
	public function create($source,$destination,$uploadPath){

		$zip = new ZipArchive();
		if (is_file($destination)){
			unlink($destination);
		}
		if (!$zip->open($destination, ZIPARCHIVE::CREATE)) {
			return false;
		}
		$zip->addGlob(addSlash($source).'*.jpg');
		$this->zipfile=$destination;
	}

	# unzip
	###########################
	public function unzip($file,$destination){
		$zip = new ZipArchive() ;
	    if ($zip->open($file) !== TRUE) {return false;} 
	   	$zip->extractTo($destination); 
	    $zip->close(); 
	    return true; 
	}
	
	# download
	###########################
	public function download(){
		header('Content-type: application/zip');
		header('Content-Transfer-Encoding: binary');
		header('Content-Length: '.filesize($this->zipfile));
		header('Content-Disposition: attachment; filename="'.basename($this->zipfile).'"');
		readfile($this->zipfile);
	}

}
