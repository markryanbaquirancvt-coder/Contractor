<?php 
session_start();
require_once 'core/dbConfig.php'; 
require_once 'core/models.php';
// Retrieve project data to pre-fill the form
$p = getProjectByID($pdo, $_GET['project_id']);
?>
<!DOCTYPE html>
<html>
<head><title>Edit Project</title><link rel="stylesheet" href="style.css"></head>
<body>
    <div class="container">
        <h1>Edit Project Details</h1>
        <form action="core/handleForms.php?project_id=<?php echo $_GET['project_id']; ?>&contractor_id=<?php echo $_GET['contractor_id']; ?>" method="POST">
            <input type="text" name="pName" value="<?php echo $p['project_name']; ?>" required>
            <input type="number" step="0.01" name="budget" value="<?php echo $p['budget']; ?>" required>
            <input type="submit" name="editProjectBtn" value="Update Project">
        </form>
        <a href="viewprojects.php?contractor_id=<?php echo $_GET['contractor_id']; ?>">Cancel</a>
    </div>
</body>
</html>