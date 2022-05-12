#!/usr/bin/env bash

set -eo allexport
. ./env

SCRIPT_DIR=$( cd -- "$( dirname -- "${BASH_SOURCE[0]}" )" &> /dev/null && pwd )

"$SCRIPT_DIR/../magento.sh" sampledata:deploy
"$SCRIPT_DIR/../magento.sh" module:enable \
    Magento_CustomerSampleData \
	Magento_MsrpSampleData \
	Magento_CatalogSampleData \
	Magento_DownloadableSampleData \
	Magento_OfflineShippingSampleData \
	Magento_BundleSampleData \
	Magento_ConfigurableSampleData \
	Magento_ThemeSampleData \
	Magento_ProductLinksSampleData \
	Magento_ReviewSampleData \
	Magento_CatalogRuleSampleData \
	Magento_SwatchesSampleData \
	Magento_GroupedProductSampleData \
	Magento_TaxSampleData \
	Magento_CmsSampleData \
	Magento_SalesRuleSampleData \
	Magento_SalesSampleData \
	Magento_WidgetSampleData \
	Magento_WishlistSampleData
"$SCRIPT_DIR/../magento.sh" cache:flush
"$SCRIPT_DIR/../magento.sh" setup:upgrade
"$SCRIPT_DIR/../magento.sh" setup:di:compile
"$SCRIPT_DIR/../magento.sh" indexer:reindex
