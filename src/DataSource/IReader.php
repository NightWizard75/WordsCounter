<?php

namespace Counters\DataSource;

use Generator;


interface IReader
{
    /**
     * Читает данные из источника
     *
     * @return Generator
     */
    public function readData(): Generator;
}