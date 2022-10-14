<?php

function route(...$route) {
    return '/^\/'.implode('\/', $route).'$/';
}
