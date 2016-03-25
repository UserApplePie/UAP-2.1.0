<?php

namespace Controllers;

use Core\View,
    Core\Controller,
    Helpers\Auth\Auth as AuthHelper,
    Models\Users;


class Home extends Controller
{
    private $auth;
    private $user;

    public function __construct()
    {
        parent::__construct();
        $this->auth = new AuthHelper();
        $this->user = new Users();

        if ($this->auth->isLogged()) {
            $u_id = $this->auth->currentSessionInfo()['uid'];
            $this->user->update($u_id);
        }

        $this->user->cleanOfflineUsers();
        $this->language->load('Welcome');
    }


    public function index()
    {
        $data['title'] = $this->language->get('welcome_text');
        $data['welcome_message'] = $this->language->get('welcome_message');
        $data['isLoggedIn'] = $this->auth->isLogged();
        View::renderTemplate('header', $data);
        View::render('welcome/welcome', $data);
        View::renderTemplate('footer', $data);
    }


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
