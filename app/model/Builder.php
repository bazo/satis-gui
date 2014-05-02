<?php

namespace App\Model;

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


	public function build()
	{
		$command = sprintf('php %s build %s %s', escapeshellarg($this->binFile), escapeshellarg($this->configFile), escapeshellarg($this->outputDir));

		$output = [];
		$returnVar = NULL;

		exec($command, $output, $returnVar);
		if ($returnVar !== 0) {
			throw new \RuntimeException(implode(' ', $output));
		}
	}


}
