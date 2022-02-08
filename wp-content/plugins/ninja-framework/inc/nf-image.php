<?php
/*
 * nf_image - WP Image Resizer v1.0
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

/** Uses WP's Image Editor Class to resize and filter images
 *
 * @param $url string the local image URL to manipulate
 * @param $params array the options to perform on the image. Keys and values supported:
 *          'width' int pixels
 *          'height' int pixels
 *          'opacity' int 0-100
 *          'color' string hex-color #000000-#ffffff
 *          'grayscale' bool
 *          'negate' bool
 *          'crop' bool
 *          'crop_only' bool
 *          'crop_x' bool string
 *          'crop_y' bool string
 *          'crop_width' bool string
 *          'crop_height' bool string
 *			'quality' int 1-100
 * @param $single boolean, if false then an array of data will be returned
 * @return string|array containing the url of the resized modified image
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! function_exists( 'nf_image' ) ) {

	function nf_image( $url, $params = array(), $single = true ) {
	    $class = NFI_Class_Factory::getNewestVersion( 'nf_image' );
	    return call_user_func( array( $class, 'thumb' ), $url, $params, $single );
	}

}


/**
 * Class factory, this is to make sure that when multiple nf_image scripts
 * are used (e.g. a plugin and a theme both use it), we always use the
 * latest version.
 */
if ( ! class_exists( 'NFI_Class_Factory' ) ) {

	class NFI_Class_Factory {

	    public static $versions = array();
	    public static $latestClass = array();


	    public static function addClassVersion( $baseClassName, $className, $version ) {
	        if ( empty( self::$versions[ $baseClassName ] ) ) {
	            self::$versions[ $baseClassName ] = array();
	        }
	        self::$versions[ $baseClassName ][] = array(
	            'class' => $className,
	            'version' => $version
	        );
	    }


	    public static function getNewestVersion( $baseClassName ) {
	        if ( empty( self::$latestClass[ $baseClassName ] ) ) {
	            usort( self::$versions[ $baseClassName ], array( __CLASS__, "versionCompare" ) );
	            self::$latestClass[ $baseClassName ] = self::$versions[ $baseClassName ][0]['class'];
	            unset( self::$versions[ $baseClassName ] );
	        }
	        return self::$latestClass[ $baseClassName ];
	    }


	    public static function versionCompare( $a, $b ) {
	        return version_compare( $a['version'], $b['version'] ) == 1 ? -1 : 1;
	    }
	}

}



/*
 * Change the default image editors
 */
add_filter( 'wp_image_editors', 'NFI_wp_image_editor' );

// Instead of using the default image editors, use our extended ones
if ( ! function_exists( 'NFI_wp_image_editor' ) ) {

	function NFI_wp_image_editor( $editorArray ) {
	    // Make sure that we use the latest versions
	    return array(
	        NFI_Class_Factory::getNewestVersion( 'NFI_Image_Editor_GD' ),
	    );
	}

}


/*
 * Include the WP Image classes
 */

require_once ABSPATH . WPINC . '/class-wp-image-editor.php';
require_once ABSPATH . WPINC . '/class-wp-image-editor-gd.php';


/**
 * check for ImageMagick or GD
 */


add_action( 'admin_init', 'NFI_wp_image_editor_check' );
if ( ! function_exists( 'NFI_wp_image_editor_check' ) ) {

	function NFI_wp_image_editor_check() {
	    $arg = array( 'mime_type' => 'image/jpeg' );
	    if ( wp_image_editor_supports( $arg ) !== true ) {
	        add_filter( 'admin_notices', 'NFI_wp_image_editor_check_notice' );
	    }
	}

}

if ( ! function_exists( 'NFI_wp_image_editor_check_notice' ) ) {
	function NFI_wp_image_editor_check_notice() {
	    printf( "<div class='error'><p>%s</div>",
	        __( "The server does not have ImageMagick or GD installed and/or enabled! Any of these libraries are required for WordPress to be able to resize images. Please contact your server administrator to enable this before continuing.", "default" ) );
	}
}



