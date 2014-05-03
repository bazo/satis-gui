<?php

namespace App\Model;

use Symfony\Component\Process\Process;



/**
 * @author Martin Bažík <martin@bazik.sk>
 */
class Builder
{

	/** @var string */
	private $configFile;

	/** @var string */
	private $outputDir;

	/** @var string */
	private $binFile;



	function __construct($configFile, $outputDir, $binFile)
	{
		$this->configFile = realpath($configFile);
		$this->outputDir = realpath($outputDir);
		$this->binFile = realpath($binFile);
	}


	public function build(array $packages = [], callable $callback = NULL)
	{
		$packageList = implode(' ', $packages);
		$command = sprintf('php %s build %s %s %s', escapeshellarg($this->binFile), escapeshellarg($this->configFile), escapeshellarg($this->outputDir), $packageList);

		$process = new Process($command);
		$process->run($callback);

		return $process->getOutput();
	}


}
