<?php
if (is_admin()) {
    function tot_editor_full_width_gutenberg()
    {
        echo '<style>
    body.gutenberg-editor-page .editor-post-title__block, body.gutenberg-editor-page .editor-default-block-appender, body.gutenberg-editor-page .editor-block-list__block {
		max-width: none !important;
	}
    .block-editor__container .wp-block {
        max-width: none !important;
    }
  </style>';
    }

    add_action('admin_head', 'tot_editor_full_width_gutenberg');
}