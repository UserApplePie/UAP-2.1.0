<?php

namespace Controllers;

use Core\View,
    Core\Controller,
    Helpers\Auth\Auth as AuthHelper;

/**
 * Sample controller showing a construct and 2 methods and their typical usage.
 */
class Welcome extends Controller
{
    private $auth;
    /**
     * Call the parent construct
     */
    public function __construct()
    {
        parent::__construct();
        $this->auth = new AuthHelper();
        $this->language->load('Welcome');
    }

    /**
     * Define Index page title and load template files
     */
    public function index()
    {
        $data['title'] = $this->language->get('welcome_text');
        $data['welcome_message'] = $this->language->get('welcome_message');
        $data['isLoggedIn'] = $this->auth->isLogged();
        View::renderTemplate('header', $data);
        View::render('welcome/welcome', $data);
        View::renderTemplate('footer', $data);
    }

    /**
     * Define Subpage page title and load template files
     */
    public function subPage()
    {
        $data['title'] = $this->language->get('subpage_text');
        $data['welcome_message'] = $this->language->get('subpage_message');
        $data['isLoggedIn'] = $this->auth->isLogged();
        View::renderTemplate('header', $data);
        View::render('welcome/subpage', $data);
        View::renderTemplate('footer', $data);
    }
}
