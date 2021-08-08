<?php

namespace Counters\Utils;


class BinaryOperations
{
    /**
     * Возвращает какое количество бит слева установлено в 1
     *
     * @param int $binary_item
     * @param int $bits_count
     * @return int
     */
    public function leftSetBitsNumber(int $binary_item, $bits_count = 8): int
    {
        $number = 0;
        for ($bit = $bits_count-1; $bit >= 0; $bit--) {
            $bin_power = 1 << $bit;
            if ($bin_power & $binary_item) {
                $number++;
            } else {
                return $number;
            }
        }
        return $number;
    }
}