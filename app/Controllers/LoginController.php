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
        $this->content = view('login', [
            'token' => $this->generateToken(),
            'signup' => false
        ]);
        // $loginView = new LoginView();
        // $loginView->display();
    }

    public function showSignup()
    {
        $this->content = view('login', [
            'token' => $this->generateToken(),
            'signup' => true
        ]);
        // $loginView = new LoginView();
        // $loginView->display();
    }

    public function login()
    {
        // var_dump($_POST);
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';
        $token = $_POST['_csrf'] ?? '';
        $result = $this->verifyLogin($email, $password, $token);
        $header = strtoupper($_SERVER['HTTP_X_REQUESTED_WITH'] ?? '');
        // die(var_dump($header == 'XMLHTTPREQUEST'));
        // die(var_dump($result));
        if ($result['success']) {
            // die(var_dump($_SESSION));
            session_regenerate_id();
            $_SESSION['logged_in'] = true;
            unset($result['user']->password);
            $_SESSION['user'] = $result['user'];
        }

        if ($header == 'XMLHTTPREQUEST') {
            // die(var_dump($result));
            ob_end_clean();
            echo json_encode($result);
            exit;
        } else {
            if ($result['success']) {
                header('Location: /');
            } else {
                $_SESSION['message'] = $result['message'];
                header('Location: /auth/login');
            }
        }
    }

    public function signup()
    {
        $_SESSION['message'] = '';
        // var_dump($_POST);
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';
        $token = $_POST['_csrf'] ?? '';
        $name = $_POST['name'] ?? '';
        $result = $this->verifySignup($email, $password, $name, $token);
        // die(var_dump($result));
        if ($result['success']) {

            $user = new User($this->conn);
            $data['email'] = $email;
            $data['password'] = password_hash($password, PASSWORD_DEFAULT);
            $data['username'] = $name;
            $user->saveUser($data);
            // die(var_dump($_SESSION));
            $this->login();
        } else {
            $_SESSION['message'] = $result['message'];
            header('Location: /auth/signup');
        }
    }

    public function logout()
    {
        $_SESSION = [];
        header('Location: /');
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
        $result['user'] = $resEmail[0];
        return $result;
    }


    private function verifySignup($email, $password, $name, $token)
    {
        $user = new User($this->conn);
        $result = [
            'success' => true,
            'message' => 'User signed up'
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
        if ($resEmail) {
            $result['success'] = false;
            $result['message'] = 'User already exists';
            return $result;
        }
        // $result['user'] = $resEmail[0];
        return $result;
    }
}