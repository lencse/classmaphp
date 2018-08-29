<?php

namespace Lencse\ClassMap\Processing;

use Lencse\ClassMap\ClassData\FileInfo;
use Lencse\ClassMap\Classes\NamespaceRepository;
use Lencse\ClassMap\Parsing\ClassDataHandler;
use Lencse\ClassMap\Parsing\Parser;

final class ParsingFileProcessor implements FileProcessor, ClassDataHandler
{
    /**
     * @var Parser
     */
    private $parser;

    /**
     * @var NamespaceRepository
     */
    private $namespaceRepository;

    public function __construct(Parser $parser)
    {
        $this->parser = $parser;
        $this->namespaceRepository = new NamespaceRepository();
    }

    public function process(string $content): void
    {
        $this->parser->parse($content, $this);
    }

    public function handle(FileInfo $classData): void
    {
        $namespace = $this->namespaceRepository->get($classData->getNamespace());
        foreach ($classData->getDependencies() as $dependency) {
            $parts = explode('\\', $dependency);
            $depNamespaceId = implode('\\', array_slice($parts, 0, count($parts) - 1));
            $depNamespace = $this->namespaceRepository->get($depNamespaceId);
            $namespace->addDependency($depNamespace);
        }
    }

    public function getNamespaceRepository(): NamespaceRepository
    {
        return $this->namespaceRepository;
    }
}
