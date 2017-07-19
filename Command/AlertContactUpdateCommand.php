<?php
	
	namespace twentysteps\Commons\UptimeRobotBundle\Command;
	
	use Symfony\Component\Console\Input\InputArgument;
	
	use twentysteps\Commons\UptimeRobotBundle\Model\AlertContactUnderscoreResponse;
	
	class AlertContactUpdateCommand extends AbstractCommand {
		
		protected function configure() {
			$this
				->setName('twentysteps:commons:uptime-robot:alert-contact:update')
				->setHelp('Update an alert contact at UptimeRobot.')
				->setDescription('Update alert contact')
				->addArgument('id',InputArgument::REQUIRED, 'ID of the alert contact')
				->addArgument('friendly_name',InputArgument::REQUIRED, 'Friendly name of the alert contact')
				->addArgument('value',InputArgument::OPTIONAL, 'Address of the alert contact (can only be used if it is a web-hook alert contact)')
				->addArgument('type',InputArgument::OPTIONAL, 'type of the alert contact',2)
			;
			parent::configure();
		}
		
		protected function executeCommand() {
			$this->updateAlertContact($this->input->getArgument('id'), $this->input->getArgument('value'), $this->input->getArgument('friendly_name'), $this->input->getArgument('type'));
		}
		
		protected function updateAlertContact($id,$value,$friendlyName,$type) {
			
			$parameters = [
				'id' => $id,
				'value' => $value,
				'friendly_name' => $friendlyName,
				'type' => $type
			];
			$response = $this->getAPI()->alertContact()->update($parameters);

			if ($response instanceof AlertContactUnderscoreResponse) {
				
				/**
				 * @var AlertContactUnderscoreResponse $alertContactResponse
				 */
				$alertContactResponse = $response;
				
				if ($alertContactResponse->getStat()=='ok') {
					
					$this->output->writeln(sprintf('<info>Alert contact with id %d updated</info>',$alertContactResponse->getAlertcontact()->getId()));
					
				} else {
					
					$this->output->writeln(sprintf('<info>Update of alert contact %d failed: %s</info>',$id,$alertContactResponse->getError()->getMessage()));
					
				}
				
				
			} else {
				$this->output->writeln('<error>Call to UptimeRobot failed: </error>');
				var_dump($response);
			}

		}
	}