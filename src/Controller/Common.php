<?php

namespace App\Controller;
/**
 * Class Common
 */
class Common
{
    private static $_instance = NULL;
    private static $_messages = null;
    private static $_constants = null;
    private static $_configurations = null;

    /**
     * Singleton instance
     */
    public static function getInstance()
    {
        if (null === static::$_instance) {
            static::$_instance = new self();
        }
        return static::$_instance;
    }

    protected static function _loadMessage()
    {
        // load base language
        $base = require_once ROOT . '/common_message.php';
        $default = array();
        $active = array();
        // load default language
        $path = ROOT . '/common_message_' . Configure::read('Config.defaultLanguage') . '.php';
        if (file_exists($path)) {
            $default = require_once $path;
        }
        // load active language
        $path = ROOT . '/common_message_' . Configure::read('Config.language') . '.php';
        if (file_exists($path)) {
            $active = Configure::read('Config.language') ? require_once $path : null;
        }
        // merge messages. for keys that exist in both arrays, the elements from the left-hand array will be used
        // @link http://php.net/manual/en/language.operators.array.php
        return (array)$active + (array)$default + (array)$base;
    }

    public static function getPlainMessage($key)
    {
        if (!static::$_messages) {
            static::$_messages = static::_loadMessage();
        }
        if (!isset(static::$_messages[$key])) {
            return $key;
        }
        return static::$_messages[$key];
    }

    public static function getConfig()
    {
        if (!static::$_configurations) {
            static::$_configurations = require_once ROOT . '/common_config.php';
        }
        $arguments = func_get_args();
        $first = array_shift($arguments);
        if (!isset(static::$_configurations[$first])) {
            return null;
        }
        $config = static::$_configurations[$first];
        while (true) {
            if (!$arguments) {
                return $config;
            }
            $key = array_shift($arguments);
            if (!isset($config[$key])) {
                return null;
            }
            $config = $config[$key];
        };
    }

    public static function isValid($value)
    {
        return 0 < strlen((string)$value);
    }

    public static function pathinfo($path, $options = null)
    {
        $path = urlencode($path);
        $parts = null === $options ? pathinfo($path) : pathinfo($path, $options);
        foreach ($parts as $field => $value) {
            $parts[$field] = urldecode($value);
        }
        return $parts;
    }

    /**
     * @return string here url include query string
     */
    public static function here()
    {
        return FULL_BASE_URL . CustomCakeRequest::getSingleton()->here();
    }

    /**
     * convert query string to pass format
     *
     * @param $url
     * @return string
     */
    public static function query2pass($url)
    {
        $parts = parse_url($url);
        if (!isset($parts['query'])) {
            return $url;
        }
        parse_str($parts['query'], $queries);
        $parts['path'] = rtrim($parts['path'], '\\/');
        foreach ($queries as $param => $value) {
            if (!strlen((string)$value)) {
                continue;
            }
            $parts['path'] .= '/' . $param . '/' . $value;
        }
        return (isset($parts['scheme']) ? $parts['scheme'] . '://' : '') . (isset($parts['host']) ? $parts['host'] : '') . $parts['path'];
    }

    /**
     * @param $url e.g format /controller/action or controller/action
     * @param array|string $params query params or string
     * @return string
     */
    public static function url($url, $params = array())
    {
        $url = '/' . ltrim($url, '\\/');
        if ($params) {
            $start = false === strpos($url, '?') ? '?' : '&';
            $query = is_array($params) ? http_build_query($params) : $params;
            $url .= $start . $query;
        }

        if (IS_CLI) {
            return BASE_URI . AREA_URI . $url;
        }
        $return = FULL_BASE_URL . BASE_URI . AREA_URI . $url;
        return !Configure::read('Param.enablePass') ? $return : static::query2pass($return);
    }

    /**
     * @param $url
     * @param array|string $params query params or string
     * @return string
     */
    public static function staticUrl($url, $params = array())
    {
        $url = '/' . ltrim($url, '\\/');
        if ($params) {
            $start = false === strpos($url, '?') ? '?' : '&';
            $query = is_array($params) ? http_build_query($params) : $params;
            $url .= $start . $query;
        }
        if (IS_CLI) {
            return BASE_URI . $url;
        }
        return FULL_BASE_URL . BASE_URI . $url;
    }

