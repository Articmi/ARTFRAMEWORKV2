<?php

# - Namespace
    use Articmi\Controllers\Home;
    use Lib\Articmi;

# - Load Controller
    Articmi::get('/', [Home::class, 'index']);

# - Dispatch
    Articmi::dispatch();