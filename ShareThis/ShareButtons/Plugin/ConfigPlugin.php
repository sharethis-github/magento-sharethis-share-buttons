<?php

namespace ShareThis\ShareButtons\Plugin;

use Magento\Config\Model\Config;
use Magento\Framework\App\RequestInterface;
use Magento\Store\Model\StoreManagerInterface;
use ShareThis\ShareButtons\Helper\Config as ConfigHelper;
use ShareThis\ShareButtons\Service\ShareThis as ShareThisService;

/**
 * Config plugin.
 */
class ConfigPlugin {
	/**
	 * @var ConfigHelper
	 */
	protected $configHelper;

	/**
	 * @var RequestInterface
	 */
	protected $request;

	/**
	 * @var ShareThisService
	 */
	protected $shareThisService;

	public function __construct(
		RequestInterface $request,
		ConfigHelper $configHelper,
		ShareThisService $shareThisService,
		StoreManagerInterface $storeManager
	) {
		$this->request = $request;
		$this->configHelper = $configHelper;
		$this->shareThisService = $shareThisService;
		$this->storeManager = $storeManager;
	}

	/**
	 * Before config save callback.
	 *
	 * @param Config $config
	 *
	 * @throws \Magento\Framework\Exception\NoSuchEntityException
	 */
	public function beforeSave( Config $config ) {
		$propertyId = $this->configHelper->getPropertyId();

		if ( false === empty( $propertyId ) ) {
			return;
		}

		$baseUrl = $this->storeManager->getStore()->getBaseUrl();

		try {
			$property = $this->shareThisService->createProperty( $baseUrl );

			$this->configHelper->saveConfigValue('sharethis_sharebuttons/general/property_id', $property['_id']);
			$this->configHelper->saveConfigValue('sharethis_sharebuttons/general/secret', $property['secret']);
		} catch ( \Exception $e ) {
			// Do nothing. Yet.
		}
	}

	/**
	 * Config save callback.
	 *
	 * @param Config $config Configuration interceptor object.
	 *
	 * @throws \Exception
	 */
	public function afterSave(Config $config) {
		$propertyId = $this->configHelper->getPropertyId();
		$secret = $this->configHelper->getSecret();

		if ( true === empty( $propertyId ) ) {
			return;
		}

		// TODO: Only run this call if we're actually updating inline buttons.
		// TODO: Wire up each field.
		$this->shareThisService->updateProduct(
			$propertyId,
			$secret,
			'inline-share-buttons',
			[
				'alignment'         => 'center',
				'enabled'           => $this->configHelper->getInlineButtonsEnabled(),
				'font_size'         => 11,
				'labels'            => 'cta',
				'min_count'         => 1,
				'padding'           => 8,
				'radius'            => 0,
				'networks'          => [
					'sms',
					'facebook',
					'twitter',
					'pinterest',
					'email',
					'sharethis',
				],
				'show_total'        => true,
				'size'              => 32,
				'spacing'           => 8,
				'language'          => 'en',
				'color'             => 'social',
				'has_spacing'       => true,
				'num_networks'      => 6,
				'size_label'        => 'small',
				'use_native_counts' => true,
			]
		);
	}
}
