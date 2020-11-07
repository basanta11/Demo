<?php
 namespace App\Helpers;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage  ;

class FileUpload{
 public function uploadFile( $file , $folder ) {
	// Store file
	$path = Storage::disk('public_uploads')->put( 'image/'.$folder, $file );
	// Get stored file name
	$fileName = explode( 'public/'.$folder, $path );
	// File nameasas
	return $fileName[0];
}

 function deleteFile( $path ) {
	// Check if configuration exists
		$fullPath = public_path() . '/' . $path;
		if ( File::exists( $fullPath ) ) {
			// File exists
			File::delete( $fullPath );
		
	}
}
}

