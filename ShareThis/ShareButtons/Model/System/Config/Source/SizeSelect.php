<?php

namespace ShareThis\ShareButtons\Model\System\Config\Source;

/**
 * Class SizeSelect.
 *
 * @package ShareThis\ShareButtons
 */
class SizeSelect extends OptionsArray {

	const LARGE = 'large';

	const MEDIUM = 'medium';

	const SMALL = 'small';

	/**
	 * Get option map of icon colors.
	 *
	 * @return array Option array map of icon colors.
	 */
	public function getOptionMap(): array {
		return [
			self::SMALL  => __( 'Small' ),
			self::MEDIUM => __( 'Medium' ),
			self::LARGE  => __( 'Large' ),
		];
	}
}
