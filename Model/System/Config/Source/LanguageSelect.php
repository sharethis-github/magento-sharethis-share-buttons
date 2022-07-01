<?php
/**
 * @author    ShareThis
 * @copyright Copyright (c) 2022 ShareThis (https://sharethis.com)
 * @license   https://www.gnu.org/licenses/gpl-3.0.html
 * @package   ShareThis_ShareButtons
 */

namespace ShareThis\ShareButtons\Model\System\Config\Source;

/**
 * Class LanguageSelect.
 *
 * @package ShareThis\ShareButtons
 */
class LanguageSelect extends OptionsArray {

	const CHINESE = 'zh';

	const ENGLISH = 'en';

	const FRENCH = 'fr';

	const GERMAN = 'de';

	const ITALIAN = 'it';

	const JAPANESE = 'ja';

	const KOREAN = 'ko';

	const PORTUGUESE = 'pt';

	const RUSSIAN = 'ru';

	const SPANISH = 'es';

	/**
	 * Get option map of languages.
	 *
	 * @return array Option array map of languages in order.
	 */
	public function getOptionMap(): array {
		return [
			self::ENGLISH    => __( 'English' ),
			self::GERMAN     => __( 'German' ),
			self::SPANISH    => __( 'Spanish' ),
			self::FRENCH     => __( 'French' ),
			self::ITALIAN    => __( 'Italian' ),
			self::JAPANESE   => __( 'Japanese' ),
			self::KOREAN     => __( 'Korean' ),
			self::PORTUGUESE => __( 'Portuguese' ),
			self::RUSSIAN    => __( 'Russian' ),
			self::CHINESE    => __( 'Chinese' ),
		];
	}
}
