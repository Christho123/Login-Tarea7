<?php

require_once __DIR__ . "/../core/Controller.php";
require_once __DIR__ . "/../models/User.php";
require_once __DIR__ . "/../models/OTPModel.php";
require_once __DIR__ . "/../services/MailService.php";

class AuthController extends Controller
{
    public function login()
    {
        $this->view("auth/login");
    }

    public function register()
    {
        $this->view("auth/register");
    }

    // 🔐 LOGIN → GENERA OTP
    public function loginPost()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            session_start();

            $email = $_POST['email'];
            $password = $_POST['password'];

            $userModel = new User();
            $user = $userModel->findByEmail($email);

            if ($user && password_verify($password, $user['password'])) {

                $code = rand(100000, 999999);
                $expires = date("Y-m-d H:i:s", strtotime("+5 minutes"));

                $otpModel = new OTPModel();
                $otpModel->createOTP($user['id'], $code, $expires);

                MailService::sendOTP($email, $code);

                $_SESSION['otp_user'] = $user['id'];

                header("Location: /Login-Seminario/public/index.php?url=auth/verifyOTP");
                exit;

            } else {
                echo "Credenciales incorrectas";
            }
        }
    }

    // Vista OTP
    public function verifyOTP()
    {
        $this->view("auth/verify_otp");
    }

    // VALIDAR OTP
    public function verifyOTPPost()
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        session_start();

        $code = $_POST['code'];
        $user_id = $_SESSION['otp_user'] ?? null;

        if (!$user_id) {
            echo "Sesión inválida";
            exit;
        }

        $otpModel = new OTPModel();
        $valid = $otpModel->verifyOTP($user_id, $code);

        if ($valid) {

            // 🔥 TRAER DATOS DEL USUARIO
            $userModel = new User();
            $user = $userModel->findById($user_id); // asegúrate que exista este método

            // ✅ CREAR SESIÓN COMPLETA
            $_SESSION['user_id'] = $user_id;
            $_SESSION['user_name'] = $user['name'] . ' ' . $user['lastname'];
            $_SESSION['user_role'] = $user['role'];
            $_SESSION['user_initials'] = strtoupper(substr($user['name'], 0, 1) . substr($user['lastname'], 0, 1));

            unset($_SESSION['otp_user']);

            // 🚀 REDIRIGIR
            header("Location: /Login-Seminario/public/dashboard.php");
            exit;

        } else {
            echo "Código inválido o expirado ❌";
        }
    }
}

    public function registerPost()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $name = $_POST['name'];
            $lastname = $_POST['lastname'];
            $email = $_POST['email'];
            $company = $_POST['company'];
            $role = $_POST['role'];
            $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

            $userModel = new User();
            $userModel->create($name, $lastname, $email, $company, $role, $password);

            echo "Usuario registrado";
        }
    }
}