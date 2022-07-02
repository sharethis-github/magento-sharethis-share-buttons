<?php
/**
 * @author    ShareThis
 * @copyright Copyright (c) 2022 ShareThis (https://sharethis.com)
 * @license   https://www.gnu.org/licenses/gpl-3.0.html
 * @package   ShareThis_ShareButtons
 */

namespace ShareThis\ShareButtons\Model\System\Config\Source;

use Magento\Cms\Model\PageFactory;

/**
 * Class StickyCmsPages.
 *
 * @package ShareThis\ShareButtons
 */
class StickyCmsPages extends OptionsArray {

	protected $pageFactory;

	public function __construct( PageFactory $pageFactory ) {
		$this->pageFactory = $pageFactory;
	}

	/**
	 * Get option map of CMS pages.
	 *
	 * @return array Option array map of CMS pages.
	 */
	public function getOptionMap(): array {
		$pages = $this->pageFactory->create()->getCollection();

		$cmsPages = [];

		foreach ( $pages as $page ) {
			$cmsPages[ $page->getId() ] = $page->getTitle();
		}

		return $cmsPages;
	}
}
