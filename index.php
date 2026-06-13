<?php
require_once 'config.php';

// Fetch all users
$sql = "SELECT * FROM users ORDER BY created_at DESC";
$stmt = $pdo->query($sql);
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Management</title>
    <style>
        body { font-family: Arial; margin: 50px; }
        table { border-collapse: collapse; width: 100%; }
        th, td { border: 1px solid #ddd; padding: 10px; text-align: left; }
        th { background-color: #4CAF50; color: white; }
        tr:nth-child(even) { background-color: #f2f2f2; }
        .btn { padding: 5px 10px; text-decoration: none; display: inline-block; margin: 2px; }
        .btn-edit { background: blue; color: white; }
        .btn-delete { background: red; color: white; }
        .btn-add { background: green; color: white; padding: 10px 20px; margin-bottom: 20px; display: inline-block; }
    </style>
</head>
<body>
    <h2>User List</h2>
    <a href="create.php" class="btn btn-add">Add New User</a>
    
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Created At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($users as $key =>  $user): ?>
            <tr>
                <td><?php echo ++$key; ?></td>
                <td><?php echo htmlspecialchars($user['name']); ?></td>
                <td><?php echo htmlspecialchars($user['email']); ?></td>
                <td><?php echo htmlspecialchars($user['phone']); ?></td>
                <td><?php echo $user['created_at']; ?></td>
                <td>
                    <a href="edit.php?id=<?php echo $user['id']; ?>" class="btn btn-edit">Edit</a>
                    <a href="delete.php?id=<?php echo $user['id']; ?>" class="btn btn-delete" onclick="return confirm('Are you sure?')">Delete</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>