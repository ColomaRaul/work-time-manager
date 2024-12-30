<?php declare(strict_types=1);

namespace App\Shared\Infrastructure\Api;

use App\Shared\Application\Command\CommandInterface;
use App\Shared\Application\Query\QueryInterface;
use App\Shared\Application\Query\QueryResponseInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Messenger\Exception\HandlerFailedException;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\HandledStamp;
use Throwable;

abstract class ApiController extends AbstractController
{
    public function __construct(
        private readonly MessageBusInterface $queryBus,
        private readonly MessageBusInterface $commandBus,
    ) {}

    /**
     * @throws Throwable
     */
    protected function ask(QueryInterface $query): QueryResponseInterface
    {
        try {
            $envelope = $this->queryBus->dispatch($query);
            $handledStamp = $envelope->last(HandledStamp::class);

            if (!$handledStamp) {
                throw new \RuntimeException('No handler processed the query.');
            }

            return $handledStamp->getResult();
        } catch (Throwable $e) {
            while ($e instanceof HandlerFailedException) {
                $e = $e->getPrevious();
            }

            throw $e;
        }
    }

    /**
     * @throws Throwable
     */
    protected function dispatch(CommandInterface $command): void
    {
        try {
            $this->commandBus->dispatch($command);
        } catch (Throwable $e) {
            while ($e instanceof HandlerFailedException) {
                $e = $e->getPrevious();
            }

            throw $e;
        }
    }

    protected function getContentBody(Request $request): array
    {
        return json_decode($request->getContent(), true);
    }
}
