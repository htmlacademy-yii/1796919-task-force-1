<?php
declare(strict_types=1);
namespace taskforce\models\actions;

use taskforce\models\exceptions\CSVFileException;

class DirectoryScan
{
    public function __construct(string $directory)
    {
        if (!$directory) {
            throw new CSVFileException("Папки '$directory' не существует");
        }
        $this->directory = $directory;
    }

    public function showFiles(string $fileExtension): array
    {
        return glob($this->directory  . '*' . $fileExtension);
    }
}
