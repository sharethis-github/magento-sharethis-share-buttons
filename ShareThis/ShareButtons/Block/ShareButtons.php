<?php

namespace ShareThis\ShareButtons\Block;

use Magento\Cms\Block\Page;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use ShareThis\ShareButtons\Helper\Config as ConfigHelper;

class ShareButtons extends Template {
	/**
	 * @var ConfigHelper
	 */
	private $configHelper;

	/**
	 * @var Page
	 */
	private $page;

	/**
	 * Constructor.
	 *
	 * @param Context      $context
	 * @param ConfigHelper $configHelper
	 * @param Page         $page
	 * @param array        $data
	 */
	public function __construct( Context $context, ConfigHelper $configHelper, Page $page, array $data = [] ) {
		parent::__construct( $context, $data );

		$this->configHelper = $configHelper;
		$this->page         = $page;
	}

	/**
	 * Is the share type enabled for this page / position?
	 *
	 * @return bool
	 */
	public function isEnabled(): bool {
		$page     = $this->getData( 'page' );
		$position = $this->getData( 'position' );
		$type     = $this->getData( 'type' );

		$pagesAllowed = [];

		switch ( $type ) {
			case 'inline':
				$pagesAllowed[] = 'under_cart';

				return true === in_array( $page, $pagesAllowed, true );
			case 'sticky':
				// TODO: Implement allowed areas.
				return false;
		}

		return false;
	}
}