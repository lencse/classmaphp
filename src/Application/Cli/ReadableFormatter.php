<?php

namespace Lencse\ClassMap\Application\Cli;

use Lencse\ClassMap\Classes\NamespaceEntityCollection;

class ReadableFormatter implements Formatter
{
    public function print(NamespaceEntityCollection $namespaces, Output $output): void
    {
        foreach ($namespaces as $namespace) {
            $output->println($namespace->getName());
            foreach ($namespace->getDependencies() as $dependency) {
                $output->println(
                    sprintf('    %s (%d)', $dependency->getNamespace()->getName(), $dependency->getCardinality())
                );
            }
        }
    }
}
