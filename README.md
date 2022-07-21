# ShareThis Share Buttons Magento Extension

ShareThis Share Buttons is a tool that allows you to expand the reach of your content organically and grow your audience. Make it easy for your audience to share your content across the most popular social channels. 

**Features**

- Choose from 40+ social channels: Facebook, Twitter, Email, LinkedIn, WhatsApp, Pinterest, Snapchat, Reddit, Tumblr, Digg, Flipboard, Meneame, Facebook Messenger, Odnoklassniki, Sina Weibo, Vk, Blogger, Xing, Mail Ru, Livejournal, Buffer, Douban, Evernote, Google Bookmarks, Gmail, HackerNews, Instapaper, Line, Pocket, QZone, Diaspora, Surfingbird, Refind, RenRen, Skype, Telegram, Threema, Yahoo Mail, WordPress, and Wechat
- Configure your buttons to stay anchored on the sidebar as visitors scroll or inline near your headline or product on the page for ideal visibility
- Customize the design including the alignment, size, and color to match your brand
- Increase social shares with our responsive, lightweight, code which loads asynchronously and won’t slow down your site.
- Select your preferred language from over 15 options: English, German, Spanish, French, Italian, Japanese, Korean, Portuguese, Russian, Chinese, Dutch, Arabic, Bengali, Hindi, Turkish, and Vietnamese.

## Table of Contents

1. [Installation](#Installation)
   1. [Installation via Composer](#Installation-via-Composer)
   2. [Installation via Github](#Installation-via-Github)
2. [Support](https://github.com/sharethis-github/magento-sharethis-share-buttons/issues/)

## Installation

### Installation via Composer

Installation via Composer is recommended.

```shell
composer require sharethis/magento-sharethis-sharebuttons
php bin/magento setup:upgrade
php bin/magento setup:static-content:deploy
```

### Installation via Github

First, clone the repo.

```bash
git clone git@github.com:weaver-sharethis/magento-sharethis-share-buttons.git
cd magento-sharethis-share-buttons
```

Add the host entry for site:

```bash
127.0.0.1   magento.local
```

Next, build Magento.

```shell
make prepare
```

Now that the containers are built, let's set up the admin:

```shell
make init
```

Once that's done, we can populate the site with sample data. This will take at least 20 minutes. Make sure you set your Docker resources high (8GB RAM at least).

```bash
make populate
```

> NOTE: This command will ask for your Magento credentials. Visit https://marketplace.magento.com/customer/accessKeys/ and copy the `Public Key` and `Private Key` in as the `Username` and `Password` respectively.

Once this is done, your store will be populated with sample data and you can log in with credentials populated from the `MAGENTO_ADMIN_USERNAME` and `MAGENTO_ADMIN_PASSWORD` values from the `env` file.
