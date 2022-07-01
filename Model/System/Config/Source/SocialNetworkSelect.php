<?php

namespace ShareThis\ShareButtons\Model\System\Config\Source;

/**
 * Class SocialNetworkSelect.
 *
 * @package ShareThis\ShareButtons
 */
class SocialNetworkSelect extends OptionsArray {

	/**
	 * Get option map of icon colors.
	 *
	 * @return array Option array map of icon colors.
	 */
	public function getOptionMap(): array {
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
