<?php

namespace ShareThis\ShareButtons\Model\System\Config\Source;

/**
 * Class InlinePosition.
 *
 * @package ShareThis\ShareButtons
 */
class InlinePosition extends OptionsArray {

	const ABOVE_CONTENT = 'above_content';

	const BELOW_CONTENT = 'below_content';

	/**
	 * Get option map of inline item positions.
	 *
	 * @return array Option array map of item positions.
	 */
	public function getOptionMap(): array {
		return [
			self::ABOVE_CONTENT => __( 'Above Content' ),
			self::BELOW_CONTENT => __( 'Below Content' ),
		];
	}
}
