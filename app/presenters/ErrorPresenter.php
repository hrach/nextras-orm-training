<?php

namespace App\Presenters;

use Nette\Application\BadRequestException;
use Nette\Application\Helpers;
use Nette\Application\IPresenter;
use Nette\Application\Request;
use Nette\Application\Response;
use Nette\Application\Responses;
use Nette\DI\Attributes\Inject;
use Tracy\ILogger;


class ErrorPresenter implements IPresenter
{
	#[Inject]
	public ILogger $logger;


	public function run(Request $request): Response
	{
		$exception = $request->getParameter('exception');

		if ($exception instanceof BadRequestException) {
			[$module, , $sep] = Helpers::splitName($request->getPresenterName());
			return new Responses\ForwardResponse($request->setPresenterName($module . $sep . 'Error4xx'));
		}

		$this->logger->log($exception, ILogger::EXCEPTION);
		return new Responses\CallbackResponse(function () {
			require __DIR__ . '/templates/Error/500.phtml';
		});
	}
}
