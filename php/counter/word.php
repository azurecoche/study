<?php

/**
 * 入力された単語の最長の単語長を出力する
 * [前提]
 * 単語はスペース区切りで入力されるものとする
 * 文末は必ずピリオドで終わるものとする
 * {this,that}のように書くことで中括弧内のいずれかの文字を使用することを宣言できる
 * たとえば‘{this,that} is a {pen,piano}.‘と入力された場合の解は11(文字)となる
 */
class WordLength
{

    public function execute()
    {
        $input_string = str_replace('.', '', trim(fgets(STDIN)));
        $word_list = explode(' ', $input_string);
        $length = $this->calc_length($word_list, 0);
        $word_average = $this->calc_average($length, count($word_list));

        echo $word_average, PHP_EOL;
    }

    private function calc_length($list, $length)
    {
        if (empty($list)) return $length;

        $word = array_shift($list);
        $multiple_word_list = [];
        if ($this->is_multiple_word($word, $multiple_word_list)) {
            $length += $this->get_max_length($multiple_word_list);
        } else {
            $length += strlen($word);
        }
        return $this->calc_length($list, $length);
    }

    private function is_multiple_word($word, &$multiple_word)
    {
        $is_match = preg_match('/\{([a-z,A-Z,\,]*)\}/', $word, $matches);
        if ($is_match) {
            $multiple_word = explode(',', $matches[1]);
        }
        return $is_match;
    }

    private function get_max_length($list)
    {
        $tmp_list = array_map(function($str) {
            return strlen($str);
        }, $list);
        rsort($tmp_list);
        return $tmp_list[0];
    }

    private function calc_average($total_length, $list_count)
    {
        return (float) $total_length / (float) $list_count;
    }

}

(new WordLength())->execute();

