<?php

namespace twentysteps\Commons\UptimeRobotBundle\Resource;

use twentysteps\Commons\EnsureBundle\Ensure;
use twentysteps\Commons\UptimeRobotBundle\Model\GetAlertContactsResponse;

class WrappedAlertContactResource extends AlertContactResource
{
	/**
	 * @param $value
	 * @param int $type
	 * @return bool|\twentysteps\Commons\UptimeRobotBundle\Model\AlertContact
	 */
	public function findByValueAndType($value,$type=2) {
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
		return false;
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
		$alertContactResponse = $this->findByValueAndType($parameters['value'],$parameters['type']);
		if ($alertContactResponse) {
			$parameters['id']=$alertContactResponse->getId();
			return $this->update($parameters);
		}
		return $this->create($parameters);
	}
	
}