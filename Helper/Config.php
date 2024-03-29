<?php
/**
 * @author    ShareThis
 * @copyright Copyright (c) 2022 ShareThis (https://sharethis.com)
 * @license   https://www.gnu.org/licenses/gpl-3.0.html
 * @package   ShareThis_ShareButtons
 */

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
class Config extends AbstractHelper
{
    /**
     * AbstractData constructor.
     *
     * @param Context $context
     * @param ObjectManagerInterface $objectManager
     * @param StoreManagerInterface $storeManager
     * @param WriterInterface $configWriter
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
    public function getInlineButtonsEnabled(): bool
    {
        return '1' === $this->getConfigValue('sharethis_inline_sharebuttons/general/enabled', '0');
    }

    /**
     * Get inline buttons font size.
     *
     * @return int
     */
    public function getInlineButtonsFontSize(): int
    {
        $size = $this->getInlineButtonsLabelSize();

        switch ($size) {
            case 'large':
                return 16;
            case 'medium':
                return 12;
            default:
            case 'small':
                return 11;
        }
    }

    /**
     * Get inline buttons selected pages as array.
     *
     * @return array
     */
    public function getInlineButtonsSelectPages(): array
    {
        $selectPages = $this->getConfigValue(
            'sharethis_inline_sharebuttons/general/show_on',
            ''
        );

        return explode(',', $selectPages);
    }

    /**
     * Get inline buttons selected positions as array.
     *
     * @return array
     */
    public function getInlineButtonsSelectPositions(): array
    {
        $selectPages = $this->getConfigValue(
            'sharethis_inline_sharebuttons/general/position',
            ''
        );

        return explode(',', $selectPages);
    }

    /**
     * Fetch whether to show inline buttons under cart on PDP.
     *
     * @return bool
     */
    public function getInlineButtonsShowUnderCart(): bool
    {
        return '1' === $this->getConfigValue('sharethis_inline_sharebuttons/general/show_under_cart', '1');
    }

    /**
     * Get inline buttons alignment.
     *
     * @return string
     */
    public function getInlineButtonsAlignment(): string
    {
        return $this->getConfigValue('sharethis_inline_sharebuttons/general/alignment', 'center');
    }

    /**
     * Get inline buttons language.
     *
     * @return string
     */
    public function getInlineButtonsLanguage(): string
    {
        return $this->getConfigValue('sharethis_inline_sharebuttons/general/language', 'en');
    }

    /**
     * Get inline buttons color.
     *
     * @return string
     */
    public function getInlineButtonsColor(): string
    {
	    return $this->getConfigValue('sharethis_inline_sharebuttons/general/color', 'social');
    }

    /**
     * Get inline buttons label size.
     *
     * @return string
     */
    public function getInlineButtonsLabelSize(): string
    {
        return $this->getConfigValue('sharethis_inline_sharebuttons/general/label_size', 'small');
    }

    /**
     * Get inline buttons label type.
     *
     * @return string
     */
    public function getInlineButtonsLabelType(): string
    {
        return $this->getConfigValue('sharethis_inline_sharebuttons/general/label_type', 'cta');
    }

    /**
     * Get inline buttons - show counts.
     *
     * @return bool
     */
    public function getInlineButtonsShowCounts(): bool
    {
        return '1' === $this->getConfigValue('sharethis_inline_sharebuttons/general/show_counts', '0');
    }

    /**
     * Get inline buttons size.
     *
     * @return int
     */
    public function getInlineButtonsSize(): int
    {
        $size = $this->getInlineButtonsLabelSize();

        switch ($size) {
            case 'large':
                return 48;
            case 'medium':
                return 40;
            default:
            case 'small':
                return 32;
        }
    }

    /**
     * Get inline buttons spacing.
     *
     * @return int
     */
    public function getInlineButtonsSpacing(): int
    {
        $size = $this->getInlineButtonsHasSpacing();

        return true === $size ? 8 : 0;
    }

    /**
     * Get inline buttons - min count to show counts.
     *
     * @return integer
     */
    public function getInlineButtonsMinimumCount(): int
    {
        return (int)$this->getConfigValue('sharethis_inline_sharebuttons/general/min_count', 1);
    }

