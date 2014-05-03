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
class Install extends Command
{

	/** @var Container */
	private $container;



	const USERS_TABLE_DDL = 'CREATE  TABLE "main"."users" ("id" INTEGER PRIMARY KEY  AUTOINCREMENT  NOT NULL , "username" VARCHAR UNIQUE , "password" VARCHAR)';
	const PACKAGES_TABLE_DDL = 'CREATE  TABLE "main"."packages" ("id" INTEGER PRIMARY KEY  AUTOINCREMENT  NOT NULL , "type" VARCHAR, "url" VARCHAR UNIQUE )';



	function __construct(Container $container)
	{
		parent::__construct();
		$this->container = $container;
	}


	protected function configure()
	{
		$this->setName('app:install')
				->setDescription('install');
	}


	protected function execute(InputInterface $input, OutputInterface $output)
	{
		$db = $this->container->getByType('Nette\Database\Connection');

		try {
			$db->query(self::USERS_TABLE_DDL);
			$db->query(self::PACKAGES_TABLE_DDL);
			$output->writeln('App installed');
		} catch (\PDOException $e) {
			$output->writeln(sprintf('<error>%s</error>', $e->getMessage()));
		}
	}


}
