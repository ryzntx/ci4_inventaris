<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;

class Auth extends BaseController
{
    // Show the login page
    public function getLogin()
    {
        // Check if the user is already logged in
        if (session()->get("logged_in")) {
            return redirect()->to("beranda");
        }
        // If not, show the login page
        return view("pages/auth/login");
    }

    // Process the login form
    public function postLoginAction()
    {
        $userModels = new UserModel();
        // Get the username and password from the form
        $username = $this->request->getVar("username");
        $password = $this->request->getVar("password");

        // Check if the username and password are correct
        $rules = [
            "username" => "required",
            "password" => "required",
        ];
        if (!$this->validate($rules)) {
            session()->setFlashdata('errors', $this->validator->getErrors());
            return redirect()->back()->withInput()->with("errors", $this->validator->getErrors());
        }

        // Check if the username exists in the database
        $checkUser = $userModels->where("username", $username)->first();
        if (!$checkUser) {
            return redirect()->back()->withInput()->with("errors", "Username tidak ditemukan!");
        } else {
            // Check if the password is correct
            if (!password_verify($password, $checkUser->password)) {
                return redirect()->back()->withInput()->with("errors", "Password salah!");
            } else {
                // Set the session data for the user
                $this->session->set([
                    "id_user" => $checkUser->id_user,
                    "level" => $checkUser->id_level,
                    'logged_in' => TRUE,
                ]);
                // Redirect to the dashboard
                return redirect()->to("beranda");
            }
        }
    }

    public function getForgotPassword()
    {
        // Check if the user is already logged in
        if (session()->get("logged_in")) {
            return redirect()->to("beranda");
        }
        // If not, show the forgot password page
        return view("pages/auth/forgot-password");
    }

    // Undone
    public function postForgotPasswordAction()
    {
        $userModels = new UserModel();
        // Get the username and phone number from the form
        $username = $this->request->getVar("username");
        $no_hp = $this->request->getVar("no_hp");

        // Check if the username and phone number are correct
        $rules = [
            "username" => "required",
            "no_hp" => "required",
        ];
        if (!$this->validate($rules)) {
            session()->setFlashdata('errors', $this->validator->getErrors());
            return redirect()->back()->withInput()->with("errors", $this->validator->getErrors());
        }

        // Check if the username exists in the database
        $checkUser = $userModels->where("username", $username)->first();
        if (!$checkUser) {
            return redirect()->back()->withInput()->with("errors", "Username tidak ditemukan!");
        } else {
            // Check if the phone number is correct
            if ($no_hp != $checkUser->no_hp) {
                return redirect()->back()->withInput()->with("errors", "No. Handphone salah!");
            } else {
                // Send the password to the phone number
                // You can use a third-party service to send the SMS
                // For example, you can use the Twilio API
                // https://www.twilio.com/docs/quickstart/php/sms
                // Redirect to the login page
                session()->setFlashdata('message', 'Kata sandi telah dikirim ke no. handphone Anda.');
                return redirect()->to("auth/login")->with('message', 'Kata sandi telah dikirim ke no. handphone Anda.');
            }
        }
    }

    // Show the register page
    public function getRegister()
    {
        // Check if the user is already logged in
        if (session()->get("logged_in")) {
            return redirect()->to("beranda");
        }
        // If not, show the register page
        return view("pages/auth/register");
    }

    // Process the register form
    public function postRegisterAction()
    {
        $userModels = new UserModel();
        // Get the data from the form
        $nik = $this->request->getVar("nik");
        $nama = $this->request->getVar("nama");
        $telp = $this->request->getVar("telp");
        $username = $this->request->getVar("username");
        $password = $this->request->getVar("password");

        // Check form validation
        $rules = [
            "nik" => "required",
            "nama" => "required",
            "telp" => "required",
            "username" => "required",
            "password" => "required",
        ];
        if (!$this->validate($rules)) {
            session()->setFlashdata('errors', $this->validator->getErrors());
            return redirect()->back()->withInput()->with("errors", $this->validator->getErrors());
        }
        // Insert the data to the database
        $user = $userModels->insert([
            "nik" => $nik,
            "nama" => $nama,
            "telp" => $telp,
            "username" => $username,
            "password" => password_hash($password, PASSWORD_BCRYPT),
            "level" => "user",
        ]);
        // Check if the data is inserted
        if ($user) {
            // Redirect to the login page
            session()->setFlashdata('message', 'Pendaftaran berhasil! Silahkan login.');
            return redirect()->to("auth/login");
        } else {
            // If not, show an error message
            session()->setFlashdata('errors', 'Pendaftaran gagal! Silahkan coba lagi.');
            return redirect()->back()->withInput()->with("errors", "Pendaftaran gagal! Silahkan coba lagi.");
        }
    }

    // Process the logout
    public function getLogout()
    {
        // Destroy the session
        $this->session->destroy();
        // Redirect to the login page
        session()->setFlashdata('message', 'Anda telah keluar dari aplikasi.');
        return redirect()->to("auth/login")->with('message', 'Anda telah keluar dari aplikasi.');
    }
}
