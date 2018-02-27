<?php

namespace App\Presenters;

use App\Model\Author;
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


	public function renderDefault(int $page = 1): void
	{
		$paginator = new Paginator();
		$paginator->setPage($page);
		$paginator->setItemsPerPage(1);
		$paginator->setItemCount(100); // todo

		$this->template->books = $this->model->books->findAll();
		$this->template->paginator = $paginator;
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


	protected function createComponentAddAuthor(): Form
	{
		$books = $this->model->books->findAll()->fetchPairs('id', 'title');

		$form = new Form();
		$form->addSelect('book_id', 'Book', $books);
		$form->addText('author', 'Author');
		$form->addSubmit('add', 'Add');

		$form->onSuccess[] = function ($form, $values) {
			$book = $this->model->books->getByIdChecked($values->book_id);

			$author = new Author();
			$author->name = $values->author;
			$book->authors->add($author);

			$this->model->persistAndFlush($book);
			$this->redirect('this');
		};

		return $form;
	}
}
