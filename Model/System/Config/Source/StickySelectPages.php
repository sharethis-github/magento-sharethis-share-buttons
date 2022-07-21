<?php
/**
 * @author    ShareThis
 * @copyright Copyright (c) 2022 ShareThis (https://sharethis.com)
 * @license   https://www.gnu.org/licenses/gpl-3.0.html
 * @package   ShareThis_ShareButtons
 */

namespace ShareThis\ShareButtons\Model\System\Config\Source;

class StickySelectPages extends OptionsArray
{

    public const CATEGORY_PAGE = 'category_page';

    public const PRODUCT_PAGE = 'product_page';

    public const CONTACT_US = 'contact_us';

    /**
     * Get option map of pages.
     *
     * @return array Option array map of pages.
     */
    public function getOptionMap(): array
    {
        return [
            self::CATEGORY_PAGE => __('Categories Page'),
            self::CONTACT_US    => __('Contact Us'),
            self::PRODUCT_PAGE  => __('Products Page'),
        ];
    }
}
