<?php

namespace Lencse\ClassMap\Adapter\Parsing;

use Lencse\ClassMap\Adapter\Parsing\Visitor\ClassNameVisitor;
use Lencse\ClassMap\Adapter\Parsing\Visitor\DependencyVisitor;
use Lencse\ClassMap\Adapter\Parsing\Visitor\NamespaceVisitor;
use Lencse\ClassMap\ClassData\FileInfo;
use Lencse\ClassMap\Parsing\ClassDataHandler;
use Lencse\ClassMap\Parsing\Parser as ParserInterface;
use PhpParser\NodeTraverser;
use PhpParser\Parser as PHPParser;
use PhpParser\ParserFactory;

final class Parser implements ParserInterface
{
    /**
     * @var PHPParser
     */
    private $parser;

    public function __construct()
    {
        $this->parser = (new ParserFactory())->create(ParserFactory::PREFER_PHP7);
    }

    public function parse(string $content, ClassDataHandler $handler): void
    {
        $statements = $this->parser->parse($content);
        if (empty($statements)) {
            return;
        }

        $namespaceVisitor = new NamespaceVisitor();
        $dependencyVisitor = new DependencyVisitor();

        $traverser = new NodeTraverser();
        foreach ([$namespaceVisitor, $dependencyVisitor] as $visitor) {
            $traverser->addVisitor($visitor);
        }

        $traverser->traverse($statements);
        if ('' === $namespaceVisitor->getNamespace()) {
            return;
        }

        $handler->handle(new FileInfo(
            $namespaceVisitor->getNamespace(),
            $dependencyVisitor->getDependencies()
        ));
    }
}
