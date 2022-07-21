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
use Magento\Framework\Message\ManagerInterface;
use Magento\Store\Model\StoreManagerInterface;
use ShareThis\ShareButtons\Helper\Config as ConfigHelper;
use ShareThis\ShareButtons\Service\ShareThis as ShareThisService;

class ConfigPlugin
{
    /**
     * @var ConfigHelper
     */
    protected $_configHelper;

    /**
     * @var RequestInterface
     */
    protected $_request;

    /**
     * @var ShareThisService
     */
    protected $_shareThisService;

    /**
     * @var StoreManagerInterface
     */
    protected $_storeManager;

    /**
     * @param RequestInterface      $request
     * @param ConfigHelper          $configHelper
     * @param ShareThisService      $shareThisService
     * @param StoreManagerInterface $storeManager
     * @param ManagerInterface      $messageManager
     */
    public function __construct(
        RequestInterface $request,
        ConfigHelper $configHelper,
        ShareThisService $shareThisService,
        StoreManagerInterface $storeManager,
        ManagerInterface $messageManager
    ) {
        $this->_request      = $request;
        $this->_configHelper = $configHelper;
        $this->_shareThisService = $shareThisService;
        $this->_storeManager = $storeManager;
        $this->_messageManager = $messageManager;
    }

    /**
     * Before config save callback.
     *
     * @param Config $config
     *
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function beforeSave(Config $config)
    {
        $propertyId = $this->_configHelper->getPropertyId();

        if (false === empty($propertyId)) {
            return;
        }

        $section = $config->getSection();

        if (false === in_array(
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

        if (true === isset($productMap[ $section ])) {
            $onboardingProduct = $productMap[ $section ];
        }

        $baseUrl = $this->_storeManager->getStore()->getBaseUrl();

        try {
            $property = $this->_shareThisService->createProperty($baseUrl, $onboardingProduct);

            $this->_configHelper->saveConfigValue('sharethis_sharebuttons/general/property_id', $property['_id']);
            $this->_configHelper->saveConfigValue('sharethis_sharebuttons/general/secret', $property['secret']);
        } catch (\Exception $e) {
            $this->_messageManager->addErrorMessage($e->getTraceAsString());
        }
    }

    /**
     * Config save callback.
     *
     * @param Config $config Configuration interceptor object.
     *
     * @throws \Exception
     */
    public function afterSave(Config $config)
    {
        $section = $config->getSection();

        if (false === in_array(
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

        $propertyId = $this->_configHelper->getPropertyId();
        $secret = $this->_configHelper->getSecret();

        if (true === empty($propertyId)) {
            return;
        }

        switch ($section) {
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
    protected function saveInlineButtonConfig($propertyId, $secret)
    {
        $inlineSocialNetworks = $this->_configHelper->getSocialNetworks('inline');

        $inlineSocialNetworksCount = count($inlineSocialNetworks);

        $this->_shareThisService->updateProduct(
            $propertyId,
            $secret,
            'inline-share-buttons',
            [
                'alignment'         => $this->_configHelper->getInlineButtonsAlignment(),
                'enabled'           => $this->_configHelper->getInlineButtonsEnabled(),
                'font_size'         => $this->_configHelper->getInlineButtonsFontSize(),
                'labels'            => $this->_configHelper->getInlineButtonsLabelType(),
                'min_count'         => $this->_configHelper->getInlineButtonsMinimumCount(),
                'padding'           => $this->_configHelper->getInlineButtonsPadding(),
                'radius'            => $this->_configHelper->getInlineButtonsRadius(),
                'networks'          => $inlineSocialNetworks,
                'show_total'        => $this->_configHelper->getInlineButtonsShowCounts(),
                'size'              => $this->_configHelper->getInlineButtonsSize(),
                'spacing'           => $this->_configHelper->getInlineButtonsSpacing(),
                'language'          => $this->_configHelper->getInlineButtonsLanguage(),
                'color'             => $this->_configHelper->getInlineButtonsColor(),
                'has_spacing'       => $this->_configHelper->getInlineButtonsHasSpacing(),
                'num_networks'      => $inlineSocialNetworksCount,
                'size_label'        => $this->_configHelper->getInlineButtonsLabelSize(),
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
    protected function saveStickyButtonConfig($propertyId, $secret)
    {
        $this->_shareThisService->updateProduct(
            $propertyId,
            $secret,
            'sticky-share-buttons',
            [
                'alignment'         => $this->_configHelper->getStickyButtonsAlignment(),
                'enabled'           => $this->_configHelper->getStickyButtonsEnabled(),
                'labels'            => $this->_configHelper->getStickyButtonsLabelType(),
                'min_count'         => $this->_configHelper->getStickyButtonsMinimumCount(),
                'radius'            => $this->_configHelper->getStickyButtonsRadius(),
                'networks'          => $this->_configHelper->getSocialNetworks('sticky'),
                'mobile_breakpoint' => $this->_configHelper->getStickyButtonsMobileBreakpoint(),
                'top'               => $this->_configHelper->getStickyButtonsVerticalAlignment(),
                'show_mobile'       => $this->_configHelper->getStickyButtonsShowMobile(),
                'show_total'        => $this->_configHelper->getStickyButtonsShowCounts(),
                'hide_desktop'      => $this->_configHelper->getStickyButtonsHideDesktop(),
                'language'          => $this->_configHelper->getStickyButtonsLanguage(),
            ]
        );
    }
}
