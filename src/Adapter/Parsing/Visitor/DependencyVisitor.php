<?php

namespace Lencse\ClassMap\Adapter\Parsing\Visitor;

use Lencse\ClassMap\Data\StringList;
use PhpParser\Node;
use PhpParser\Node\Stmt\Use_;
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
        if ($node instanceof Use_) {
            $this->dependencies = $this->dependencies->add(implode('\\', $node->uses[0]->name->parts));
        }
    }

    public function getDependencies(): StringList
    {
        return $this->dependencies;
    }
}
