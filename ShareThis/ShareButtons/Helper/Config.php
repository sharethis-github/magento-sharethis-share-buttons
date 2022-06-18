<?php

namespace ShareThis\ShareButtons\Helper;

use Magento\Framework\App\Config\Storage\WriterInterface;
use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;
use Magento\Framework\ObjectManagerInterface;
use Magento\Store\Model\ScopeInterface;
use Magento\Store\Model\StoreManagerInterface;

/**
 * Config helper.
 */
class Config extends AbstractHelper {
	/**
	 * AbstractData constructor.
	 *
	 * @param Context $context
	 * @param ObjectManagerInterface $objectManager
	 * @param StoreManagerInterface $storeManager
	 */
	public function __construct(
		Context $context,
		ObjectManagerInterface $objectManager,
		StoreManagerInterface $storeManager,
		WriterInterface $configWriter
	) {
		$this->configWriter = $configWriter;
		$this->objectManager = $objectManager;
		$this->storeManager = $storeManager;

		parent::__construct($context);
	}

	/**
	 * Fetch whether inline buttons are enabled.
	 *
	 * @return bool
	 */
	public function getInlineButtonsEnabled(): bool {
		return '1' === $this->getConfigValue('sharethis_inline_sharebuttons/general/enabled', '0');
	}

	/**
	 * Get inline buttons alignment.
	 *
	 * @return string
	 */
	public function getInlineButtonsAlignment(): string {
		return $this->getConfigValue('sharethis_inline_sharebuttons/general/alignment', 'center');
	}

	/**
	 * Get inline buttons language.
	 *
	 * @return string
	 */
	public function getInlineButtonsLanguage(): string {
		return $this->getConfigValue('sharethis_inline_sharebuttons/general/language', 'en');
	}

	/**
	 * Get inline buttons label size.
	 *
	 * @return string
	 */
	public function getInlineButtonsLabelSize(): string {
		return $this->getConfigValue('sharethis_inline_sharebuttons/general/label_size', 'small');
	}

	/**
	 * Get inline buttons label type.
	 *
	 * @return string
	 */
	public function getInlineButtonsLabelType(): string {
		return $this->getConfigValue('sharethis_inline_sharebuttons/general/label_type', 'cta');
	}

	/**
	 * Get inline buttons - show counts.
	 *
	 * @return bool
	 */
	public function getInlineButtonsShowCounts(): bool {
		return '1' === $this->getConfigValue('sharethis_inline_sharebuttons/general/show_counts', '0');
	}

	/**
	 * Get inline buttons - min count to show counts.
	 *
	 * @return integer
	 */
	public function getInlineButtonsMinimumCount(): int {
		return intval( $this->getConfigValue( 'sharethis_inline_sharebuttons/general/min_count', 1 ) );
	}

	/**
	 * Get inline buttons border radius.
	 *
	 * @return integer
	 */
	public function getInlineButtonsRadius(): int {
		return intval( $this->getConfigValue( 'sharethis_inline_sharebuttons/general/radius', 0 ) );
	}

	/**
	 * Get inline buttons - has spacing.
	 *
	 * @return bool
	 */
	public function getInlineButtonsHasSpacing(): bool {
		return '1' === $this->getConfigValue( 'sharethis_inline_sharebuttons/general/has_spacing', '1' );
	}

	/**
	 * Get inline social networks.
	 *
	 * @return array
	 */
	public function getInlineSocialNetworks(): array {
		$networks = [];

		foreach ( $this->getSupportedSocialNetworks() as $supportedSocialNetwork => $supportedSocialNetworkLabel ) {
			$networks[ $supportedSocialNetwork ] = $this->getConfigValue(
				sprintf( 'sharethis_inline_sharebuttons/social_networks/%s', $supportedSocialNetwork ),
				''
			);
		}

		$networks = array_filter( $networks, function ( $network ) {
			return false === empty( $network );
		} );

		$network_slugs = array_keys( $networks );

		sort( $network_slugs );

		return $network_slugs;
	}