    /**
     * Get inline buttons padding.
     *
     * @return int
     */
    public function getInlineButtonsPadding(): int
    {
        $size = $this->getInlineButtonsLabelSize();

        switch ($size) {
            case 'large':
                return 12;
            case 'medium':
                return 10;
            default:
            case 'small':
                return 8;
        }
    }

    /**
     * Get inline buttons border radius.
     *
     * @return integer
     */
    public function getInlineButtonsRadius(): int
    {
        return (int)$this->getConfigValue('sharethis_inline_sharebuttons/general/radius', 0);
    }

    /**
     * Get inline buttons - has spacing.
     *
     * @return bool
     */
    public function getInlineButtonsHasSpacing(): bool
    {
        return '1' === $this->getConfigValue('sharethis_inline_sharebuttons/general/has_spacing', '1');
    }

    /**
     * Get inline social networks.
     *
     * @param string $type Button type (inline or sticky).
     *
     * @return array
     */
    public function getSocialNetworks(string $type = 'inline'): array
    {
        $networks = [];

        foreach ($this->getSupportedSocialNetworks() as $supportedSocialNetwork => $supportedSocialNetworkLabel) {
            $networks[ $supportedSocialNetwork ] = $this->getConfigValue(
                sprintf('sharethis_%s_sharebuttons/social_networks/%s', $type, $supportedSocialNetwork),
                ''
            );
        }

        $networks = array_filter(
            $networks,
            function ($network) {
                return false === empty($network);
            }
        );

        $networkSlugs = array_keys($networks);

        sort($networkSlugs);

        return $networkSlugs;
    }

    /** Sticky Share */

    /**
     * Fetch whether sticky buttons are enabled.
     *
     * @return bool
     */
    public function getStickyButtonsEnabled(): bool
    {
        return '1' === $this->getConfigValue('sharethis_sticky_sharebuttons/general/enabled', '0');
    }

    /**
     * Get sticky buttons label type.
     *
     * @return string
     */
    public function getStickyButtonsLabelType(): string
    {
        return $this->getConfigValue('sharethis_sticky_sharebuttons/general/label_type', 'cta');
    }

    /**
     * Get sticky buttons selected pages as array.
     *
     * @return array
     */
    public function getStickyButtonsSelectPages(): array
    {
        $selectPages = $this->getConfigValue(
            'sharethis_sticky_sharebuttons/general/show_on_page',
            ''
        );

        return array_filter(explode(',', $selectPages));
    }

    /**
     * Get sticky buttons cms pages as array.
     *
     * @return array
     */
    public function getStickyButtonsCmsPages(): array
    {
        $cmsPages = $this->getConfigValue(
            'sharethis_sticky_sharebuttons/general/show_on_cms_page',
            ''
        );

        return array_filter(array_map('intval', explode(',', $cmsPages)));
    }

    /**
     * Get sticky buttons 'show on' string.
     *
     * @return string
     */
    public function getStickyButtonsShowOn(): string
    {
        return $this->getConfigValue('sharethis_sticky_sharebuttons/general/show_on', 'all_pages');
    }

    /**
     * Get sticky buttons - min count to show counts.
     *
     * @return integer
     */
    public function getStickyButtonsMinimumCount(): int
    {
        return (int)$this->getConfigValue('sharethis_sticky_sharebuttons/general/min_count', 1);
    }

    /**
     * Get sticky buttons alignment.
     *
     * @return string
     */
    public function getStickyButtonsAlignment(): string
    {
        return $this->getConfigValue('sharethis_sticky_sharebuttons/general/alignment', 'left');
    }

    /**
     * Get sticky buttons language.
     *
     * @return string
     */
    public function getStickyButtonsLanguage(): string
    {
        return $this->getConfigValue('sharethis_sticky_sharebuttons/general/language', 'en');
    }

    /**
     * Get sticky buttons border radius.
     *
     * @return integer
     */
    public function getStickyButtonsRadius(): int
    {
        return (int)$this->getConfigValue('sharethis_sticky_sharebuttons/general/radius', 0);
    }

