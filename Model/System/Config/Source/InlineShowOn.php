<?php
/**
 * @author    ShareThis
 * @copyright Copyright (c) 2022 ShareThis (https://sharethis.com)
 * @license   https://www.gnu.org/licenses/gpl-3.0.html
 * @package   ShareThis_ShareButtons
 */

namespace ShareThis\ShareButtons\Model\System\Config\Source;

/**
 * Class InlineShowOn.
 *
 * @package ShareThis\ShareButtons
 */
class InlineShowOn extends OptionsArray {

	const HOME_PAGE = 'home_page';

	const CATEGORY_PAGE = 'category_page';

	const PRODUCT_PAGE = 'product_page';

	/**
	 * Get option map of page options.
	 *
	 * @return array Option array map of page options.
	 */
	public function getOptionMap(): array {
		return [
			self::HOME_PAGE     => __( 'Home Page' ),
			self::CATEGORY_PAGE => __( 'Category Pages' ),
			self::PRODUCT_PAGE  => __( 'Product Pages' ),
		];
	}
}
