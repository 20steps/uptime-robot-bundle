<?php
	
	namespace twentysteps\Commons\UptimeRobotBundle\Command;
	
	use Symfony\Component\Console\Input\InputArgument;
	
	use twentysteps\Commons\UptimeRobotBundle\Model\MonitorResponse;
	
	class MonitorCreateCommand extends AbstractCommand {
		
		protected function configure() {
			$this
				->setName('twentysteps:commons:uptime-robot:monitor:create')
				->setHelp('Create a monitor at UptimeRobot.')
				->setDescription('Create monitor')
				->addArgument('friendly_name',InputArgument::REQUIRED, 'Friendly name of the monitor')
				->addArgument('url',InputArgument::REQUIRED, 'URL to be monitored')
				->addArgument('alert_contacts',InputArgument::OPTIONAL, '-separated ids of alert contacts')
			;
			parent::configure();
		}
		
		protected function executeCommand() {
			$this->createMonitor($this->input->getArgument('friendly_name'), $this->input->getArgument('url'), $this->input->getArgument('alert_contacts'));
		}
		
		protected function createMonitor($friendlyName, $url, $alertContacts) {
			
			$parameters = [
				'friendly_name' => $friendlyName,
				'url' => $url,
				'alert_contacts' => $alertContacts
			];
			$response = $this->getAPI()->monitor()->create($parameters);

			if ($response instanceof MonitorResponse) {
				
				/**
				 * @var MonitorResponse $monitorResponse
				 */
				$monitorResponse = $response;
				
				if ($monitorResponse->getStat()=='ok') {
					
					$this->output->writeln(sprintf('<info>Monitor with id %d created</info>',$monitorResponse->getMonitor()->getId()));
					
				} else {
					
					$this->output->writeln(sprintf('<info>Creation of monitor failed: %s</info>',$monitorResponse->getError()->getMessage()));
					
				}
				
				
			} else {
				$this->output->writeln('<error>Call to UptimeRobot failed: </error>');
				var_dump($response);
			}

		}
	}