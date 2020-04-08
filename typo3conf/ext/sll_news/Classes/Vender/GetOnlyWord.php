<?php
namespace Sll\SllNews\Method;
/**
 * 汉字转拼音
 *
 * @author wanghongbin <wanghongbin@ngoos.org>
 * @since
 */
class GetOnlyWord {
    var $filter = array();

    function __construct()
    {
        $this->filter = array(
            '`', '·', '~', '!', '！', '@', '#', '$', '￥', '%', '^', '……', '&', '*', '(', ')', '（', '）', '-', '_', '——', '+', '=', '|', '\\', '[', ']', '【', '】', '{', '}', ';', '；', ':', '：', '\'', '"', '“', '”', ',', '，', '<', '>', '《', '》', '.', '。', '/', '、', '?', '？',' '
        );
    }
    
    /**
     * 替换特殊字符
     *
     * @param string $s         汉字字符串
     * @param bool $quanpin     是否全拼
     * @param bool $daxie       首字母是否大写
     * @return string
     */
    public function getWord($str)
    {
        $str =urlencode($str);//将关键字编码
        //下面的必须写在一行，不可换行截断
        $str=preg_replace("/(%7E|%60|%21|%40|%23|%24|%25|%5E|%26|%27|%2A|%28|%29|%2B|%7C|%5C|%3D|\-|_|%5B|%5D|%7D|%7B|%3B|%22|%3A|%3F|%3E|%3C|%2C|\.|%2F|%A3%BF|%A1%B7|%A1%B6|%A1%A2|%A1%A3|%A3%AC|%7D|%A1%B0|%A3%BA|%A3%BB|%A1%AE|%A1%AF|%A1%B1|%A3%FC|%A3%BD|%A1%AA|%A3%A9|%A3%A8|%A1%AD|%A3%A4|%A1%A4|%A3%A1|%A1%AB|%A3%FB|%A3%FD|%A1%BE|%A1%BF|)+/",'',$str);
        $str =urldecode($str);//将过滤后的关键字解码
        return $str;
    }

    /**
     * 过滤字符串中的特殊符号
     *
     * @param [type] $str
     * @return void
     * @author wanghongbin <wanghongbin@ngoos.org>
     * @since
     */
    public function strFilter($str,$mark='_')
    {
        for ($i=0; $i < count($this->filter); $i++) { 
            $str = str_replace($this->filter[$i], $mark, $str);
        }
        return trim(trim($str),$mark);
    }

    /**
     * 截取字符串,兼容中文
     *
     * @param [type] $str
     * @param [type] $length
     * @param string $charset
     * @param integer $start
     * @param boolean $suffix
     * @return void
     * @author wanghongbin <wanghongbin@ngoos.org>
     * @since
     */
    public function csubstr($str, $length, $charset = "", $start = 0, $suffix = true)
    {
        $str = $this->strFilter(strip_tags($str),'');
        if (empty($charset))
            $charset = "utf-8";
        if (function_exists("mb_substr")) {
            if (mb_strlen($str, $charset) <= $length)
                return $str;
            $slice = mb_substr($str, $start, $length, $charset);
        } else {
            $re['utf-8'] = "/[\x01-\x7f]¦[\xc2-\xdf][\x80-\xbf]¦[\xe0-\xef][\x80-\xbf]{2}¦[\xf0-\xff][\x80-\xbf]{3}/";
            $re['gb2312'] = "/[\x01-\x7f]¦[\xb0-\xf7][\xa0-\xfe]/";
            $re['gbk'] = "/[\x01-\x7f]¦[\x81-\xfe][\x40-\xfe]/";
            $re['big5'] = "/[\x01-\x7f]¦[\x81-\xfe]([\x40-\x7e]¦\xa1-\xfe])/";
            preg_match_all($re[$charset], $str, $match);
            if (count($match[0]) <= $length) return $str;
            $slice = join("", array_slice($match[0], $start, $length));
        }
        if ($suffix) return $slice . "...";
        return $slice;
    }
}