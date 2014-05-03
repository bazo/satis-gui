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
class Build extends Command
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
		$this->setName('satis:build')
				->addArgument('packages', InputArgument::OPTIONAL, 'list of packages you want to rebuild', '')
				->setDescription('build');
	}


	protected function execute(InputInterface $input, OutputInterface $output)
	{
		$output->writeln('building package.json...');

		$packages = explode(' ', $input->getArgument('packages'));

		$builder = $this->container->getByType('App\Model\Builder');
		$builder->build($packages);

		$output->writeln('built package.json');
	}


}
