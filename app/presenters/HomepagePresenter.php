<?php

namespace App\Presenters;

use App\Model\Model;
use Nette;


class HomepagePresenter extends Nette\Application\UI\Presenter
{
	/** @var Model @inject */
	public $model;


	public function renderDefault()
	{
	}


	protected function createComponentAddBook()
	{
		$form = new Nette\Application\UI\Form();
		$form->addText('title', 'Title')->setRequired(true);
		$form->addText('publishedOn', 'Published on')
			->setType('date')
			->setRequired(true);
		$form->addSubmit('add', 'Add');

		$form->onSuccess[] = function ($form, $values) {

		};

		return $form;
	}
}
