<?php

namespace ShareThis\ShareButtons\Model\System\Config\Source;

/**
 * Class StickyShowOn.
 *
 * @package ShareThis\ShareButtons
 */
class StickyShowOn extends OptionsArray {

	const ALL_PAGES = 'all_pages';

	const SELECT_PAGES = 'select_pages';

	/**
	 * Get option map of page options.
	 *
	 * @return array Option array map of page options.
	 */
	public function getOptionMap(): array {
		return [
			self::ALL_PAGES    => __( 'All Pages' ),
			self::SELECT_PAGES => __( 'Select Pages' ),
		];
	}
}
