<?php
/**
 * Config - an example for setting up system settings.
 * When you are done editing, rename this file to 'Config.php'.
 *
 * @author David Carr - dave@daveismyname.com
 * @author Edwin Hoksberg - info@edwinhoksberg.nl
 * @version 2.2
 * @date June 27, 2014
 * @date updated Sept 19, 2015
 */

namespace Core;

use Helpers\Session;

/**
 * Configuration constants and options.
 */
class Config
{
    /**
     * Executed as soon as the framework runs.
     */
    public function __construct()
    {
        /**
         * Turn on output buffering.
         */
        ob_start();

        /**
         * Relative base path.
         */
        define('DIR', '/');

        /**
         * Set default controller and method for legacy calls.
         */
        define('DEFAULT_CONTROLLER', 'welcome');
        define('DEFAULT_METHOD', 'index');

        /**
         * Set the default template.
         */
        define('TEMPLATE', 'default');

        /**
         * Set a default language.
         * Auth Languages availables: en / fr / de / es
         * Other available languages: cs / it / nl / pl / ro / ru
         *      (will cause error if set to any of these since Auth languages uses this,
         *       unless you add in the translations yourself to Helpers/Auth/Lang.php)
         */
        define('LANGUAGE_CODE', 'en');

        /**
         * Site and Email Title
         */
        define('SITETITLE', 'UAP V2.1');

        /**
         * Set prefix for sessions.
         */
        define('SESSION_PREFIX', 'uap_');


        /********************
         *                  *
         *     DATABASE     *
         *                  *
         ********************/

        // Database engine default is mysql.
        define('DB_TYPE', 'mysql');

        // Database host default is localhost.
        define('DB_HOST', 'localhost');

        // Database name
        define('DB_NAME', 'dbname');

        // Database username
        define('DB_USER', 'dbusername');

        // Database password
        define('DB_PASS', 'dbpassword');

        // PREFIX to be used before each table name
        define('PREFIX', 'uap_');



        /********************
         *                  *
         *      EMAIL       *
         *     uses SMTP    *
         ********************/
        // Email's email
        define('EMAIL_USERNAME', 'email@domain.com');

        // Email's password
        define('EMAIL_PASSWORD', 'passw0rd');

        // Email sent from whom? a name
        define('EMAIL_FROM_NAME','George Lopez');

        // Email host
        // Example : Google (smtp.gmail.com), Yahoo (smtp.mail.yahoo.com)
        define('EMAIL_HOST','smtp.gmail.com');

        // Email port
        // default : 25 (https://www.arclab.com/en/kb/email/list-of-smtp-and-pop3-servers-mailserver-list.html)
        define('EMAIL_PORT', '25');

        // Email authentication
        // default : ssl
        // choices : ssl, tls, (leave it empty)
        define('EMAIL_STMP_SECURE','ssl');



        /********************
         *                  *
         *     RECAPTCHA    *
         *                  *
         ********************/
        // reCAPCHA site key provided by google for testing purposes
        define("RECAP_PUBLIC_KEY", '6LeIxAcTAAAAAJcZVRqyHh71UMIEGNQ_MXjiZKhI');
        // reCAPCHA secret key provided by google for testing purposes
        define("RECAP_PRIVATE_KEY", '6LeIxAcTAAAAAGG-vFI1TnRWxMZNFuojJ4WifJWe');



        /*****************
         *                *
         *     Account    *
         *                *
         *****************/
        // Account needs email activation, false=no true=yes
        define("ACCOUNT_ACTIVATION",false);

        // Max attempts for login before user is locked out
        define("MAX_ATTEMPTS", 5);

        // URL to Auth Class installation root WITH trailing slash
        define("BASE_URL", "http://127.0.0.1/");

        // Account activation route
        define("ACTIVATION_ROUTE", 'activate');

        // Account password reset route
        define("RESET_PASSWORD_ROUTE", 'resetpassword');

        //How long a session lasts : Default = +1 day
        define("SESSION_DURATION", "+1 day");

        //How long a REMEMBER ME SESSION lasts : Default = +1 month
        define("SESSION_DURATION_RM", "+1 month");

        //Max attempts for logging in
        define("SECURITY_DURATION", "+5 minutes");

        //INT cost of BCRYPT algorithm
        define("COST", 10);

        //INT hash length of BCRYPT algorithm
        define("HASH_LENGTH", 22);

        // min length of username
        define('MIN_USERNAME_LENGTH', 5);

        // max length of username
        define('MAX_USERNAME_LENGTH', 30);

        // min length of password
        define('MIN_PASSWORD_LENGTH', 5);

        // max length of password
        define('MAX_PASSWORD_LENGTH', 30);

        //max length of email
        define('MAX_EMAIL_LENGTH', 100);

        // min length of email
        define('MIN_EMAIL_LENGTH', 5);

        //random key used for password reset or account activation
        define('RANDOM_KEY_LENGTH', 15);

        $waittime = preg_replace("/[^0-9]/", "", SECURITY_DURATION); //DO NOT MODIFY
        // this is the same as SECURITY_DURATION but in number format
        define('WAIT_TIME', $waittime); //DO NOT MODIFY



        /**
         * Turn on custom error handling.
         */
        set_exception_handler('Core\Logger::ExceptionHandler');
        set_error_handler('Core\Logger::ErrorHandler');

        /**
         * Set timezone.
         */
        date_default_timezone_set('America/Los_Angeles');


        /**
         * Start sessions.
         */
        Session::init();
    }
}
