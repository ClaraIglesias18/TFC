<?php
$pageTitle = "Admin - Manage Employees";
require_once 'layouts/header.php';
?>
<h1>Admin - Manage Employees</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($employees as $employee): ?>
                <tr>
                    <td><?php echo $employee['id']; ?></td>
                    <td><?php echo $employee['name']; ?></td>
                    <td>
                        <a href="index.php?route=administrador/edit&employeeId=<?php echo $employee['id']; ?>">Edit</a>
                        <a href="index.php?route=administrador/delete&employeeId=<?php echo $employee['id']; ?>">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <a href="index.php?route=administrador/add">Add Employee</a>
<?php
require_once 'layouts/footer.php';
?>