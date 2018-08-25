<?php

namespace Lencse\ClassMap\Adapter\Parsing\Visitor;

use PhpParser\Node;
use PhpParser\Node\Stmt\Namespace_;
use PhpParser\NodeVisitorAbstract;

final class NamespaceVisitor extends NodeVisitorAbstract
{
    /**
     * @var string
     */
    private $namespace = '';

    public function enterNode(Node $node)
    {
        if ($node instanceof Namespace_) {
            $this->namespace = (string) $node->name;
        }
    }

    public function getNamespace(): string
    {
        return $this->namespace;
    }
}
