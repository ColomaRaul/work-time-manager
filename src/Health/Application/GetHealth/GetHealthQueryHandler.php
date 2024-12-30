<?php declare(strict_types=1);

namespace App\Health\Application\GetHealth;

use App\Shared\Application\Query\QueryHandlerInterface;
use App\Shared\Application\Query\QueryResponseInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
final class GetHealthQueryHandler implements QueryHandlerInterface
{
    public function __invoke(GetHealthQuery $query): QueryResponseInterface
    {
        return new GetHealthQueryResponse('OK',['message' => 'Is a test!!']);
    }
}
