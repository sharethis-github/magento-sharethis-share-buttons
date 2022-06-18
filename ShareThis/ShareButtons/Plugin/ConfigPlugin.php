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
		$section = $config->getSection();

		if ( false === in_array(
				$section,
				[
					'sharethis_inline_sharebuttons',
					'sharethis_inline_stickybuttons',
					'sharethis_inline_gdpr',
				],
				true
			)
		) {
			return;
		}

		$propertyId = $this->configHelper->getPropertyId();
		$secret = $this->configHelper->getSecret();

		if ( true === empty( $propertyId ) ) {
			return;
		}

		// TODO: Wire up product map to config section.
		$productMap = [
			'sharethis_inline_sharebuttons'  => 'inline-share-buttons',
			'sharethis_inline_stickybuttons' => 'sticky-share-buttons',
			'sharethis_inline_gdpr'          => 'gdpr-compliance-tool',
		];

		$inlineSocialNetworks = $this->configHelper->getInlineSocialNetworks();

		$inlineSocialNetworksCount = count($inlineSocialNetworks);

		// TODO: Only run this call if we're actually updating inline buttons.
		// TODO: Wire up each field.
		$this->shareThisService->updateProduct(
			$propertyId,
			$secret,
			'inline-share-buttons',
			[
				'alignment'         => $this->configHelper->getInlineButtonsAlignment(),
				'enabled'           => $this->configHelper->getInlineButtonsEnabled(),
				'font_size'         => 11,
				'labels'            => $this->configHelper->getInlineButtonsLabelType(),
				'min_count'         => $this->configHelper->getInlineButtonsMinimumCount(),
				'padding'           => 8,
				'radius'            => $this->configHelper->getInlineButtonsRadius(),
				'networks'          => $inlineSocialNetworks,
				'show_total'        => $this->configHelper->getInlineButtonsShowCounts(),
				'size'              => 32,
				'spacing'           => 8,
				'language'          => $this->configHelper->getInlineButtonsLanguage(),
				'color'             => 'social',
				'has_spacing'       => $this->configHelper->getInlineButtonsHasSpacing(),
				'num_networks'      => $inlineSocialNetworksCount,
				'size_label'        => $this->configHelper->getInlineButtonsLabelSize(),
				'use_native_counts' => true,
			]
		);
	}
}
