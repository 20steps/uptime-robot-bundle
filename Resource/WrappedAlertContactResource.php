<?php

namespace twentysteps\Commons\UptimeRobotBundle\Resource;

use Http\Client\HttpClient;
use Http\Message\MessageFactory;
use Symfony\Component\Serializer\SerializerInterface;

use twentysteps\Commons\EnsureBundle\Ensure;

use twentysteps\Commons\UptimeRobotBundle\Model\GetAlertContactsResponse;
use twentysteps\Commons\UptimeRobotBundle\UptimeRobotAPI;


class WrappedAlertContactResource extends AlertContactResource
{
	private $api;
	
	public function __construct(UptimeRobotAPI $api,$httpClient, MessageFactory $messageFactory, SerializerInterface $serializer)
	{
		parent::__construct($httpClient,$messageFactory,$serializer);
		$this->api = $api;
	}
	
	/**
	 * @param $id
	 * @return null|\twentysteps\Commons\UptimeRobotBundle\Model\AlertContact
	 */
	public function find($id) {
		$alertContactsResponse = $this->all();
		if ($alertContactsResponse instanceof GetAlertContactsResponse) {
			if ($alertContactsResponse->getStat()=='ok') {
				foreach ($alertContactsResponse->getAlertContacts() as $alertContact) {
					if ($alertContact->getId()==$id) {
						return $alertContact;
					}
				}
			}
		}
		return null;
	}
	
	/**
	 * @param $value
	 * @param int $type
	 * @return null|\twentysteps\Commons\UptimeRobotBundle\Model\AlertContact
	 */
	public function findOneByValueAndType($value,$type=2) {
		$alertContactsResponse = $this->all();
		if ($alertContactsResponse instanceof GetAlertContactsResponse) {
			if ($alertContactsResponse->getStat()=='ok') {
				foreach ($alertContactsResponse->getAlertContacts() as $alertContact) {
					if ($alertContact->getValue()==$value && $alertContact->getType()==$type) {
						return $alertContact;
					}
				}
			}
		}
		return null;
	}
	
	/**
	 * @param $parameters
	 * @return null|\Psr\Http\Message\ResponseInterface|\twentysteps\Commons\UptimeRobotBundle\Model\AlertContactResponse|\twentysteps\Commons\UptimeRobotBundle\Model\AlertContactUnderscoreResponse
	 */
	public function createOrUpdate($parameters) {
		Ensure::isTrue(is_array($parameters) && array_key_exists('value',$parameters),'check your parameters - must be an array and contain a value and type entry');
		if (!array_key_exists('type',$parameters)) {
			$parameters['type']=2;
		}
		$alertContactResponse = $this->findOneByValueAndType($parameters['value'],$parameters['type']);
		if ($alertContactResponse) {
			$parameters['id']=$alertContactResponse->getId();
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