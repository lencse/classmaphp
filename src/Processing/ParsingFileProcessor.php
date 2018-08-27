<?php

namespace Lencse\ClassMap\Processing;

use Lencse\ClassMap\ClassData\ClassDataList;
use Lencse\ClassMap\Parsing\Parser;

final class ParsingFileProcessor implements FileProcessor
{
    /**
     * @var Parser
     */
    private $parser;

    /**
     * @var ClassDataList
     */
    private $classDataList;

    public function __construct(Parser $parser)
    {
        $this->parser = $parser;
        $this->classDataList = new ClassDataList();
    }

    public function process(string $content): void
    {
        $this->classDataList = $this->classDataList->append($this->parser->parse($content));
    }

    public function getClassDataList(): ClassDataList
    {
        return $this->classDataList;
    }
}
