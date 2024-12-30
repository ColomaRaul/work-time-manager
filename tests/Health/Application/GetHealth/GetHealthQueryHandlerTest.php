<?php declare(strict_types=1);

namespace App\Tests\Health\Application\GetHealth;

use App\Tests\Shared\Infrastructure\PhpUnit\UnitTestCase;

final class GetHealthQueryHandlerTest extends UnitTestCase
{
    public function testGivenNothingWhenExecuteTestThenReturnOk(): void
    {
        $this->assertTrue(true);
    }
}
