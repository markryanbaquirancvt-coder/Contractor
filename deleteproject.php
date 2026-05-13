<?php 
session_start();
require_once 'core/dbConfig.php'; 
require_once 'core/models.php';

/**
 * We fetch the project details using the refactored getProjectByID function.
 * We use 'project_id' from the GET parameters to find the specific record.
 */
$p = getProjectByID($pdo, $_GET['project_id']);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Delete Project</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1 style="color: #d93025;">Delete Project: <?php echo $p['project_name']; ?>?</h1>
        <p>Are you sure you want to permanently delete this project record?</p>

        <form action="core/handleForms.php?project_id=<?php echo $_GET['project_id']; ?>&contractor_id=<?php echo $_GET['contractor_id']; ?>" method="POST">
            <input type="submit" name="deleteProjectBtn" value="Confirm Delete" style="background-color: #d93025; color: white; border: none; padding: 12px; cursor: pointer; width: 100%; font-weight: bold; border-radius: 4px;">
        </form>
        <br>
        <a href="viewprojects.php?contractor_id=<?php echo $_GET['contractor_id']; ?>">Cancel and Go Back</a>
    </div>
</body>
</html>