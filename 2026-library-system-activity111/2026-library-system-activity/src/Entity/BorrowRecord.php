<?php 
declare(strict_types=1);

namespace App\Library\Entity;

class BarrowRecord {
    private $id;
    private $bookId;
    private $userId;
    private $borrowDate;
    private $returnDate;

    public function __construct($id, $bookId, $userId, $borrowDate, $returnDate) {
        $this->id = $id;
        $this->bookId = $bookId;
        $this->userId = $userId;
        $this->borrowDate = $borrowDate;
        $this->returnDate = $returnDate;
    }

    public function getId() {
        return $this->id;
    }

    public function getBookId() {
        return $this->bookId;
    }

    public function getUserId() {
        return $this->userId;
    }

    public function getBorrowDate() {
        return $this->borrowDate;
    }

    public function getReturnDate() {
        return $this->returnDate;
    }
}
?>