<?php

namespace App\Presenters;

/**
 * Homepage presenter.
 */
class HomepagePresenter extends SecuredPresenter
{

	public function renderDefault()
	{
		$this->template->webhookPassword = $this->context->parameters['webhook']['password'];
	}


}
