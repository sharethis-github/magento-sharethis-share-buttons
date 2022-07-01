<?php
/**
 * @author    ShareThis
 * @copyright Copyright (c) 2022 ShareThis (https://sharethis.com)
 * @license   https://www.gnu.org/licenses/gpl-3.0.html
 * @package   ShareThis_ShareButtons
 */

namespace ShareThis\ShareButtons\Model\System\Config\Source;

/**
 * Class StickyAlignmentSelect.
 *
 * @package ShareThis\ShareButtons
 */
class StickyAlignmentSelect extends OptionsArray {

	const LEFT = 'left';

	const RIGHT = 'right';

	/**
	 * Get option map of inline item alignments.
	 *
	 * @return array Option array map of item alignments.
	 */
	public function getOptionMap(): array {
		return [
			self::LEFT => __( 'Left' ),
			self::RIGHT => __( 'Right' ),
		];
	}
}
