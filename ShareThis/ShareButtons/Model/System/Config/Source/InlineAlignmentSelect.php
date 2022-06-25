<?php

namespace ShareThis\ShareButtons\Model\System\Config\Source;

/**
 * Class InlineAlignmentSelect.
 *
 * @package ShareThis\ShareButtons
 */
class InlineAlignmentSelect extends OptionsArray {

	const CENTER = 'center';

	const JUSTIFIED = 'justified';

	const LEFT = 'left';

	const RIGHT = 'right';

	/**
	 * Get option map of alignment options.
	 *
	 * @return array Option array map of alignment options.
	 */
	public function getOptionMap(): array {
		return [
			self::LEFT      => __( 'Left' ),
			self::CENTER    => __( 'Center' ),
			self::RIGHT     => __( 'Right' ),
			self::JUSTIFIED => __( 'Justified' ),
		];
	}
}
