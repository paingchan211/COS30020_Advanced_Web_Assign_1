<?php
session_name('paing_chan'); // name the session to prevent conflicts with other applications
session_start();

// redirect to main_menu.php if user is already logged in
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true && isset($_SESSION['email'])) {
    header("Location: main_menu.php");
    exit();
}

$message = '';

$success = false;

// Helper function to validate email format
function validate_email($email)
{
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

// Helper function to retrieve the user from the User/user.txt file by email
function get_user_by_email($email, $file_path)
{
    if (file_exists($file_path)) {
        $file_contents = file($file_path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($file_contents as $line) {
            // Explode the user data by '|' delimiter
            $user_data = explode('|', $line);

            // Make sure that the expected fields exist
            if (count($user_data) >= 7) {
                $existing_email = trim(explode(':', $user_data[5])[1]); // Email is the 6th item

                if ($existing_email == $email) {
                    // Return user data if email matches
                    $_SESSION['email'] = $existing_email;
                    return [
                        'first_name' => trim(explode(':', $user_data[1])[1]), // First Name is the 2nd item
                        'last_name' => trim(explode(':', $user_data[2])[1]),  // Last Name is the 3rd item
                        'dob' => trim(explode(':', $user_data[3])[1]),        // DOB is the 4th item
                        'gender' => trim(explode(':', $user_data[4])[1]),     // Gender is the 5th item
                        'email' => $existing_email,                          // Email is the 6th item
                        'hometown' => trim(explode(':', $user_data[6])[1]),   // Hometown is the 7th item
                        'password' => trim(explode(':', $user_data[7])[1]),   // Password is the 8th item
                    ];
                }
            }
        }
    }
    return null; // Return null if no user found
}

// Process the login form
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Validate email format
    if (!validate_email($email)) {
        $message = 'Invalid email format!';
    } else {
        // Path to the User/user.txt file
        $file_path = "data/User/user.txt";

        // Retrieve user data by email
        $user = get_user_by_email($email, $file_path);

        if ($user && $user['password'] === $password) {
            session_regenerate_id(true); // Regenerate the session ID to prevent fixation
            // Set session variables on successful login
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $user['first_name'] . ' ' . $user['last_name'];
            $success = true;
        } else {
            $message = 'Login failed. Invalid email or password. Please try again.';
        }
    }
}
?>

<?php include_once 'head.php'; ?>

<body>
    <?php include_once "header.php"; ?>
    <main id="main-mt" class="d-flex align-items-center justify-content-center p-2">
        <div class="card shadow-lg p-4" id="login-container">
            <h1 class="text-center mb-4">Please Log In</h1>

            <!-- Display success message and meta refresh for redirection -->
            <?php if ($success): ?>
                <div class="alert alert-success">
                    <small>Login successful! Redirecting to Main Menu ...</small>
                </div>
                <meta http-equiv="refresh" content="2;url=main_menu.php">
            <?php endif; ?>

            <form id="login-form" method="POST" action="">
                <div class="mb-3">
                    <label for="email" class="form-label">Email Address</label>
                    <input type="email" id="email" name="email" placeholder="email" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" id="password" placeholder="password" name="password" class="form-control" required>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Login</button>
                </div>
                <p class="mt-3 text-center">Don't have an account? <a href="registration.php" class="text-primary">Register</a></p>
                <p class="text-center">Forgot your password? <a href="forgot_password.php" class="text-primary">Reset</a></p>

            </form>
            <?php if ($message): ?>
                <div class="alert alert-danger">
                    <?= htmlspecialchars($message) ?>
                </div>
            <?php endif; ?>
        </div>
    </main>

    <?php include_once 'footer.php'; ?>

</body>

</html>