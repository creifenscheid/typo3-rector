<?php
return [
    'mybitmapicon' => ['provider' => \TYPO3\CMS\Core\Imaging\IconProvider\BitmapIconProvider::class, 'source' => 'EXT:my_extension/Resources/Public/Icons/mybitmap.png'],
    'mysvgicon' => ['provider' => \TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class, 'source' => 'EXT:my_extension/Resources/Public/Icons/mysvg.svg'],
    'proof-of-concept' => ['provider' => \TYPO3\CMS\Core\Imaging\IconProvider\FontawesomeIconProvider::class, 'name' => 'spinner', 'spinning' => true],
];
