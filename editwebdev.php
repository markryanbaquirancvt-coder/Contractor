<?php 
session_start();
require_once 'core/dbConfig.php'; 
require_once 'core/models.php';
// Fetches contractor details using the updated model function
$contractor = getContractorByID($pdo, $_GET['contractor_id']);
?>
<!DOCTYPE html>
<html>
<head><link rel="stylesheet" href="style.css"></head>
<body>
    <div class="container">
        <h1>Edit Contractor</h1>
        <form action="core/handleForms.php?contractor_id=<?php echo $_GET['contractor_id']; ?>" method="POST">
            <input type="text" name="cName" value="<?php echo $contractor['company_name']; ?>" required>
            <input type="text" name="oName" value="<?php echo $contractor['contractor_name']; ?>" required>
            <input type="text" name="contact" value="<?php echo $contractor['contact_number']; ?>" required>
            <input type="text" name="spec" value="<?php echo $contractor['specialization']; ?>" required>
            <input type="email" name="email" value="<?php echo $contractor['email']; ?>" required>
            <input type="submit" name="editContractorBtn" value="Update Contractor">
        </form>
        <a href="index.php">Cancel</a>
    </div>
</body>
</html>