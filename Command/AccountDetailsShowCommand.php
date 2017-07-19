<?php
	
	namespace twentysteps\Commons\UptimeRobotBundle\Command;
	
	use Symfony\Component\Console\Helper\Table;
	
	use twentysteps\Commons\UptimeRobotBundle\Model\AccountDetailsResponse;
	
	class AccountDetailsShowCommand extends AbstractCommand {
		
		protected function configure() {
			$this
				->setName('twentysteps:commons:uptime-robot:account-details:show')
				->setHelp('Show details of your account at UptimeRobot.')
				->setDescription('Show account details');
			parent::configure();
		}
		
		protected function executeCommand() {
			$this->showAccountDetails();
		}
		
		protected function showAccountDetails() {
			
			$response = $this->getAPI()->accountDetails()->get();

			if ($response instanceof AccountDetailsResponse) {
				/**
				 * @var AccountDetailsResponse $accountDetails
				 */
				$accountDetails = $response;
				
				if ($accountDetails->getStat()=='ok') {
					$this->output->writeln('<info>Account details:</info>');
					$account = $accountDetails->getAccount();
					$tableRows = [
						['api_key',$this->getAPI()->getApiKey()],
						['id', $account->getId()?$account->getId():'n/a'],
						['email', $account->getEmail()],
						['monitor_limit', $account->getMonitorLimit()],
						['monitor_interval', $account->getMonitorInterval()],
						['up_monitors', $account->getUpMonitors()],
						['down_monitors', $account->getDownMonitors()],
						['paused_monitors', $account->getPausedMonitors()]
					];
					$table = new Table($this->output);
					$table
						->setHeaders(array('Key', 'Value'))
						->setRows($tableRows);
					$table->render($this->output);
				} else {
					$this->output->writeln(sprintf('<error>Failed to get account details: %s</error>',$accountDetails->getError()->getMessage()));
				}

			} else {
				$this->output->writeln('<error>Call to UptimeRobot failed: </error>');
				var_dump($response);
			}

		}
	}