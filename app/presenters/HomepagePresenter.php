<?php

namespace App\Presenters;

use App\Model\Book;
use App\Model\Model;
use Nette\Application\UI\Form;
use Nette\Application\UI\Presenter;
use Nette\Bridges\ApplicationLatte\Template;
use Nette\DI\Attributes\Inject;
use Nette\Utils\Paginator;
use Nextras\Orm\Collection\ICollection;


class HomepageTemplate extends Template
{
	public Paginator $paginator;

	/** @var ICollection<Book> */
	public ICollection $books;
}


/**
 * @property-read HomepageTemplate $template
 */
class HomepagePresenter extends Presenter
{
	#[Inject]
	public Model $model;


	public function renderDefault(): void
	{
		$this->template->books = $this->model->books->findAll();
	}


	protected function createComponentAddBook(): Form
	{
		$form = new Form();
		$form->addText('title', 'Title')
			->setRequired();
		$form->addText('publishedOn', 'Published on')
			->setHtmlType('date')
			->setRequired();
		$form->addSubmit('add', 'Add');

		$form->onSuccess[] = function ($form, $values) {
			$book = new Book();
			$book->title = $values->title;
			$book->publishedOn = $values->publishedOn;
			$this->model->persistAndFlush($book);
			$this->redirect('this');
		};

		return $form;
	}
}
