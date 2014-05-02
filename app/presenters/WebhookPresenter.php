<?php

namespace App\Presenters;

use App\Model\Builder;



/**
 * Webhook presenter.
 */
class WebhookPresenter extends BasePresenter
{

	/** @var Builder */
	private $builder;



	function __construct(Builder $builder)
	{
		$this->builder = $builder;
	}


	public function actionDefault($password)
	{
		if ($password === $this->context->parameters['webhook']['password']) {
			$this->builder->build();
		}
		$this->terminate();
	}


}
