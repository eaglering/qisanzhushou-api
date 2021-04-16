<?php

if (!function_exists('qs_crypt')) {
    /**
     * 通用加密
     * @param $password
     * @return string
     */
    function qszs_hash($password) {
        return sha1(sha1($password) . 'qszs_salt_Mo01Sx');
    }
}

if (!function_exists('pretty_exception')) {
    function pretty_exception(\Exception $e, $trace = false) {
        return $e->getMessage() . ' at ' . $e->getFile() . ':' . $e->getLine() . PHP_EOL . $e->getTraceAsString();
    }
}

if (!function_exists('filterable_integer')) {
    function filterable_integer($array, $field, $gt = -1) {
        return isset($array[$field]) && $array[$field] !== '' &&
            filter_var($array[$field], FILTER_VALIDATE_INT) !== false && $array[$field] > $gt;
    }
}

if (!function_exists('filterable_string')) {
    /**
     * 判断变量是否为字符串类型
     * @param $array
     * @param $field
     * @return bool
     */
    function filterable_string($array, $field) {
        return isset($array[$field]) && is_string($array[$field]) && trim($array[$field]) !== '';
    }
}

if (!function_exists('array_merge_multiple')) {
    /**
     * 多维数组合并
     * @param $array1
     * @param $array2
     * @return array
     */
    function array_merge_multiple($array1, $array2)
    {
        $merge = $array1 + $array2;
        $data = [];
        foreach ($merge as $key => $val) {
            if (
                isset($array1[$key])
                && is_array($array1[$key])
                && isset($array2[$key])
                && is_array($array2[$key])
            ) {
                $data[$key] = array_merge_multiple($array1[$key], $array2[$key]);
            } else {
                $data[$key] = isset($array2[$key]) ? $array2[$key] : $array1[$key];
            }
        }
        return $data;
    }
}

if (!function_exists('curl')) {
    /**
     * curl请求指定url (get)
     * @param $url
     * @param array $data
     * @param array $options
     * @return mixed
     * @throws Exception
     */
    function curl($url, $data = [], $options = [])
    {
        // 处理get数据
        if (!empty($data)) {
            $flag = strpos($url, '?') === false ? '?' : '&';
            $url = $url . $flag . http_build_query($data);
        }
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);//这个是重点。
        !empty($options['timeout']) && curl_setopt($ch, CURLOPT_TIMEOUT, $options['timeout']);
        $result = curl_exec($ch);
        if ($result) {
            curl_close($ch);
            return $result;
        }
        $code = curl_errno($ch);
        $msg = curl_error($ch);
        curl_close($ch);
        throw new \Exception($msg, $code);
    }
}

if (!function_exists('curlPost')) {
    /**
     * curl请求指定url (post)
     * @param $url
     * @param array $data
     * @param array $options
     * @return mixed
     * @throws Exception
     */
    function curlPost($url, $data = [], $options = [])
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        !empty($options['timeout']) && curl_setopt($ch, CURLOPT_TIMEOUT, $options['timeout']);
        !empty($options['header']) && curl_setopt($ch, CURLOPT_HTTPHEADER, $options['header']);
        $result = curl_exec($ch);
        if ($result) {
            curl_close($ch);
            return $result;
        }
        $code = curl_errno($ch);
        $msg = curl_error($ch);
        curl_close($ch);
        throw new \Exception($msg, $code);
    }
}

if (!function_exists('list2tree')) {
    /**
     * 无线级列表转树
     * @param $list
     * @param string $pk
     * @param string $pid
     * @param string $child
     * @return array
     */
    function list2tree($list, $pk = 'id', $pid = 'parent_id', $child = 'children') {
        $refs = [];
        foreach ($list as $key => $item) {
            $refs[$item[$pk]] = &$list[$key];
        }
        $result = [];
        foreach ($list as $key => $item) {
            if ($item[$pid] === 0) {
                $result[] = &$list[$key];
            } else if (isset($refs[$item[$pid]])) {
                $refs[$item[$pid]][$child][] = &$list[$key];
            }
        }
        return $result;
    }
}

if (!function_exists('fen2yuan')) {
    /**
     * 分转元
     * @param $fen
     * @return string
     */
    function fen2yuan($fen) {
        return sprintf('%.2f', $fen / 100);
    }
}
