<?php

/**
 * Class Sum
 * １～N(引数)までの数をfor,while,再帰を使って和を求める
 * 実行引数がなかった場合は10までの和を出力
 * ※ 1 <= N <= 90 (開発OSのコールスタックサイズの限度)
 */
class Sum
{
    private $list = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];

    /**
     * check_argument
     *
     * @param $arg_count
     * @param $arg_list
     * @return $this
     * @throws Exception
     */
    public function check_argument($arg_count, $arg_list)
    {
        if ($arg_count < 1)
            throw new Exception("引数の数が不正です");

        if (isset($arg_list[1]) && $arg_list[1] <= 90)
            $this->list = range(1, $arg_list[1]);

        return $this;
    }

    /**
     * execute
     */
    public function execute()
    {
        $result_for = $this->sum_for();
        $this->display_result('for : ' . $result_for);

        $result_while = $this->sum_while();
        $this->display_result('while : ' . $result_while);

        $result_recurrent = $this->sum_recursive($this->list, 0);
        $this->display_result('recursive : ' . $result_recurrent);
    }

    /**
     * sum_for
     *
     * @return int
     */
    private function sum_for()
    {
        $list_limit = count($this->list);
        $result = 0;
        for ($index = 0; $index < $list_limit; ++$index) {
            $result += $this->list[$index];
        }

        return $result;
    }

    /**
     * sum_while
     *
     * @return int
     */
    private function sum_while()
    {
        $list_limit = count($this->list);
        $index = 0;
        $result = 0;
        while ($index < $list_limit) {
            $result += $this->list[$index];
            $index++;
        }

        return $result;
    }

    /**
     * sum_recursive
     *
     * @param $list
     * @param $num
     * @return int
     */
    private function sum_recursive($list, $num)
    {
        if (empty($list)) return $num;

        $num += array_shift($list);
        return $this->sum_recursive($list, $num);
    }

    /**
     * display_result
     *
     * @param $result
     */
    private function display_result($result)
    {
        echo $result, PHP_EOL;
    }

}

(new Sum())->check_argument($argc, $argv)->execute();
