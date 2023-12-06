<?php declare(strict_types = 1);

namespace App\Model;

use Nette\Utils\Json;
use Nextras\Dbal\QueryBuilder\QueryBuilder;
use Nextras\Orm\Collection\Aggregations\IArrayAggregator;
use Nextras\Orm\Collection\Aggregations\IDbalAggregator;
use Nextras\Orm\Collection\Functions\CollectionFunction;
use Nextras\Orm\Collection\Functions\Result\ArrayExpressionResult;
use Nextras\Orm\Collection\Functions\Result\DbalExpressionResult;
use Nextras\Orm\Collection\Helpers\ArrayCollectionHelper;
use Nextras\Orm\Collection\Helpers\DbalQueryBuilderHelper;
use Nextras\Orm\Entity\IEntity;


class FetchJsonFieldFunction implements CollectionFunction
{
	public function processArrayExpression(
		ArrayCollectionHelper $helper,
		IEntity $entity,
		array $args,
		?IArrayAggregator $aggregator = null,
	): ArrayExpressionResult
	{
		$valueResult = $helper->getValue($entity, $args[0], $aggregator);
		$value = Json::decode($valueResult->value);
		return new ArrayExpressionResult(
			value: $value->{$args[1]} ?? null,
		);
	}


	public function processDbalExpression(
		DbalQueryBuilderHelper $helper,
		QueryBuilder $builder,
		array $args,
		?IDbalAggregator $aggregator = null,
	): DbalExpressionResult
	{
		$columnExpression = $helper->processExpression($builder, $args[0], $aggregator);
		$value = $args[1];
		return $columnExpression->append('->%s', "$.$value");
	}
}