	/**
	 * Get property ID.
	 *
	 * @return string
	 */
	public function getPropertyId(): string {
		return $this->getConfigValue('sharethis_sharebuttons/general/property_id', '');
	}

	/**
	 * Get secret.
	 *
	 * @return string
	 */
	public function getSecret(): string {
		return $this->getConfigValue('sharethis_sharebuttons/general/secret', '');
	}

	/**
	 * Get configuration value.
	 *
	 * @param string $field      Field string.
	 * @param mixed  $default    Mixed fallback value if string is empty.
	 * @param string $scopeType  Type of scope (e.g. store)
	 * @param mixed  $scopeValue Type of scope value (e.g. storeId).
	 *
	 * @return mixed|string
	 */
	public function getConfigValue(
		string $field,
		$default = '',
		string $scopeType = ScopeInterface::SCOPE_STORE,
		$scopeValue = null
	) {
		$value = $this->scopeConfig->getValue( $field, $scopeType, $scopeValue );

		if ( 0 !== $value && '0' !== $value && true === empty( $value ) ) {
			return $default;
		}

		return $value;
	}

	/**
	 * @param string $path
	 * @param        $value
	 *
	 * @return void
	 */
	public function saveConfigValue(
		string $path,
		$value
	) {
		$this->configWriter->save($path, $value);
	}

	/**
	 * Get supported social networks.
	 *
	 * @return array
	 */
	public function getSupportedSocialNetworks(): array {
		return [
			'blm'             => __( "BLM" ),
			'blogger'         => __( "Blogger" ),
			'buffer'          => __( "Buffer" ),
			'delicious'       => __( "Delicious" ),
			'diaspora'        => __( "Diaspora" ),
			'digg'            => __( "Digg" ),
			'douban'          => __( "Douban" ),
			'email'           => __( "Email" ),
			'evernote'        => __( "Evernote" ),
			'facebook'        => __( 'Facebook' ),
			'flipboard'       => __( "Flipboard" ),
			'getpocket'       => __( "Pocket" ),
			'gmail'           => __( "Gmail" ),
			'googlebookmarks' => __( "Google Bookmarks" ),
			'hackernews'      => __( "Hacker News" ),
			'instapaper'      => __( "Instapaper" ),
			'line'            => __( "Line" ),
			'linkedin'        => __( "LinkedIn" ),
			'livejournal'     => __( "LiveJournal" ),
			'mailru'          => __( "Mail.ru" ),
			'meneame'         => __( "Menéame" ),
			'messenger'       => __( "Messenger" ),
			'odnoklassniki'   => __( "Odnoklassniki" ),
			'pinterest'       => __( "Pinterest" ),
			'print'           => __( "Print" ),
			'qzone'           => __( "Qzone" ),
			'reddit'          => __( "Reddit" ),
			'refind'          => __( "Refind" ),
			'renren'          => __( "Renren" ),
			'sharethis'       => __( "ShareThis" ),
			'skype'           => __( "Skype" ),
			'sms'             => __( "SMS" ),
			'surfingbird'     => __( "SurfingBird" ),
			'snapchat'        => __( "Snapchat" ),
			'stumbleupon'     => __( "StumbleUpon" ),
			'telegram'        => __( "Telegram" ),
			'threema'         => __( "Threema" ),
			'twitter'         => __( 'Twitter' ),
			'tumblr'          => __( "Tumblr" ),
			'vk'              => __( "VK" ),
			'wechat'          => __( "WeChat" ),
			'weibo'           => __( "Weibo" ),
			'whatsapp'        => __( "WhatsApp" ),
			'wordpress'       => __( "WordPress" ),
			'xing'            => __( "Xing" ),
			'yahoomail'       => __( "Yahoo! Mail" ),
		];
	}
}
