<?php

namespace App\Controllers;
use App\Models\User;

class LoginController extends BaseController
{
    private function generateToken(): string
    {
        $token = bin2hex(random_bytes(32));
        $_SESSION['csrf'] = $token;
        return $token;
    }

    public function showLogin()
    {
        $this->content = view('login', ['token' => $this->generateToken()]);
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
        var_dump($_POST);
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';
        $token = $_POST['_csrf'] ?? '';
        $result = $this->verifyLogin($email, $password, $token);
        // die(var_dump($result));
        if ($result['success']) {
            session_regenerate_id();
            $_SESSION['logged_in'] = true;
            unset($result['user']['password']);
            $_SESSION['userData'] = $result['user'];
            header('Location: /');
            exit;
        } else {
            $_SESSION['message'] = $result['message'];
            header('Location: /auth/login');
        }
    }

    public function display(): void
    {
        require $this->layout;
    }

    private function verifyLogin($email, $password, $token): array
    {
        $user = new User($this->conn);
        $result = [
            'success' => true,
            'message' => 'User logged in'
        ];
        if (!isset($_SESSION['csrf']) || $token !== $_SESSION['csrf']) {
            $result['success'] = false;
            $result['message'] = 'Invalid token';
            return $result;
        }
        $email = filter_var($email, FILTER_VALIDATE_EMAIL);
        if (!$email) {
            $result['success'] = false;
            $result['message'] = 'Invalid email';
            return $result;
        }
        if (strlen($password) < 6) {
            $result['success'] = false;
            $result['message'] = 'Password too short';
            return $result;
        }
        $resEmail = $user->getUserByEmail($email);
        // var_dump($resEmail);
        if (!$resEmail) {
            $result['success'] = false;
            $result['message'] = 'User not found';
            return $result;
        }
        if(!password_verify($password, $resEmail[0]->password)){
            $result['success'] = false;
            $result['message'] = 'Invalid password';
            return $result;
        }
        return $result;
    }
}