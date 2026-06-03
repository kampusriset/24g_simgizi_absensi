<?php

class User {

    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    // REGISTER
    public function register($nama, $username, $password, $role) {

        $password = password_hash($password, PASSWORD_DEFAULT);

        return $this->conn->query(
            "INSERT INTO users
            (nama, username, password, role)
            VALUES
            ('$nama', '$username', '$password', '$role')"
        );
    }

    // LOGIN
    public function login($username) {

        $result = $this->conn->query(
            "SELECT * FROM users
            WHERE username='$username'"
        );

        return $result->fetch_assoc();
    }
}
?>