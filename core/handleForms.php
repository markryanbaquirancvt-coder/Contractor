<?php
session_start();
require_once 'dbConfig.php';
require_once 'models.php';

$currentUser = $_SESSION['username'] ?? "System";

/* --- AUTHENTICATION ACTIONS --- */

// Handle User Registration
if (isset($_POST['registerUserBtn'])) {
    $username = trim($_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    if (!empty($username) && !empty($_POST['password'])) {
        if (insertUser($pdo, $username, $password)) {
            header("Location: ../login.php?success=1");
        } else {
            header("Location: ../login.php?error=UsernameExists");
        }
    }
    exit();
}

// Handle User Login
if (isset($_POST['loginUserBtn'])) {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    $user = loginUser($pdo, $username, $password);
    if ($user) { 
        $_SESSION['username'] = $user['username']; 
        header("Location: ../index.php"); 
    } else { 
        header("Location: ../login.php?error=1"); 
    }
    exit();
}

// Handle Logout
if (isset($_GET['logout'])) { 
    session_destroy(); 
    header("Location: ../login.php"); 
    exit(); 
}

/* --- CONTRACTOR ACTIONS --- */

// Insert New Contractor
if (isset($_POST['insertContractorBtn'])) {
    $cName = trim($_POST['cName']);
    $oName = trim($_POST['oName']);
    $contact = trim($_POST['contact']);
    $spec = trim($_POST['spec']);
    $email = trim($_POST['email']);

    if (insertContractor($pdo, $cName, $oName, $contact, $spec, $email)) {
        insertLog($pdo, "CREATE", null, $currentUser, "Added Contractor: " . $cName);
        header("Location: ../index.php");
    }
    exit();
}

// Edit Existing Contractor
if (isset($_POST['editContractorBtn'])) {
    $contractor_id = $_GET['contractor_id'];
    $cName = trim($_POST['cName']);
    $oName = trim($_POST['oName']);
    $contact = trim($_POST['contact']);
    $spec = trim($_POST['spec']);
    $email = trim($_POST['email']);

    if (updateContractor($pdo, $cName, $oName, $contact, $spec, $email, $contractor_id)) {
        insertLog($pdo, "UPDATE", $contractor_id, $currentUser, "Updated Contractor: " . $cName);
        header("Location: ../index.php");
    }
    exit();
}

// Delete Contractor
if (isset($_POST['deleteContractorBtn'])) {
    $contractor_id = $_GET['contractor_id'];
    
    if (deleteContractor($pdo, $contractor_id)) {
        insertLog($pdo, "DELETE", $contractor_id, $currentUser, "Deleted a Contractor record.");
        header("Location: ../index.php");
    }
    exit();
}

/* --- PROJECT ACTIONS --- */

// Insert New Project
if (isset($_POST['insertProjectBtn'])) {
    $contractor_id = $_GET['contractor_id'];
    $pName = trim($_POST['pName']);
    $budget = $_POST['budget'];

    if (insertProject($pdo, $pName, $budget, $contractor_id)) {
        insertLog($pdo, "CREATE", $contractor_id, $currentUser, "Added Project: " . $pName);
        header("Location: ../viewprojects.php?contractor_id=" . $contractor_id);
    }
    exit();
}

// Edit Existing Project
if (isset($_POST['editProjectBtn'])) {
    $project_id = $_GET['project_id'];
    $contractor_id = $_GET['contractor_id'];
    $pName = trim($_POST['pName']);
    $budget = $_POST['budget'];

    if (updateProject($pdo, $pName, $budget, $project_id)) {
        insertLog($pdo, "UPDATE", $contractor_id, $currentUser, "Updated Project: " . $pName);
        header("Location: ../viewprojects.php?contractor_id=" . $contractor_id);
    }
    exit();
}

// Delete Project
if (isset($_POST['deleteProjectBtn'])) {
    $project_id = $_GET['project_id'];
    $contractor_id = $_GET['contractor_id'];

    if (deleteProject($pdo, $project_id)) {
        insertLog($pdo, "DELETE", $contractor_id, $currentUser, "Deleted a project record.");
        header("Location: ../viewprojects.php?contractor_id=" . $contractor_id);
    }
    exit();
}
?>