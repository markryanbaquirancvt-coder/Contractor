<?php 
session_start();
require_once 'core/dbConfig.php'; 
require_once 'core/models.php'; 
// Updated to use contractor_id and relevant model function
$contractor = getContractorByID($pdo, $_GET['contractor_id']);
?>
<!DOCTYPE html>
<html>
<head><title>Delete Contractor</title><link rel="stylesheet" href="style.css"></head>
<body>
    <div class="container">
        <h1 style="color: #d93025;">Delete Contractor: <?php echo $contractor['company_name']; ?>?</h1>
        <form action="core/handleForms.php?contractor_id=<?php echo $_GET['contractor_id']; ?>" method="POST">
            <input type="submit" name="deleteContractorBtn" value="Confirm Delete" style="background-color: #d93025; color: white; border: none; padding: 10px; cursor: pointer;">
        </form>
        <a href="index.php">Cancel</a>
    </div>
</body>
</html>