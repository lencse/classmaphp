<?php

namespace Lencse\ClassMap\Adapter\Parsing;

use Lencse\ClassMap\Adapter\Parsing\Visitor\ClassNameVisitor;
use Lencse\ClassMap\Parsing\Parser as ParserInterface;
use Lencse\ClassMap\Value\PHPClass;
use Lencse\ClassMap\Value\PHPClassList;
use PhpParser\NodeTraverser;
use PhpParser\ParserFactory;

final class Parser implements ParserInterface
{
    public function parseAndExtendClassList(string $content, PHPClassList $classes): PHPClassList
    {
        $parser = (new ParserFactory())->create(ParserFactory::PREFER_PHP7);
        $ast = $parser->parse($content);
        $visitor = new ClassNameVisitor();
        $traverser = new NodeTraverser();
        $traverser->addVisitor($visitor);
        if (empty($ast)) {
            return $classes;
        }

        $traverser->traverse($ast);
        if (!$visitor->isClassDefinition()) {
            return $classes;
        }

        return $classes->add(new PHPClass($visitor->getClassName()));
    }
}
