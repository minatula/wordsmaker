<?php

namespace App\LibParser;

class LibParser
{
    private $libPath;

    public function __construct($libPath)
    {
        if (!file_exists($libPath)) {
            throw new \Exception("Файл {$libPath} не существует");
        }

        $this->libPath = $libPath;
    }

    private function getWords()
    {
        return file_get_contents($this->libPath);
    }

    public function getWordsArray()
    {
        return explode(' ', trim($this->getWords()));
    }

}

