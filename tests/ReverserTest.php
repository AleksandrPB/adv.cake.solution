<?php


use App\Reverser;
use PHPUnit\Framework\TestCase;

class ReverserTest extends TestCase
{
    /**
     * Проверяем выполнение основной функции
     * @test
     */
    function it_reverse_mb_ru_string_with_punctuation_and_register()
    {
        $reverser_instance = new Reverser;

        $this->assertEquals(
            'Тевирп! Онвад ен ьсиледив.',
            $reverser_instance->revertCharacters("Привет! Давно не виделись."));
    }

    /**
     * Проверяем, что основная фнукция вернет тип string
     * @test
     */
    function it_returns_string()
    {
        $reverser_instance = new Reverser;

        $this->assertIsString($reverser_instance->revertCharacters("Привет! Давно не виделись."));
    }

    /**
     * Проверяем, что служебная функция mb_getStringArr разобьет строку на массив знаков
     * @test
     */
    function it_splits_mb_string_into_array()
    {
        $reverser_instance = new Reverser;

        $this->assertEquals(
            ['П', 'р', 'и', 'в', 'е', 'т', '!', ' ', 'Д', 'а', 'в', 'н', 'о', ' ', 'н', 'е', ' ',
                'в', 'и', 'д', 'е', 'л', 'и', 'с', 'ь', '.'],
            $reverser_instance->mb_getStringArr("Привет! Давно не виделись."));
    }

    /**
     * Проверяем, что служебная функция strArrWordReverse перевернет слова в строка относительно
     * каждого из них с соблюдением пунктуации
     * @test
     */
    function it_reverse_array_of_strings()
    {
        $reverser_instance = new Reverser;

        $this->assertEquals(
            'тевирП! онваД ен ьсиледив.',
            $reverser_instance->strArrWordReverse(['П', 'р', 'и', 'в', 'е', 'т', '!', ' ', 'Д', 'а', 'в', 'н', 'о', ' '
                , 'н', 'е', ' ', 'в', 'и', 'д', 'е', 'л', 'и', 'с', 'ь', '.']));
    }

    /**
     * Проверяем, что служебная функция strArrWordReverse перевернет слова в строка относительно
     * каждого из них с соблюдением пунктуации
     * @test
     */
    function it_splits_string_into_array_of_sentences()
    {
        $reverser_instance = new Reverser;

        $this->assertEquals(
            ['Привет!', 'Давно не виделись.'],
            $reverser_instance->mb_getSentencesArrRu("Привет! Давно не виделись."));
    }

    /**
     * Проверяем, что служебная функция strArrWordReverse перевернет слова в строка относительно
     * каждого из них с соблюдением пунктуации
     * @test
     */
    function it_uppercase_first_letter_in_sentence()
    {
        $reverser_instance = new Reverser;

        $this->assertEquals(
            'Привет!',
            $reverser_instance->mb_ucfirst('привет!', "UTF-8"));
    }
}
