<?php
/**
 * @author    ShareThis
 * @copyright Copyright (c) 2022 ShareThis (https://sharethis.com)
 * @license   https://www.gnu.org/licenses/gpl-3.0.html
 * @package   ShareThis_ShareButtons
 */

namespace ShareThis\ShareButtons\Model\System\Config\Source;

class LabelSelect extends OptionsArray
{

    public const CTA = 'cta';

    public const COUNTS = 'counts';

    public const NONE = 'none';

    /**
     * Get option map of labels.
     *
     * @return array Option array map of labels.
     */
    public function getOptionMap(): array
    {
        return [
            self::CTA    => __('Call to Action'),
            self::COUNTS => __('Share Counts'),
            self::NONE   => __('None'),
        ];
    }
}
