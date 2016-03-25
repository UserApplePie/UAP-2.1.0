<?php
use Helpers\Hooks;

Hooks::addHook('sidebar','Modules\Members\Controllers\Members@index');
Hooks::addHook('routes','Modules\Members\Controllers\Members@routes');
Hooks::addHook('navbar','Modules\Members\Controllers\Members@navbar');