<?php
/**
 * @author    ShareThis
 * @copyright Copyright (c) 2022 ShareThis (https://sharethis.com)
 * @license   https://www.gnu.org/licenses/gpl-3.0.html
 * @package   ShareThis_ShareButtons
 */

namespace ShareThis\ShareButtons\Model\System\Config\Source;

class InlineColorSelect extends OptionsArray
{

    public const SOCIAL = 'social';

    public const WHITE = 'white';

    public const GRAY = 'gray';

    public const BLACK = 'black';

    /**
     * Get option map of color options.
     *
     * @return array Option array map of color options.
     */
    public function getOptionMap(): array
    {
        return [
            self::SOCIAL      => __('Social'),
            self::WHITE    => __('White'),
            self::GRAY     => __('Gray'),
            self::BLACK => __('Black'),
        ];
    }
}
