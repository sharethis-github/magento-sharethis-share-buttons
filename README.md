# ShareThis Share Buttons Magento Extension

ShareThis - the original embeddable share buttons. We've rebuilt our buttons from the ground up, and they're better than ever. Try them today!

Our share buttons feature all the most popular social networks, including mobile choices like SMS and WhatsApp. Our buttons are mobile optimized, enabling visitors to share your content from any device. Our code is lightweight and won’t bog down your site. Did we mention they're beautiful too? Get crisp logos at any size, plus bold, eye catching colors and labels. Customize a set today to make them your own.

The ShareThis Share Buttons plugin allows Magento websites to quickly configure and install ShareThis share buttons. All the functionality found in the manual installation can be accomplished using this plugin, and more! Take complete control over where and how your share buttons appear on your Magento site.

## Table of Contents

1. [Installation](#Installation)

## Installation

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
