<?php

/**
 * Class WPML_TM_Post_Link_Factory
 *
 * Creates post links for the TM dashboard and the translation queue
 */
class WPML_TM_Post_Link_Factory {

	/** @var SitePress $sitepress */
	private $sitepress;

	public function __construct( SitePress $sitepress ) {
		$this->sitepress = $sitepress;
	}

	/**
	 * Link to the front end, link text is the post title
	 *
	 * @param int $post_id
	 *
	 * @return string
	 */
	public function view_link( $post_id ) {

		return (string) ( new WPML_TM_Post_View_Link_Title( $this->sitepress,
			(int) $post_id ) );
	}

	/**
	 * Link to the front end, link text is given by the anchor
	 *
	 * @param int    $post_id
	 * @param string $anchor
	 *
	 * @return string
	 */
	public function view_link_anchor( $post_id, $anchor, $target = '' ) {

		return (string) ( new WPML_TM_Post_View_Link_Anchor( $this->sitepress,
			(int) $post_id, $anchor, $target ) );
	}

	/**
	 * Link to the backend, link text is given by the anchor
	 *
	 * @param int    $post_id
	 * @param string $anchor
	 *
	 * @return string
	 */
	public function edit_link_anchor( $post_id, $anchor ) {

		return (string) ( new WPML_TM_Post_Edit_Link_Anchor( $this->sitepress,
			(int) $post_id, $anchor ) );
	}
}