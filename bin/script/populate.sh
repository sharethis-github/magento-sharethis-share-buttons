#!/usr/bin/env bash

set -eo allexport

# Load env variables in.
. ./env

# Get this directory as a variable.
SCRIPT_DIR=$(cd -- "$(dirname -- "${BASH_SOURCE[0]}")" &>/dev/null && pwd)

# Deploy sample data modules.
"$SCRIPT_DIR/../magento.sh" sampledata:deploy

# Enable sample data modules.
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

# Flush the cache.
"$SCRIPT_DIR/../magento.sh" cache:flush

# Run the upgrade migration scripts.
"$SCRIPT_DIR/../magento.sh" setup:upgrade

# Run dependency injection compilation.
"$SCRIPT_DIR/../magento.sh" setup:di:compile

# Run reindexer.
"$SCRIPT_DIR/../magento.sh" indexer:reindex
