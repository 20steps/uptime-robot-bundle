<?php

namespace twentysteps\Commons\UptimeRobotBundle\Resource;

use Joli\Jane\OpenApi\Runtime\Client\QueryParam;
use Joli\Jane\OpenApi\Runtime\Client\Resource;
class AlertContactResource extends Resource
{
    /**
     * The list of alert contacts can be called with this method.
     *
     * @param array  $parameters {
     *     @var string $api_key API key
     *     @var string $format Response format
     *     @var string $alertcontacts if not used, will return all alert contacts in an account. Else, it is possible to define any number of alert contacts with their IDs like: alertcontacts=236-1782-4790
     *     @var int $offset used for pagination. Defines the record to start paginating. Default is 0
     *     @var int $limit used for pagination. Defines the max number of records to return for the response. Default and max. is 50
     * }
     * @param string $fetch      Fetch mode (object or response)
     *
     * @return \Psr\Http\Message\ResponseInterface|\twentysteps\Commons\UptimeRobotBundle\Model\GetAlertContactsResponse|null
     */
    public function all($parameters = array(), $fetch = self::FETCH_OBJECT)
    {
        $queryParam = new QueryParam();
        $queryParam->setDefault('api_key', NULL);
        $queryParam->setFormParameters(array('api_key'));
        $queryParam->setDefault('format', 'json');
        $queryParam->setFormParameters(array('format'));
        $queryParam->setDefault('alertcontacts', NULL);
        $queryParam->setFormParameters(array('alertcontacts'));
        $queryParam->setDefault('offset', NULL);
        $queryParam->setFormParameters(array('offset'));
        $queryParam->setDefault('limit', NULL);
        $queryParam->setFormParameters(array('limit'));
        $url = '/v2/getAlertContacts';
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
                return $this->serializer->deserialize((string) $response->getBody(), 'twentysteps\\Commons\\UptimeRobotBundle\\Model\\GetAlertContactsResponse', 'json');
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
     * New alert contacts of any type (mobile/SMS alert contacts are not supported yet) can be created using this method. The alert contacts created using the API are validated with the same way as they were created from uptimerobot.com (activation link for e-mails, tc.).
     *
     * @param array  $parameters {
     *     @var string $api_key API key
     *     @var string $format Response format
     *     @var string $type 1 - SMS, 2 - E-mail, 3 - Twitter DM, 4 - Boxcar, 5 - Web-Hook, 6 - Pushbullet, 7 - Zapier, 9 - Pushover, 10 - HipChat, 11 - Slack - he type of the alert contact notified (SMS is not supported yet).
     *     @var string $value address qualifier depending on type, e.g. email address
     *     @var string $friendly_name 
     * }
     * @param string $fetch      Fetch mode (object or response)
     *
     * @return \Psr\Http\Message\ResponseInterface|\twentysteps\Commons\UptimeRobotBundle\Model\AlertContactResponse|null
     */
    public function create($parameters = array(), $fetch = self::FETCH_OBJECT)
    {
        $queryParam = new QueryParam();
        $queryParam->setDefault('api_key', NULL);
        $queryParam->setFormParameters(array('api_key'));
        $queryParam->setDefault('format', 'json');
        $queryParam->setFormParameters(array('format'));
        $queryParam->setDefault('type', '2');
        $queryParam->setFormParameters(array('type'));
        $queryParam->setRequired('value');
        $queryParam->setFormParameters(array('value'));
        $queryParam->setDefault('friendly_name', NULL);
        $queryParam->setFormParameters(array('friendly_name'));
        $url = '/v2/newAlertContact';
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
                return $this->serializer->deserialize((string) $response->getBody(), 'twentysteps\\Commons\\UptimeRobotBundle\\Model\\AlertContactResponse', 'json');
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
     * Update alert contacts of any type (mobile/SMS alert contacts are not supported yet) can be created using this method. The alert contacts created using the API are validated with the same way as they were created from uptimerobot.com (activation link for e-mails, tc.).
     *
     * @param array  $parameters {
     *     @var string $api_key API key
     *     @var string $format Response format
     *     @var int $id 
     *     @var string $type 1 - SMS, 2 - E-mail, 3 - Twitter DM, 4 - Boxcar, 5 - Web-Hook, 6 - Pushbullet, 7 - Zapier, 9 - Pushover, 10 - HipChat, 11 - Slack - he type of the alert contact notified (SMS is not supported yet).
     *     @var string $value address qualifier depending on type (can only be used if it is a web-hook alert contact)
     *     @var string $friendly_name 
     * }
     * @param string $fetch      Fetch mode (object or response)
     *
     * @return \Psr\Http\Message\ResponseInterface|\twentysteps\Commons\UptimeRobotBundle\Model\AlertContactUnderscoreResponse|null
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
        $queryParam->setDefault('type', '2');
        $queryParam->setFormParameters(array('type'));
        $queryParam->setRequired('value');
        $queryParam->setFormParameters(array('value'));
        $queryParam->setDefault('friendly_name', NULL);
        $queryParam->setFormParameters(array('friendly_name'));
        $url = '/v2/editAlertContact';
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
                return $this->serializer->deserialize((string) $response->getBody(), 'twentysteps\\Commons\\UptimeRobotBundle\\Model\\AlertContactUnderscoreResponse', 'json');
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
     * Alert contacts can be deleted using this method.
     *
     * @param array  $parameters {
     *     @var string $api_key API key
     *     @var string $format Response format
     *     @var string $id ID of the alert contact to delete
     * }
     * @param string $fetch      Fetch mode (object or response)
     *
     * @return \Psr\Http\Message\ResponseInterface|\twentysteps\Commons\UptimeRobotBundle\Model\AlertContactUnderscoreResponse|null
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
        $url = '/v2/deleteAlertContact';
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
                return $this->serializer->deserialize((string) $response->getBody(), 'twentysteps\\Commons\\UptimeRobotBundle\\Model\\AlertContactUnderscoreResponse', 'json');
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