<?php

require_once __DIR__ . "/../config/Database.php";

class OTPModel {

    private $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->connect();
    }

    public function createOTP($user_id, $code, $expires_at) {
        $stmt = $this->db->prepare("
            INSERT INTO otps (user_id, code, expires_at)
            VALUES (:user_id, :code, :expires_at)
        ");

        return $stmt->execute([
            ':user_id' => $user_id,
            ':code' => $code,
            ':expires_at' => $expires_at
        ]);
    }

    public function verifyOTP($user_id, $code) {
        $stmt = $this->db->prepare("
            SELECT * FROM otps 
            WHERE user_id = :user_id 
            AND code = :code 
            AND expires_at > NOW()
            ORDER BY id DESC 
            LIMIT 1
        ");

        $stmt->execute([
            ':user_id' => $user_id,
            ':code' => $code
        ]);

        return $stmt->fetch();
    }
}