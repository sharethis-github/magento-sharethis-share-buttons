<?php

namespace ShareThis\ShareButtons\Model\System\Config\Source;

/**
 * Class LabelSelect.
 *
 * @package ShareThis\ShareButtons
 */
class LabelSelect extends OptionsArray {

	const CTA = 'cta';

	const COUNTS = 'counts';

	const NONE = 'none';

	/**
	 * Get option map of labels.
	 *
	 * @return array Option array map of labels.
	 */
	public function getOptionMap(): array {
		return [
			self::CTA    => __( 'Call to Action' ),
			self::COUNTS => __( 'Share Counts' ),
			self::NONE   => __( 'None' ),
		];
	}
}
