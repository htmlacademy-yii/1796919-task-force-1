<?php
declare(strict_types=1);
namespace taskforce\models\actions;

use \SplFileObject;
use \RuntimeException;
use taskforce\models\exceptions\CSVFileException;

class DataConverter
{
    public function __construct($directory)
    {
        if (!file_exists($directory)) {
            throw new CSVFileException("Папка '$directory' не существует или недоступна для чтения");
        }
        $this->directory = $directory;
    }

    public function convert($fileName): void
    {
        $fileObjectCSV = new SplFileObject($fileName);
        try {
            $namePath = pathinfo($fileName, PATHINFO_FILENAME);
            $fileNames = explode('.', $namePath)[0] ?? null;
            $fileName = $this->directory . $fileNames . '.sql';
            $fileObjectSQL = new SplFileObject($fileName, "w");

        } catch (RuntimeException $exception) {
            throw new CSVFileException("Не удалось создать sql файл для записи");
        }

        $fileObjectCSV->setFlags(SplFileObject::SKIP_EMPTY | SplFileObject::DROP_NEW_LINE);
        $columns = $this->getColumns($fileObjectCSV);

        $firstValues = $this->arrayToString(
            $fileObjectCSV->fgetcsv()
        );

        $firstSqlLine = "INSERT INTO $fileNames (" . $columns . ")\n" . 'VALUES ("' . $firstValues . '"),';
        $this->writeLine($fileObjectSQL, $firstSqlLine);

        foreach ($this->getNextLine($fileObjectCSV) as $insertingValues) {
            if ($insertingValues) {
                $insertingValues = $this->arrayToString($insertingValues);
                $line = '("' . $insertingValues . '"),';
                $this->writeLine($fileObjectSQL, $line);
            }
        }

        $fileObjectSQL->fseek(-2, SEEK_END);
        $fileObjectSQL->fwrite(';');
    }

    private function getColumns(SplFileObject $fileObjectCSV): string
    {
        $fileObjectCSV->rewind();
        $data = $fileObjectCSV->fgetcsv();
        $columns = array_shift($data);

        foreach ($data as $value) {
            $columns .= ", $value";
        }

        return $columns;
    }

    private function getNextLine(SplFileObject $fileObjectCSV): iterable
    {
        while (!$fileObjectCSV->eof()) {
            yield $fileObjectCSV->fgetcsv();
        }
    }

    private function writeLine(SplFileObject $fileObjectSQL, string $line): void
    {
        $fileObjectSQL->fwrite("$line\n");
    }

    private function arrayToString(array $array): string
    {
        return implode('", "', $array);
    }
}
