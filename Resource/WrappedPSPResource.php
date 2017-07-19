<?php

namespace twentysteps\Commons\UptimeRobotBundle\Resource;

use Http\Client\HttpClient;
use Http\Message\MessageFactory;
use Symfony\Component\Serializer\SerializerInterface;

use twentysteps\Commons\EnsureBundle\Ensure;

use twentysteps\Commons\UptimeRobotBundle\Model\GetPSPsResponse;
use twentysteps\Commons\UptimeRobotBundle\Model\Monitor;
use twentysteps\Commons\UptimeRobotBundle\UptimeRobotAPI;

class WrappedPSPResource extends PSPResource
{
	private $api;
	
	public function __construct(UptimeRobotAPI $api,$httpClient, MessageFactory $messageFactory, SerializerInterface $serializer)
	{
		parent::__construct($httpClient,$messageFactory,$serializer);
		$this->api = $api;
	}
	
	/**
	 * @param $id
	 * @return null|\twentysteps\Commons\UptimeRobotBundle\Model\PSP
	 */
	public function find($id) {
		$pspsResponse = $this->all();
		if ($pspsResponse instanceof GetPSPsResponse) {
			if ($pspsResponse->getStat()=='ok') {
				foreach ($pspsResponse->getPsps() as $psp) {
					if ($psp->getId()==$id) {
						return $psp;
					}
				}
			}
		}
		return null;
	}
	
	/**
	 * @param $monitorId
	 * @return bool|\twentysteps\Commons\UptimeRobotBundle\Model\PSP
	 */
	public function findOneByMonitorId($monitorId) {
		/**
		 * @var Monitor $monitor
		 */
		$pspsResponse = $this->all();
		if ($pspsResponse instanceof GetPSPsResponse) {
			if ($pspsResponse->getStat()=='ok') {
				foreach ($pspsResponse->getPsps() as $psp) {
					$monitors = $psp->getMonitors();
					if (is_array($monitors) && count($monitors)==1 && $monitors[0] == $monitorId) {
						return $psp;
					}
				}
			}
		}
		return false;
	}
	
	/**
	 * @param array $monitorIds
	 * @return bool|\twentysteps\Commons\UptimeRobotBundle\Model\PSP
	 */
	public function findOneByMonitorIds(array $monitorIds) {
		/**
		 * @var Monitor $monitor
		 */
		$pspsResponse = $this->all();
		if ($pspsResponse instanceof GetPSPsResponse) {
			if ($pspsResponse->getStat()=='ok') {
				foreach ($pspsResponse->getPsps() as $psp) {
					$monitors = $psp->getMonitors();
					if (is_array($monitors)) {
						sort($monitors);
						sort($monitorIds);
						if ($monitors==$monitorIds) {
							return $psp;
						}
					}
				}
			}
		}
		return false;
	}
	
	/**
	 * @param int $monitorId
	 * @return \Psr\Http\Message\ResponseInterface|\twentysteps\Commons\UptimeRobotBundle\Model\PSPResponse
	 */
	public function createOrUpdateByMonitorId($monitorId) {
		/**
		 * @var Monitor $monitor
		 */
		$monitor = Ensure::isNotNull($this->getApi()->monitor()->find($monitorId),'no monitor with id ['.$monitorId.'] found');
		$psp = $this->findOneByMonitorId($monitorId);
		$parameters['monitors']=$monitorId;
		$parameters['friendly_name']=$monitor->getFriendlyName();
		if ($psp) {
			$parameters['id']=$psp->getId();
			return $this->update($parameters);
		}
		return $this->create($parameters);
	}
	
	/**
	 * @param array $monitorIds
	 * @return \Psr\Http\Message\ResponseInterface|\twentysteps\Commons\UptimeRobotBundle\Model\PSPResponse
	 */
	public function createOrUpdateByMonitorIds(array $monitorIds,$friendlyName) {
		$psp = $this->findOneByMonitorIds($monitorIds);
		$parameters['monitors']=implode('-',$monitorIds);
		$parameters['friendly_name']=$friendlyName;
		if ($psp) {
			$parameters['id']=$psp->getId();
			return $this->update($parameters);
		}
		return $this->create($parameters);
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