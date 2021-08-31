<?php
function image_thumb($path, $image, $width, $height){
    // Get the CodeIgniter super object
    $CI =& get_instance();

    //	adjust path for source and thumbnail image
    $path_parts = pathinfo($image);    
    $source_image = $path.''.$image;
    $new_image = $path.''.$path_parts['filename'].'_thumb'.'.'.$path_parts['extension'];
    
    if( ! file_exists($new_image)){
    	// LOAD LIBRARY
        $CI->load->library('image_lib');
		
        // CONFIGURE IMAGE LIBRARY
        $config['image_library']    = 'gd2';
        $config['source_image']     = $source_image;
        $config['new_image']        = $new_image;
        $config['maintain_ratio']   = TRUE;
        $config['width']            = $width;
        $config['height']           = $height;
        
        $CI->image_lib->initialize($config);        
        $CI->image_lib->resize();        
        $CI->image_lib->clear();
    }
}
/* End of file thumb_helper.php */
/* Location: ./application/helpers/thumb_helper.php */