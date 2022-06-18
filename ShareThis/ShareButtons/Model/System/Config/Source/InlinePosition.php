<?php

namespace ShareThis\ShareButtons\Model\System\Config\Source;

/**
 * Class InlinePosition.
 *
 * @package ShareThis\ShareButtons
 */
class InlinePosition extends OptionsArray {

	const UNDER_CART = 'under_cart';

	/**
	 * Get option map of inline item positions.
	 *
	 * @return array Option array map of item positions.
	 */
	public function getOptionMap(): array {
		return [
			self::UNDER_CART => __( 'Product Page - Under Cart' ),
		];
	}
}
