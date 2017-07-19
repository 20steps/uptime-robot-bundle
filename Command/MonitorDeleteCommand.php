<?php
	
	namespace twentysteps\Commons\UptimeRobotBundle\Command;
	
	use Symfony\Component\Console\Input\InputArgument;

	use \twentysteps\Commons\UptimeRobotBundle\Model\MonitorResponse;
	
	class MonitorDeleteCommand extends AbstractCommand {
		
		protected function configure() {
			$this
				->setName('twentysteps:commons:uptime-robot:monitor:delete')
				->setHelp('Delete a monitor at UptimeRobot.')
				->setDescription('Delete monitor')
				->addArgument('id',InputArgument::REQUIRED, 'Id of the monitor you want to delete');
			parent::configure();
		}
		
		protected function executeCommand() {
			$this->deleteMonitor($this->input->getArgument('id'));
		}
		
		protected function deleteMonitor($id) {
			
			$response = $this->getAPI()->monitor()->delete(['id' => $id]);

			if ($response instanceof MonitorResponse) {
				/**
				 * @var MonitorResponse $monitorResponse
				 */
				$monitorResponse = $response;
				
				if ($monitorResponse->getStat()=='ok') {
					$this->output->writeln(sprintf('<info>Monitor with id %d deleted</info>',$monitorResponse->getMonitor()->getId()));
				} else {
					$this->output->writeln(sprintf('<error>Failed to delete monitor with id %d: %s</error>',$id,$monitorResponse->getError()->getMessage()));
				}

			} else {
				$this->output->writeln('<error>Call to UptimeRobot failed: </error>');
				var_dump($response);
			}

		}
	}