<?php
	
	namespace twentysteps\Commons\UptimeRobotBundle\Command;
	
	use Symfony\Component\Console\Input\InputArgument;

	use \twentysteps\Commons\UptimeRobotBundle\Model\AlertContactUnderscoreResponse;
	
	class AlertContactDeleteCommand extends AbstractCommand {
		
		protected function configure() {
			$this
				->setName('twentysteps:commons:uptime-robot:alert-contact:delete')
				->setHelp('Delete an alert contact at UptimeRobot.')
				->setDescription('Delete alert contact')
				->addArgument('id',InputArgument::REQUIRED, 'Id of the alert contact you want to delete');
			parent::configure();
		}
		
		protected function executeCommand() {
			$this->deleteAlertContact($this->input->getArgument('id'));
		}
		
		protected function deleteAlertContact($id) {
			
			$response = $this->getAPI()->alertContact()->delete(['id' => $id]);

			if ($response instanceof AlertContactUnderscoreResponse) {
				/**
				 * @var AlertContactUnderscoreResponse $alertContactResponse
				 */
				$alertContactResponse = $response;
				
				if ($alertContactResponse->getStat()=='ok') {
					$this->output->writeln(sprintf('<info>Alert contact with id %d deleted</info>',$alertContactResponse->getAlertcontact()->getId()));
				} else {
					$this->output->writeln(sprintf('<error>Failed to delete alert contact page with id %d: %s</error>',$id,$alertContactResponse->getError()->getMessage()));
				}

			} else {
				$this->output->writeln('<error>Call to UptimeRobot failed: </error>');
				var_dump($response);
			}

		}
	}