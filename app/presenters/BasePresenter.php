<?php

namespace App\Presenters;

use App\Model;
use Nette;
use Texy;

/**
 * Base presenter for all application presenters.
 */
abstract class BasePresenter extends Nette\Application\UI\Presenter {

//	public function startup() {
//		parent::startup();
//		if (!$this->user->isLoggedIn() && !$this->presenter instanceof SignPresenter) {
//			$this->flashMessage('Nemáte na Facebook přístup!', 'warning');
//			$this->redirect('Sign:in');
//		}
//	}

	protected function createTemplate($class = NULL) {
		$template = parent::createTemplate($class);
		$template->registerHelper('texy', function ($input) {
			$texy = new Texy\Texy();
			Texy\Configurator::safeMode($texy);
			$html = new Nette\Utils\Html();
			return $html::el()->setHtml($texy->process($input));
		});
		return $template;
	}

}
