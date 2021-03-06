<?php

namespace WPML\ST\MO;

class Plural implements \IWPML_Backend_Action, \IWPML_Frontend_Action {

	public function add_hooks() {
		add_filter( 'ngettext', [ $this, 'handle_plural' ], 9, 5 );
		add_filter( 'ngettext_with_context', [ $this, 'handle_plural_with_context' ], 9, 6 );
	}

	/**
	 * @param string $translation Translated text.
	 * @param string $single      The text to be used if the number is singular.
	 * @param string $plural      The text to be used if the number is plural.
	 * @param string $number      The number to compare against to use either the singular or plural form.
	 * @param string $domain      Text domain. Unique identifier for retrieving translated strings.
	 *
	 * @return string
	 */
	public function handle_plural( $translation, $single, $plural, $number, $domain ) {
		if ( $number === 1 ) {
			return $translation;
		} else {
			$possible_translation = __( $plural, $domain );

			return $possible_translation !== $plural ? $possible_translation : $translation;
		}
	}

	/**
	 * @param string $translation Translated text.
	 * @param string $single      The text to be used if the number is singular.
	 * @param string $plural      The text to be used if the number is plural.
	 * @param string $number      The number to compare against to use either the singular or plural form.
	 * @param string $context     Context information for the translators.
	 * @param string $domain      Text domain. Unique identifier for retrieving translated strings.
	 *
	 * @return string
	 */
	public function handle_plural_with_context( $translation, $single, $plural, $number, $context, $domain ) {
		if ( $number === 1 ) {
			return $translation;
		} else {
			$possible_translation = _x( $plural, $context, $domain );

			return $possible_translation !== $plural ? $possible_translation : $translation;
		}
	}

}