<?php

$finder = PhpCsFixer\Finder::create()
    ->in([__DIR__ . '/src'])
    ->in([__DIR__ . '/tests'])
;

return (new PhpCsFixer\Config())
    ->setRules([
        '@PSR12' => true,
    ])
    ->setFinder($finder)
;
