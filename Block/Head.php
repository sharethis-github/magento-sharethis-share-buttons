<?php
/**
 * @author    ShareThis
 * @copyright Copyright (c) 2022 ShareThis (https://sharethis.com)
 * @license   https://www.gnu.org/licenses/gpl-3.0.html
 * @package   ShareThis_ShareButtons
 */

namespace ShareThis\ShareButtons\Block;

use Magento\Framework\View\Element\Template\Context;
use Magento\Framework\View\Element\Template;
use ShareThis\ShareButtons\Helper\Config as ConfigHelper;

class Head extends Template
{
    /**
     * @var ConfigHelper $_configHelper
     */
    protected $_configHelper;

    /**
     * Constructor.
     *
     * @param Context      $context
     * @param ConfigHelper $configHelper
     * @param array        $data
     */
    public function __construct(Context $context, ConfigHelper $configHelper, array $data = [])
    {
        parent::__construct($context, $data);

        $this->_configHelper = $configHelper;
    }

    /**
     * Print script.
     *
     * @return void
     */
    public function printScript()
    {
        $propertyId = $this->_configHelper->getPropertyId();

        if (true === empty($propertyId)) {
            return;
        }
        ?>
        <script src="//platform-api.sharethis.com/js/sharethis.js?ver=1.5.7#property=<?= $propertyId; ?>"></script>
        <?php
    }
}
