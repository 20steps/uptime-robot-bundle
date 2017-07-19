<?php
	
	namespace twentysteps\Commons\UptimeRobotBundle\Command;
	
	use Symfony\Component\Console\Input\InputArgument;

	use \twentysteps\Commons\UptimeRobotBundle\Model\MonitorResponse;
	
	class MonitorPauseCommand extends AbstractCommand {
		
		protected function configure() {
			$this
				->setName('twentysteps:commons:uptime-robot:monitor:pause')
				->setHelp('Pause a monitor at UptimeRobot.')
				->setDescription('Pause monitor')
				->addArgument('id',InputArgument::REQUIRED, 'Id of the monitor you want to pause');
			parent::configure();
		}
		
		protected function executeCommand() {
			$this->pauseMonitor($this->input->getArgument('id'));
		}
		
		protected function pauseMonitor($id) {
			
			$response = $this->getAPI()->monitor()->pause(['id' => $id]);

			if ($response instanceof MonitorResponse) {
				/**
				 * @var MonitorResponse $monitorResponse
				 */
				$monitorResponse = $response;
				
				if ($monitorResponse->getStat()=='ok') {
					$this->output->writeln(sprintf('<info>Monitor with id %d paused</info>',$monitorResponse->getMonitor()->getId()));
				} else {
					$this->output->writeln(sprintf('<error>Failed to pause monitor with id %d: %s</error>',$id,$monitorResponse->getError()->getMessage()));
				}

			} else {
				$this->output->writeln('<error>Call to UptimeRobot failed: </error>');
				var_dump($response);
			}

		}
	}