/*
 * Enhanced GD Image Editor
 */


if ( ! class_exists( 'NFI_Image_Editor_GD_1_3' ) ) {

	NFI_Class_Factory::addClassVersion( 'NFI_Image_Editor_GD', 'NFI_Image_Editor_GD_1_3', '1.3' );

	class NFI_Image_Editor_GD_1_3 extends WP_Image_Editor_GD {


	}
}

/*
 * Main Class
 */
if ( ! class_exists( 'nf_image_1_3' ) ) {

	NFI_Class_Factory::addClassVersion( 'nf_image', 'nf_image_1_3', '1.3' );

	class nf_image_1_3 {

	    /** Uses WP's Image Editor Class to resize and filter images
	     * Inspired by: https://github.com/sy4mil/Aqua-Resizer/blob/master/aq_resizer.php
	     *
	     * @param $url string the local image URL to manipulate
	     * @param $params array the options to perform on the image. Keys and values supported:
	     *          'width' int pixels
	     *          'height' int pixels
	     *          'crop' bool
	     *          'crop_only' bool
	     *          'crop_x' bool string
	     *          'crop_y' bool string
	     *          'crop_width' bool string
	     *          'crop_height' bool string
		 *			'quality' int 1-100
	     * @param $single boolean, if false then an array of data will be returned
	     * @return string|array
	     */
	    public static function thumb( $url, $params = array(), $single = true ) {
	        extract( $params );

	        //validate inputs
	        if ( ! $url ) {
	            return false;
	        }

	        $crop_only = isset( $crop_only ) ? $crop_only : false;

	        //define upload path & dir
	        $upload_info = wp_upload_dir();
	        $upload_dir = $upload_info['basedir'];
	        $upload_url = $upload_info['baseurl'];
	        $theme_url = get_template_directory_uri();
	        $theme_dir = get_template_directory();

	        // find the path of the image. Perform 2 checks:
	        // #1 check if the image is in the uploads folder
	        if ( strpos( $url, $upload_url ) !== false ) {
	            $rel_path = str_replace( $upload_url, '', $url );
	            $img_path = $upload_dir . $rel_path;

	        // #2 check if the image is in the current theme folder
	        } else if ( strpos( $url, $theme_url ) !== false ) {
	            $rel_path = str_replace( $theme_url, '', $url );
	            $img_path = $theme_dir . $rel_path;
	        }

	        // Fail if we can't find the image in our WP local directory
	        if ( empty( $img_path ) ) {
	            return $url;
	        }

	        // check if img path exists, and is an image indeed
	        if( ! @file_exists( $img_path ) || ! getimagesize( $img_path ) ) {
	            return $url;
	        }

	        // This is the filename
	        $basename = basename( $img_path );

	        //get image info
	        $info = pathinfo( $img_path );
	        $ext = $info['extension'];
	        list( $orig_w, $orig_h ) = getimagesize( $img_path );

	        // support percentage dimensions. compute percentage based on
	        // the original dimensions
	        if ( isset( $width ) ) {
	            if ( stripos( $width, '%' ) !== false ) {
	                $width = (int) ( (float) str_replace( '%', '', $width ) / 100 * $orig_w );
	            }
	        }
	        if ( isset( $height ) ) {
	            if ( stripos( $height, '%' ) !== false ) {
	                $height = (int) ( (float) str_replace( '%', '', $height ) / 100 * $orig_h );
	            }
	        }

	        // The only purpose of this is to determine the final width and height
	        // without performing any actual image manipulation, which will be used
	        // to check whether a resize was previously done.
	        if ( isset( $width ) && $crop_only === false ) {
	            //get image size after cropping
	            $dims = image_resize_dimensions( $orig_w, $orig_h, $width, isset( $height ) ? $height : null, isset( $crop ) ? $crop : false );
	            $dst_w = $dims[4];
	            $dst_h = $dims[5];

	        } else if ( $crop_only === true ) {
	            // we don't want a resize,
	            // but only a crop in the image

	            // get x position to start croping
	            $src_x = ( isset( $crop_x ) ) ? $crop_x : 0;

	            // get y position to start croping
	            $src_y = ( isset( $crop_y ) ) ? $crop_y : 0;

	            // width of the crop
	            if ( isset( $crop_width ) ) {
	                $src_w = $crop_width;
	            } else if ( isset( $width ) ) {
	                $src_w = $width;
	            } else {
	                $src_w = $orig_w;
	            }

	            // height of the crop
	            if ( isset( $crop_height ) ) {
	                $src_h = $crop_height;
	            } else if ( isset( $height ) ) {
	                $src_h = $height;
	            } else {
	                $src_h = $orig_h;
	            }

	            // set the width resize with the crop
	            if ( isset( $crop_width ) && isset( $width ) ) {
	                $dst_w = $width;
	            } else {
	                $dst_w = null;
	            }

	            // set the height resize with the crop
	            if ( isset( $crop_height ) && isset( $height ) ) {
	                $dst_h = $height;
	            } else {
	                $dst_h = null;
	            }

	            // allow percentages
	            if ( isset( $dst_w ) ) {
	                if ( stripos( $dst_w, '%' ) !== false ) {
	                    $dst_w = (int) ( (float) str_replace( '%', '', $dst_w ) / 100 * $orig_w );
	                }
	            }
	            if ( isset( $dst_h ) ) {
	                if ( stripos( $dst_h, '%' ) !== false ) {
	                    $dst_h = (int) ( (float) str_replace( '%', '', $dst_h ) / 100 * $orig_h );
	                }
	            }

	            $dims = image_resize_dimensions( $src_w, $src_h, $dst_w, $dst_h, false );
	            $dst_w = $dims[4];
	            $dst_h = $dims[5];

	            // Make the pos x and pos y work with percentages
	            if ( stripos( $src_x, '%' ) !== false ) {
	                $src_x = (int) ( (float) str_replace( '%', '', $width ) / 100 * $orig_w );
	            }
	            if ( stripos( $src_y, '%' ) !== false ) {
	                $src_y = (int) ( (float) str_replace( '%', '', $height ) / 100 * $orig_h );
	            }

	            // allow center to position crop start
	            if ( $src_x === 'center' ) {
	                $src_x = ( $orig_w - $src_w ) / 2;
	            }
	            if ( $src_y === 'center' ) {
	                $src_y = ( $orig_h - $src_h ) / 2;
	            }
	        }

	        // create the suffix for the saved file
	        // we can use this to check whether we need to create a new file or just use an existing one.
	        $suffix = (string) filemtime( $img_path ) .
	            ( isset( $width ) ? str_pad( (string) $width, 5, '0', STR_PAD_LEFT ) : '0' ) .
	            ( isset( $height ) ? str_pad( (string) $height, 5, '0', STR_PAD_LEFT ) : '0' ) .
	            ( isset( $crop ) ? ( $crop ? '1' : '0' ) : '0' ) .
	            ( isset( $crop_only ) ? ( $crop_only ? '1' : '0' ) : '0' ) .
	            ( isset( $src_x ) ? str_pad( (string) $src_x, 5, '0', STR_PAD_LEFT ) : '0' ) .
	            ( isset( $src_y ) ? str_pad( (string) $src_y, 5, '0', STR_PAD_LEFT ) : '0' ) .
	            ( isset( $src_w ) ? str_pad( (string) $src_w, 5, '0', STR_PAD_LEFT ) : '0' ) .
	            ( isset( $src_h ) ? str_pad( (string) $src_h, 5, '0', STR_PAD_LEFT ) : '0' ) .
	            ( isset( $dst_w ) ? str_pad( (string) $dst_w, 5, '0', STR_PAD_LEFT ) : '0' ) .
	            ( isset( $dst_h ) ? str_pad( (string) $dst_h, 5, '0', STR_PAD_LEFT ) : '0' ) .
				( ( isset ( $quality ) && $quality > 0 && $quality <= 100 ) ? ( $quality ? (string) $quality : '0' ) : '0' );
	        $suffix = self::base_convert_arbitrary( $suffix, 10, 36 );

	        // use this to check if cropped image already exists, so we can return that instead
	        $dst_rel_path = str_replace( '.' . $ext, '', basename( $img_path ) );

	        // If opacity is set, change the image type to png
	        if ( isset( $opacity ) ) {
	            $ext = 'png';
	        }


	        // Create the upload subdirectory, this is where
	        // we store all our generated images
	        if ( defined( 'NFITHUMB_UPLOAD_DIR' ) ) {
	            $upload_dir .= "/" . NFITHUMB_UPLOAD_DIR;
	            $upload_url .= "/" . NFITHUMB_UPLOAD_DIR;
	        } else {
	            $upload_dir .= "/nf_image";
	            $upload_url .= "/nf_image";
	        }
	        if ( ! is_dir( $upload_dir ) ) {
	            wp_mkdir_p( $upload_dir );
	        }


	        // desination paths and urls
	        $destfilename = "{$upload_dir}/{$dst_rel_path}-{$suffix}.{$ext}";

			// The urls generated have lower case extensions regardless of the original case
			$ext = strtolower( $ext );
	        $img_url = "{$upload_url}/{$dst_rel_path}-{$suffix}.{$ext}";

	        // if file exists, just return it
	        if ( @file_exists( $destfilename ) && getimagesize( $destfilename ) ) {
	        } else {
	            // perform resizing and other filters
	            $editor = wp_get_image_editor( $img_path );

	            if ( is_wp_error( $editor ) ) return false;

	            /*
	             * Perform image manipulations
	             */
	            if ( $crop_only === false ) {
	                if ( ( isset( $width ) && $width ) || ( isset( $height ) && $height ) ) {
	                    if ( is_wp_error( $editor->resize( isset( $width ) ? $width : null, isset( $height ) ? $height : null, isset( $crop ) ? $crop : false ) ) ) {
	                        return false;
	                    }
	                }
	            } else {
	                if ( is_wp_error( $editor->crop( $src_x, $src_y, $src_w, $src_h, $dst_w, $dst_h ) ) ) {
	                    return false;
	                }
	            }

	            if ( isset( $negate ) ) {
	                if ( $negate ) {
	                    if ( is_wp_error( $editor->negate() ) ) {
	                        return false;
	                    }
	                }
	            }

				// set the image quality (1-100) to save this image at
				if ( isset( $quality ) && $quality > 0 && $quality <= 100 && $ext != 'png' ) {
					$editor->set_quality( $quality );
				}

	            // save our new image
	            $mime_type = isset( $opacity ) ? 'image/png' : null;
	            $resized_file = $editor->save( $destfilename, $mime_type );
	        }

	        //return the output
	        if ( $single ) {
	            $image = $img_url;
	        } else {
	            //array return
	            $image = array (
	                0 => $img_url,
	                1 => isset( $dst_w ) ? $dst_w : $orig_w,
	                2 => isset( $dst_h ) ? $dst_h : $orig_h,
	            );
	        }

	        return $image;
	    }


	    /** Shortens a number into a base 36 string
	     *
	     * @param $number string a string of numbers to convert
	     * @param $fromBase starting base
	     * @param $toBase base to convert the number to
	     * @return string base converted characters
	     */
	    protected static function base_convert_arbitrary( $number, $fromBase, $toBase ) {
	        $digits = '0123456789abcdefghijklmnopqrstuvwxyz';
	        $length = strlen( $number );
	        $result = '';

	        $nibbles = array();
	        for ( $i = 0; $i < $length; ++$i ) {
	            $nibbles[ $i ] = strpos( $digits, $number[ $i ] );
	        }

	        do {
	            $value = 0;
	            $newlen = 0;

	            for ( $i = 0; $i < $length; ++$i ) {

	                $value = $value * $fromBase + $nibbles[ $i ];

	                if ( $value >= $toBase ) {
	                    $nibbles[ $newlen++ ] = (int) ( $value / $toBase );
	                    $value %= $toBase;

	                } else if ( $newlen > 0 ) {
	                    $nibbles[ $newlen++ ] = 0;
	                }
	            }

	            $length = $newlen;
	            $result = $digits[ $value ] . $result;
	        }
	        while ( $newlen != 0 );

	        return $result;
	    }
	}
}



