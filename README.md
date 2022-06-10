# Magento ShareThis Share Buttons Plugin Base

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

## Development

TBD...
