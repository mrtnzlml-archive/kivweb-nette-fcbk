<?php

namespace App\Presenters;

use App;
use App\Model\Posts;
use Nette\Application\UI;
use Tracy;

class HomepagePresenter extends BasePresenter {

	/** @var App\Model\Posts @inject */
	public $posts;

	private $post_id = NULL;
	private $post;

	public function actionDefault($id) {
		$this->post_id = $id;
		$posts = $this->posts->read($id);
		if (!$posts) {
			$this->error();
		}
		$this->post = $posts;
	}

	public function renderDefault($id) {
		$this->template->posts = $this->posts->read();
	}

	protected function createComponentForm() {
		$form = new UI\Form;
		$form->addTextArea('message')
			->setRequired('Co se vám honí hlavou?')
			->setAttribute('placeholder', 'Co se vám honí hlavou?');
		$form->addSubmit('send', 'Odeslat')
			->setAttribute('class', 'btn btn-primary pull-right')
			->setAttribute('style', 'background:#3a5795');
		if ($this->post_id) {
			$form->setDefaults([
				'message' => $this->post->content,
			]);
		}
		$form->onSuccess[] = $this->formSucceeded;
		return $form;
	}

	public function formSucceeded(UI\Form $form, $vals) {
		try {
			if ($this->post_id) {
				$this->posts->update($this->post_id, array(
					Posts::COLUMN_CONTENT => $vals->message,
				));
				$this->flashMessage('Příspěvek byl úspěšně upraven.', 'success');
			} else {
				$this->posts->create(array(
					Posts::COLUMN_CONTENT => $vals->message,
					Posts::COLUMN_DATE => new \DateTime,
				));
				$this->flashMessage('Příspěvek byl úspěšně uložen.', 'success');
			}
		} catch (\PDOException $exc) {
			$this->flashMessage('Příspěvek se nepodařilo uložit.', 'danger');
			Tracy\Debugger::log($exc->getMessage(), Tracy\Debugger::CRITICAL);
		}
		$this->redirect('this');
	}

	public function handleDeletePost($id) {
		//Kontrola oprávnění
		if (is_numeric($id)) {
			try {
				$this->posts->delete($id);
				$this->flashMessage('Příspěvek byl úspěšně smazán.', 'info');
			} catch (\PDOException $exc) {
				$this->flashMessage('Příspěvek se nepodařilo smazat.', 'danger');
				Tracy\Debugger::log($exc->getMessage(), Tracy\Debugger::ERROR);
			}
		}
		$this->redirect('default');
	}

}
