<?php 
session_start();
if (!isset($_SESSION['username'])) { header("Location: login.php"); exit(); }
require_once 'core/dbConfig.php'; 
require_once 'core/models.php'; 
?>
<!DOCTYPE html>
<html>
<head><title>Contractor Management</title><link rel="stylesheet" href="style.css"></head>
<body>
    <div class="dashboard-container">
        <p>Active User: <b><?php echo $_SESSION['username']; ?></b> | <a href="activitylogs.php">Logs</a> | <a href="core/handleForms.php?logout=1">Logout</a></p>
        <h1>Construction Contractor Registry</h1>
        
        <form action="core/handleForms.php" method="POST">
            <input type="text" name="cName" placeholder="Company Name" required>
            <input type="text" name="oName" placeholder="Lead Contractor" required>
            <input type="text" name="contact" placeholder="Contact #" required>
            <input type="text" name="spec" placeholder="Specialization (e.g. Electrical, Plumbing)" required>
            <input type="email" name="email" placeholder="Business Email" required>
            <input type="submit" name="insertContractorBtn" value="Register Contractor">
        </form>

        <div class="search-box">
            <form action="index.php" method="GET">
                <input type="text" name="searchQuery" placeholder="Search contractors..." value="<?php echo $_GET['searchQuery'] ?? ''; ?>">
                <input type="submit" value="Search" style="width: auto;">
                <a href="index.php" style="margin-left:10px;">Clear</a>
            </form>
        </div>

        <table>
            <tr><th>Company</th><th>Lead</th><th>Specialization</th><th>Actions</th></tr>
            <?php 
            $contractors = (isset($_GET['searchQuery']) && !empty($_GET['searchQuery'])) ? searchContractors($pdo, $_GET['searchQuery']) : getAllContractors($pdo);
            foreach ($contractors as $row) { ?>
            <tr>
                <td><?php echo $row['company_name']; ?></td>
                <td><?php echo $row['contractor_name']; ?></td>
                <td><?php echo $row['specialization']; ?></td>
                <td>
                    <a href="viewprojects.php?contractor_id=<?php echo $row['contractor_id']; ?>">View Projects</a> | 
                    <a href="editwebdev.php?contractor_id=<?php echo $row['contractor_id']; ?>">Edit</a> | 
                    <a href="deletewebdev.php?contractor_id=<?php echo $row['contractor_id']; ?>">Delete</a>
                </td>
            </tr>
            <?php } ?>
        </table>
    </div>
</body>
</html>