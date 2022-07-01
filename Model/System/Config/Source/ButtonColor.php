<?php

namespace ShareThis\ShareButtons\Model\System\Config\Source;

/**
 * Class ButtonColor.
 *
 * @package ShareThis\ShareButtons
 */
class ButtonColor extends OptionsArray {

	const BLACK = '#000000';

	const CUSTOM = 'custom';

	const GREY = '#808080';

	const NONE = 'transparent';

	const WHITE = '#FFFFFF';

	/**
	 * Get option map of button colors.
	 *
	 * @return array Option array map of button colors.
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
