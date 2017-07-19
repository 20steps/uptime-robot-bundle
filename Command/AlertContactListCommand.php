<?php
	
	namespace twentysteps\Commons\UptimeRobotBundle\Command;
	
	use Symfony\Component\Console\Helper\Table;
	
	use twentysteps\Commons\UptimeRobotBundle\Model\GetAlertContactsResponse;
	
	class AlertContactListCommand extends AbstractCommand {
		
		protected function configure() {
			$this
				->setName('twentysteps:commons:uptime-robot:alert-contact:list')
				->setHelp('Lists your alert contacts at UptimeRobot.')
				->setDescription('List alert contacts');
			parent::configure();
		}
		
		protected function executeCommand() {
			$this->listAlertContacts();
		}
		
		protected function listAlertContacts() {
			
			$response = $this->getAPI()->alertContact()->all();

			if ($response instanceof GetAlertContactsResponse) {
				/**
				 * @var GetAlertContactsResponse $alertContactsResponse
				 */
				$alertContactsResponse = $response;
				
				if ($alertContactsResponse->getStat()=='ok') {
					$this->output->writeln('<info>Alert contacts: </info>');
					
					$tableRows = array();
					foreach ($alertContactsResponse->getAlertContacts() as $alertContact) {
						$tableRows[] = array(
							$alertContact->getId(),
							$alertContact->getFriendlyName(),
							$alertContact->getType(),
							$alertContact->getStatus(),
							$alertContact->getValue(),
						);
					}
					$table = new Table($this->output);
					$table
						->setHeaders(array('ID', 'Friendly name','Type','Status','Value'))
						->setRows($tableRows);
					$table->render($this->output);
				} else {
					$this->output->writeln(sprintf('<error>Failed to get alert contacts: %s</error>',$alertContactsResponse->getError()->getMessage()));
				}
				
			} else {
				$this->output->writeln('<error>Call to UptimeRobot failed: </error>');
				var_dump($response);
			}

		}
	}