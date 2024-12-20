<?php

$finder = (new PhpCsFixer\Finder())
    ->in([
        __DIR__ . '/src',
        __DIR__ . '/tests'
    ])
;

return (new PhpCsFixer\Config())
    ->setRules([
        '@PSR12' => true,
        'strict_param' => true,
        'declare_strict_types' => true,
        'phpdoc_to_comment' => false,
        'array_syntax' => ['syntax' => 'short'],
        'native_function_invocation' => ['include' => ['@all']],
    ])
    ->setFinder($finder)
;
