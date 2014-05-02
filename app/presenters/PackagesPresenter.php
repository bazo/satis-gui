<?php

namespace App\Presenters;

use App\Model\Builder;
use App\Model\PackageManager;
use Nette\Application\UI\Form;
use PDOException;
use RuntimeException;



/**
 * Homepage presenter.
 */
class PackagesPresenter extends BasePresenter
{

	/** @var PackageManager */
	private $packageManager;

	/** @var Builder */
	private $builder;



	function __construct(PackageManager $packageManager, Builder $builder)
	{
		$this->packageManager = $packageManager;
		$this->builder = $builder;
	}


	protected function startup()
	{
		parent::startup();

		if (!$this->user->isLoggedIn()) {
			$this->redirect('sign:in');
		}
	}


	protected function createComponentFormAdd()
	{
		$form = new Form;

		$form->addText('type', 'Type')->setDefaultValue('vcs')->setRequired();
		$form->addText('url', 'Url')->setRequired();

		$form->addSubmit('btnSubmit', 'Add');

		$form->onSuccess[] = $this->addPackage;

		return $form;
	}


	public function addPackage(Form $form)
	{
		$values = $form->getValues();

		try {
			$this->packageManager->add($values->type, $values->url);
			$this->packageManager->compileConfig();
			$this->flashMessage('Package added.', 'success');
		} catch (PDOException $e) {
			if ($e->getCode() === '23000') {
				$this->flashMessage('Package already exists.', 'danger');
			}
		}

		$this->redirect('this');
	}


	public function renderDefault()
	{
		$packages = $this->packageManager->getAll();


		$this->template->packages = $packages;
	}


	public function handleDelete($id)
	{
		$this->packageManager->delete($id);
		$this->packageManager->compileConfig();
		$this->flashMessage('Package deleted.', 'success');
		$this->redirect('this');
	}


	public function handleBuild()
	{
		try {
			$this->builder->build();
			$this->flashMessage('Packages json built.', 'success');
		} catch (RuntimeException $e) {
			$this->flashMessage('There was an error building packages.json: ' . $e->getMessage(), 'danger');
		}
		$this->redirect('this');
	}


}
