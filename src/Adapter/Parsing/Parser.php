<?php

namespace Lencse\ClassMap\Adapter\Parsing;

use Lencse\ClassMap\Adapter\Parsing\Visitor\ClassNameVisitor;
use Lencse\ClassMap\Adapter\Parsing\Visitor\DependencyVisitor;
use Lencse\ClassMap\Adapter\Parsing\Visitor\NamespaceVisitor;
use Lencse\ClassMap\ClassData\ClassData;
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

        $classNameVisitor = new ClassNameVisitor();
        $namespaceVisitor = new NamespaceVisitor();
        $dependencyVisitor = new DependencyVisitor();

        $traverser = new NodeTraverser();
        foreach ([$classNameVisitor, $namespaceVisitor, $dependencyVisitor] as $visitor) {
            $traverser->addVisitor($visitor);
        }

        $traverser->traverse($statements);
        if (!$classNameVisitor->isClassDefinition() || '' === $namespaceVisitor->getNamespace()) {
            return;
        }

        $handler->handle(new ClassData(
            $classNameVisitor->getClassName(),
            $namespaceVisitor->getNamespace(),
            $dependencyVisitor->getDependencies()
        ));
    }
}
