<?php

namespace ShareThis\ShareButtons\Model\System\Config\Source;

/**
 * Class IconColor.
 *
 * @package ShareThis\ShareButtons
 */
class IconColor extends OptionsArray {

	const BLACK = '#000000';

	const CUSTOM = 'custom';

	const GREY = '#808080';

	const NONE = 'transparent';

	const WHITE = '#FFFFFF';

	/**
	 * Get option map of icon colors.
	 *
	 * @return array Option array map of icon colors.
	 */
	public function getOptionMap(): array {
		return [
			self::BLACK  => __( 'Black' ),
			self::CUSTOM => __( 'Custom' ),
			self::GREY   => __( 'Grey' ),
			self::NONE   => __( 'Transparent (none)' ),
			self::WHITE  => __( 'White' ),
		];
	}
}
