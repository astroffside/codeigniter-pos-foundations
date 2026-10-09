<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    public function login(): string|\CodeIgniter\HTTP\RedirectResponse
    {
        if (session('isLoggedIn')) {
            return redirect()->to(site_url('customers'));
        }

        return view('auth/login', [
            'title'      => 'Staff Login',
            'activePage' => 'login',
        ]);
    }

    public function attempt()
    {
        $rules = [
            'username' => 'required|max_length[50]',
            'password' => 'required',
        ];

        if (! $this->validate($rules)) {
            return redirect()->to(site_url('login'))
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $username = trim((string) $this->request->getPost('username'));
        $password = (string) $this->request->getPost('password');
        $user = (new UserModel())->where('username', $username)->first();

        if ($user === null || ! password_verify($password, (string) $user['password'])) {
            return redirect()->to(site_url('login'))
                ->withInput()
                ->with('error', 'The username or password is incorrect.');
        }

        session()->regenerate();
        session()->set([
            'isLoggedIn' => true,
            'user_id'     => (int) $user['id'],
            'username'    => $user['username'],
            'full_name'   => $user['full_name'],
        ]);

        $intendedUrl = session('intended_url');
        session()->remove('intended_url');

        return redirect()->to(is_string($intendedUrl) ? $intendedUrl : site_url('customers'))
            ->with('message', 'Welcome back, ' . $user['full_name'] . '.');
    }

    public function logout()
    {
        session()->destroy();

        return redirect()->to(site_url('login'))
            ->with('message', 'You have been logged out.');
    }
}
