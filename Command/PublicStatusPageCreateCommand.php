<?php
	
	namespace twentysteps\Commons\UptimeRobotBundle\Command;
	
	use Symfony\Component\Console\Input\InputArgument;
	
	use twentysteps\Commons\UptimeRobotBundle\Model\PSPResponse;
	
	class PublicStatusPageCreateCommand extends AbstractCommand {
		
		protected function configure() {
			$this
				->setName('twentysteps:commons:uptime-robot:public-status-page:create')
				->setHelp('Create a public status pages at UptimeRobot.')
				->setDescription('Create public status pages')
				->addArgument('friendly_name',InputArgument::REQUIRED, 'Friendly name of the status page')
				->addArgument('monitors',InputArgument::OPTIONAL, '- separate list of monitor ids, 0 for all',0)
			;
			parent::configure();
		}
		
		protected function executeCommand() {
			$this->createPublicStatusPage($this->input->getArgument('friendly_name'), $this->input->getArgument('monitors'));
		}
		
		protected function createPublicStatusPage($friendlyName, $monitors) {
			
			$parameters = [
				'friendly_name' => $friendlyName,
				'monitors' => $monitors
			];
			$response = $this->getAPI()->publicStatusPage()->create($parameters);

			if ($response instanceof PSPResponse) {
				
				/**
				 * @var PSPResponse $pspResponse
				 */
				$pspResponse = $response;
				
				if ($pspResponse->getStat()=='ok') {
					
					$this->output->writeln(sprintf('<info>Public status page with id %d created</info>',$pspResponse->getPsp()->getId()));
					
				} else {
					
					$this->output->writeln(sprintf('<info>Creation of public status page failed: %s</info>',$pspResponse->getError()->getMessage()));
					
				}
				
				
			} else {
				$this->output->writeln('<error>Call to UptimeRobot failed: </error>');
				var_dump($response);
			}

		}
	}