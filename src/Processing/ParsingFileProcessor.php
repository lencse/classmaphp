<?php

namespace Lencse\ClassMap\Processing;

use Lencse\ClassMap\ClassData\ClassData;
use Lencse\ClassMap\Classes\ClassRepository;
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
     * @var ClassRepository
     */
    private $classRepository;

    /**
     * @var NamespaceRepository
     */
    private $namespaceRepository;

    public function __construct(Parser $parser)
    {
        $this->parser = $parser;
        $this->classRepository = new ClassRepository();
        $this->namespaceRepository = new NamespaceRepository();
    }

    public function process(string $content): void
    {
        $this->parser->parse($content, $this);
    }

    public function handle(ClassData $classData): void
    {
        $namespace = $this->namespaceRepository->get($classData->getNamespace());
        $depClasses = [];
        foreach ($classData->getDependencies() as $dependency) {
            $parts = explode('\\', $dependency);
            $depNamespaceId = implode('\\', array_slice($parts, 0, count($parts) - 1));
            $depClassName = (string) array_pop($parts);
            $depNamespace = $this->namespaceRepository->get($depNamespaceId);
            $depClasses[] = $this->classRepository->get($depNamespace, $depClassName);
        }
        $class = $this->classRepository->get($namespace, $classData->getName());
        foreach ($depClasses as $depClass) {
            $class->addDependency($depClass);
        }
    }

    public function getNamespaceRepository(): NamespaceRepository
    {
        return $this->namespaceRepository;
    }
}
