<?php

require LUCID . 'routing.php';

return [
    route() => 'page',
    route('home') => 'page',
    route('about') => 'page@about',
    route('post') => 'post',
    route('post', '(?<post_id>\d+)') => 'post@show',
    route('post', 'new') => 'post@new',
    route('post', '(?<post_id>\d+)', 'edit') => 'post@edit',
    route('post', 'create') => 'post@create',
    route('post', '(?<post_id>\d+)', 'update') => 'post@update',
    route('post', '(?<post_id>\d+)', 'destroy') => 'post@destroy',
];
