<?php

function colorLog($text, $color)
{
    switch ($color) {
        case 'red':
            echo "\033[1;31m" . $text . "\033[0m" . PHP_EOL;
            break;
        case 'green':
            echo "\033[1;32m" . $text . "\033[0m" . PHP_EOL;
            break;
        case 'yellow':
            echo "\033[1;33m" . $text . "\033[0m" . PHP_EOL;
            break;
        case 'blue':
            echo "\033[1;34m" . $text . "\033[0m" . PHP_EOL;
            break;
        default:
            echo $text . PHP_EOL;
            break;
    }
}

function boxLog($logMessage, $color = 'white')
{

    $boxWidth = 30;
    $boxPadding = 2;
    $boxHorizontalLine = str_repeat("-", $boxWidth);
    $boxVerticalLine = "|";
    $boxEmptySpace = str_repeat(" ", $boxWidth - ($boxPadding * 2) - strlen($logMessage));

    $logBox = $boxHorizontalLine . "\n";
    $logBox .= $boxVerticalLine . str_repeat(" ", $boxPadding) . $logMessage . $boxEmptySpace . str_repeat(" ", $boxPadding) . $boxVerticalLine . "\n";
    $logBox .= $boxHorizontalLine . "\n";
    colorLog($logBox, $color);
}
