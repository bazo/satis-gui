<?php

namespace Console\Commands;

use Nette\DI\Container;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;



/**
 * @author Martin Bažík <martin@bazik.sk>
 */
class CreateUser extends Command
{

	/** @var Container */
	private $container;



	function __construct(Container $container)
	{
		parent::__construct();
		$this->container = $container;
	}


	protected function configure()
	{
		$this->setName('user:create')
				->addArgument('login', InputArgument::REQUIRED, 'login?')
				->addArgument('password', InputArgument::REQUIRED, 'password?')
				->setDescription('Create a user');
	}


	protected function execute(InputInterface $input, OutputInterface $output)
	{
		$login = $input->getArgument('login');
		$password = $input->getArgument('password');

		$this->container->getByType('App\Model\UserManager')->add($login, $password);

		$output->writeln("User $login was added.");
	}


}
