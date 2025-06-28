<?php

namespace Tests\Unit\Framework\Http\Router;

use org\bovigo\vfs\vfsStream;
use Framework\Http\Router\FileBasedRouteFinder;
use Framework\Http\Context;
use Psr\Log\LoggerInterface;

beforeEach(function () {
    $this->logger = $this->createMock(LoggerInterface::class);
    $this->context = $this->createMock(Context::class);
    $this->context->logger = $this->logger;
});

test('finds PHP files with handler methods', function () {
    $root = vfsStream::setup('root', null, [
        'DummyPage.php' => '<?php 
namespace App\\app\\Pages;
use Framework\\Http\\PageAbstractClass;
class DummyPage extends PageAbstractClass { 
    public function get() {} 
        public function pageHtml() {}
}',
        'DummyPostPage.php' => '<?php 
namespace App\\app\\Pages;
use Framework\\Http\\PageAbstractClass;
class DummyPostPage extends PageAbstractClass { 
    public function post() {} 
        public function pageHtml() {}
}',
        'NotAPage.txt' => 'not a php file',
        'Other.php' => '<?php 
namespace App\\app\\Pages;
class Other {}'
    ]);

    $finder = new FileBasedRouteFinder($this->context);
    $results = $finder->getFileBasedPages($root->url());

    // Check results
    $resultClasses = array_column($results, 'class');
    expect($resultClasses)->toContain('App\\app\\Pages\\DummyPage');
    expect($resultClasses)->toContain('App\\app\\Pages\\DummyPostPage');

    $methods = array_column($results, 'method');
    expect($methods)->toContain('GET');
    expect($methods)->toContain('POST');
});

test('ignores non-PHP files', function () {
    $root = vfsStream::setup('root', null, [
        'NotPHP.txt' => 'just text'
    ]);

    $finder = new FileBasedRouteFinder($this->context);
    $results = $finder->getFileBasedPages($root->url());

    expect($results)->toBeEmpty();
});

test('ignores classes not extending PageAbstractClass', function () {
    $root = vfsStream::setup('root', null, [
        'Other.php' => '<?php 
namespace App\\app\\Pages;
class Other {}'
    ]);

    $finder = new FileBasedRouteFinder($this->context);
    $results = $finder->getFileBasedPages($root->url());

    expect($results)->toBeEmpty();
});

test('handles nested directories', function () {
    $root = vfsStream::setup('root', null, [
        'subdir' => [
            'NestedPage.php' => '<?php 
namespace App\\app\\Pages;
use Framework\\Http\\PageAbstractClass;
class NestedPage extends PageAbstractClass { 
    public function get() {} 
    public function pageHtml() {}
}'
        ]
    ]);

    $finder = new FileBasedRouteFinder($this->context);
    $results = $finder->getFileBasedPages($root->url());

    expect($results)->toHaveCount(1);
    expect($results[0]['class'])->toBe('App\\app\\Pages\\NestedPage');
    expect($results[0]['route'])->toBe('/subdir/');
});

test('handles empty directories', function () {
    $root = vfsStream::setup('root', null, [
        'empty_dir' => []
    ]);

    $finder = new FileBasedRouteFinder($this->context);
    $results = $finder->getFileBasedPages($root->url());

    expect($results)->toBeEmpty();
});

test('creates routes for all http methods in a class', function () {
    $root = vfsStream::setup('root', null, [
        'MultiMethodPage.php' => '<?php 
namespace App\\app\\Pages;
use Framework\\Http\\PageAbstractClass;
class MultiMethodPage extends PageAbstractClass { 
    public function get() {}
    public function post() {}
    public function put() {}
    public function delete() {}
    public function pageHtml() {}
}'
    ]);

    $finder = new FileBasedRouteFinder($this->context);
    $results = $finder->getFileBasedPages($root->url());

    expect($results)->toHaveCount(4);
    $methods = array_column($results, 'method');
    expect($methods)->toContain('GET', 'POST', 'PUT', 'DELETE');
});

test('generates correct route for index pages', function () {
    $root = vfsStream::setup('root', null, [
        'IndexPage.php' => '<?php 
namespace App\\app\\Pages;
use Framework\\Http\\PageAbstractClass;
class IndexPage extends PageAbstractClass { 
    public function get() {} 
    public function pageHtml() {}
}'
    ]);

    $finder = new FileBasedRouteFinder($this->context);
    $results = $finder->getFileBasedPages($root->url());

    expect($results[0]['route'])->toBe('/');
});
