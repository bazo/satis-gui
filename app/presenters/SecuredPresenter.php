<?php

namespace App\Presenters;

/**
 * @author Martin Bažík <martin@bazik.sk>
 */
class SecuredPresenter extends BasePresenter
{

	protected function startup()
	{
		parent::startup();

		if (!$this->user->isLoggedIn()) {
			$this->redirect('sign:in');
		}
	}


}
