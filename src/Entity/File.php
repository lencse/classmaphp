<?php

namespace Lencse\ClassMap\Entity;

class File
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
}
