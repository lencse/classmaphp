<?php

namespace Lencse\ClassMap\Adapter\Processing;

use League\Flysystem\Adapter\Local;
use League\Flysystem\Filesystem;
use League\Flysystem\FilesystemInterface;
use Lencse\ClassMap\Processing\FileProcessor;
use Lencse\ClassMap\Processing\PackageProcessor;
use Nette\Utils\Json;

final class LocalFileSystemPackageProcessor implements PackageProcessor
{
    /**
     * @var FilesystemInterface
     */
    private $files;

    public function __construct(string $packageRootPath)
    {
        $this->files = new Filesystem(new Local($packageRootPath));
    }

    public function processPhpFiles(FileProcessor $fileProcessor): void
    {
        /** @var string[][][] $composerData */
        $composerData = Json::decode($this->files->read('composer.json'), Json::FORCE_ARRAY);

        foreach ($composerData['autoload']['psr-4'] as $dir) {
            /** @var string[][] $fileIterator */
            $fileIterator = $this->files->listContents($dir, true);
            foreach ($fileIterator as $fileData) {
                if ('file' === $fileData['type']
                    && isset($fileData['extension'])
                    && 'php' === $fileData['extension']
                ) {
                    $fileProcessor->process((string) $this->files->read($fileData['path']));
                }
            }
        }
    }
}
