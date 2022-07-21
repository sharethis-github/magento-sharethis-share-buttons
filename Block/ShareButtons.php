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

class ShareButtons extends Template
{
    /**
     * @var ConfigHelper
     */
    protected $_configHelper;

    /**
     * @var Page
     */
    protected $_page;

    /**
     * Constructor.
     *
     * @param Context      $context
     * @param ConfigHelper $configHelper
     * @param Page         $page
     * @param array        $data
     */
    public function __construct(Context $context, ConfigHelper $configHelper, Page $page, array $data = [])
    {
        parent::__construct($context, $data);

        $this->_configHelper = $configHelper;
        $this->_page         = $page;
    }

    /**
     * Is the share type enabled for this page / position?
     *
     * @return bool
     */
    public function isEnabled(): bool
    {
        $page     = $this->getData('page');
        $position = $this->getData('position');
        $type     = $this->getData('type');

        switch ($type) {
            case 'inline':
                if ('under_cart' === $position && true === $this->_configHelper->getInlineButtonsShowUnderCart()) {
                    return true;
                }

                $pagesAllowed = $this->_configHelper->getInlineButtonsSelectPages();

                return true === in_array($page, $pagesAllowed, true) &&
                       true === in_array($position, $this->_configHelper->getInlineButtonsSelectPositions(), true);
            case 'sticky':
                $stickyButtonsShowOn = $this->_configHelper->getStickyButtonsShowOn();

                if (StickyShowOn::ALL_PAGES === $stickyButtonsShowOn) {
                    return true;
                } elseif (StickyShowOn::SELECT_PAGES === $stickyButtonsShowOn) {
                    $selectPages = $this->_configHelper->getStickyButtonsSelectPages();
                    $cmsPages    = $this->_configHelper->getStickyButtonsCmsPages();

                    if ('cms_page' === $page) {
                        $pageId = (int)$this->_page->getPage()->getId();

                        if (true === in_array($pageId, $cmsPages, true)) {
                            return true;
                        }
                    } elseif (true === in_array($page, $selectPages, true)) {
                        return true;
                    }
                }
        }

        return false;
    }
}
