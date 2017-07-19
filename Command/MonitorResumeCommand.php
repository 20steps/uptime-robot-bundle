<?php
	
	namespace twentysteps\Commons\UptimeRobotBundle\Command;
	
	use Symfony\Component\Console\Input\InputArgument;

	use \twentysteps\Commons\UptimeRobotBundle\Model\MonitorResponse;
	
	class MonitorResumeCommand extends AbstractCommand {
		
		protected function configure() {
			$this
				->setName('twentysteps:commons:uptime-robot:monitor:resume')
				->setHelp('Resume a monitor at UptimeRobot.')
				->setDescription('Resume monitor')
				->addArgument('id',InputArgument::REQUIRED, 'Id of the monitor you want to resume');
			parent::configure();
		}
		
		protected function executeCommand() {
			$this->resumeMonitor($this->input->getArgument('id'));
		}
		
		protected function resumeMonitor($id) {
			
			$response = $this->getAPI()->monitor()->resume(['id' => $id]);

			if ($response instanceof MonitorResponse) {
				/**
				 * @var MonitorResponse $monitorResponse
				 */
				$monitorResponse = $response;
				
				if ($monitorResponse->getStat()=='ok') {
					$this->output->writeln(sprintf('<info>Monitor with id %d resumed</info>',$monitorResponse->getMonitor()->getId()));
				} else {
					$this->output->writeln(sprintf('<error>Failed to resume monitor with id %d: %s</error>',$id,$monitorResponse->getError()->getMessage()));
				}

			} else {
				$this->output->writeln('<error>Call to UptimeRobot failed: </error>');
				var_dump($response);
			}

		}
	}