    /**
     * Get sticky buttons mobile breakpoint.
     *
     * @return int
     */
    public function getStickyButtonsMobileBreakpoint(): int
    {
        return (int)$this->getConfigValue('sharethis_sticky_sharebuttons/general/mobile_breakpoint', 1024);
    }

    /**
     * Get sticky buttons vertical alignment.
     *
     * @return int
     */
    public function getStickyButtonsVerticalAlignment(): int
    {
        return (int)$this->getConfigValue('sharethis_sticky_sharebuttons/general/vertical_alignment', 160);
    }

    /**
     * Get whether sticky buttons should show on mobile.
     *
     * @return bool
     */
    public function getStickyButtonsShowMobile(): bool
    {
        return 1 === (int)$this->getConfigValue('sharethis_sticky_sharebuttons/extra/show_on_mobile', '1');
    }

    /**
     * Get whether sticky buttons should hide on desktop.
     *
     * @return bool
     */
    public function getStickyButtonsHideDesktop(): bool
    {
        return 1 === (int)$this->getConfigValue('sharethis_sticky_sharebuttons/extra/hide_on_desktop', '0');
    }

    /**
     * Get sticky buttons - show counts.
     *
     * @return bool
     */
    public function getStickyButtonsShowCounts(): bool
    {
        return 1 === (int)$this->getConfigValue('sharethis_sticky_sharebuttons/general/show_counts', '0');
    }

    /** Etc. */

    /**
     * Get property ID.
     *
     * @return string
     */
    public function getPropertyId(): string
    {
        return $this->getConfigValue('sharethis_sharebuttons/general/property_id', '');
    }

    /**
     * Get secret.
     *
     * @return string
     */
    public function getSecret(): string
    {
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
        $value = $this->scopeConfig->getValue($field, $scopeType, $scopeValue);

        if (0 !== $value && '0' !== $value && true === empty($value)) {
            return $default;
        }

        return $value;
    }

    /**
     * Save configuration value.
     *
     * @param string $path  Path string.
     * @param mixed  $value Value.
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
    public function getSupportedSocialNetworks(): array
    {
        return [
            'blm'             => __("BLM"),
            'blogger'         => __("Blogger"),
            'buffer'          => __("Buffer"),
            'diaspora'        => __("Diaspora"),
            'digg'            => __("Digg"),
            'douban'          => __("Douban"),
            'email'           => __("Email"),
            'evernote'        => __("Evernote"),
            'facebook'        => __('Facebook'),
            'flipboard'       => __("Flipboard"),
            'getpocket'       => __("Pocket"),
            'gmail'           => __("Gmail"),
            'googlebookmarks' => __("Google Bookmarks"),
            'hackernews'      => __("Hacker News"),
            'instapaper'      => __("Instapaper"),
            'line'            => __("Line"),
            'linkedin'        => __("LinkedIn"),
            'livejournal'     => __("LiveJournal"),
            'mailru'          => __("Mail.ru"),
            'meneame'         => __("Menéame"),
            'messenger'       => __("Messenger"),
            'odnoklassniki'   => __("Odnoklassniki"),
            'pinterest'       => __("Pinterest"),
            'print'           => __("Print"),
            'qzone'           => __("Qzone"),
            'reddit'          => __("Reddit"),
            'refind'          => __("Refind"),
            'renren'          => __("Renren"),
            'sharethis'       => __("ShareThis"),
            'skype'           => __("Skype"),
            'sms'             => __("SMS"),
            'surfingbird'     => __("SurfingBird"),
            'snapchat'        => __("Snapchat"),
            'telegram'        => __("Telegram"),
            'threema'         => __("Threema"),
            'twitter'         => __('Twitter'),
            'tumblr'          => __("Tumblr"),
            'vk'              => __("VK"),
            'wechat'          => __("WeChat"),
            'weibo'           => __("Weibo"),
            'whatsapp'        => __("WhatsApp"),
            'wordpress'       => __("WordPress"),
            'xing'            => __("Xing"),
            'yahoomail'       => __("Yahoo! Mail"),
        ];
    }
}
