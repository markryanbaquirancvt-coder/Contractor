<?php 
session_start();
if (!isset($_SESSION['username'])) { header("Location: login.php"); exit(); }
require_once 'core/dbConfig.php'; 
require_once 'core/models.php'; 
?>
<!DOCTYPE html>
<html>
<head><title>Project House</title><link rel="stylesheet" href="style.css"></head>
<body>
    <div class="dashboard-container">
        <a href="index.php">← Back to Contractors</a>
        <?php 
        // Fetch contractor details based on the ID in the URL
        $contractor = getContractorByID($pdo, $_GET['contractor_id']); 
        ?>
        <h1>Projects for: <?php echo $contractor['company_name']; ?></h1>

        <div class="search-box">
            <h3>Assign New Project</h3>
            <form action="core/handleForms.php?contractor_id=<?php echo $_GET['contractor_id']; ?>" method="POST">
                <input type="text" name="pName" placeholder="Project Name/Location" required>
                <input type="number" step="0.01" name="budget" placeholder="Project Budget" required>
                <input type="submit" name="insertProjectBtn" value="Add Project">
            </form>
        </div>

        <table>
            <tr><th>Project Name</th><th>Budget</th><th>Actions</th></tr>
            <?php 
            // Fetch all projects associated with this contractor
            $projects = getProjectsByContractor($pdo, $_GET['contractor_id']); 
            foreach ($projects as $p) { ?>
            <tr>
                <td><?php echo $p['project_name']; ?></td>
                <td>$<?php echo number_format($p['budget'], 2); ?></td>
                <td>
                    <a href="editproject.php?project_id=<?php echo $p['project_id']; ?>&contractor_id=<?php echo $_GET['contractor_id']; ?>">Edit</a> | 
                    <a href="deleteproject.php?project_id=<?php echo $p['project_id']; ?>&contractor_id=<?php echo $_GET['contractor_id']; ?>">Delete</a>
                </td>
            </tr>
            <?php } ?>
        </table>
    </div>
</body>
</html>