<?php
	
	namespace twentysteps\Commons\UptimeRobotBundle\Command;
	
	use Symfony\Component\Console\Input\InputArgument;
	
	use twentysteps\Commons\UptimeRobotBundle\Model\MonitorResponse;
	
	class MonitorUpdateCommand extends AbstractCommand {
		
		protected function configure() {
			$this
				->setName('twentysteps:commons:uptime-robot:monitor:update')
				->setHelp('Update a monitor at UptimeRobot.')
				->setDescription('Update monitor')
				->addArgument('id',InputArgument::REQUIRED, 'ID monitor')
				->addArgument('friendly_name',InputArgument::REQUIRED, 'Friendly name of the monitor')
				->addArgument('url',InputArgument::REQUIRED, 'URL to be monitored')
				->addArgument('alert_contacts',InputArgument::OPTIONAL, '-separated ids of alert contacts')
			;
			parent::configure();
		}
		
		protected function executeCommand() {
			$this->updateMonitor($this->input->getArgument('id'), $this->input->getArgument('friendly_name'), $this->input->getArgument('url'), $this->input->getArgument('alert_contacts'));
		}
		
		protected function updateMonitor($id, $friendlyName, $url, $alertContacts) {
			
			$parameters = [
				'id' => $id,
				'friendly_name' => $friendlyName,
				'url' => $url,
				'alert_contacts' => $alertContacts
			];
			$response = $this->getAPI()->monitor()->update($parameters);

			if ($response instanceof MonitorResponse) {
				
				/**
				 * @var MonitorResponse $monitorResponse
				 */
				$monitorResponse = $response;
				
				if ($monitorResponse->getStat()=='ok') {
					
					$this->output->writeln(sprintf('<info>Monitor with id %d updated</info>',$monitorResponse->getMonitor()->getId()));
					
				} else {
					
					$this->output->writeln(sprintf('<info>Update of monitor failed: %s</info>',$monitorResponse->getError()->getMessage()));
					
				}
				
				
			} else {
				$this->output->writeln('<error>Call to UptimeRobot failed: </error>');
				var_dump($response);
			}

		}
	}