// don't use the default resizer since we want to allow resizing to larger sizes (than the original one)
// Parts are copied from media.php
// Crop is always applied (just like timthumb)
// Don't use this inside the admin since sometimes images in the media library get resized
if ( ! is_admin() ) {
	add_filter( 'image_resize_dimensions', 'NFI_image_resize_dimensions', 10, 5 );
}

if ( ! function_exists( 'NFI_image_resize_dimensions' ) ) {
	function NFI_image_resize_dimensions( $payload, $orig_w, $orig_h, $dest_w, $dest_h, $crop = false ) {
	    $aspect_ratio = $orig_w / $orig_h;

	    $new_w = $dest_w;
	    $new_h = $dest_h;

	    if ( empty( $new_w ) || $new_w < 0  ) {
	        $new_w = intval( $new_h * $aspect_ratio );
	    }

	    if ( empty( $new_h ) || $new_h < 0 ) {
	        $new_h = intval( $new_w / $aspect_ratio );
	    }

	    $size_ratio = max( $new_w / $orig_w, $new_h / $orig_h );

	    $crop_w = round( $new_w / $size_ratio );
	    $crop_h = round( $new_h / $size_ratio );
	    $s_x = floor( ( $orig_w - $crop_w ) / 2 );
	    $s_y = floor( ( $orig_h - $crop_h ) / 2 );
		
		// Safe guard against super large or zero images which might cause 500 errors
		if ( $new_w > 5000 || $new_h > 5000 || $new_w <= 0 || $new_h <= 0 ) {
			return null;
		}

	    // the return array matches the parameters to imagecopyresampled()
	    // int dst_x, int dst_y, int src_x, int src_y, int dst_w, int dst_h, int src_w, int src_h
	    return array( 0, 0, (int) $s_x, (int) $s_y, (int) $new_w, (int) $new_h, (int) $crop_w, (int) $crop_h );
	}
}


// This function allows us to latch on WP image functions such as
// the_post_thumbnail, get_image_tag and wp_get_attachment_image_src
// so that you won't have to use the function nf_image in order to do resizing.
// To make this work, in the WP image functions, when specifying an
// array for the image dimensions, add a 'nf_image' => true to
// the array, then add your normal $params arguments.
//
// e.g. the_post_thumbnail( array( 1024, 400, 'nf_image' => true, 'grayscale' => true ) );
add_filter( 'image_downsize', 'NFI_image_downsize', 1, 3 );

if ( ! function_exists( 'NFI_image_downsize' ) ) {
	function NFI_image_downsize( $out, $id, $size ) {
	    if ( ! is_array( $size ) ) {
	        return false;
	    }
	    if ( ! array_key_exists( 'nf_image', $size ) ) {
	        return false;
	    }
	    if ( empty( $size['nf_image'] ) ) {
	        return false;
	    }

	    $img_url = wp_get_attachment_url( $id );

	    $params = $size;
	    $params['width'] = $size[0];
	    $params['height'] = $size[1];

	    $resized_img_url = nf_image( $img_url, $params );

	    return array( $resized_img_url, $size[0], $size[1], false );
	}
}
