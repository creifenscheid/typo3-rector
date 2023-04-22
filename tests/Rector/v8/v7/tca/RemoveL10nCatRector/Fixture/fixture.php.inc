<?php

namespace Ssch\TYPO3Rector\Tests\Rector\v8\v7\tca\RemoveL10nCatRector\Fixture;

return [
    'ctrl' => [],
    'columns' => [
        'aColumn' => [
            'l10n_cat' => 'text',
            'config' => [
            ],
        ],
        'bColumn' => [
            'l10n_cat' => 'media',
            'config' => [
            ],
        ],
    ],
];

?>
-----
<?php

namespace Ssch\TYPO3Rector\Tests\Rector\v8\v7\tca\RemoveL10nCatRector\Fixture;

return [
    'ctrl' => [],
    'columns' => [
        'aColumn' => [
            'config' => [
            ],
        ],
        'bColumn' => [
            'config' => [
            ],
        ],
    ],
];

?>
