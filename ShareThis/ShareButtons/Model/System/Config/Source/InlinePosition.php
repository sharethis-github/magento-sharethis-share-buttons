<?php

namespace ShareThis\ShareButtons\Model\System\Config\Source;

/**
 * Class InlinePosition.
 *
 * @package ShareThis\ShareButtons
 */
class InlinePosition extends OptionsArray {

	const POST_TOP = 'post_top';

	const POST_BOTTOM = 'post_bottom';

	const PAGE_TOP = 'page_top';

	const PAGE_BOTTOM = 'page_bottom';

	const EXCLUDE_EXCERPTS = 'exclude_excerpts';

	/**
	 * Get option map of inline item positions.
	 *
	 * @return array Option array map of icon colors.
	 */
	public function getOptionMap(): array {
		return [
			self::POST_TOP         => __( 'Post Content Top' ),
			self::POST_BOTTOM      => __( 'Post Content Bottom' ),
			self::PAGE_TOP         => __( 'Page Content Top' ),
			self::PAGE_BOTTOM      => __( 'Page Content Bottom' ),
			self::EXCLUDE_EXCERPTS => __( 'Exclude in Excerpts' ),
		];
	}
}