    public static function backUrl($url, $params = array())
    {
        $searchedKey = AppHelper::getSearchedKey();
        $searchedKey ? $params['searched_key'] = $searchedKey : '';
        return static::url($url, $params);
    }

    /**
     * Convert array to string
     *
     * @param array $array
     * @param string $glue
     * @return string
     */
    public static function arrayToString($array = array(), $glue = PHP_EOL)
    {
        is_array($array) ? NULL : $array = array();
        is_string($glue) ? NULL : $glue = '';

        return implode($glue, Common::oneDimension($array));
    }

    /**
     * Merge all leafs (of any dimension array) into one dimensional array
     *
     * @param array $array multi dimensions array
     * @return array on one dimension array
     */
    public static function oneDimension($array = array())
    {
        $oneDimension = array();
        is_array($array) || $array = array();
        $stack = $array;

        while (0 < count($stack)) {
            # get end element
            $current = array_pop($stack);
            switch (true) {
                case is_string($current):
                    $oneDimension[] = $current;
                    break;
                case is_array($current):
                    # deep browser
                    foreach ($current as $element) {
                        array_push($stack, $element);
                    }
                    break;
                default:
                    break;
            }
        }

        return array_reverse($oneDimension);
    }

    public static function unique($prefix = null, $encode = false)
    {
        $unique = hash('sha1', uniqid(time(), true));
        if ('' !== (string)$prefix) {
            $unique = ($encode ? md5($prefix) : $prefix) . $unique;
        }
        return $unique;
    }

    public static function sha256($string)
    {
        $hash = hash('sha256', $string);
        return $hash;
    }

    /**
     * @param $key
     * @example
     * Common::getMessageX('DEMO_KEY', 'ARG_KEY1');
     * Common::getMessageX('DEMO_KEY', 'ARG_KEY1', 'ARG_KEY2', ...); // horizontal argument keys
     * Common::getMessageX('DEMO_KEY', array('ARG_KEY1', 'ARG_KEY2', ...)); // vertical argument keys
     * @return string
     */
    public function getMessageX($key)
    {
        $arguments = func_get_args();
        // remove first arg: $key
        array_shift($arguments);
        // convert vertical to horizontal
        1 == count($arguments) && isset($arguments[0]) && is_array($arguments[0]) ? $arguments = $arguments[0] : '';
        $messages = array();
        // convert to array to easy translated
        is_array($arguments) ? '' : $arguments = array($arguments);
        foreach ($arguments as $index => $itemKey) {
            $messages[] = Common::getMessage($itemKey);
        }
        return Common::getMessage($key, $messages);
    }

    /**
     * Get message by key and parameters
     * @example
     * Common::getMessage('DEMO_KEY', 'arg1');
     * Common::getMessage('DEMO_KEY', 'arg1', 'arg2', ...); // horizontal arguments
     * Common::getMessage('DEMO_KEY', array('arg1', 'arg2', ...)); // vertical arguments
     * Common::getMessage('DEMO_KEY');
     * @param $key
     * @return string
     */
    public static function getMessage($key)
    {
        if (!static::$_messages) {
            static::$_messages = static::_loadMessage();
        }
        if (!isset(static::$_messages[$key]) && isset(static::$_messages[strtoupper($key)])) {
            $key = strtoupper($key);
        }
        $arguments = func_get_args();
        if (!isset(static::$_messages[$key])) {
            // only key
            if (1 >= count($arguments)) {
                return $key;
            }
            // some other arguments
            $translated = $key;
        } else {
            $translated = static::$_messages[$key];
        }
        // remove first arg: $key
        array_shift($arguments);
        // convert vertical to horizontal
        1 == count($arguments) && isset($arguments[0]) && is_array($arguments[0]) ? $arguments = $arguments[0] : '';
        if (!$arguments) {
            return $translated;
        }
        $result = @vsprintf($translated, $arguments);
        return $result ? $result : $translated;
    }


