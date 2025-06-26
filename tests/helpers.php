<?php

/**
 * Join paths by DIRECTORY_SEPARATOR.
 *
 * @param string[] $paths The paths to join
 *
 * @return string           The joined path
 */
function joinpaths(): string
{
    return join(DIRECTORY_SEPARATOR, func_get_args());
}

/**
 * Return true if $arr has all of the keys in $keys.
 *
 * @param array $keys Keys to check for
 * @param array $arr  Array to check
 *
 * @return bool      If all $keys are in $arr
 */
function keys_exist($keys, $arr): bool
{
    return array_all(
        $keys,
        fn($k): bool => array_key_exists($k, $arr),
    );
}

/**
 * Return the contents of a SQL fixture file.
 *
 * @param string $name Name of the sql file.
 */
function fixture_sql(string $name)
{
    $path = joinpaths(TEST_ROOT, "fixtures", "${name}.sql");
    if (!file_exists($path)) {
        throw new ErrorException("No such fixture: '$path'");
    }
    return file_get_contents($path);
}

/**
 * Require/include a stub file.
 *
 * @return void
 */
function require_stub(...$paths): void
{
    include_once joinpaths(TEST_ROOT, "stubs", "phpbb", ...$paths);
}

/**
 * Print a horizontal line to stdout.
 *
 * @return null
 */
function hr(): void
{
    print "\n=======================================\n";
}

/**
 * Print a message to stdout.
 */
function out(...$msg): void
{
    $text = join(" ", $msg);
    print "\n[incubator] $text\n\n";
}

/**
 * Print a message to stderr.
 */
function err(...$msg): void
{
    $text = join(" ", $msg);
    fwrite(STDERR, "\n[incubator] ERROR $text\n\n");
}

/**
 * Avoid triggering errors for E_USER_NOTICE "errors".
 *
 * @return bool True means no further action; False means error should be
 *              re-raised.
 */
$handler = function (int $level, string $msg, string $file, int $line): bool {
    switch ($level) {
        case E_USER_NOTICE:
            $level_name = "NOTICE";
            $done = true;
            break;
        case E_USER_WARNING:
            $level_name = "WARNING";
            // fall-through
        case E_USER_DEPRECATED:
            $level_name = "DEPRECATED";
            // fall-through
        case E_USER_ERROR:
            $level_name = "ERROR";
            // fall-through
        default:
            $done = false;
            break;
    }

    // if (!$done) {
        // $file = str_replace(getcwd(), ".", $file);
        // out("$file:$line [$level_name] $msg");
    // }

    return $done;
};

set_error_handler($handler);
