<?php 
declare(strict_types=1);
namespace App\Library\Repository;

class BorrowRepository {
    private $pdo;

    public function __construct($pdo = null) {
        $this->pdo = $pdo;
    }

    public function createBorrowRecord($studentId, $bookId) {
        $query = "INSERT INTO borrow_records (student_id, book_id, borrow_date) VALUES (?, ?, NOW())";
        $stmt = $this->pdo->prepare($query);
        return $stmt->execute([$studentId, $bookId]);
    }

    public function getBorrowRecordsByStudent($studentId) {
        $query = "SELECT * FROM borrow_records WHERE student_id = ?";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([$studentId]);
        return $stmt->fetchAll();
    }

    public function getBorrowRecordsByBook($bookId) {
        $query = "SELECT * FROM borrow_records WHERE book_id = ?";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([$bookId]);
        return $stmt->fetchAll();
    }

    public function deleteBorrowRecord($recordId) {
        $query = "DELETE FROM borrow_records WHERE id = ?";
        $stmt = $this->pdo->prepare($query);
        return $stmt->execute([$recordId]);
    }
}
?>