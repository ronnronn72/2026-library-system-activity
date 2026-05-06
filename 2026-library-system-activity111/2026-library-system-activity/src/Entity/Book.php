<?php

declare(strict_types=1);

namespace App\Library\Entity;

class Book {
    private $id;
    private $title;
    private $author;
    private $isbn;
    private $publishedDate;

    public function __construct($id, $title, $author, $isbn, $publishedDate) {
        $this->id = $id;
        $this->title = $title;
        $this->author = $author;
        $this->isbn = $isbn;
        $this->publishedDate = $publishedDate;
    }

    public function getId() {
        return $this->id;
    }

    public function getTitle() {
        return $this->title;
    }

    public function getAuthor() {
        return $this->author;
    }

    public function getIsbn() {
        return $this->isbn;
    }

    public function getPublishedDate() {
        return $this->publishedDate;
    }
}

?>