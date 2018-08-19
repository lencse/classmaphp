<?php

namespace Lencse\ClassMap\Entity;

final class File
{
    /**
     * @var string
     */
    private $content;

    public function __construct(string $content)
    {
        $this->content = $content;
    }

    public function getNamespace(): PSRNamespace
    {
        foreach (explode("\n", $this->content) as $line) {
            if (preg_match('/namespace\s+(\S+)\s*;/i', $line, $match)) {
                return new SubNamespace($match[1]);
            }
        }

        return new RootNamespace();
    }

    public function getDependencies(): PSRNamespaceList
    {
        $result = new PSRNamespaceList();
        foreach (explode("\n", $this->content) as $line) {
            if (preg_match('/use\s+(\S+)\\\\\S*\s*;/i', $line, $match)) {
                $result = $result->add(new SubNamespace($match[1]));
            }
        }

        return $result;
    }
}
