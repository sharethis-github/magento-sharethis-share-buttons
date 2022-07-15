<?php
/**
 * @author    ShareThis
 * @copyright Copyright (c) 2022 ShareThis (https://sharethis.com)
 * @license   https://www.gnu.org/licenses/gpl-3.0.html
 * @package   ShareThis_ShareButtons
 */

namespace ShareThis\ShareButtons\Service;

use Magento\Framework\Serialize\Serializer\Json;
use Magento\Framework\Exception\CouldNotSaveException;
use ShareThis\ShareButtons\Helper\Curl;

/**
 * ShareThis Platform API Service.
 */
class ShareThis
{
    /**
     * Base API URL.
     */
    public const API_REQUEST_URL = 'https://platform-api.sharethis.com';

    /**
     * Property endpoint.
     */
    public const API_PROPERTIES_ENDPOINT = '/v1.0/property';

    /**
     * Products endpoint.
     */
    public const API_PRODUCTS_ENDPOINT = '/v1.0/property/product';

    /**
     * @var \Magento\Framework\HTTP\Client\CurlFactory
     */
    protected $_curlFactory;

    /**
     * @param \Magento\Framework\HTTP\Client\CurlFactory $curlFactory
     * @param Json                                       $json
     */
    public function __construct(
        \Magento\Framework\HTTP\Client\CurlFactory $curlFactory,
        Json $json
    ) {
        $this->_curlFactory = $curlFactory;
        $this->curl         = new Curl();
        $this->json        = $json;
    }

    /**
     * Create property.
     *
     * @param string $domain            Store domain string.
     * @param string $onboardingProduct Onboarding product (default = 'inline-share-buttons').
     *
     * @return array
     *
     * @throws \Exception
     */
    public function createProperty(string $domain, string $onboardingProduct = 'inline-share-buttons')
    {
        $host = parse_url($domain, PHP_URL_HOST); // @codingStandardsIgnoreLine

        $response = $this->doPost(
            self::API_PROPERTIES_ENDPOINT,
            [
                'domain'     => $host,
                'product'    => $onboardingProduct,
                'is_magento' => true,
            ]
        );

        if (false === is_array($response) || true === empty($response['_id'])) {
            throw new CouldNotSaveException(__('Unexpected response from %s', self::API_REQUEST_URL));
        }

        return $response;
    }

    /**
     * Update property.
     *
     * @param string       $propertyId Property ID string.
     * @param string       $secret     Property secret.
     * @param array|object $data       Property data.
     *
     * @return array
     *
     * @throws \Exception
     */
    public function updateProperty($propertyId, $secret, $data)
    {
        $response = $this->doPut(
            sprintf(
                '%s/?id=%s&secret=%s',
                self::API_PROPERTIES_ENDPOINT,
                $propertyId,
                $secret
            ),
            $data
        );

        if (false === is_array($response) || true === empty($response['_id'])) {
            throw new \Exception(__('Unexpected response from %s', self::API_REQUEST_URL));
        }

        return $response;
    }

    /**
     * Update the product by property id and secret.
     *
     * @param string $propertyId Property ID string.
     * @param string $secret     Secret string.
     * @param string $product    Product name string.
     * @param array  $config     Configuration array object.
     *
     * @return array|bool
     * @throws \Exception
     */
    public function updateProduct($propertyId, $secret, $product, $config = [])
    {
        $id = $propertyId;

        $response = $this->doPut(
            self::API_PRODUCTS_ENDPOINT,
            compact('id', 'config', 'product', 'secret')
        );

        if (false === is_array($response) || true === empty($response['_id'])) {
            throw new \Exception(__('Unexpected response from %s', self::API_REQUEST_URL));
        }

        return $response;
    }

    /**
     * Do POST request.
     *
     * @param string $uriEndpoint Endpoint string.
     * @param array  $body        Array of items.
     *
     * @return array|bool
     */
    private function doPost(
        string $uriEndpoint,
        array $body
    ) {
        try {
            $curl = $this->_curlFactory->create();

            $curl->addHeader('Content-Type', 'application/json; charset=utf-8');

            $curl->post(
                self::API_REQUEST_URL . $uriEndpoint,
                json_encode($body)
            );

            $response = $this->json->unserialize($curl->getBody());

            if (false === empty($response['error'])) {
                throw new \Exception(__('Error received: %s', $response['error']));
            }

            return $response;
        } catch (\Exception $e) {
            // Do nothing.
            return false;
        }
    }

    /**
     * Do PUT request.
     *
     * @param string       $uriEndpoint Endpoint string.
     * @param array|object $body        Array of items.
     *
     * @return array|bool
     */
    private function doPut(
        string $uriEndpoint,
        array $body
    ) {
        try {
            $curl = $this->curl;

            $curl->addHeader('Content-Type', 'application/json; charset=utf-8');

            $curl->put(
                self::API_REQUEST_URL . $uriEndpoint,
                json_encode($body)
            );

            $response = $this->json->unserialize($curl->getBody());

            if (false === empty($response['error'])) {
                throw new \Exception(__('Error received: %s', $response['error']));
            }

            return $response;
        } catch (\Exception $e) {
            // Do nothing.
            return false;
        }
    }
}
