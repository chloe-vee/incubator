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

function require_stub(...$paths): void
{
    require_once(joinpaths(TEST_ROOT, "stubs", "phpbb", ...$paths));
}
