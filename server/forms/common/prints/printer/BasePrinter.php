<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/12/14
 * Time: 10:17
 */

namespace app\forms\common\prints\printer;


use app\forms\common\prints\config\BaseConfig;
use app\forms\common\prints\content\OrderContent;
use app\forms\common\prints\Exceptions\PrintException;

/**
 * @property BaseConfig $config
 */
abstract class BasePrinter
{
    public $config;

    /**
     * @param $data
     * @return mixed
     * @throws PrintException
     */
    public function print($data, $limit = 0)
    {
        $content = [];
        $bout = 0;
        foreach ($data as $item) {
            if (isset($item['show']) && $item['show'] == 0) {
                continue;
            }
            $getter = 'get' . $item['handle'];
            $children = $item['content'];
            if (isset($item['children'])) {
                foreach ($item['children'] as $value) {
                    if (isset($value['content'])) {
                        $childGetter = 'get' . $value['handle'];
                        $children .= $this->$childGetter($value['content']);
                    }
                }
            }
            $append = $this->$getter($children);

            $content[$bout] = $content[$bout] ?? '';


            $totalStr = $content[$bout] . $append;
            $func = function ($limit, $totalStr) use (&$content, &$bout, &$func) {
                if ($limit && (strlen($totalStr) > $limit)) {
                    if (strlen($totalStr) > $limit) {
                        $br = $this->getBR('');
                        $begin_str = substr($totalStr, 0, $limit);
                        $index = strripos($begin_str, $br);

                        $begin_str = substr($totalStr, 0, $index);
                        $content[$bout] = $begin_str;

                        $end_str = substr($totalStr, $index, -1);
                        $bout += 1;
                        $func($limit, $end_str);
                    } else {
                        $bout += 1;
                        $content[$bout] = $totalStr;
                    }
                } else {
                    $content[$bout] = $totalStr;
                }
            };
            $func($limit, $totalStr);
            //if ($limit && (strlen($append . $content[$bout]) > $limit)) {
            //    $bout += 1;
            //    $content[$bout] = '';
            //}
            //
            //$content[$bout] .= $append;
        }

        for ($i = 0; $i < count($content); $i++) {
            //test return
            $this->config->print($content[$i]);
        }
    }

    /**
     * ????????????
     * ???n??????????????????????????????????????????
     * @param string $input
     * @param integer $n
     * @return array
     */
    protected function rStrPad1($input, $n = 7)
    {
        if (function_exists('mb_strimwidth')) {
            if ($n == 7) {
                return $this->n($input, 14);
            }
            if ($n == 8) {
                return $this->n($input, 15);
            }
        }

        $string = "";
        $count = 0;
        $c_count = 0;
        $arr = array();
        for ($i = 0; $i < mb_strlen($input, 'UTF-8'); $i++) {
            $char = mb_substr($input, $i, 1, 'UTF-8');
            $string .= $char;
            if (strlen($char) == 3) {
                $count += 2;
                $c_count++;
            } else {
                $count += 1;
            }
            if ($count >= $n * 2) {
                $arr[] = $string;
                $string = '';
                $count = 0;
                $c_count = 0;
            }
        }
        if ($count < $n * 2) {
            $string = str_pad($string, $n * 2 + $c_count);
            $arr[] = $string;
        }
        return $arr;
    }

    protected function n($string, $n = 14)
    {
        $arr = [];
        $func = function ($string) use (&$arr, &$func, &$n) {
            $substr = mb_strimwidth($string, 0, $n, '', 'UTF-8');
            if ($substr) {
                array_push($arr, $substr . str_pad('', $n - mb_strwidth($substr, 'UTF-8')));
                $startIndex = mb_strlen($substr);
                $string = mb_substr($string, $startIndex, null, 'UTF-8');
                $func($string);
            } else {
                return false;
            }
        };
        $func($string);
        return $arr;
    }


    /**
     * ????????????
     * ??????????????????????????????
     * @param string $input
     * @param integer $n
     * @return string
     */
    protected function rStrPad($input, $n = 7)
    {
        $string = "";
        $count = 0;
        $c_count = 0;
        for ($i = 0; $i < mb_strlen($input, 'UTF-8'); $i++) {
            $char = mb_substr($input, $i, 1, 'UTF-8');
            $string .= $char;
            if (strlen($char) == 3) {
                $count += 2;
                $c_count++;
            } else {
                $count += 1;
            }
            if ($count >= $n * 2) {
                break;
            }
        }
        if ($count < $n * 2) {
            $string = str_pad($string, $n * 2 + $c_count);
        }
        return $string;
    }

    /**
     * @return string
     * ????????????
     */
    public function getTimes()
    {
        return '';
    }

    /**
     * @param $content
     * @return mixed
     * ??????
     */
    public function getCenter($content)
    {
        return $content;
    }

    /**
     * @param $content
     * @return mixed
     * ??????
     */
    public function getBold($content)
    {
        return $content;
    }

    /**
     * @param $content
     * @return string
     * ????????????
     */
    public function getCenterBold($content)
    {
        return "$content";
    }

    /**
     * @param $content
     * @return mixed
     * ??????
     */
    public function getBR($content)
    {
        return $content;
    }

    /**
     * @param OrderContent $data
     * @return mixed
     * ??????---???????????????
     */
    public function getTableNoAttr($data)
    {
        return '';
    }

    /**
     * @param OrderContent $data
     * @return mixed
     * ??????--????????????
     */
    public function getTableAttr($data)
    {
        return '';
    }

    /**
     * @param $content
     * @return string
     * ??????--??????
     */
    public function getPrice($content)
    {
        return $content . '???';
    }

    /**
     * @return mixed
     * ?????????
     */
    public function getDivide()
    {
        return $this->getBR("--------------------------------");
    }

    public function getRemarkText($text)
    {
        $arrText = $this->rStrPad1($text, 18);
        $newText = '';
        foreach ($arrText as $item) {
            $newText .= $this->getBR($item);
        }

        return $newText;
    }
}
