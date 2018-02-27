<?php

namespace App\Presenters;

use App\Model\Author;
use App\Model\Book;
use App\Model\Model;
use Nette;


class HomepagePresenter extends Nette\Application\UI\Presenter
{
	/** @var Model @inject */
	public $model;


	public function renderDefault(int $page = 1)
	{
		$booksFiltered = $this->model->books->findAll();

		$paginator = new Nette\Utils\Paginator();
		$paginator->setPage($page);
		$paginator->setItemsPerPage(1);
		$paginator->setItemCount($booksFiltered->countStored());

		$this->template->books = $booksFiltered->limitBy(
			$paginator->itemsPerPage,
			$paginator->offset
		);
		$this->template->paginator = $paginator;
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
			$book = new Book();
			$book->title = $values->title;
			$book->publishedOn = $values->publishedOn;
			$this->model->persistAndFlush($book);
			$this->redirect('this');
		};

		return $form;
	}


	protected function createComponentAddAuthor()
	{
		$books = $this->model->books->findAll()->fetchPairs('id', 'title');

		$form = new Nette\Application\UI\Form();
		$form->addSelect('book_id', 'Book', $books);
		$form->addText('author', 'Author');
		$form->addSubmit('add', 'Add');

		$form->onSuccess[] = function ($form, $values) {
			$book = $this->model->books->getById($values->book_id);
			if (!$book) $this->error();

			$author = new Author();
			$author->name = $values->author;
			$book->authors->add($author);

			$this->model->persistAndFlush($book);
			$this->redirect('this');
		};

		return $form;
	}
}
