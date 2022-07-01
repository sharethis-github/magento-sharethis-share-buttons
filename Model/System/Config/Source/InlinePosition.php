<?php
/**
 * @author    ShareThis
 * @copyright Copyright (c) 2022 ShareThis (https://sharethis.com)
 * @license   https://www.gnu.org/licenses/gpl-3.0.html
 * @package   ShareThis_ShareButtons
 */

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
