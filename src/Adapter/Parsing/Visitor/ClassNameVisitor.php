<?php

namespace Lencse\ClassMap\Adapter\Parsing\Visitor;

use PhpParser\Node;
use PhpParser\Node\Stmt\Class_;
use PhpParser\NodeTraverser;
use PhpParser\NodeVisitorAbstract;

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

            return NodeTraverser::STOP_TRAVERSAL;
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
