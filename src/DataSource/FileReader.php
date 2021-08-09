<?php

namespace Counters\DataSource;

use Generator;
use Counters\Utils\Symbols;


class FileReader implements IReader
{

    /**
     * Имя файла
     * @var string
     */
    private string $fileName;

    /**
     * @param string $fileName
     */
    public function __construct(string $fileName)
    {
        $this->fileName = $fileName;
    }

    /**
     * Производит посимвольное чтение из файла и формирует слова из русских и английских букв
     *
     * @return Generator
     */
    public function readData(): Generator
    {
        $word = '';
        if (!file_exists($this->fileName)) yield $word;
        $fileHandler = fopen($this->fileName, "r");
        while (($symbol = fread($fileHandler, 1)) !== "") {
            $bytesCount = (new Symbols())->symbolBytesNumber(ord($symbol));
            $symbol .= ($bytesCount>1)
                ? fread($fileHandler, $bytesCount - 1)
                : '';
            if (!preg_match('/\w/u', $symbol)) {
                if (!empty($word)) {
                    yield trim($word);
                    $word = '';
                }
            } else {
                $word .= $symbol;
            }
        }
        fclose($fileHandler);
        if (!empty($word)) {
            yield trim($word);
        }
    }
}