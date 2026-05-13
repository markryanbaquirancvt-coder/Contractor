<?php 
require_once 'dbConfig.php';

/* USER MANAGEMENT */
function insertUser($pdo, $username, $password) {
    $check = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $check->execute([$username]);
    if ($check->rowCount() == 0) {
        return $pdo->prepare("INSERT INTO users (username, password) VALUES (?,?)")->execute([$username, $password]);
    }
    return false;
}

function loginUser($pdo, $username, $password) {
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    if ($stmt->rowCount() == 1) {
        $user = $stmt->fetch();
        if (password_verify($password, $user['password'])) return $user;
    }
    return false;
}

/* ACTIVITY LOGS */
function insertLog($pdo, $operation, $contractor_id, $username, $description) {
    $sql = "INSERT INTO activity_logs (operation, contractor_id, done_by, description) VALUES(?,?,?,?)";
    return $pdo->prepare($sql)->execute([$operation, $contractor_id, $username, $description]);
}

function getAllLogs($pdo) {
    return $pdo->query("SELECT * FROM activity_logs ORDER BY date_added DESC")->fetchAll();
}

/* CONTRACTOR FUNCTIONS */
function getAllContractors($pdo) {
    return $pdo->query("SELECT * FROM contractors ORDER BY date_added DESC")->fetchAll();
}

function getContractorByID($pdo, $contractor_id) {
    $stmt = $pdo->prepare("SELECT * FROM contractors WHERE contractor_id = ?");
    $stmt->execute([$contractor_id]);
    return $stmt->fetch();
}

function searchContractors($pdo, $search) {
    $stmt = $pdo->prepare("SELECT * FROM contractors WHERE company_name LIKE ? OR contractor_name LIKE ? OR specialization LIKE ?");
    $q = "%".$search."%"; 
    $stmt->execute([$q, $q, $q]);
    return $stmt->fetchAll();
}

function insertContractor($pdo, $cName, $oName, $contact, $spec, $email) {
    $sql = "INSERT INTO contractors (company_name, contractor_name, contact_number, specialization, email) VALUES (?,?,?,?,?)";
    return $pdo->prepare($sql)->execute([$cName, $oName, $contact, $spec, $email]);
}

function updateContractor($pdo, $cName, $oName, $contact, $spec, $email, $id) {
    $sql = "UPDATE contractors SET company_name=?, contractor_name=?, contact_number=?, specialization=?, email=? WHERE contractor_id=?";
    return $pdo->prepare($sql)->execute([$cName, $oName, $contact, $spec, $email, $id]);
}

function deleteContractor($pdo, $id) {
    return $pdo->prepare("DELETE FROM contractors WHERE contractor_id = ?")->execute([$id]);
}

/* PROJECT FUNCTIONS */
function getProjectsByContractor($pdo, $contractor_id) {
    $stmt = $pdo->prepare("SELECT * FROM projects WHERE contractor_id = ?");
    $stmt->execute([$contractor_id]);
    return $stmt->fetchAll();
}

function getProjectByID($pdo, $id) {
    $stmt = $pdo->prepare("SELECT * FROM projects WHERE project_id = ?");
    $stmt->execute([$id]);
    return $stmt->fetch();
}

function insertProject($pdo, $name, $budget, $contractor_id) {
    return $pdo->prepare("INSERT INTO projects (project_name, budget, contractor_id) VALUES (?,?,?)")->execute([$name, $budget, $contractor_id]);
}

function updateProject($pdo, $name, $budget, $id) {
    return $pdo->prepare("UPDATE projects SET project_name=?, budget=? WHERE project_id=?")->execute([$name, $budget, $id]);
}

function deleteProject($pdo, $id) {
    return $pdo->prepare("DELETE FROM projects WHERE project_id = ?")->execute([$id]);
}
?>