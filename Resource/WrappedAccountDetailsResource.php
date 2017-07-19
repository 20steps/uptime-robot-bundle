<?php

namespace twentysteps\Commons\UptimeRobotBundle\Resource;

use Http\Client\HttpClient;
use Http\Message\MessageFactory;
use Symfony\Component\Serializer\SerializerInterface;

use twentysteps\Commons\EnsureBundle\Ensure;

use twentysteps\Commons\UptimeRobotBundle\UptimeRobotAPI;

class WrappedAccountDetailsResource extends AccountDetailsResource
{
	private $api;
	
	public function __construct(UptimeRobotAPI $api,$httpClient, MessageFactory $messageFactory, SerializerInterface $serializer)
	{
		parent::__construct($httpClient,$messageFactory,$serializer);
		$this->api = $api;
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