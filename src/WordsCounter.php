<?php

namespace Counters;


use Counters\DataSource\FileReader;


class WordsCounter
{
    private FileReader $stream;
    private array $wordsChart = [];

    /**
     * @param string $fileName
     */
    public function __construct(string $fileName = '')
    {
        $this->stream = new FileReader($fileName);
    }

    /**
     * Возвращает список всех найденных слов с количеством повторов
     * @return array
     */
    public function getWords(): array
    {
        return $this->wordsChart;
    }

    /**
     * Подсчитывает повторы слов
     */
    public function countWords()
    {
        $iterator = $this->stream->readData();
        foreach ($iterator as $word) {
            $this->wordsChart[$word] = isset($this->wordsChart[$word]) ? $this->wordsChart[$word] + 1 : 1;
        }
    }

    /**
     * Возвращает слово, чаще всего встречающееся в файле
     *
     * @return array
     */
    public function getTopOne(): array
    {
        arsort($this->wordsChart);
        return array_slice($this->wordsChart, 0, 1);
    }

    /**
     * Возвращает Топ 5 самых встречающихся слов
     *
     * @return array
     */
    public function getTopFive(): array
    {
        arsort($this->wordsChart);
        return array_slice($this->wordsChart, 0, 5);
    }

    /**
     * Возвращает все найденные слова в отсортированном порядке по количеству попаданий
     *
     * @return array
     */
    public function getSortedWords(): array
    {
        $sortedWords = $this->getWords();
        arsort($sortedWords);
        return $sortedWords;
    }

}
