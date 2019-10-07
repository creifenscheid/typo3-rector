<?php

namespace Ssch\TYPO3Rector\Tests\Core\Environment;

use Iterator;
use Rector\Testing\PHPUnit\AbstractRectorTestCase;
use Ssch\TYPO3Rector\Core\Environment\ConstantToEnvironmentCall;
use PHPUnit\Framework\TestCase;

class ConstantToEnvironmentCallTest extends AbstractRectorTestCase
{
    /**
     * @dataProvider provideDataForTest()
     *
     * @param string $file
     */
    public function test(string $file): void
    {
        $this->doTestFile($file);
    }

    public function provideDataForTest(): Iterator
    {
        yield [__DIR__.'/Fixture/environment_constants.php.inc'];
    }

    protected function getRectorsWithConfiguration(): array
    {
        return [
            ConstantToEnvironmentCall::class => [],
        ];
    }

}
