<?php

declare(strict_types=1);

namespace Ssch\TYPO3Rector\Tests\FileProcessor\Resources\Files\Rector\v12\v0\RenameConstantsAndSetupFileEndingRector;

use Iterator;
use Rector\Testing\PHPUnit\AbstractRectorTestCase;

final class RenameConstantsAndSetupFileEndingRectorTest extends AbstractRectorTestCase
{
    /**
     * @dataProvider provideData
     */
    public function test(string $filePath): void
    {
        $this->doTestFile($filePath);
        $this->assertCount(1, $this->removedAndAddedFilesCollector->getMovedFiles());
    }

    /**
     * @dataProvider provideDataSkippedFiles
     */
    public function testSkip(string $filePath): void
    {
        $this->doTestFile($filePath);
        $this->assertCount(0, $this->removedAndAddedFilesCollector->getMovedFiles());
    }

    /**
     * @return Iterator<array<string>>
     */
    public function provideData(): Iterator
    {
        return $this->yieldFilesFromDirectory(__DIR__ . '/Fixture/my_extension/', '*.txt.inc');
    }

    /**
     * @return Iterator<array<string>>
     */
    public function provideDataSkippedFiles(): Iterator
    {
        return $this->yieldFilesFromDirectory(__DIR__ . '/Fixture/my_other_extension/', '*.inc');
    }

    public function provideConfigFilePath(): string
    {
        return __DIR__ . '/config/configured_rule.php';
    }
}
