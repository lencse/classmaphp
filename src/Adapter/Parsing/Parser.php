<?php

namespace Lencse\ClassMap\Adapter\Parsing;

use Lencse\ClassMap\Adapter\Parsing\Visitor\ClassNameVisitor;
use Lencse\ClassMap\Adapter\Parsing\Visitor\DependencyVisitor;
use Lencse\ClassMap\Adapter\Parsing\Visitor\NamespaceVisitor;
use Lencse\ClassMap\Parsing\Parser as ParserInterface;
use Lencse\ClassMap\Value\ClassData;
use Lencse\ClassMap\Value\ClassDataList;
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

    public function parseAndExtendClassList(string $content, ClassDataList $classes): ClassDataList
    {
        $statements = $this->parser->parse($content);
        $traverser = new NodeTraverser();
        $classNameVisitor = new ClassNameVisitor();
        $traverser->addVisitor($classNameVisitor);
        $namespaceVisitor = new NamespaceVisitor();
        $traverser->addVisitor($namespaceVisitor);
        $dependencyVisitor = new DependencyVisitor();
        $traverser->addVisitor($dependencyVisitor);
        if (empty($statements)) {
            return $classes;
        }

        $traverser->traverse($statements);
        if (!$classNameVisitor->isClassDefinition() || '' === $namespaceVisitor->getNamespace()) {
            return $classes;
        }

        $class = new ClassData(
            $classNameVisitor->getClassName(),
            $namespaceVisitor->getNamespace(),
            $dependencyVisitor->getDependencies()
        );

        return $classes->add($class);
    }
}
