<?php

$di->set("config",function () use ($config) {
    return $config;
});
