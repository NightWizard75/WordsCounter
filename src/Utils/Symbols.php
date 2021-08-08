<?php

namespace Counters\Utils;


class Symbols
{
    /**
     * Возвращает количество байт используемых для кодирования символа
     *
     * @param $symbol
     * @return int
     */
    public function symbolBytesNumber($symbol): int
    {
        return (new BinaryOperations())->leftSetBitsNumber($symbol);
    }
}