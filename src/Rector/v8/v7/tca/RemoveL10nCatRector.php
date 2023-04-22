<?php

declare(strict_types=1);

namespace Ssch\TYPO3Rector\Rector\v8\v7\tca;

use PhpParser\Node\Expr;
use PhpParser\Node\Expr\Array_;
use Ssch\TYPO3Rector\Rector\Tca\AbstractTcaRector;
use Symplify\RuleDocGenerator\ValueObject\CodeSample\CodeSample;
use Symplify\RuleDocGenerator\ValueObject\RuleDefinition;

/**
 * @changelog http://www.christian-reifenscheid.de
 * @see \Ssch\TYPO3Rector\Tests\Rector\v8\v7\tca\RemoveL10nCatRector\RemoveL10nCatRectorTest
 */
final class RemoveL10nCatRector extends AbstractTcaRector
{
    protected function refactorColumn(Expr $columnName, Expr $columnTca): void
    {
        $configArray = $this->extractSubArrayByKey($columnTca, self::CONFIG);
        if (! $configArray instanceof Array_) {
            return;
        }

        dump($configArray);die();

        $this->hasAstBeenChanged = true;
    }

    /**
     * @codeCoverageIgnore
     */
    public function getRuleDefinition(): RuleDefinition
    {
        return new RuleDefinition('Removes TCA option \"l10n_cat\"', [new CodeSample(
            <<<'CODE_SAMPLE'
CODE_SAMPLE
            ,
            <<<'CODE_SAMPLE'
CODE_SAMPLE
        )]);
    }
}
