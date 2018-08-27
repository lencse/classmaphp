<?php

namespace Lencse\ClassMap\Processing;

use Lencse\ClassMap\ClassData\ClassData;
use Lencse\ClassMap\ClassData\ClassDataList;
use Lencse\ClassMap\Parsing\ClassDataHandler;
use Lencse\ClassMap\Parsing\Parser;

final class ParsingFileProcessor implements FileProcessor, ClassDataHandler
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
        $this->parser->parse($content, $this);
    }

    public function handle(ClassData $classData): void
    {
        $this->classDataList = $this->classDataList->add($classData);
    }

    public function getClassDataList(): ClassDataList
    {
        return $this->classDataList;
    }
}
