<?php
	
	namespace twentysteps\Commons\UptimeRobotBundle\Command;
	
	use Symfony\Component\Console\Input\InputArgument;

	use \twentysteps\Commons\UptimeRobotBundle\Model\PSPResponse;
	
	class PublicStatusPageDeleteCommand extends AbstractCommand {
		
		protected function configure() {
			$this
				->setName('twentysteps:commons:uptime-robot:public-status-page:delete')
				->setHelp('Delete a public status page at UptimeRobot.')
				->setDescription('Delete public status page')
				->addArgument('id',InputArgument::REQUIRED, 'Id of the public status page you want to delete');
			parent::configure();
		}
		
		protected function executeCommand() {
			$this->deletePublicStatusPage($this->input->getArgument('id'));
		}
		
		protected function deletePublicStatusPage($id) {
			
			$response = $this->getAPI()->publicStatusPage()->delete(['id' => $id]);

			if ($response instanceof PSPResponse) {
				/**
				 * @var PSPResponse $pspResponse
				 */
				$pspResponse = $response;
				
				if ($pspResponse->getStat()=='ok') {
					$this->output->writeln(sprintf('<info>Public status page with id %d deleted</info>',$pspResponse->getPsp()->getId()));
				} else {
					$this->output->writeln(sprintf('<error>Failed to delete public status page with id %d: %s</error>',$id,$pspResponse->getError()->getMessage()));
				}

			} else {
				$this->output->writeln('<error>Call to UptimeRobot failed: </error>');
				var_dump($response);
			}

		}
	}