<?php
// Users and their credentials
$userCredentials = [
    'Admin' => [
        'admin' => 'root'      
    ],
    'Content Manager' => [
        'tanggol' => 'tanggol123',
        'cardodalisay' => 'pulismatulis123'
    ],
    'System User' => [
        '_carxinaay' => 'crnadlrsr'
    ]
];

// Check if the form is submitted
if (isset($_REQUEST['btnSignIn'])) {
    $userType = $_REQUEST['inputUserType'];
    $userUsername = $_REQUEST['inputUserName'];
    $userPassword = $_REQUEST['inputPassword'];

    $isValidUser = array_key_exists($userUsername, $userCredentials[$userType]) && 
                   ($userCredentials[$userType][$userUsername] === $userPassword);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="css/custom-login.css">
    <title>Login Page</title>
</head>
<body>
    <div class="container mt-5">
        <?php if (isset($isValidUser)): ?>
            <div class="alert alert-<?= $isValidUser ? 'success' : 'danger' ?> alert-dismissible fade show" style="max-width: 350px; margin: auto;">
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                <?= $isValidUser ? "Welcome to the system: " . htmlspecialchars($userUsername) : "Incorrect Username / Password." ?>
            </div>
        <?php endif; ?>

        <div class="card mx-auto" style="max-width: 400px;">
            <div class="card-body text-center">
                <img id="profile-img" class="profile-img-card mb-3" src="//ssl.gstatic.com/accounts/ui/avatar_2x.png" alt="Profile Image" />
                <h4 class="card-title">Login</h4>
                <form method="post" class="form-signin">
                    <div class="mb-3">
                        <select class="form-select" name="inputUserType" id="inputUserType" required>
                            <option value="" disabled selected>Select User Type</option>
                            <option value="Admin">Admin</option>
                            <option value="Content Manager">Content Manager</option>  
                            <option value="System User">System User</option>   
                        </select>
                    </div>
                    <div class="mb-3">
                        <input type="text" name="inputUserName" id="inputUserName" class="form-control" placeholder="User Name" required autofocus>
                    </div>
                    <div class="mb-3">
                        <input type="password" name="inputPassword" id="inputPassword" class="form-control" placeholder="Password" required>
                    </div>
                    <button class="btn btn-lg btn-primary btn-block" type="submit" name='btnSignIn'>Sign in</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
