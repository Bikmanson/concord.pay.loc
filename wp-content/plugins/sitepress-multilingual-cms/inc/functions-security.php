<?php

function wpml_get_authenticated_action() {

	$action = filter_input( INPUT_POST, 'icl_ajx_action' );
	$action = $action ? $action : filter_input( INPUT_POST, 'action' );
	$nonce  = $action ? filter_input( INPUT_POST, '_icl_nonce' ) : null;
	if ( $nonce === null || $action === null ) {
		$action = filter_input( INPUT_GET, 'icl_ajx_action' );
		$nonce  = $action ? filter_input( INPUT_GET, '_icl_nonce' ) : null;
	}

	$authenticated_action = $action && wp_verify_nonce( (string) $nonce, $action . '_nonce' ) ? $action : null;

	return $authenticated_action;
}

/**
 * Validates a nonce according to the schema also used by \wpml_nonce_field
 *
 * @param string $action
 *
 * @return false|int
 */
function wpml_is_action_authenticated( $action ) {
	$nonce = isset( $_POST['_icl_nonce'] ) ? $_POST['_icl_nonce'] : '';
	if ( '' !== $nonce ) {
		$action = $action . '_nonce';
	} else {
		$nonce = isset( $_POST['nonce'] ) ? $_POST['nonce'] : '';
	}

	return wp_verify_nonce( $nonce, $action );
}

/**
 * Generates HTML for the hidden nonce input field following the schema
 * used by \wpml_is_action_authenticated
 *
 * @param string $action
 *
 * @return string
 */
function wpml_nonce_field( $action ) {
	return '<input name="_icl_nonce" type="hidden" value="'
	       . wp_create_nonce( $action . '_nonce' ) . '"/>';
}

/**
 * RFC 4122 compliant UUID version 5.
 *
 * @param  string $name    The name to generate the UUID from.
 * @param  string $ns_uuid Namespace UUID. Default is for the NS when name string is a URL.
 *
 * @return string          The UUID string.
 */
if ( ! function_exists( 'uuid_v5' ) ) {
	function uuid_v5( $name, $ns_uuid = '6ba7b811-9dad-11d1-80b4-00c04fd430c8' ) {
		$wpml_uuid = new WPML_UUID();
		return $wpml_uuid->get_uuid_v5( $name, $ns_uuid );
	}
}

/**
 * This function was introduced in WP 4.7.0
 * Generate a random UUID (version 4).
 *
 * @return string UUID.
 */
if ( ! function_exists( 'wp_generate_uuid4' ) ) {
	function wp_generate_uuid4() {
		return sprintf( '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
		                mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ),
		                mt_rand( 0, 0xffff ),
		                mt_rand( 0, 0x0fff ) | 0x4000,
		                mt_rand( 0, 0x3fff ) | 0x8000,
		                mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff )
		);
	}
}

/**
 * @param string   $object_id
 * @param string   $object_type
 * @param int|null $timestamp   If this parameter is `null`, it will be assigned the current time
 *                              Set this parameter to 0 if the uuid should not have a time footprint
 *
 * @return string
 */
function wpml_uuid( $object_id, $object_type, $timestamp = null ) {
	$wpml_uuid = new WPML_UUID();
	return $wpml_uuid->get( $object_id, $object_type, $timestamp );
}