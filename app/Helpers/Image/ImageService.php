<?php

namespace App\Helpers\Image;

use File;
use Intervention\Image\ImageManager;

class ImageService extends ImageManager {

	public $image = null;

	public function upload( $image, $path = null, $keepAspectRation = true ) {
		$this->image = parent::make( $image );
		$this->directory( public_path( $path )  );

		$name = $image->getClientOriginalName();

		$fullPath = public_path( $path ) . '/' . $name;

		$this->image->save( $fullPath );

		$sizes = config( 'image.sizes' );

		foreach ( $sizes as $sizeName => $widthHeight ) {

			list( $width, $height ) = $widthHeight;

			$image = parent::make( $fullPath );
			$canvas = parent::canvas( $width, $height, array(255, 255, 255, 0) );
	
			$image->fit($width, $height, function($constraint)
			{
				$constraint->aspectRatio();
				$constraint->upsize();
			});

			$canvas->insert($image, 'center');

			$sizePath = $image->dirname . '/' . $sizeName . "-" . $image->basename;
			$canvas->save( $sizePath );
		}

		$localImage = new LocalImageFile( $path . '/' . $name );

		return $localImage;
	}

	public function directory( $path ) {
		if ( ! File::exists( $path ) ) {
			File::makeDirectory( $path, 0755, true, true );
		}

		return $this;
	}

	public function destroy() {
		//
	}
}

