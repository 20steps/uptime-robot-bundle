<?php

namespace twentysteps\Commons\UptimeRobotBundle\Resource;

use Joli\Jane\OpenApi\Runtime\Client\QueryParam;
use Joli\Jane\OpenApi\Runtime\Client\Resource;
class PSPResource extends Resource
{
    /**
     * The list of public status pages can be called with this method.
     *
     * @param array  $parameters {
     *     @var string $api_key API key
     *     @var string $format Response format
     *     @var string $psps optional (if not used, will return all alert contacts in an account. Else, it is possible to define any number of alert contacts with their IDs like: psps=236-1782-4790)
     *     @var int $offset optional (used for pagination. Defines the record to start paginating. Default is 0)
     *     @var int $limit optional (used for pagination. Defines the max number of records to return for the response. Default and max. is 10)
     * }
     * @param string $fetch      Fetch mode (object or response)
     *
     * @return \Psr\Http\Message\ResponseInterface|\twentysteps\Commons\UptimeRobotBundle\Model\GetPSPsResponse|null
     */
    public function all($parameters = array(), $fetch = self::FETCH_OBJECT)
    {
        $queryParam = new QueryParam();
        $queryParam->setDefault('api_key', NULL);
        $queryParam->setFormParameters(array('api_key'));
        $queryParam->setDefault('format', 'json');
        $queryParam->setFormParameters(array('format'));
        $queryParam->setDefault('psps', NULL);
        $queryParam->setFormParameters(array('psps'));
        $queryParam->setDefault('offset', 0);
        $queryParam->setFormParameters(array('offset'));
        $queryParam->setDefault('limit', 10);
        $queryParam->setFormParameters(array('limit'));
        $url = '/v2/getPSPs';
        $url = $url . ('?' . $queryParam->buildQueryString($parameters));
        $headers = array_merge(array('Host' => 'api.uptimerobot.com'), $queryParam->buildHeaders($parameters));
        $body = $queryParam->buildFormDataString($parameters);
        $request = $this->messageFactory->createRequest('POST', $url, $headers, $body);
        $promise = $this->httpClient->sendAsyncRequest($request);
        if (self::FETCH_PROMISE === $fetch) {
            return $promise;
        }
        $response = $promise->wait();
        if (self::FETCH_OBJECT == $fetch) {
            if ('200' == $response->getStatusCode()) {
                return $this->serializer->deserialize((string) $response->getBody(), 'twentysteps\\Commons\\UptimeRobotBundle\\Model\\GetPSPsResponse', 'json');
            }
            if ('400' == $response->getStatusCode()) {
                return null;
            }
            if ('500' == $response->getStatusCode()) {
                return null;
            }
        }
        return $response;
    }
    /**
     * New public status pages can be created using this method.
     *
     * @param array  $parameters {
     *     @var string $api_key API key
     *     @var string $format Response format
     *     @var string $friendly_name name of monitor
     *     @var string $monitors required (The monitors to be displayed can be sent as 15830-32696-83920. Or 0 for displaying all monitors)
     *     @var string $custom_domain optinal
     *     @var int $sort required for port monitoring
     *     @var int $hide_url_links optional (for hiding the Uptime Robot links and only available in the Pro Plan)
     *     @var int $status optional
     * }
     * @param string $fetch      Fetch mode (object or response)
     *
     * @return \Psr\Http\Message\ResponseInterface|\twentysteps\Commons\UptimeRobotBundle\Model\PSPResponse|null
     */
    public function create($parameters = array(), $fetch = self::FETCH_OBJECT)
    {
        $queryParam = new QueryParam();
        $queryParam->setDefault('api_key', NULL);
        $queryParam->setFormParameters(array('api_key'));
        $queryParam->setDefault('format', 'json');
        $queryParam->setFormParameters(array('format'));
        $queryParam->setRequired('friendly_name');
        $queryParam->setFormParameters(array('friendly_name'));
        $queryParam->setDefault('monitors', '0');
        $queryParam->setFormParameters(array('monitors'));
        $queryParam->setDefault('custom_domain', NULL);
        $queryParam->setFormParameters(array('custom_domain'));
        $queryParam->setDefault('sort', NULL);
        $queryParam->setFormParameters(array('sort'));
        $queryParam->setDefault('hide_url_links', NULL);
        $queryParam->setFormParameters(array('hide_url_links'));
        $queryParam->setDefault('status', NULL);
        $queryParam->setFormParameters(array('status'));
        $url = '/v2/newPSP';
        $url = $url . ('?' . $queryParam->buildQueryString($parameters));
        $headers = array_merge(array('Host' => 'api.uptimerobot.com', 'Accept' => array('application/json')), $queryParam->buildHeaders($parameters));
        $body = $queryParam->buildFormDataString($parameters);
        $request = $this->messageFactory->createRequest('POST', $url, $headers, $body);
        $promise = $this->httpClient->sendAsyncRequest($request);
        if (self::FETCH_PROMISE === $fetch) {
            return $promise;
        }
        $response = $promise->wait();
        if (self::FETCH_OBJECT == $fetch) {
            if ('200' == $response->getStatusCode()) {
                return $this->serializer->deserialize((string) $response->getBody(), 'twentysteps\\Commons\\UptimeRobotBundle\\Model\\PSPResponse', 'json');
            }
            if ('400' == $response->getStatusCode()) {
                return null;
            }
            if ('500' == $response->getStatusCode()) {
                return null;
            }
        }
        return $response;
    }
    /**
     * Public status pages can be edited using this method. 
     *
     * @param array  $parameters {
     *     @var string $api_key API key
     *     @var string $format Response format
     *     @var int $id ID
     *     @var string $friendly_name name of monitor
     *     @var string $monitors optional (The monitors to be displayed can be sent as 15830-32696-83920. Or 0 for displaying all monitors)
     *     @var string $custom_domain optional
     *     @var int $sort optional
     *     @var int $hide_url_links optional (for hiding the Uptime Robot links and only available in the Pro Plan)
     *     @var int $status optional
     * }
     * @param string $fetch      Fetch mode (object or response)
     *
     * @return \Psr\Http\Message\ResponseInterface|\twentysteps\Commons\UptimeRobotBundle\Model\PSPResponse|null
     */
    public function update($parameters = array(), $fetch = self::FETCH_OBJECT)
    {
        $queryParam = new QueryParam();
        $queryParam->setDefault('api_key', NULL);
        $queryParam->setFormParameters(array('api_key'));
        $queryParam->setDefault('format', 'json');
        $queryParam->setFormParameters(array('format'));
        $queryParam->setRequired('id');
        $queryParam->setFormParameters(array('id'));
        $queryParam->setDefault('friendly_name', NULL);
        $queryParam->setFormParameters(array('friendly_name'));
        $queryParam->setDefault('monitors', NULL);
        $queryParam->setFormParameters(array('monitors'));
        $queryParam->setDefault('custom_domain', NULL);
        $queryParam->setFormParameters(array('custom_domain'));
        $queryParam->setDefault('sort', NULL);
        $queryParam->setFormParameters(array('sort'));
        $queryParam->setDefault('hide_url_links', NULL);
        $queryParam->setFormParameters(array('hide_url_links'));
        $queryParam->setDefault('status', NULL);
        $queryParam->setFormParameters(array('status'));
        $url = '/v2/editPSP';
        $url = $url . ('?' . $queryParam->buildQueryString($parameters));
        $headers = array_merge(array('Host' => 'api.uptimerobot.com'), $queryParam->buildHeaders($parameters));
        $body = $queryParam->buildFormDataString($parameters);
        $request = $this->messageFactory->createRequest('POST', $url, $headers, $body);
        $promise = $this->httpClient->sendAsyncRequest($request);
        if (self::FETCH_PROMISE === $fetch) {
            return $promise;
        }
        $response = $promise->wait();
        if (self::FETCH_OBJECT == $fetch) {
            if ('200' == $response->getStatusCode()) {
                return $this->serializer->deserialize((string) $response->getBody(), 'twentysteps\\Commons\\UptimeRobotBundle\\Model\\PSPResponse', 'json');
            }
            if ('400' == $response->getStatusCode()) {
                return null;
            }
            if ('500' == $response->getStatusCode()) {
                return null;
            }
        }
        return $response;
    }
    /**
     * Public status pages can be deleted using this method.
     *
     * @param array  $parameters {
     *     @var string $api_key API key
     *     @var string $format Response format
     *     @var int $id ID of public status page to delete
     * }
     * @param string $fetch      Fetch mode (object or response)
     *
     * @return \Psr\Http\Message\ResponseInterface|\twentysteps\Commons\UptimeRobotBundle\Model\PSPResponse|null
     */
    public function delete($parameters = array(), $fetch = self::FETCH_OBJECT)
    {
        $queryParam = new QueryParam();
        $queryParam->setDefault('api_key', NULL);
        $queryParam->setFormParameters(array('api_key'));
        $queryParam->setDefault('format', 'json');
        $queryParam->setFormParameters(array('format'));
        $queryParam->setRequired('id');
        $queryParam->setFormParameters(array('id'));
        $url = '/v2/deletePSP';
        $url = $url . ('?' . $queryParam->buildQueryString($parameters));
        $headers = array_merge(array('Host' => 'api.uptimerobot.com'), $queryParam->buildHeaders($parameters));
        $body = $queryParam->buildFormDataString($parameters);
        $request = $this->messageFactory->createRequest('POST', $url, $headers, $body);
        $promise = $this->httpClient->sendAsyncRequest($request);
        if (self::FETCH_PROMISE === $fetch) {
            return $promise;
        }
        $response = $promise->wait();
        if (self::FETCH_OBJECT == $fetch) {
            if ('200' == $response->getStatusCode()) {
                return $this->serializer->deserialize((string) $response->getBody(), 'twentysteps\\Commons\\UptimeRobotBundle\\Model\\PSPResponse', 'json');
            }
            if ('400' == $response->getStatusCode()) {
                return null;
            }
            if ('500' == $response->getStatusCode()) {
                return null;
            }
        }
        return $response;
    }
}