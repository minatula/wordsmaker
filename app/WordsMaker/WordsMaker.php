<?php

namespace App\WordsMaker;

use GordonLesti\Levenshtein\Levenshtein;

class WordsMaker
{
    private $words;

    public function __construct($words)
    {

        $this->words = $words;

    }

    public function makeWord($first, $last, $accum = [])
    {
        //Проверяем длину введённых слов
        if (mb_strlen($first) != 4 || mb_strlen($last) != 4) {
            throw new \Exception("Длина слов должна быть 4 буквы \n\r");
        }

        //Добавляем слова, используемые в поиске
        if (end($accum) != $first) {
            $accum[] = $first;
        }

        //Ищем следующию партию слов
        $nextWords = $this->getNextWords($first);

        //Терминальное условие
        if (in_array($last, $nextWords)) {
            $accum[] = $last;
            return $accum;
        }

        //Запуск рекурсии
        foreach ($nextWords as $word) {

            if (!in_array($word, $accum)) {

                $accum = $this->makeWord($word, $last, $accum);
                if (end($accum) == $last) {
                    return $accum;
                }
            }

        }

        return $accum;
    }

    private function getNextWords($current)
    {
        $result = [];

        foreach ($this->words as $word) {
            if (Levenshtein::levenshtein($word, $current) == 1) {
                $result[] = $word;
            }
        }

        return $result;
    }
}
