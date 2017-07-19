<?php

namespace twentysteps\Commons\UptimeRobotBundle\Resource;

use Http\Client\HttpClient;
use Http\Message\MessageFactory;
use Symfony\Component\Serializer\SerializerInterface;

use twentysteps\Commons\EnsureBundle\Ensure;

use twentysteps\Commons\UptimeRobotBundle\Model\GetMonitorsResponse;
use twentysteps\Commons\UptimeRobotBundle\Model\MonitorResponse;
use twentysteps\Commons\UptimeRobotBundle\UptimeRobotAPI;

class WrappedMonitorResource extends MonitorResource
{
	private $api;
	
	public function __construct(UptimeRobotAPI $api, $httpClient, MessageFactory $messageFactory, SerializerInterface $serializer)
	{
		parent::__construct($httpClient,$messageFactory,$serializer);
		$this->api = $api;
	}
	
	/**
	 * @param $id
	 * @return null|\twentysteps\Commons\UptimeRobotBundle\Model\Monitor
	 */
	public function find($id) {
		$monitorsResponse = $this->all();
		if ($monitorsResponse instanceof GetMonitorsResponse) {
			if ($monitorsResponse->getStat()=='ok') {
				foreach ($monitorsResponse->getMonitors() as $monitor) {
					if ($monitor->getId()==$id) {
						return $monitor;
					}
				}
			}
		}
		return null;
	}
	
	/**
	 * @param $url
	 * @return null|\twentysteps\Commons\UptimeRobotBundle\Model\Monitor
	 */
	public function findOneByUrl($url) {
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
		return null;
	}
	
	/**
	 * @param $parameters
	 * @return \Psr\Http\Message\ResponseInterface|\twentysteps\Commons\UptimeRobotBundle\Model\MonitorResponse
	 */
	public function createOrUpdate($parameters) {
		Ensure::isTrue(is_array($parameters) && array_key_exists('url',$parameters),'check your parameters - must be an array and contain a url entry');
		$monitorResponse = $this->findOneByUrl($parameters['url']);
		if ($monitorResponse) {
			$parameters['id']=$monitorResponse->getId();
			return $this->update($parameters);
		}
		return $this->create($parameters);
	}
	
	
	/**
	 *
	 * pause a monitor
	 *
	 * @param array $parameters
	 * @param string $fetch
	 * @return bool|\Psr\Http\Message\ResponseInterface|\twentysteps\Commons\UptimeRobotBundle\Model\Error
	 */
	public function pause($parameters = array(), $fetch = self::FETCH_OBJECT)
	{
		$parameters['status']=0;
		$monitorResponse = $this->update($parameters,$fetch);
		if ($monitorResponse instanceof MonitorResponse) {
			if ($monitorResponse->getStat()=='ok') {
				return true;
			}
			return $monitorResponse->getError();
		}
		return $monitorResponse;
	}
	
	/**
	 * @param $url
	 * @return bool|null|\Psr\Http\Message\ResponseInterface|\twentysteps\Commons\UptimeRobotBundle\Model\Error
	 */
	public function pauseByUrl($url) {
		$monitorResponse = $this->findOneByUrl($url);
		if ($monitorResponse) {
			/**
			 * @var MonitorResponse $monitorResponse
			 */
			$parameters['id'] = $monitorResponse->getId();
			return $this->pause($parameters);
		}
		return null;
	}
	
	/**
	 *
	 * resume a monitor
	 *
	 * @param array $parameters
	 * @param string $fetch
	 * @return bool|\Psr\Http\Message\ResponseInterface|\twentysteps\Commons\UptimeRobotBundle\Model\Error
	 */
	public function resume($parameters = array(), $fetch = self::FETCH_OBJECT)
	{
		$parameters['status']=1;
		$monitorResponse = $this->update($parameters,$fetch);
		if ($monitorResponse instanceof MonitorResponse) {
			if ($monitorResponse->getStat()=='ok') {
				return true;
			}
			return $monitorResponse->getError();
		}
		return $monitorResponse;
	}
	
	/**
	 * @param $url
	 * @return bool|null|\Psr\Http\Message\ResponseInterface|\twentysteps\Commons\UptimeRobotBundle\Model\Error
	 */
	public function resumeByUrl($url) {
		$monitorResponse = $this->findOneByUrl($url);
		if ($monitorResponse) {
			/**
			 * @var MonitorResponse $monitorResponse
			 */
			$parameters['id'] = $monitorResponse->getId();
			return $this->resume($parameters);
		}
		return null;
	}
	
	// helpers
	
	/**
	 * @return UptimeRobotAPI
	 */
	protected function getApi() {
		return $this->api;
	}
	
	/**
	 * @param UptimeRobotAPI $api
	 * @return WrappedAccountDetailsResource
	 */
	protected function setApi($api) {
		$this->api = $api;
		
		return $this;
	}
	
}