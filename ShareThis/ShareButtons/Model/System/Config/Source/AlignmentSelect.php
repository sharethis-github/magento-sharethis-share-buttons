<?php

namespace ShareThis\ShareButtons\Model\System\Config\Source;

/**
 * Class AlignmentSelect.
 *
 * @package ShareThis\ShareButtons
 */
class AlignmentSelect extends OptionsArray {

	const CENTER = 'center';

	const LEFT = 'left';

	const RIGHT = 'right';

	/**
	 * Get option map of icon colors.
	 *
	 * @return array Option array map of icon colors.
	 */
	public function getOptionMap(): array {
		return [
			self::LEFT  => __( 'Left' ),
			self::CENTER => __( 'Center' ),
			self::RIGHT  => __( 'Right' ),
		];
	}
}
