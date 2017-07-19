<?php
	
	namespace twentysteps\Commons\UptimeRobotBundle\Command;
	
	use Symfony\Component\Console\Helper\Table;
	
	use \twentysteps\Commons\UptimeRobotBundle\Model\GetMonitorsResponse;
	use twentysteps\Commons\UptimeRobotBundle\Model\Monitor;
	
	class MonitorListCommand extends AbstractCommand {
		
		protected function configure() {
			$this
				->setName('twentysteps:commons:uptime-robot:monitor:list')
				->setHelp('Lists your monitors at UptimeRobot.')
				->setDescription('List monitors');
			parent::configure();
		}
		
		protected function executeCommand() {
			$this->listMonitors();
		}
		
		protected function listMonitors() {
			
			$response = $this->getAPI()->monitor()->all(['logs' => 1]);

			if ($response instanceof GetMonitorsResponse) {
				/**
				 * @var GetMonitorsResponse $monitorsResponse
				 */
				$monitorsResponse = $response;
				
				if ($monitorsResponse->getStat()=='ok') {
					$this->output->writeln('<info>Monitors: </info>');
					
					$tableRows = array();
					foreach ($monitorsResponse->getMonitors() as $monitor) {
						$tableRows[] = array(
							$monitor->getId(),
							$monitor->getFriendlyName(),
							$monitor->getUrl(),
							$monitor->getStatus()
						);
					}
					$table = new Table($this->output);
					$table
						->setHeaders(array('ID', 'Friendly name', 'URL', 'Status'))
						->setRows($tableRows);
					$table->render($this->output);
				} else {
					$this->output->writeln(sprintf('<error>Failed to get monitors: %s</error>',$monitorsResponse->getError()->getMessage()));
				}
				
			} else {
				$this->output->writeln('<error>Call to UptimeRobot failed: </error>');
				var_dump($response);
			}

		}
	}