<?php
	
	namespace twentysteps\Commons\UptimeRobotBundle\Command;
	
	use Symfony\Component\Console\Input\InputArgument;

	use \twentysteps\Commons\UptimeRobotBundle\Model\MonitorResponse;
	
	class MonitorResetCommand extends AbstractCommand {
		
		protected function configure() {
			$this
				->setName('twentysteps:commons:uptime-robot:monitor:reset')
				->setHelp('Reset a monitor at UptimeRobot.')
				->setDescription('Reset monitor')
				->addArgument('id',InputArgument::REQUIRED, 'Id of the monitor you want to reset');
			parent::configure();
		}
		
		protected function executeCommand() {
			$this->resetMonitor($this->input->getArgument('id'));
		}
		
		protected function resetMonitor($id) {
			
			$response = $this->getAPI()->monitor()->reset(['id' => $id]);

			if ($response instanceof MonitorResponse) {
				/**
				 * @var MonitorResponse $monitorResponse
				 */
				$monitorResponse = $response;
				
				if ($monitorResponse->getStat()=='ok') {
					$this->output->writeln(sprintf('<info>Monitor with id %d reset</info>',$monitorResponse->getMonitor()->getId()));
				} else {
					$this->output->writeln(sprintf('<error>Failed to reset monitor with id %d: %s</error>',$id,$monitorResponse->getError()->getMessage()));
				}

			} else {
				$this->output->writeln('<error>Call to UptimeRobot failed: </error>');
				var_dump($response);
			}

		}
	}