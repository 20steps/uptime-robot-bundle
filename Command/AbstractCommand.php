<?php
	
	namespace twentysteps\Commons\UptimeRobotBundle\Command;
	
	use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;

	use Symfony\Component\DependencyInjection\ContainerInterface;
	use Symfony\Component\Console\Input\InputInterface;
	use Symfony\Component\Console\Output\OutputInterface;
	use Symfony\Component\Console\Style\SymfonyStyle;
	
	use Monolog\Logger;
	use twentysteps\Commons\UptimeRobotBundle\UptimeRobotAPI;
	
	abstract class AbstractCommand extends ContainerAwareCommand {
		
		/**
		 * @var InputInterface
		 */
		protected $input;
		
		/**
		 * @var OutputInterface
		 */
		protected $output;
		
		/**
		 * @var array
		 */
		protected $options;
		
		/** @var  SymfonyStyle */
		protected $io;
		
		/**
		 * @var ContainerInterface
		 */
		protected $container;
		
		/**
		 * @var Logger
		 */
		protected $logger;
		
		protected function init(InputInterface $input, OutputInterface $output) {
			$this->input = $input;
			$this->output = $output;
			$this->io = new SymfonyStyle($this->input,$this->output);

			$this->container = $this->getContainer();
			$this->kernel = $this->container->get('kernel');
			$this->logger = $this->container->get('logger');
		}
		
		protected function execute(InputInterface $input, OutputInterface $output) {
			// tell Wordpress that we are a command so no ouput/redirect/cookie is sent
			define('WP_CLI',1);
			try {
				$this->init($input, $output);
				return $this->executeCommand();
			} catch (\Exception $e) {
				$output->writeln('<error>Exception: \\' . get_class($e) . ' ("' . $e->getMessage() . '")</error>');
				$output->writeln($e->getTraceAsString());
				return 69; // cp. HTTP file:///usr/include/sysexits.h
			}
		}
		
		/**
		 * @return UptimeRobotAPI
		 */
		protected function getAPI() {
			return $this->container->get('twentysteps_commons.uptime_robot.api');
		}
		
		abstract protected function executeCommand();
	}