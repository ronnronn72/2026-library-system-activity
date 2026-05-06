<?php 
declare(strict_types=1);
?>
<!DOCTYPE html>
<html>
<head><title>Library Books</title></head>
<body>
    <table>
        <thead>
            <tr><th>ID</th><th>Title</th><th>Author</th></tr>
        </thead>
        <tbody>
            <?php foreach ($books as $book): ?>
            <tr>
                <td><?= htmlspecialchars((string) $book->getId()) ?></td>
                <td><?= htmlspecialchars($book->getTitle()) ?></td>
                <td><?= htmlspecialchars($book->getAuthor()) ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
