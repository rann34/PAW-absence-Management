<?php
require_once "db_connect.php";

$conn = getConnection();
$stmt = $conn->query("SELECT * FROM students");
$students = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<h2>Students List</h2>
<table border="1" cellpadding="6">
<tr><th>ID</th><th>Fullname</th><th>Matricule</th><th>Group</th><th>Actions</th></tr>

<?php foreach ($students as $s): ?>
<tr>
    <td><?= $s["id"] ?></td>
    <td><?= $s["fullname"] ?></td>
    <td><?= $s["matricule"] ?></td>
    <td><?= $s["group_id"] ?></td>
    <td>
        <a href="update_student.php?id=<?= $s['id'] ?>">Update</a> |
        <a href="delete_student.php?id=<?= $s['id'] ?>">Delete</a>
    </td>
</tr>
<?php endforeach; ?>
</table>

