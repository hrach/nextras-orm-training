<?php

namespace App\Presenters;

use App\Model\Author;
use App\Model\Book;
use App\Model\FetchJsonFieldFunction;
use App\Model\Model;
use App\Model\Sex;
use Nette\Application\UI\Form;
use Nette\Application\UI\Presenter;
use Nette\Bridges\ApplicationLatte\Template;
use Nette\DI\Attributes\Inject;
use Nette\Utils\Paginator;
use Nextras\Orm\Collection\Functions\CompareEqualsFunction;
use Nextras\Orm\Collection\ICollection;


class HomepageTemplate extends Template
{
	public array $flashes = [];

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
		$booksFiltered = $this->model->books->findAll();

		$paginator = new Paginator();
		$paginator->setPage($page);
		$paginator->setItemsPerPage(1);
		$paginator->setItemCount($booksFiltered->countStored());

		$this->template->books = $booksFiltered->limitBy(
			$paginator->itemsPerPage,
			$paginator->offset
		);
		$this->template->paginator = $paginator;

		// $authors = $this->model->authors->findBy(['sex' => Sex::MALE]);

		$authors = $this->model->authors->findBy([
			ICollection::AND,
			[CompareEqualsFunction::class,
				[FetchJsonFieldFunction::class, 'color', 'red'],
				10
			],
		]);

		foreach ($authors as $author) {
			echo $author->name . '-' . $author->sex->value . '<br>';
		}

		// error
		// $this->model->authors->findBy(['sex' => 'male'])->countStored();
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
