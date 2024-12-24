<?php

class User extends Model
{
    protected ?string $username;
    protected ?string $password;
    protected static $tableName = "users";

    public function __construct($username, $password)
    {
        $this->username = $username;
        $this->password = $password;
    }

    public static function find($username, $password)
    {
        $sql = "SELECT * FROM users WHERE username = ? AND password = ?";
        $pdo = connect();
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$username, $password]);
        $user = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if (count($user) == 0)
            return false;
        return $user[0];
    }
    public function save()
    {
        $sqlReq = "INSERT INTO users(username, password) VALUES(?, ?)";
        $pdo = connect();
        try {
            $stmt = $pdo->prepare($sqlReq);
            $stmt->execute([$this->username, $this->password]);
        } catch (PDOException $err) {
            die("Error:  " . $err->getMessage());
        }
    }

    public static function books($user_id)
    {
        $sql = "SELECT * FROM books  INNER JOIN rentals ON books.id = rentals.book_id WHERE user_id = ? ";
        $pdo = connect();
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$user_id]);
        $books = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $books;
    }
}
