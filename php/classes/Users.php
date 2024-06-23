<?php

class User
{
    private $name;
    private $lastname;
    private $email;
    private $id;

    function __construct($id, $name, $lastname, $email)
    {
        $this->id = $id;
        $this->name = $name;
        $this->lastname = $lastname;
        $this->email = $email;
    }

    function getId()
    {
        return $this->id;
    }
    function getName()
    {
        return $this->name;
    }
    function getLastname()
    {
        return $this->lastname;
    }
    function getEmail()
    {
        return $this->email;
    }

    //статический метод добавления пльзователя в базу данных
    static function addUser($name, $lastname, $email, $pass)
    {
        global $mysqli;
        $email = mb_strtolower(trim($email));
        $pass = trim($pass);
        $pass = password_hash($pass, PASSWORD_DEFAULT);

        $result = $mysqli->query("SELECT * FROM `users` WHERE `email`='$email'");

        if ($result->num_rows != 0) {
            return json_encode(["result" => "exist"]);
        } else {
            $mysqli->query("INSERT INTO `users`(`name`, `lastname`, `email`, `pass`) VALUES ('$name', '$lastname', '$email', '$pass')");
            return json_encode(["result" => "success"]);
        }
    }

    // статич метод авториз пользователя

    static function authUser($email, $pass)
    {
        global $mysqli;

        // $email = mb_strtolower(trim($email));
        // $pass = trim($pass);

        // $sql = "SELECT * FROM `users` WHERE `email`= ?";
        // $stmt = $mysqli-> prepare($sql);
        // $stmt->bind_param("s", $email);
        // $stmt->execute();
        // $result = $stmt->get_result();

        $result = $mysqli->query("SELECT * FROM `users` WHERE `email`='$email'");
        $result = $result->fetch_assoc();

        if (password_verify($pass, $result["pass"])) {
            $_SESSION["id"] = $result["id"];
            return json_encode(["result" => "success"]);
        } else {
            return json_encode(["result" => "notok"]);
        }
    }

    //Статический метод получения данных пользователя

    static function getUser($userId)
    {
        global $mysqli;
        $result = $mysqli->query("SELECT `id`, `name`, `lastname`, `email` FROM `users` WHERE `id`='$userId'");
        $result = $result->fetch_assoc();
        return json_encode($result);
    }


    //Статический метод получения данных пользователЕЙ

    static function getUsers()
    {
        global $mysqli;
        $result = $mysqli->query("SELECT `id`, `name`, `lastname`, `email` FROM `users` WHERE 1");
        while ($row = $result->fetch_assoc()) {
            $users[] = $row;
        }
        return json_encode($users);
    }
}
