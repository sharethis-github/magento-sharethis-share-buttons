<?php

namespace ShareThis\ShareButtons\Model\System\Config\Source;

/**
 * Class BackgroundColor.
 *
 * @package ShareThis\ShareButtons
 */
class BackgroundColor extends OptionsArray {

	const BLACK = '#000000';

	const CUSTOM = 'custom';

	const GREY = '#808080';

	const NONE = 'transparent';

	const WHITE = '#FFFFFF';

	/**
	 * Get option map of background colors.
	 *
	 * @return array Option array map of background colors.
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
