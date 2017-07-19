<?php
	
	namespace twentysteps\Commons\UptimeRobotBundle\Command;
	
	use Symfony\Component\Console\Input\InputArgument;
	
	use twentysteps\Commons\UptimeRobotBundle\Model\AlertContactResponse;
	
	class AlertContactCreateCommand extends AbstractCommand {
		
		protected function configure() {
			$this
				->setName('twentysteps:commons:uptime-robot:alert-contact:create')
				->setHelp('Create an alert contact at UptimeRobot.')
				->setDescription('Create alert contact')
				->addArgument('friendly_name',InputArgument::REQUIRED, 'Friendly name of the alert contact')
				->addArgument('value',InputArgument::REQUIRED, 'Address of the alert contact')
				->addArgument('type',InputArgument::OPTIONAL, 'type of the alert contact',2)
			;
			parent::configure();
		}
		
		protected function executeCommand() {
			$this->createAlertContact($this->input->getArgument('value'), $this->input->getArgument('friendly_name'), $this->input->getArgument('type'));
		}
		
		protected function createAlertContact($value,$friendlyName,$type) {
			
			$parameters = [
				'value' => $value,
				'friendly_name' => $friendlyName,
				'type' => $type
			];
			$response = $this->getAPI()->alertContact()->create($parameters);

			if ($response instanceof AlertContactResponse) {
				
				/**
				 * @var AlertContactResponse $alertContactResponse
				 */
				$alertContactResponse = $response;
				
				if ($alertContactResponse->getStat()=='ok') {
					
					$this->output->writeln(sprintf('<info>Alert contact with id %d created</info>',$alertContactResponse->getAlertcontact()->getId()));
					
				} else {
					
					$this->output->writeln(sprintf('<info>Creation of alert contact failed: %s</info>',$alertContactResponse->getError()->getMessage()));
					
				}
				
				
			} else {
				$this->output->writeln('<error>Call to UptimeRobot failed: </error>');
				var_dump($response);
			}

		}
	}