<?php

declare(strict_types=1);

namespace Ssch\TYPO3Rector\Rector\v9\v5;

use PhpParser\Node;
use PhpParser\Node\Expr\MethodCall;
use PhpParser\Node\Expr\New_;
use PhpParser\Node\Identifier;
use PhpParser\Node\Name\FullyQualified;
use PHPStan\Type\ObjectType;
use Rector\Core\Rector\AbstractRector;
use Rector\PostRector\Collector\NodesToAddCollector;
use Ssch\TYPO3Rector\Helper\Typo3NodeResolver;
use Symplify\RuleDocGenerator\ValueObject\CodeSample\CodeSample;
use Symplify\RuleDocGenerator\ValueObject\RuleDefinition;
use TYPO3\CMS\Frontend\Controller\TypoScriptFrontendController;

/**
 * @changelog https://docs.typo3.org/c/typo3/cms-core/master/en-us/Changelog/9.5/Deprecation-86486-TypoScriptFrontendController-processOutput.html
 * @see \Ssch\TYPO3Rector\Tests\Rector\v9\v5\RefactorProcessOutputRector\RefactorProcessOutputRectorTest
 */
final class RefactorProcessOutputRector extends AbstractRector
{
    /**
     * @readonly
     */
    public NodesToAddCollector $nodesToAddCollector;

    /**
     * @readonly
     */
    private Typo3NodeResolver $typo3NodeResolver;

    public function __construct(Typo3NodeResolver $typo3NodeResolver, NodesToAddCollector $nodesToAddCollector)
    {
        $this->typo3NodeResolver = $typo3NodeResolver;
        $this->nodesToAddCollector = $nodesToAddCollector;
    }

    /**
     * @return array<class-string<Node>>
     */
    public function getNodeTypes(): array
    {
        return [MethodCall::class];
    }

    /**
     * @param MethodCall $node
     */
    public function refactor(Node $node): ?Node
    {
        if ($this->typo3NodeResolver->isMethodCallOnGlobals(
            $node,
            'processOutput',
            Typo3NodeResolver::TYPO_SCRIPT_FRONTEND_CONTROLLER
        )) {
            $this->refactorToNewMethodCalls($node);

            return null;
        }

        if (! $this->nodeTypeResolver->isMethodStaticCallOrClassMethodObjectType(
            $node,
            new ObjectType('TYPO3\CMS\Frontend\Controller\TypoScriptFrontendController')
        )) {
            return null;
        }

        if (! $this->isName($node->name, 'processOutput')) {
            return null;
        }

        $this->refactorToNewMethodCalls($node);

        return $node;
    }

    /**
     * @codeCoverageIgnore
     */
    public function getRuleDefinition(): RuleDefinition
    {
        return new RuleDefinition(
            'TypoScriptFrontendController->processOutput() to TypoScriptFrontendController->applyHttpHeadersToResponse() and TypoScriptFrontendController->processContentForOutput()',
            [
                new CodeSample(
                    <<<'CODE_SAMPLE'
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Frontend\Controller\TypoScriptFrontendController;

$tsfe = GeneralUtility::makeInstance(TypoScriptFrontendController::class);
$tsfe->processOutput();
CODE_SAMPLE
                    ,
                    <<<'CODE_SAMPLE'
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Frontend\Controller\TypoScriptFrontendController;
use TYPO3\CMS\Core\Http\Response;

$tsfe = GeneralUtility::makeInstance(TypoScriptFrontendController::class);
$tsfe->applyHttpHeadersToResponse(new Response());
$tsfe->processContentForOutput();
CODE_SAMPLE
                ),
            ]
        );
    }

    private function refactorToNewMethodCalls(MethodCall $methodCall): void
    {
        $methodCall->name = new Identifier('applyHttpHeadersToResponse');

        $response = new New_(new FullyQualified('TYPO3\CMS\Core\Http\Response'));

        $methodCall->args[0] = $this->nodeFactory->createArg($response);

        $newNode = $this->nodeFactory->createMethodCall($methodCall->var, 'processContentForOutput');
        $this->nodesToAddCollector->addNodeAfterNode($newNode, $methodCall);
    }
}
