<?php 
declare(strict_types=1);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Borrow Book Form</h1>
    <form method="POST" action="">
        <div>
            <label for="student_id">Student ID:</label>
            <input type="number" id="student_id" name="student_id" required>
        </div>
        
        <div>
            <label for="book_id">Book ID:</label>
            <input type="number" id="book_id" name="book_id" required>
        </div>
        
        <div>
            <label for="days">Borrow Duration (days):</label>
            <input type="number" id="days" name="days" min="1" required>
        </div>
        
        <button type="submit">Borrow Book</button>
    </form>
</body>
</html>