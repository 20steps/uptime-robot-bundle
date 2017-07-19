<?php
	
	namespace twentysteps\Commons\UptimeRobotBundle\Command;
	
	use Symfony\Component\Console\Input\InputArgument;
	
	use twentysteps\Commons\UptimeRobotBundle\Model\PSPResponse;
	
	class PublicStatusPageUpdateCommand extends AbstractCommand {
		
		protected function configure() {
			$this
				->setName('twentysteps:commons:uptime-robot:public-status-page:update')
				->setHelp('Update a public status pages at UptimeRobot.')
				->setDescription('Update public status pages')
				->addArgument('id',InputArgument::REQUIRED, 'ID of the status page')
				->addArgument('friendly_name',InputArgument::OPTIONAL, 'Friendly name of the status page')
				->addArgument('monitors',InputArgument::OPTIONAL, '- separate list of monitor ids, 0 for all',0)
			;
			parent::configure();
		}
		
		protected function executeCommand() {
			$this->updatePublicStatusPage($this->input->getArgument('id'),$this->input->getArgument('friendly_name'), $this->input->getArgument('monitors'));
		}
		
		protected function updatePublicStatusPage($id,$friendlyName, $monitors) {
			
			$parameters = [
				'id' => $id,
				'friendly_name' => $friendlyName,
				'monitors' => $monitors
			];
			$response = $this->getAPI()->publicStatusPage()->update($parameters);

			if ($response instanceof PSPResponse) {
				
				/**
				 * @var PSPResponse $pspResponse
				 */
				$pspResponse = $response;
				
				if ($pspResponse->getStat()=='ok') {
					
					$this->output->writeln(sprintf('<info>Public status page with id %d updated</info>',$pspResponse->getPsp()->getId()));
					
				} else {
					
					$this->output->writeln(sprintf('<info>Update of public status page failed: %s</info>',$pspResponse->getError()->getMessage()));
					
				}
				
				
			} else {
				$this->output->writeln('<error>Call to UptimeRobot failed: </error>');
				var_dump($response);
			}

		}
	}