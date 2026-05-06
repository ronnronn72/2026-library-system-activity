<?php 
declare(strict_types=1);

class LibraryService {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function addStudent(Student $student) {
        // Validate student data
        if (empty($student->getName()) || empty($student->getEmail())) {
            throw new ValidationException("Name and email are required");
        }

        // Insert student into database
        try {
            $stmt = $this->db->prepare("INSERT INTO students (name, email, phone) VALUES (?, ?, ?)");
            $stmt->execute([$student->getName(), $student->getEmail(), $student->getPhone()]);
        } catch (PDOException $e) {
            throw new DatabaseException("Failed to add student: " . $e->getMessage());
        }
    }

    public function borrowBook($bookId, $userId) {
        // Validate input
        if (empty($bookId) || empty($userId)) {
            throw new ValidationException("Book ID and User ID are required");
        }

        // Insert borrow record into database
        try {
            $stmt = $this->db->prepare("INSERT INTO borrow_records (book_id, user_id, borrow_date) VALUES (?, ?, NOW())");
            $stmt->execute([$bookId, $userId]);
        } catch (PDOException $e) {
            throw new DatabaseException("Failed to borrow book: " . $e->getMessage());
        }
    }
}
?>