<?php

function log_updates($updates)
{
    file_put_contents(__DIR__ . '/logs.txt', print_r($updates, 1), FILE_APPEND);
}
