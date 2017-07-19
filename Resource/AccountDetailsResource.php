<?php

namespace twentysteps\Commons\UptimeRobotBundle\Resource;

use Joli\Jane\OpenApi\Runtime\Client\QueryParam;
use Joli\Jane\OpenApi\Runtime\Client\Resource;
class AccountDetailsResource extends Resource
{
    /**
     * Account details (max number of monitors that can be added and number of up/down/paused monitors) can be grabbed using this method.
     *
     * @param array  $parameters {
     *     @var string $api_key API key
     *     @var string $format Response format
     * }
     * @param string $fetch      Fetch mode (object or response)
     *
     * @return \Psr\Http\Message\ResponseInterface|\twentysteps\Commons\UptimeRobotBundle\Model\AccountDetailsResponse|null
     */
    public function get($parameters = array(), $fetch = self::FETCH_OBJECT)
    {
        $queryParam = new QueryParam();
        $queryParam->setDefault('api_key', NULL);
        $queryParam->setFormParameters(array('api_key'));
        $queryParam->setDefault('format', 'json');
        $queryParam->setFormParameters(array('format'));
        $url = '/v2/getAccountDetails';
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
                return $this->serializer->deserialize((string) $response->getBody(), 'twentysteps\\Commons\\UptimeRobotBundle\\Model\\AccountDetailsResponse', 'json');
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