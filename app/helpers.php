<?php
if (!function_exists('getValueOrDefault')) {
    /**
     * Return `$default` if `$value` is null or empty or not in `$constraints`
     *
     * @param string|null $value
     * @param array $constraints (array to match `$value`)
     * @param string $default return if `$constraints` does not match `$value`
     * @return string
     */
    function getValueOrDefault(string|null $value, array $constraints, string $default): string
    {
        return $value
            ? (array_search($value, $constraints) >= 0 ? $value : $default)
            : $default;
    }
}
