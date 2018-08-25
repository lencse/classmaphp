<?php

namespace Lencse\ClassMap\Adapter\Parsing\Visitor;

use Lencse\ClassMap\Parsing\Exception\ClassNameNotParsedException;
use PhpParser\Node;
use PhpParser\NodeVisitorAbstract;
use PhpParser\Node\Stmt\Class_;

final class ClassNameVisitor extends NodeVisitorAbstract
{
    /**
     * @var string
     */
    private $className = '';

    /**
     * @var bool
     */
    private $classDefinition = false;

    public function enterNode(Node $node)
    {
        if ($node instanceof Class_) {
            $this->classDefinition = true;
            $this->className = (string) $node->name;
        }
    }

    public function getClassName(): string
    {
        return $this->className;
    }

    public function isClassDefinition(): bool
    {
        return $this->classDefinition;
    }
}
