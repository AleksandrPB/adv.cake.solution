<?php

namespace App;

class Reverser implements PunctuationLookup, EncodingLookup
{

    /**
     * Главный метод, выполняющий переворот слов в мультибайтовой кириллической строке,
     * с сохранением заглавных букв и пунктуации
     * @param string $string
     * @return string
     */
    public function revertCharacters(string $string): string
    {
        $strArr = $this->mb_getStringArr($string);

        $reversed = $this->strArrWordReverse($strArr);

        $reversed = mb_strtolower($reversed);

        $plainSentences = $this->mb_getSentencesArrRu($reversed);

        foreach ($plainSentences as $sentence)
            $formattedSentences[] = $this->mb_ucfirst($sentence, self::ENC_UTF8);


        return implode(" ", $formattedSentences);
    }


    /**
     * Служебный метод для разбиения мультибайтовой строки в массив элементов
     * Область видимости установлена public только для юнит-тестирования
     * @param string $string
     * @return array
     */
    public function mb_getStringArr(string $string): array
    {
        $strArr = preg_split('//u', $string, null, PREG_SPLIT_NO_EMPTY);
        return $strArr;
    }

    /**
     * Служебный метод, проходящий по разбитой на массив строке и переворачивющий слова.
     * Элементы конкатенируются в строку.
     * Область видимости установлена public только для юнит-тестирования
     * @param array $strArr
     * @return string
     */
    public function strArrWordReverse(array $strArr): string
    {
        $reversed = "";
        $tmp = "";
        $stringLength = count($strArr);

        for ($i = 0; $i < $stringLength; $i++) {
            if ($strArr[$i] == self::BLANK) {
                $reversed .= $tmp . self::BLANK;
                $tmp = "";
                continue;
            }
            if ($strArr[$i] == self::COMMA) {
                $reversed .= $tmp . self::COMMA;
                $tmp = "";
                continue;
            }
            if ($strArr[$i] == self::EXCLAMATION_POINT) {
                $reversed .= strtolower($tmp) . self::EXCLAMATION_POINT;
                $tmp = "";
                continue;
            }
            if ($strArr[$i] == self::DOT) {
                $reversed .= $tmp . self::DOT;
                $tmp = "";
                continue;
            }
            $tmp = $strArr[$i] . $tmp;
        }
        $reversed .= $tmp;
        return $reversed;
    }

    /**
     * Служебный метод для разбиения мультибайтовой кириллической строки на массив предложений
     * Область видимости установлена public только для юнит-тестирования
     * @param string $reversed
     * @return array|false|string[]
     */
    public function mb_getSentencesArrRu(string $reversed): array
    {
        $sentences = preg_split('/(?<=[.?!])\s+(?=[а-я])/i', $reversed);
        return $sentences;
    }

    /**
     * Служебный метод для установки заглавным первого знака мультибайтовой строки
     * Область видимости установлена public только для юнит-тестирования
     * @param string $string
     * @param string $encoding
     * @return string
     */
    public function mb_ucfirst(string $string, string $encoding): string
    {
        $firstChar = mb_substr($string, 0, 1, $encoding);
        $then = mb_substr($string, 1, null, $encoding);
        return mb_strtoupper($firstChar, $encoding) . $then;
    }


}
