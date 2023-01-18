<?php

namespace App\Controllers;

class LoginController extends BaseController
{
    public function showLogin()
    {
        $this->content = view('login');
        // $loginView = new LoginView();
        // $loginView->display();
    }

    public function showSignup()
    {
        // $loginView = new LoginView();
        // $loginView->display();
    }

    public function login()
    {
        // $loginModel = new LoginModel();
        // $loginModel->login();
    }

    public function display(): void
    {
        require $this->layout;
    }
}