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

function mini(int $value, string|null $str)
{
    if ($str <= $value) {
        return strlen($value);
    }
}

function maxi(int $value, string|null $str)
{
    if ($str >= $value) {
        return strlen($value);
    }
}