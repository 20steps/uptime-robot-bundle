<?php

namespace twentysteps\Commons\UptimeRobotBundle\Resource;

use twentysteps\Commons\EnsureBundle\Ensure;
use twentysteps\Commons\UptimeRobotBundle\Model\GetMonitorsResponse;
use twentysteps\Commons\UptimeRobotBundle\Model\MonitorResponse;

class WrappedMonitorResource extends MonitorResource
{
	/**
	 * @param $url
	 * @return bool|\twentysteps\Commons\UptimeRobotBundle\Model\Monitor
	 */
	public function findByUrl($url) {
		$monitorsResponse = $this->all();
		if ($monitorsResponse instanceof GetMonitorsResponse) {
			if ($monitorsResponse->getStat()=='ok') {
				foreach ($monitorsResponse->getMonitors() as $monitor) {
					if ($monitor->getUrl()==$url) {
						return $monitor;
					}
				}
			}
		}
		return false;
	}
	
	/**
	 * @param $parameters
	 * @return \Psr\Http\Message\ResponseInterface|\twentysteps\Commons\UptimeRobotBundle\Model\MonitorResponse
	 */
	public function createOrUpdate($parameters) {
		Ensure::isTrue(is_array($parameters) && array_key_exists('url',$parameters),'check your parameters - must be an array and contain a url entry');
		$monitorResponse = $this->findByUrl($parameters['url']);
		if ($monitorResponse) {
			$parameters['id']=$monitorResponse->getId();
			return $this->update($parameters);
		}
		return $this->create($parameters);
	}
	
	
	/*
	 * Pause a monitor.
	 *
	 * @param array  $parameters {
	 *     @var string $apiKey API key
	 *     @var string $format Response format
	 *     @var int $id ID of monitor to pause
	 * }
	 * @param string $fetch      Fetch mode (object or response)
	 *
	 * @return \Psr\Http\Message\ResponseInterface|\twentysteps\Commons\UptimeRobotBundle\Model\MonitorResponse
	 */
	public function pause($parameters = array(), $fetch = self::FETCH_OBJECT)
	{
		$parameters['status']=0;
		return $this->update($parameters,$fetch);
	}
	
	/**
	 * @param $url
	 * @return bool|\Psr\Http\Message\ResponseInterface|MonitorResponse
	 */
	public function pauseByUrl($url) {
		$monitorResponse = $this->findByUrl($url);
		if ($monitorResponse) {
			/**
			 * @var MonitorResponse $monitorResponse
			 */
			$parameters['id'] = $monitorResponse->getId();
			return $this->pause($parameters);
		}
		return false;
	}
	
	/*
	 * Resume a monitor.
	 *
	 * @param array  $parameters {
	 *     @var string $apiKey API key
	 *     @var string $format Response format
	 *     @var int $id ID of monitor to pause
	 * }
	 * @param string $fetch      Fetch mode (object or response)
	 *
	 * @return \Psr\Http\Message\ResponseInterface|\twentysteps\Commons\UptimeRobotBundle\Model\MonitorResponse
	 */
	public function resume($parameters = array(), $fetch = self::FETCH_OBJECT)
	{
		$parameters['status']=1;
		return $this->update($parameters,$fetch);
	}
	
	/**
	 * @param $url
	 * @return bool|\Psr\Http\Message\ResponseInterface|MonitorResponse
	 */
	public function resumeByUrl($url) {
		$monitorResponse = $this->findByUrl($url);
		if ($monitorResponse) {
			/**
			 * @var MonitorResponse $monitorResponse
			 */
			$parameters['id'] = $monitorResponse->getId();
			return $this->resume($parameters);
		}
		return false;
	}
	
}