<?php
/**
 * @author    ShareThis
 * @copyright Copyright (c) 2022 ShareThis (https://sharethis.com)
 * @license   https://www.gnu.org/licenses/gpl-3.0.html
 * @package   ShareThis_ShareButtons
 */

namespace ShareThis\ShareButtons\Model\System\Config\Source;

class StickyShowOn extends OptionsArray
{

    public const ALL_PAGES = 'all_pages';

    public const SELECT_PAGES = 'select_pages';

    /**
     * Get option map of page options.
     *
     * @return array Option array map of page options.
     */
    public function getOptionMap(): array
    {
        return [
            self::ALL_PAGES    => __('All Pages'),
            self::SELECT_PAGES => __('Select Pages'),
        ];
    }
}
