<?php

/**
 * 標準入力で与えられた数をN進数にして返却する
 * ※N=実行引数で与えられた数（デフォルト=11）
 * ※1 <= N <= 16
 */
class DecimalConverter
{
    const DEFAULT_BASE_NUMBER = 11;
    private $base_number = 0;
    private $conversion_table = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 'a', 'b', 'c', 'd', 'e', 'f'];

    /**
     * execute
     *
     * @param $argc
     * @param $argv
     */
    public function execute($argc, $argv)
    {
        // 進数変換のための初期処理
        $this->check_argument_count($argc);
        $this->set_base_number($argv);
        $this->set_conversion_table();

        // 進数変換
        $number = (int)trim(fgets(STDIN));
        $result = $this->convert($number, '');

        $this->output_message($result);
    }

    /**
     * check_argument_count
     *
     * @param $argument_count
     * @throws Exception
     */
    private function check_argument_count($argument_count)
    {
        if ($argument_count < 1 || $argument_count > 2)
            throw new \Exception("引数の数が不正です");
    }

    /**
     * set_base_number
     *
     * @param $argumenet_list
     */
    private function set_base_number($argumenet_list)
    {
        // 進数指定なし、あるいは 範囲（1<=<N<=16）外の場合はデフォルト11進数に
        if (!isset($argumenet_list[1]) || $argumenet_list[1] > 16 || $argumenet_list[1] < 0) {
            $this->base_number = self::DEFAULT_BASE_NUMBER;
        } else {
            $this->base_number = $argumenet_list[1];
        }
    }

    /**
     * set_conversion_table
     */
    private function set_conversion_table()
    {
        $chunked_list = array_chunk($this->conversion_table, $this->base_number);
        $this->conversion_table = $chunked_list[0];
    }

    /**
     * convert
     * 進数変換を行う
     *
     * @param $number
     * @param $result
     * @return string
     */
    private function convert($number, $result)
    {
        if ($number < $this->base_number) {
            return $result . $this->conversion_table[$number];
        } else {
            $floor_num = floor($number / $this->base_number);

            if (strlen($floor_num) > 1) {
                $result .= $this->convert($floor_num, $result);
            } else {
                $result .= $this->conversion_table[$floor_num];
            }

            $amari = $number % $this->base_number;
            return $this->convert($amari, $result);
        }
    }

    /**
     * output_message
     *
     * @param $message
     */
    private function output_message($message)
    {
        echo $message, PHP_EOL;
    }

}

(new DecimalConverter())->execute($argc, $argv);