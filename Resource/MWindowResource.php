<?php

namespace twentysteps\Commons\UptimeRobotBundle\Resource;

use Joli\Jane\OpenApi\Runtime\Client\QueryParam;
use Joli\Jane\OpenApi\Runtime\Client\Resource;
class MWindowResource extends Resource
{
    /**
     * The list of maintenance windows can be called with this method.
     *
     * @param array  $parameters {
     *     @var string $api_key API key
     *     @var string $format Response format
     *     @var string $mwindows optional (if not used, will return all mwindows in an account. Else, it is possible to define any number of mwindows with their IDs like: mwindows=236-1782-4790)
     *     @var int $offset optional (used for pagination. Defines the record to start paginating. Default is 0)
     *     @var int $limit optional (used for pagination. Defines the max number of records to return for the response. Default and max. is 10)
     * }
     * @param string $fetch      Fetch mode (object or response)
     *
     * @return \Psr\Http\Message\ResponseInterface|\twentysteps\Commons\UptimeRobotBundle\Model\GetMWindowsResponse|null
     */
    public function all($parameters = array(), $fetch = self::FETCH_OBJECT)
    {
        $queryParam = new QueryParam();
        $queryParam->setDefault('api_key', NULL);
        $queryParam->setFormParameters(array('api_key'));
        $queryParam->setDefault('format', 'json');
        $queryParam->setFormParameters(array('format'));
        $queryParam->setDefault('mwindows', 'json');
        $queryParam->setFormParameters(array('mwindows'));
        $queryParam->setDefault('offset', 0);
        $queryParam->setFormParameters(array('offset'));
        $queryParam->setDefault('limit', 10);
        $queryParam->setFormParameters(array('limit'));
        $url = '/v2/getMWindows';
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
                return $this->serializer->deserialize((string) $response->getBody(), 'twentysteps\\Commons\\UptimeRobotBundle\\Model\\GetMWindowsResponse', 'json');
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