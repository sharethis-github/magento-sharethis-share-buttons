<?php
/**
 * @author    ShareThis
 * @copyright Copyright (c) 2022 ShareThis (https://sharethis.com)
 * @license   https://www.gnu.org/licenses/gpl-3.0.html
 * @package   ShareThis_ShareButtons
 */

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
