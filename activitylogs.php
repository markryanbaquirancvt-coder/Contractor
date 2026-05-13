<?php 
session_start();
if (!isset($_SESSION['username'])) { header("Location: login.php"); exit(); }
require_once 'core/dbConfig.php'; 
require_once 'core/models.php'; 
?>
<!DOCTYPE html>
<html>
<head><title>Activity Logs</title><link rel="stylesheet" href="style.css"></head>
<body>
    <div class="dashboard-container">
        <a href="index.php">Back Home</a>
        <h1>System Activity Logs</h1>
        <table>
            <tr><th>Operation</th><th>User</th><th>Description</th><th>Timestamp</th></tr>
            <?php $logs = getAllLogs($pdo); foreach ($logs as $l) { ?>
            <tr>
                <td><?php echo $l['operation']; ?></td>
                <td><?php echo $l['done_by']; ?></td>
                <td><?php echo $l['description']; ?></td>
                <td><?php echo $l['date_added']; ?></td>
            </tr>
            <?php } ?>
        </table>
    </div>
</body>
</html>