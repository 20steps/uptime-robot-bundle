<?php

namespace twentysteps\Commons\UptimeRobotBundle\Resource;

use Http\Client\HttpClient;
use Http\Message\MessageFactory;
use Symfony\Component\Serializer\SerializerInterface;

use twentysteps\Commons\EnsureBundle\Ensure;

use twentysteps\Commons\UptimeRobotBundle\Model\GetMWindowsResponse;
use twentysteps\Commons\UptimeRobotBundle\UptimeRobotAPI;

class WrappedMWindowResource extends MWindowResource
{
	
	private $api;
	
	public function __construct(UptimeRobotAPI $api,$httpClient, MessageFactory $messageFactory, SerializerInterface $serializer)
	{
		parent::__construct($httpClient,$messageFactory,$serializer);
		$this->api = $api;
	}
	
	/**
	 * @param $id
	 * @return null|\twentysteps\Commons\UptimeRobotBundle\Model\MWindow
	 */
	public function find($id) {
		$mwindowsResponse = $this->all();
		if ($mwindowsResponse instanceof GetMWindowsResponse) {
			if ($mwindowsResponse->getStat()=='ok') {
				foreach ($mwindowsResponse->getMwindows() as $mWindow) {
					if ($mWindow->getId()==$id) {
						return $mWindow;
					}
				}
			}
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