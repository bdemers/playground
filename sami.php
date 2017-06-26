<?php

use Sami\RemoteRepository\GitHubRemoteRepository;
use Sami\Sami;
use Sami\Version\GitVersionCollection;
use Symfony\Component\Finder\Finder;

$dir = __DIR__ . '/src';

$iterator = Finder::create()
    ->files()
    ->name('*.php')
    ->in($dir)
;


$versions = GitVersionCollection::create($dir)
    ->addFromTags('*')
    ->add('master', 'Master')
;

return new Sami($iterator, [
    'title'             => 'Bretterer Playground',
    'versions'          => $versions,
    'build_dir'         => __DIR__ . '/%version%',
    'cache_dir'         => __DIR__ . '/doc_cache/%version%',
    'remote_repository' => new GitHubRemoteRepository('okta/okta-sdk-php', dirname($dir)),
]);