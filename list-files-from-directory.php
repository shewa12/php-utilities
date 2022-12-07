<?php
/**
 * Print all the files from directory & it's sub-directory recursively 
 *
 * @param string $dir directory path
 * @return void
 */
function get_files( $dir ) {
	static $found_files = array();

    // Check weather its directory or not.
	if ( ! in_array( $dir, array( '.', '..' ) ) && is_dir( $dir ) ) {

        // Scan all files.
		$files = scandir( $dir );

		foreach ( $files as $file ) {
            // If directory then get back & scan files again.
			if ( ! in_array( $file, array( '.', '..' ) ) && is_dir( $dir . '/' . $file ) ) {
				$child_dir = $dir . DIRECTORY_SEPARATOR . $file;
				get_files( $child_dir );

			} else {
                // Strip out dots.
				if ( ! in_array( $file, array( '.', '..' ) ) ) {
					array_push( $found_files, $file );
				}
			}
		}
	}
	return $found_files;
}


$path = '/Applications/MAMP/htdocs/tutor-v2/wp-content/plugins/tutor/views';
echo "<pre>";
print_r( get_files( $path ) );