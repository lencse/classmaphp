<?php

namespace Lencse\ClassMap\Adapter\Parsing\Visitor;

use Lencse\ClassMap\Value\NamespaceId;
use Lencse\ClassMap\Value\NamespaceIdList;
use PhpParser\Node;
use PhpParser\Node\Stmt\Class_;
use PhpParser\NodeVisitorAbstract;

final class NamespaceVisitor extends NodeVisitorAbstract
{
    /**
     * @var string
     */
    private $namespace = '';

    public function enterNode(Node $node)
    {
        if ($node instanceof Node\Stmt\Namespace_) {
            $this->namespace = (string) $node->name;
        }
    }

    public function getNamespace(): string
    {
        return $this->namespace;
    }
}
