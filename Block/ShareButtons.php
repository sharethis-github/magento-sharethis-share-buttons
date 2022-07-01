<?php
/**
 * @author    ShareThis
 * @copyright Copyright (c) 2022 ShareThis (https://sharethis.com)
 * @license   https://www.gnu.org/licenses/gpl-3.0.html
 * @package   ShareThis_ShareButtons
 */

namespace ShareThis\ShareButtons\Block;

use Magento\Cms\Block\Page;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use ShareThis\ShareButtons\Helper\Config as ConfigHelper;
use ShareThis\ShareButtons\Model\System\Config\Source\StickyShowOn;

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

		switch ( $type ) {
			case 'inline':
				if ( 'under_cart' === $position && true === $this->configHelper->getInlineButtonsShowUnderCart() ) {
					return true;
				}

				$pagesAllowed = $this->configHelper->getInlineButtonsSelectPages();

				return true === in_array( $page, $pagesAllowed, true ) &&
					   true === in_array( $position, $this->configHelper->getInlineButtonsSelectPositions(), true );
			case 'sticky':
				$stickyButtonsShowOn = $this->configHelper->getStickyButtonsShowOn();

				if ( StickyShowOn::ALL_PAGES === $stickyButtonsShowOn ) {
					return true;
				} elseif ( StickyShowOn::SELECT_PAGES === $stickyButtonsShowOn ) {
					$selectPages = $this->configHelper->getStickyButtonsSelectPages();
					$cmsPages    = $this->configHelper->getStickyButtonsCmsPages();

					if ( 'cms_page' === $page ) {
						$pageId = intval($this->page->getPage()->getId());

						if ( true === in_array( $pageId, $cmsPages, true ) ) {
							return true;
						}
					} elseif ( true === in_array( $page, $selectPages, true ) ) {
						return true;
					}
				}
		}

		return false;
	}
}