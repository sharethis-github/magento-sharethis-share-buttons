<?php
/**
 * @author    ShareThis
 * @copyright Copyright (c) 2022 ShareThis (https://sharethis.com)
 * @license   https://www.gnu.org/licenses/gpl-3.0.html
 * @package   ShareThis_ShareButtons
 */

namespace ShareThis\ShareButtons\Model\System\Config\Source;

use Magento\Framework\Option\ArrayInterface;

/**
 * Class OptionsArray.
 *
 * @package ShareThis\ShareButtons
 */
abstract class OptionsArray implements ArrayInterface
{

    /**
     * Return options array for use with Option Source interface.
     *
     * @return array
     */
    public function toOptionArray(): array
    {
        $options = [];

        foreach ($this->getOptionMap() as $value => $label) {
            $options[] = compact('value', 'label');
        }

        return $options;
    }

    /**
     * Get option map.
     *
     * @return array
     */
    abstract public function getOptionMap(): array;
}
