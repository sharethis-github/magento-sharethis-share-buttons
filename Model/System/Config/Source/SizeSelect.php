<?php
/**
 * @author    ShareThis
 * @copyright Copyright (c) 2022 ShareThis (https://sharethis.com)
 * @license   https://www.gnu.org/licenses/gpl-3.0.html
 * @package   ShareThis_ShareButtons
 */

namespace ShareThis\ShareButtons\Model\System\Config\Source;

class SizeSelect extends OptionsArray
{

    public const LARGE = 'large';

    public const MEDIUM = 'medium';

    public const SMALL = 'small';

    /**
     * Get option map of sizes.
     *
     * @return array Option array map of sizes.
     */
    public function getOptionMap(): array
    {
        return [
            self::SMALL  => __('Small'),
            self::MEDIUM => __('Medium'),
            self::LARGE  => __('Large'),
        ];
    }
}
