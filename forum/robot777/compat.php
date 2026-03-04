<?php
if (defined('LEGACY_PHP8_COMPAT_LOADED')) {
    return;
}

define('LEGACY_PHP8_COMPAT_LOADED', true);

error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING & ~E_DEPRECATED);
ini_set('default_charset', 'windows-1251');

$GLOBALS['HTTP_GET_VARS'] = &$_GET;
$GLOBALS['HTTP_POST_VARS'] = &$_POST;
$GLOBALS['HTTP_COOKIE_VARS'] = &$_COOKIE;
$GLOBALS['HTTP_POST_FILES'] = &$_FILES;
$GLOBALS['HTTP_SERVER_VARS'] = &$_SERVER;
$GLOBALS['HTTP_ENV_VARS'] = &$_ENV;

$legacyServerVars = array(
    'PHP_SELF',
    'REMOTE_ADDR',
    'REMOTE_HOST',
    'REQUEST_METHOD',
    'QUERY_STRING',
    'HTTP_USER_AGENT',
    'HTTP_REFERER',
    'SERVER_NAME',
    'SERVER_PORT',
    'DOCUMENT_ROOT',
    'REQUEST_URI',
);

foreach ($legacyServerVars as $legacyServerVar) {
    if (!array_key_exists($legacyServerVar, $GLOBALS)) {
        $GLOBALS[$legacyServerVar] = $_SERVER[$legacyServerVar] ?? '';
    }
}

foreach (array($_COOKIE, $_GET, $_POST, $_FILES) as $legacySource) {
    foreach ($legacySource as $legacyKey => $legacyValue) {
        if (!is_string($legacyKey)) {
            continue;
        }

        if (!preg_match('/^[A-Za-z_][A-Za-z0-9_]*$/', $legacyKey)) {
            continue;
        }

        if ($legacyKey === 'GLOBALS') {
            continue;
        }

        if (isset($legacyKey[0]) && $legacyKey[0] === '_') {
            continue;
        }

        if (array_key_exists($legacyKey, $GLOBALS)) {
            continue;
        }

        $GLOBALS[$legacyKey] = $legacyValue;
    }
}

if (!function_exists('legacy_posix_pattern')) {
    function legacy_posix_pattern($pattern, $caseInsensitive = false)
    {
        $delimiter = '~';
        $escaped = str_replace($delimiter, '\\' . $delimiter, (string) $pattern);

        return $delimiter . $escaped . $delimiter . ($caseInsensitive ? 'i' : '');
    }
}

if (!function_exists('ereg')) {
    function ereg($pattern, $string, &$regs = null)
    {
        $matches = array();
        $result = @preg_match(legacy_posix_pattern($pattern, false), (string) $string, $matches);

        if ($result !== 1) {
            $regs = array();

            return false;
        }

        $regs = $matches;

        return strlen($matches[0]);
    }
}

if (!function_exists('eregi')) {
    function eregi($pattern, $string, &$regs = null)
    {
        $matches = array();
        $result = @preg_match(legacy_posix_pattern($pattern, true), (string) $string, $matches);

        if ($result !== 1) {
            $regs = array();

            return false;
        }

        $regs = $matches;

        return strlen($matches[0]);
    }
}

if (!function_exists('ereg_replace')) {
    function ereg_replace($pattern, $replacement, $string)
    {
        $result = @preg_replace(
            legacy_posix_pattern($pattern, false),
            (string) $replacement,
            (string) $string
        );

        return $result === null ? (string) $string : $result;
    }
}

if (!function_exists('eregi_replace')) {
    function eregi_replace($pattern, $replacement, $string)
    {
        $result = @preg_replace(
            legacy_posix_pattern($pattern, true),
            (string) $replacement,
            (string) $string
        );

        return $result === null ? (string) $string : $result;
    }
}

if (!function_exists('split')) {
    function split($pattern, $string, $limit = -1)
    {
        $limit = (int) $limit;

        if ($limit <= 0) {
            $limit = -1;
        }

        $result = @preg_split(legacy_posix_pattern($pattern, false), (string) $string, $limit);

        return $result === false ? array((string) $string) : $result;
    }
}

if (!function_exists('spliti')) {
    function spliti($pattern, $string, $limit = -1)
    {
        $limit = (int) $limit;

        if ($limit <= 0) {
            $limit = -1;
        }

        $result = @preg_split(legacy_posix_pattern($pattern, true), (string) $string, $limit);

        return $result === false ? array((string) $string) : $result;
    }
}

if (!function_exists('each')) {
    function each(&$array)
    {
        if (!is_array($array)) {
            return false;
        }

        $key = key($array);

        if ($key === null) {
            return false;
        }

        $value = current($array);
        next($array);

        return array(
            0 => $key,
            1 => $value,
            'key' => $key,
            'value' => $value,
        );
    }
}

if (!function_exists('sql_regcase')) {
    function sql_regcase($string)
    {
        $string = (string) $string;

        return preg_replace_callback(
            '/[A-Za-z]/',
            function ($matches) {
                return '[' . strtoupper($matches[0]) . strtolower($matches[0]) . ']';
            },
            $string
        );
    }
}

if (!function_exists('get_magic_quotes_gpc')) {
    function get_magic_quotes_gpc()
    {
        return false;
    }
}

if (!function_exists('set_magic_quotes_runtime')) {
    function set_magic_quotes_runtime($newSetting)
    {
        return false;
    }
}
