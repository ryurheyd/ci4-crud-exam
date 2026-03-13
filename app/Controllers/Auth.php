<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{

    public function register()
    {
        return view('auth/register');
    }

    public function saveRegister()
    {
        $model = new UserModel();

        $rules = [
            'name' => 'required|min_length[3]',
            'email' => 'required|valid_email|is_unique[users.email]',
            'password' => 'required|min_length[6]',
            'confirm_password' => 'required|matches[password]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $hashedPassword = password_hash(
            $this->request->getPost('password'),
            PASSWORD_BCRYPT
        );

        $model->save([
            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'password' => $hashedPassword,
            'created_at' => date('Y-m-d H:i:s')
        ]);

        session()->setFlashdata('success', 'Registration successful. Please login.');

        return redirect()->to('/login');
    }

    public function login()
    {
        return view('auth/login');
    }

    public function checkLogin()
    {
        $model = new UserModel();

        $rules = [
            'email' => 'required|valid_email',
            'password' => 'required'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Please enter email and password.');
        }

        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $user = $model->where('email', $email)->first();

        if ($user) {
            if (password_verify($password, $user['password'])) {

                session()->set([
                    'user_id' => $user['id'],
                    'name' => $user['name'],
                    'isLoggedIn' => true
                ]);

                session()->setFlashdata('success', 'Login successful!');
                return redirect()->to('/dashboard');
            }
        }

        session()->setFlashdata('error', 'Invalid email or password');

        return redirect()->back()
            ->with('error', 'Invalid email or password');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }

}