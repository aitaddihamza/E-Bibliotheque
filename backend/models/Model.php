<?php

abstract class Model
{
    protected static $tableName;

    public static function All()
    {
        $query = "SELECT * FROM " . static::$tableName;
        $param = null;
        if (static::$tableName == "users") {
            $query = $query . " WHERE role != ?";
            $param = ["admin"];
        }
        $pdo = connect();
        $stmt = $pdo->prepare($query);
        $stmt->execute($param);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public static function paginate(int $limit)
    {
        $sql = "SELECT * FROM books ORDER BY id DESC LIMIT $limit";
        $pdo = connect();
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public static function delete($id)
    {
        $sql = "DELETE FROM " . static::$tableName . " WHERE id = $id";
        $pdo = connect();
        $result = $pdo->exec($sql);
        if ($result)
            return true;
        else
            return false;
    }
    public static function query($column, $value)
    {
        $sql = "SELECT * FROM " . static::$tableName . " WHERE $column = ?";
        $pdo = connect();
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$value]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if (count($result) == 0)
            return false;
        return $result;
    }
}
