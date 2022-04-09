<?php

function isIdentity(string $value = null): bool
{
    return preg_math(
        "#[a-zA-ZàîïöôüûÄÂâäêëéè,.'-]+$#",
        $value
    );
}

function isNotBlank(string|array|null $fiels): bool
{
    return !empty($fiels);
}

function min(int $value, string|null $str)
{
    if ($str <= $value) {
        return strlen($value);
    }
}

function max(int $value, string|null $str)
{
    if ($str >= $value) {
        return strlen($value);
    }
}