<?php

namespace twentysteps\Commons\UptimeRobotBundle\Resource;

use Joli\Jane\OpenApi\Runtime\Client\QueryParam;
use Joli\Jane\OpenApi\Runtime\Client\Resource;
class MonitorResource extends Resource
{
    /**
     * This is a Swiss-Army knife type of a method for getting any information on monitors. By default, it lists all the monitors in a user's account, their friendly names, types (http, keyword, port, etc.), statuses (up, down, etc.) and uptime ratios. There are optional parameters which lets the getMonitors method to output information on any given monitors rather than all of them.
     *
     * @param array  $parameters {
     *     @var string $api_key API key
     *     @var string $format Response format
     *     @var string $monitors optional (if not used, will return all monitors in an account. Else, it is possible to define any number of monitors with their IDs like: monitors=15830-32696-83920)
     *     @var string $types optional (if not used, will return all monitors types (HTTP, keyword, ping..) in an account. Else, it is possible to define any number of monitor types like: types=1-3-4)
     *     @var string $statuses optional (if not used, will return all monitors statuses (up, down, paused) in an account. Else, it is possible to define any number of monitor statuses like: statuses=2-9)
     *     @var string $custom_uptime_ratios optional (defines the number of days to calculate the uptime ratio(s) for. Ex: customUptimeRatio=7-30-45 to get the uptime ratios for those periods)
     *     @var int $logs optional (defines if the logs of each monitor will be returned. Should be set to 1 for getting the logs. Default is 0)
     *     @var string $logs_limit optional (the number of logs to be returned (descending order). If empty, all logs are returned.
     *     @var string $response_times optional (defines if the response time data of each monitor will be returned. Should be set to 1 for getting them. Default is 0)
     *     @var string $response_times_limits 
     *     @var string $response_times_average optional (by default, response time value of each check is returned. The API can return average values in given minutes. Default is 0. For ex: the Uptime Robot dashboard displays the data averaged/grouped in 30 minutes)
     *     @var string $response_times_start_date optional (the number of response time logs to be returned (descending order). If empty, last 24 hours of logs are returned (if responseTimesStartDate and responseTimesEndDate are not used).
     *     @var string $response_times_end_date optional and works only for the Pro Plan as 24 hour+ logs are kept only in the Pro Plan (ending date of the response times, formatted as 2015-04-23 and must be used with responseTimesStartDate) (can only be used if monitors parameter is used with a single monitorID and responseTimesEndDate - responseTimesStartDate can't be more than 7 days)
     *     @var string $alert_contacts optional (defines if the notified alert contacts of each notification will be returned. Should be set to 1 for getting them. Default is 0. Requires logs to be set to1)
     *     @var int $offset optional (used for pagination. Defines the record to start paginating. Default is 0)
     *     @var int $limit optional (used for pagination. Defines the max number of records to return for the response. Default and max. is 50)
     *     @var string $search optional (a keyword of your choice to search within monitorURL and monitorFriendlyName and get filtered results)
     * }
     * @param string $fetch      Fetch mode (object or response)
     *
     * @return \Psr\Http\Message\ResponseInterface|\twentysteps\Commons\UptimeRobotBundle\Model\GetMonitorsResponse|null
     */
    public function all($parameters = array(), $fetch = self::FETCH_OBJECT)
    {
        $queryParam = new QueryParam();
        $queryParam->setDefault('api_key', NULL);
        $queryParam->setFormParameters(array('api_key'));
        $queryParam->setDefault('format', 'json');
        $queryParam->setFormParameters(array('format'));
        $queryParam->setDefault('monitors', NULL);
        $queryParam->setFormParameters(array('monitors'));
        $queryParam->setDefault('types', NULL);
        $queryParam->setFormParameters(array('types'));
        $queryParam->setDefault('statuses', NULL);
        $queryParam->setFormParameters(array('statuses'));
        $queryParam->setDefault('custom_uptime_ratios', NULL);
        $queryParam->setFormParameters(array('custom_uptime_ratios'));
        $queryParam->setDefault('logs', NULL);
        $queryParam->setFormParameters(array('logs'));
        $queryParam->setDefault('logs_limit', NULL);
        $queryParam->setFormParameters(array('logs_limit'));
        $queryParam->setDefault('response_times', NULL);
        $queryParam->setFormParameters(array('response_times'));
        $queryParam->setDefault('response_times_limits', NULL);
        $queryParam->setFormParameters(array('response_times_limits'));
        $queryParam->setDefault('response_times_average', NULL);
        $queryParam->setFormParameters(array('response_times_average'));
        $queryParam->setDefault('response_times_start_date', NULL);
        $queryParam->setFormParameters(array('response_times_start_date'));
        $queryParam->setDefault('response_times_end_date', NULL);
        $queryParam->setFormParameters(array('response_times_end_date'));
        $queryParam->setDefault('alert_contacts', NULL);
        $queryParam->setFormParameters(array('alert_contacts'));
        $queryParam->setDefault('offset', 0);
        $queryParam->setFormParameters(array('offset'));
        $queryParam->setDefault('limit', 50);
        $queryParam->setFormParameters(array('limit'));
        $queryParam->setDefault('search', NULL);
        $url = '/v2/getMonitors';
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
                return $this->serializer->deserialize((string) $response->getBody(), 'twentysteps\\Commons\\UptimeRobotBundle\\Model\\GetMonitorsResponse', 'json');
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
     * New monitors of any type can be created using this method.
     *
     * @param array  $parameters {
     *     @var string $api_key API key
     *     @var string $format Response format
     *     @var string $friendly_name name of monitor
     *     @var string $url URL to monitor
     *     @var int $type type of monitor
     *     @var string $sub_type required for port monitoring
     *     @var int $port required for port monitoring
     *     @var string $keyword_type required for keyword monitoring
     *     @var string $keyword_value required for keyword monitoring
     *     @var int $interval optional (in seconds)
     *     @var string $http_username optional
     *     @var string $http_password optional
     *     @var string $alert_contacts optional (the alert contacts to be notified when the monitor goes up/down.Multiple alert_contact>ids can be sent like alert_contacts=457_0_0-373_5_0-8956_2_3 where alert_contact>ids are seperated with - and threshold + recurrence are seperated with _. For ex: alert_contacts=457_5_0 refers to 457 being the alert_contact>id, 5 being the threshold and 0 being the recurrence. As the threshold and recurrence is only available in the Pro Plan, they are always 0 in the Free Plan)
     *     @var int $mwindows optional (the maintenance windows for the monitor which can be mentioned with their IDs like 345-2986-71)
     * }
     * @param string $fetch      Fetch mode (object or response)
     *
     * @return \Psr\Http\Message\ResponseInterface|\twentysteps\Commons\UptimeRobotBundle\Model\MonitorResponse|null
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
        $queryParam->setRequired('url');
        $queryParam->setFormParameters(array('url'));
        $queryParam->setDefault('type', 1);
        $queryParam->setFormParameters(array('type'));
        $queryParam->setDefault('sub_type', NULL);
        $queryParam->setFormParameters(array('sub_type'));
        $queryParam->setDefault('port', NULL);
        $queryParam->setFormParameters(array('port'));
        $queryParam->setDefault('keyword_type', NULL);
        $queryParam->setFormParameters(array('keyword_type'));
        $queryParam->setDefault('keyword_value', NULL);
        $queryParam->setFormParameters(array('keyword_value'));
        $queryParam->setDefault('interval', NULL);
        $queryParam->setFormParameters(array('interval'));
        $queryParam->setDefault('http_username', NULL);
        $queryParam->setFormParameters(array('http_username'));
        $queryParam->setDefault('http_password', NULL);
        $queryParam->setFormParameters(array('http_password'));
        $queryParam->setDefault('alert_contacts', NULL);
        $queryParam->setFormParameters(array('alert_contacts'));
        $queryParam->setDefault('mwindows', NULL);
        $queryParam->setFormParameters(array('mwindows'));
        $url = '/v2/newMonitor';
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
                return $this->serializer->deserialize((string) $response->getBody(), 'twentysteps\\Commons\\UptimeRobotBundle\\Model\\MonitorResponse', 'json');
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
     * Monitors can be edited using this method. Important: The type of a monitor can not be edited (like changing a HTTP monitor into a Port monitor). For such cases, deleting the monitor and re-creating a new one is adviced.
     *
     * @param array  $parameters {
     *     @var string $api_key API key
     *     @var string $format Response format
     *     @var int $id ID of the monitor
     *     @var int $status Status of the monitor (1=resume, 0=pause)
     *     @var string $friendly_name name of monitor
     *     @var string $url URL to monitor
     *     @var int $type type of monitor
     *     @var string $sub_type required for port monitoring
     *     @var int $port required for port monitoring
     *     @var string $keyword_type required for keyword monitoring
     *     @var string $keyword_value required for keyword monitoring
     *     @var int $interval optional (in seconds)
     *     @var string $http_username optional
     *     @var string $http_password optional
     *     @var string $alert_contacts optional (the alert contacts to be notified when the monitor goes up/down.Multiple alert_contact>ids can be sent like alert_contacts=457_0_0-373_5_0-8956_2_3 where alert_contact>ids are seperated with - and threshold + recurrence are seperated with _. For ex: alert_contacts=457_5_0 refers to 457 being the alert_contact>id, 5 being the threshold and 0 being the recurrence. As the threshold and recurrence is only available in the Pro Plan, they are always 0 in the Free Plan)
     *     @var int $mwindows optional (the maintenance windows for the monitor which can be mentioned with their IDs like 345-2986-71)
     * }
     * @param string $fetch      Fetch mode (object or response)
     *
     * @return \Psr\Http\Message\ResponseInterface|\twentysteps\Commons\UptimeRobotBundle\Model\MonitorResponse|null
     */
    public function update($parameters = array(), $fetch = self::FETCH_OBJECT)
    {
        $queryParam = new QueryParam();
        $queryParam->setDefault('api_key', NULL);
        $queryParam->setFormParameters(array('api_key'));
        $queryParam->setDefault('format', 'json');
        $queryParam->setFormParameters(array('format'));
        $queryParam->setDefault('id', 'json');
        $queryParam->setFormParameters(array('id'));
        $queryParam->setDefault('status', NULL);
        $queryParam->setFormParameters(array('status'));
        $queryParam->setDefault('friendly_name', NULL);
        $queryParam->setFormParameters(array('friendly_name'));
        $queryParam->setDefault('url', NULL);
        $queryParam->setFormParameters(array('url'));
        $queryParam->setDefault('type', 1);
        $queryParam->setFormParameters(array('type'));
        $queryParam->setDefault('sub_type', NULL);
        $queryParam->setFormParameters(array('sub_type'));
        $queryParam->setDefault('port', NULL);
        $queryParam->setFormParameters(array('port'));
        $queryParam->setDefault('keyword_type', NULL);
        $queryParam->setFormParameters(array('keyword_type'));
        $queryParam->setDefault('keyword_value', NULL);
        $queryParam->setFormParameters(array('keyword_value'));
        $queryParam->setDefault('interval', NULL);
        $queryParam->setFormParameters(array('interval'));
        $queryParam->setDefault('http_username', NULL);
        $queryParam->setFormParameters(array('http_username'));
        $queryParam->setDefault('http_password', NULL);
        $queryParam->setFormParameters(array('http_password'));
        $queryParam->setDefault('alert_contacts', NULL);
        $queryParam->setFormParameters(array('alert_contacts'));
        $queryParam->setDefault('mwindows', NULL);
        $queryParam->setFormParameters(array('mwindows'));
        $url = '/v2/editMonitor';
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
                return $this->serializer->deserialize((string) $response->getBody(), 'twentysteps\\Commons\\UptimeRobotBundle\\Model\\MonitorResponse', 'json');
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
     * Monitors can be deleted using this method.
     *
     * @param array  $parameters {
     *     @var string $api_key API key
     *     @var string $format Response format
     *     @var int $id ID of monitor to delete
     * }
     * @param string $fetch      Fetch mode (object or response)
     *
     * @return \Psr\Http\Message\ResponseInterface|\twentysteps\Commons\UptimeRobotBundle\Model\MonitorResponse|null
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
        $url = '/v2/deleteMonitor';
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
                return $this->serializer->deserialize((string) $response->getBody(), 'twentysteps\\Commons\\UptimeRobotBundle\\Model\\MonitorResponse', 'json');
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
     * Monitors can be reset (deleting all stats and response time data) using this method.
     *
     * @param array  $parameters {
     *     @var string $api_key API key
     *     @var string $format Response format
     *     @var int $id ID of monitor to reset
     * }
     * @param string $fetch      Fetch mode (object or response)
     *
     * @return \Psr\Http\Message\ResponseInterface|\twentysteps\Commons\UptimeRobotBundle\Model\MonitorResponse|null
     */
    public function reset($parameters = array(), $fetch = self::FETCH_OBJECT)
    {
        $queryParam = new QueryParam();
        $queryParam->setDefault('api_key', NULL);
        $queryParam->setFormParameters(array('api_key'));
        $queryParam->setDefault('format', 'json');
        $queryParam->setFormParameters(array('format'));
        $queryParam->setRequired('id');
        $queryParam->setFormParameters(array('id'));
        $url = '/v2/resetMonitor';
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
                return $this->serializer->deserialize((string) $response->getBody(), 'twentysteps\\Commons\\UptimeRobotBundle\\Model\\MonitorResponse', 'json');
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