<?php

namespace Lencse\ClassMap\Adapter\Parsing\Visitor;

use Lencse\ClassMap\Value\NamespaceId;
use Lencse\ClassMap\Value\NamespaceIdList;
use Lencse\ClassMap\Value\StringList;
use PhpParser\Node;
use PhpParser\Node\Stmt\Class_;
use PhpParser\NodeVisitorAbstract;

final class DependencyVisitor extends NodeVisitorAbstract
{
    /**
     * @var StringList
     */
    private $dependencies;

    public function __construct()
    {
        $this->dependencies = new StringList();
    }

    public function enterNode(Node $node)
    {
        if ($node instanceof Node\Stmt\Use_) {
            $this->dependencies = $this->dependencies->add(implode('\\', $node->uses[0]->name->parts));
        }
    }

    public function getDependencies(): StringList
    {
        return $this->dependencies;
    }
}
