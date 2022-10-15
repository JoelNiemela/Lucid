<?php

abstract class Casing {
    public static function snake_to_pascal(string $name): string {
        return str_replace('_', '', ucwords($name, '_'));
    }

    public static function pascal_to_snake(string $name): string {
        return strtolower(preg_replace('/(?<!^)[A-Z]/', '_$0', $name));
    }
}
