<?php
/**
 * @author    ShareThis
 * @copyright Copyright (c) 2022 ShareThis (https://sharethis.com)
 * @license   https://www.gnu.org/licenses/gpl-3.0.html
 * @package   ShareThis_ShareButtons
 */

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

		$section = $config->getSection();

		if ( false === in_array(
				$section,
				[
					'sharethis_inline_sharebuttons',
					'sharethis_sticky_sharebuttons',
				],
				true
			)
		) {
			return;
		}

		$productMap = [
			'sharethis_inline_sharebuttons' => 'inline-share-buttons',
			'sharethis_sticky_sharebuttons' => 'sticky-share-buttons',
		];

		$onboardingProduct = null;

		if ( true === isset( $productMap[ $section ] ) ) {
			$onboardingProduct = $productMap[ $section ];
		}

		$baseUrl = $this->storeManager->getStore()->getBaseUrl();

		try {
			$property = $this->shareThisService->createProperty( $baseUrl, $onboardingProduct );

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
					'sharethis_sticky_sharebuttons',
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

		switch($section) {
			case 'sharethis_inline_sharebuttons':
				$this->saveInlineButtonConfig($propertyId, $secret);
				break;
			case 'sharethis_sticky_sharebuttons':
				$this->saveStickyButtonConfig($propertyId, $secret);
				break;
		}
	}

	/**
	 * Save inline button config to ShareThis.
	 *
	 * @param string $propertyId Property ID string.
	 * @param string $secret     Secret string.
	 *
	 * @throws \Exception
	 */
	protected function saveInlineButtonConfig($propertyId, $secret) {
		$inlineSocialNetworks = $this->configHelper->getSocialNetworks('inline');

		$inlineSocialNetworksCount = count($inlineSocialNetworks);

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

	/**
	 * Save sticky button config to ShareThis.
	 *
	 * @param string $propertyId Property ID string.
	 * @param string $secret     Secret string.
	 *
	 * @throws \Exception
	 */
	protected function saveStickyButtonConfig( $propertyId, $secret ) {
		$this->shareThisService->updateProduct(
			$propertyId,
			$secret,
			'sticky-share-buttons',
			[
				'alignment'         => $this->configHelper->getStickyButtonsAlignment(),
				'enabled'           => $this->configHelper->getStickyButtonsEnabled(),
				'labels'            => $this->configHelper->getStickyButtonsLabelType(),
				'min_count'         => $this->configHelper->getStickyButtonsMinimumCount(),
				'radius'            => $this->configHelper->getStickyButtonsRadius(),
				'networks'          => $this->configHelper->getSocialNetworks( 'sticky' ),
				'mobile_breakpoint' => $this->configHelper->getStickyButtonsMobileBreakpoint(),
				'top'               => $this->configHelper->getStickyButtonsVerticalAlignment(),
				'show_mobile'       => $this->configHelper->getStickyButtonsShowMobile(),
				'show_total'        => $this->configHelper->getStickyButtonsShowCounts(),
				'hide_desktop'      => $this->configHelper->getStickyButtonsHideDesktop(),
				'language'          => $this->configHelper->getStickyButtonsLanguage(),
			]
		);
	}
}
