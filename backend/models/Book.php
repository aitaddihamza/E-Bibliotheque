<?php

class Book extends Model
{
    protected ?string $title;
    protected ?string $category;
    protected ?string $author;
    protected ?bool $available;
    protected ?string $image_name;
    protected static $tableName = "books";

    public function __construct($title, $author, $category, $image_name = NULL, $available = 1)
    {
        $this->title = $title;
        $this->author = $author;
        $this->category = $category;
        $this->available = $available;
        $this->image_name = $image_name;
    }

    public function save()
    {
        $sql = "INSERT INTO books(title, author, category, image_name) VALUES(?, ?, ?, ?)";
        $pdo = connect();
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$this->title, $this->author, $this->category, $this->image_name]);
    }

    public static function find($book_id)
    {
        $sql = "SELECT * FROM books WHERE id = ? ";
        $pdo = connect();
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$book_id]);
        $book = $stmt->fetch(PDO::FETCH_ASSOC);
        if (count($book) == 0)
            return false;
        return $book;
    }

    public static function update($book_id, array $newBook)
    {
        $sql = "UPDATE books SET title = ?,  author = ? , category = ?, image_name = ?  WHERE id = ?";
        $pdo = connect();
        $stmt = $pdo->prepare($sql);
        $stmt->execute([...$newBook, $book_id]);
    }
}
