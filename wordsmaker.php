<?php

require_once __DIR__ . '/vendor/autoload.php';

use App\LibParser\LibParser;
use App\WordsMaker\WordsMaker;

define('ROOT', __DIR__);

//Определяем, введены ли аргументы
if ($argv[1] && $argv[2]) {
    $first = $argv[1];
    $last = $argv[2];
    echo "Вы ввели: {$first}, {$last}. \n\r";
    echo "Пожулуйста, дождитесь завершения работы скрипта. \n\r";
} else {
    $first = 'лужа';
    $last = 'море';
    echo "Аргументы не введены, будут использованы слова: {$first}, {$last} \n\r";
    echo "Пожулуйста, дождитесь завершения работы скрипта. \n\r";
}

//Запуск основного кода
try {
    $words = new LibParser(ROOT . '/app/lib/words');
    $wordsArray = $words->getWordsArray();
    $maker = new WordsMaker($wordsArray);

    foreach ($maker->makeWord($first, $last) as $nubmer => $word) {
        echo "{$nubmer} - {$word} \n\r";
    }

} catch (\Exception $e) {
    echo "Длина слов должна быть 4 буквы \n\r";
}