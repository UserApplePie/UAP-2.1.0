<?php
/**
 * Routes - all standard routes are defined here.
 *
 * @author David Carr - dave@daveismyname.com
 * @version 2.2
 * @date updated Sept 19, 2015
 */

/** Create alias for Router. */
use Core\Router;
use Helpers\Hooks;

/** Define routes. */
Router::any('', 'Controllers\Home@index');
Router::any('subpage', 'Controllers\Home@subPage');

Router::any('register', 'Controllers\Auth@register');
Router::any('activate/username/(:any)/key/(:any)', 'Controllers\Auth@activate');
Router::any('forgot-password', 'Controllers\Auth@forgotPassword');
Router::any('resetpassword/username/(:any)/key/(:any)', 'Controllers\Auth@resetPassword');
Router::any('resend-activation-email', 'Controllers\Auth@resendActivation');

Router::any('login', 'Controllers\Auth@login');
Router::any('logout', 'Controllers\Auth@logout');
Router::any('settings', 'Controllers\Auth@settings');
Router::any('change-email', 'Controllers\Auth@changeEmail');
Router::any('change-password', 'Controllers\Auth@changePassword');


/** Module routes. */
$hooks = Hooks::get();
$hooks->run('routes');

/** If no route found. */
Router::error('Core\Error@index');

/** Turn on old style routing. */
Router::$fallback = false;

/** Execute matched routes. */
Router::dispatch();
