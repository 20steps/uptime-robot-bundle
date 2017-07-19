<?php
	
	namespace twentysteps\Commons\UptimeRobotBundle\Command;
	
	use Symfony\Component\Console\Helper\Table;
	
	use twentysteps\Commons\UptimeRobotBundle\Model\GetPSPsResponse;
	
	class PublicStatusPageListCommand extends AbstractCommand {
		
		protected function configure() {
			$this
				->setName('twentysteps:commons:uptime-robot:public-status-page:list')
				->setHelp('Lists your public status pages at UptimeRobot.')
				->setDescription('List public status pages');
			parent::configure();
		}
		
		protected function executeCommand() {
			$this->listPublicStatusPages();
		}
		
		protected function listPublicStatusPages() {
			
			$response = $this->getAPI()->publicStatusPage()->all();

			if ($response instanceof GetPSPsResponse) {
				/**
				 * @var GetPSPsResponse $publicStatusPagesResponse
				 */
				$publicStatusPagesResponse = $response;
				
				if ($publicStatusPagesResponse->getStat()=='ok') {
					$this->output->writeln('<info>Public status pages: </info>');
					
					$tableRows = array();
					foreach ($publicStatusPagesResponse->getPsps() as $publicStatusPage) {
						$tableRows[] = array(
							$publicStatusPage->getId(),
							$publicStatusPage->getFriendlyName(),
							is_array($publicStatusPage->getMonitors())?implode(',',$publicStatusPage->getMonitors()):'all',
							$publicStatusPage->getSort(),
							$publicStatusPage->getStatus(),
							$publicStatusPage->getStandardUrl(),
							$publicStatusPage->getCustomUrl(),
						);
					}
					$table = new Table($this->output);
					$table
						->setHeaders(array('ID', 'Friendly name','Monitors','Sort','Status','Standard URL','Custom URL'))
						->setRows($tableRows);
					$table->render($this->output);
				} else {
					$this->output->writeln(sprintf('<error>Failed to get public status pages: %s</error>',$publicStatusPagesResponse->getError()->getMessage()));
				}
				
			} else {
				$this->output->writeln('<error>Call to UptimeRobot failed: </error>');
				var_dump($response);
			}

		}
	}