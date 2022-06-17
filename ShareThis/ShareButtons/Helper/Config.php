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
	 * Get inline social networks.
	 *
	 * @return array
	 */
	public function getInlineSocialNetworks(): array {
		$inline_social_networks = $this->getConfigValue('sharethis_inline_sharebuttons/social_networks/networks', '');

		return explode(',', $inline_social_networks);
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

		if ( true === empty( $value ) ) {
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
}
