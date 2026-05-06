<?php
class LibrarySystem 
{
    public $db_host  = "localhost";
    public $db_username= "root";
    public $password= "";
    public $db_name = "library_db";
    public $conn;
    public $dailyFineRate = 5;
    function connect()
    {
        $this->conn = new mysqli($this->db_host, $this->db_username, $this->password, $this->db_name);
        if ($this->conn->connect_error) {
            die("db error");
        }
    }
    function aaddBook(string $title, string $author, int $year, string $genre){
        $sql = "INSERT INTO books(title,author,year,genre) VALUES('" . $title . "','" . $author . "'," . $year . ",'" . $genre . "')";
        $this->conn->query($sql);
        return $this->conn->insert_id;
    }
    function findById(int $bookId){
        $sql = "SELECT * FROM books WHERE book_id=" . $bookId;
        $result = $this->conn->query($sql);
        return $result->fetch_assoc();
    }
    function borrowBook(int $student_id, int $book_id, int $days)
    {
        $due = date('Y-m-d', strtotime('+' . $days . ' days'));
        $sql = "INSERT INTO borrow_records(student_id,book_id,borrow_date,due_date,status) VALUES(" . $student_id . "," . $book_id . ",'" . date('Y-m-d') . "','" . $due . "','borrowed')";
        $this->conn->query($sql);
        return true;
    }
    function returnBook(int $record_id){
        $sql = "SELECT * FROM borrow_records WHERE record_id=" . $record_id;
        $record = $this->conn->query($sql)->fetch_assoc();
        $due = strtotime($record['due_date']);
        $today = strtotime(date('Y-m-d'));
        $diff = ($today - $due) / (60 * 60 * 24);
        $fine = 0;
        if ($diff > 0) {
            $fine = $diff * $this->dailyFineRate;
        }
        $sql2 = "UPDATE borrow_records SET return_date='" . date('Y-m-d') . "', fine_amount=" . $fine . ", status='returned' WHERE record_id=" . $rid;
        $this->conn->query($sql2);
        return $fine;
    }
    function listBooks()
    {
        $sql = "SELECT * FROM books";
        $result = $this->conn->query($sql);
        echo "<table border='1'><tr><th>ID</th><th>Title</th><th>Author</th><th>Year</th><th>Genre</th></tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row['book_id'] . "</td><td>" . $row['title'] . "</td><td>" . $row['author'] . "</td><td>" . $row['year'] . "</td><td>" . $row['genre'] . "</td></tr>";
        }
        echo "</table>";
    }
    function searchBooks($kw)
    {
        $sql = "SELECT * FROM books WHERE title LIKE '%" . $kw . "%' OR author LIKE '%" . $kw . "%'";
        $result = $this->conn->query($sql);
        $books = array();
        while ($row = $result->fetch_assoc()) {
            $books[] = $row;
        }
        return $books;
    }
    function getOverdueBooks()
    {
        $sql = "SELECT br.*, b.title, s.name FROM borrow_records br JOIN books b ON br.book_id=b.book_id JOIN students s ON br.student_id=s.student_id WHERE br.due_date<'" . date('Y-m-d') . "' AND br.status='borrowed'";
        $result = $this->conn->query($sql);
        $list = array();
        while ($row = $result->fetch_assoc()) {
            $list[] = $row;
        }
        return $list;
    }
    function generateReport()
    {
        $totalBooks = $this->conn->query("SELECT COUNT(*) as c FROM books")->fetch_assoc()['c'];
        $totalBorrowed = $this->conn->query("SELECT COUNT(*) as c FROM borrow_records WHERE status='borrowed'")->fetch_assoc()['c'];
        $totalReturned = $this->conn->query("SELECT COUNT(*) as c FROM borrow_records WHERE status='returned'")->fetch_assoc()['c'];
        $totalFines = $this->conn->query("SELECT SUM(fine_amount) as s FROM borrow_records WHERE fine_amount>0")->fetch_assoc()['s'];
        echo "<h2>Library Report</h2>";
        echo "<p>Total Books: " . $totalBooks . "</p>";
        echo "<p>Borrowed: " . $totalBorrowed . "</p>";
        echo "<p>Returned: " . $totalReturned . "</p>";
        echo "<p>Total Fines Collected: $" . $totalFines . "</p>";
    }
}
$lib = new LibrarySystem ();
$lib->connect();
if (isset($_GET['act'])) {
    if ($_GET['act'] == 'add') {
        $lib->addBook($_POST['t'], $_POST['a'], $_POST['y'], $_POST['g']);
    } elseif ($_GET['act'] == 'list') {
        $lib->listBooks();
    } elseif ($_GET['act'] == 'report') {
        $lib->generateReport();
    }
}