    /**
     * Get constant by key
     * @example Common::getConstant('SEX_MALE');
     *
     * @param $key
     * @return mixed
     */
    public static function getConstant($key)
    {
        if (!static::$_constants) {
            static::$_constants = require_once ROOT . '/common/common_constant.php';
        }
        if (!array_key_exists($key, static::$_constants)) {
            return $key;
        }
        return static::$_constants[$key];
    }

    /**
     * check valid datetime, date, time
     *
     * @param $value
     * @return bool
     */
    public static function isDatetime($value)
    {
        if (trim($value) != $value) {
            return false;
        }
        // detect datetime
        switch (true) {
            // datetime
            case false !== strpos($value, ' '):
                break;
            // time
            case false !== strpos($value, ':'):
                $value = '2000-01-02 ' . $value;
                break;
            // date
            default:
                $value = $value . ' 00:00:00';
                break;
        }

        $second = strpos($value, ':') != strrpos($value, ':') ? ':s' : '';
        // convert to ISO8601 format
        // http://php.net/manual/en/datetime.formats.date.php
        $value = str_replace('/', '-', $value);
        $formatCorrect = (string)$value == date('Y-m-d H:i' . $second, strtotime((string)$value))
            || (string)$value == date('Y-m-d G:i' . $second, strtotime((string)$value))
            || (string)$value == date('Y-n-j H:i' . $second, strtotime((string)$value))
            || (string)$value == date('Y-n-j G:i' . $second, strtotime((string)$value));
        if (!$formatCorrect) {
            return false;
        };
        $valueCorrect = strtotime(Common::getConstant('TIMESTAMP_MAX')) >= strtotime((string)$value)
            && strtotime(Common::getConstant('TIMESTAMP_MIN')) <= strtotime((string)$value);
        return $valueCorrect;
    }

    public static function isTimestamp($value)
    {
        if (static::isDatetime($value)) {
            return Common::getConstant('TIMESTAMP_ERROR_NO');
        }
        $value = str_replace('/', '-', $value);
        $parts = explode('-', $value, 2);
        $year = $parts[0];
        if (Common::getConstant('TIMESTAMP_YEAR_MIN') >= $year) {
            return Common::getConstant('TIMESTAMP_ERROR_MIN');
        } else if (Common::getConstant('TIMESTAMP_YEAR_MAX') <= $year) {
            return Common::getConstant('TIMESTAMP_ERROR_MAX');
        } else {
            return Common::getConstant('TIMESTAMP_ERROR_OTHER');
        }
    }

    public static function execute($command)
    {
        if (!$command) {
            return;
        }
        $result = exec($command, $exeOutput = null, $return = null);
        $info = array('command' => $command, 'output' => $exeOutput, 'return' => $return, 'result' => $result);
        if (Configure::read('EasyLog.execute')) {
            App::uses('EasyLogComponent', 'Controller/Component');
            $easyLog = EasyLogComponent::getSingleton(Registry::get('prefix'));
            $easyLog->info(var_export($info, true));
        }
        return $info;
    }


    /**
     * Recursively Remove directory
     *
     * @param $dir
     * @param bool $recursive
     * @param bool $removeSelf
     * @param int $timeout minutes to be deleted. default is null which mean deleted as soon as
     */
    public static function removeDir($dir, $recursive = true, $removeSelf = true, $timeout = null)
    {
        $dir = rtrim($dir, '\\/');
        // ensure item for deleting, is directory
        if (is_file($dir)) {
            @unlink($dir);
            return;
        }
        $objects = @scandir($dir);
        foreach ($objects as $object) {
            // virtual directory can't be processed
            if ('.' === $object || '..' === $object) {
                continue;
            }
            if ('dir' == filetype($dir . DIRECTORY_SEPARATOR . $object)) {
                // recursively remove subdirectory
                $recursive ? static::removeDir($dir . DIRECTORY_SEPARATOR . $object, $recursive, true) : null;
            } else {
                // remove file
                if (!$timeout || strtotime(date('Y-m-d H:i:s')) >= filemtime($dir . DIRECTORY_SEPARATOR . $object) + $timeout * 60) {
                    @unlink($dir . DIRECTORY_SEPARATOR . $object);
                }
            }
        }
        reset($objects);
        // remove current directory
        $removeSelf ? rmdir($dir) : false;
    }

}