<?php
	
	namespace twentysteps\Commons\UptimeRobotBundle\Command;
	
	use Symfony\Component\Console\Helper\Table;
	
	use twentysteps\Commons\UptimeRobotBundle\Model\GetMWindowsResponse;
	
	class MaintenanceWindowListCommand extends AbstractCommand {
		
		protected function configure() {
			$this
				->setName('twentysteps:commons:uptime-robot:maintenance-window:list')
				->setHelp('Lists your maintenance windows at UptimeRobot.')
				->setDescription('List maintenance windows');
			parent::configure();
		}
		
		protected function executeCommand() {
			$this->listMonitors();
		}
		
		protected function listMonitors() {
			
			$response = $this->getAPI()->maintenanceWindow()->all();

			if ($response instanceof GetMWindowsResponse) {
				/**
				 * @var GetMWindowsResponse $maintenanceWindowResponse
				 */
				$maintenanceWindowResponse = $response;
				
				if ($maintenanceWindowResponse->getStat()=='ok') {
					$this->output->writeln('<info>Maintenance Windows: </info>');
					
					$tableRows = array();
					foreach ($maintenanceWindowResponse->getMwindows() as $mwindow) {
						$tableRows[] = array(
							$mwindow->getId(),
							$mwindow->getUser(),
							$mwindow->getType(),
							$mwindow->getFriendlyName(),
							$mwindow->getStatus(),
							$mwindow->getDuration(),
							$mwindow->getStartTime()
						);
					}
					$table = new Table($this->output);
					$table
						->setHeaders(array('ID', 'User', 'Type', 'Friendly name', 'Status', 'Duration', 'Start time'))
						->setRows($tableRows);
					$table->render($this->output);
				} else {
					$this->output->writeln(sprintf('<error>Failed to get maintenance windows: %s</error>',$maintenanceWindowResponse->getError()->getMessage()));
				}


			} else {
				$this->output->writeln('<error>Call to UptimeRobot failed: </error>');
				var_dump($response);
			}

		}
	}