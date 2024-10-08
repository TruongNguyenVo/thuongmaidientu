<?php

/**
 * Get All Envira Gallery.
 *
 * @return void
 */
function seedprod_lite_get_envira_galleries() {
	if ( check_ajax_referer( 'seedprod_nonce' ) ) {
		if ( ! current_user_can( apply_filters( 'seedprod_builder_preview_render_capability', 'edit_others_posts' ) ) ) {
			wp_send_json_error();
		}

        $type = filter_input( INPUT_GET, 'type', FILTER_SANITIZE_STRING );
		$galleries = array();

        if($type === 'lite'){
            if ( class_exists( 'Envira_Gallery_Lite' ) ) {
                $galleries = Envira_Gallery_Lite::get_instance()->_get_galleries();
            }
        }else{
            if ( class_exists( 'Envira_Gallery' ) ) {
                $galleries = Envira_Gallery::get_instance()->_get_galleries();
            }
        }
		wp_send_json( $galleries );
	}
}

