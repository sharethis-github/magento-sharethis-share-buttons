<?php

namespace ShareThis\ShareButtons\Model\System\Config\Source;

/**
 * Class StickySelectPages.
 *
 * @package ShareThis\ShareButtons
 */
class StickySelectPages extends OptionsArray {

	const CATEGORY_PAGE = 'category_page';

	const PRODUCT_PAGE = 'product_page';

	const CONTACT_US = 'contact_us';

	/**
	 * Get option map of pages.
	 *
	 * @return array Option array map of pages.
	 */
	public function getOptionMap(): array {
		return [
			self::CATEGORY_PAGE => __( 'Categories Page' ),
			self::CONTACT_US    => __( 'Contact Us' ),
			self::PRODUCT_PAGE  => __( 'Products Page' ),
		];
	}
}
