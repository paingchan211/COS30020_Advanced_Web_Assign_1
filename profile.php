<?php
session_name('paing_chan'); // name the session to prevent conflicts with other applications
session_start();

// Redirect the user to the login page if they are not logged in
if (empty($_SESSION['loggedin']) || empty($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}


// Path to the User/user.txt file
$file_path = 'data/User/user.txt';
$email = $_SESSION['email'];
$name = '';
$studentId = '';

if (file_exists($file_path)) {
    $file_contents = file($file_path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($file_contents as $line) {
        $user_data = explode('|', $line);
        $existing_email = trim(explode(':', $user_data[5])[1]);
        if ($existing_email == $email) {
            $userInfo = $user_data;

            // Assigning data to variables
            $studentId = trim(explode(':', $userInfo[0])[1]);
            $firstName = trim(explode(':', $userInfo[1])[1]);
            $lastName = trim(explode(':', $userInfo[2])[1]);
            $email = trim(explode(':', $userInfo[5])[1]);
            $profileImage = trim(explode(':', $userInfo[8])[1]);

            // Full name concatenation
            $name = $firstName . ' ' . $lastName;
            break; // Exit loop once user is found
        }
    }
}

// // Load user data from the text file (e.g., User/user.txt)
// $userData = file_get_contents($file_path);

// // Extract the user's data from the User/user.txt file
// // Assuming only one user exists in this example for simplicity
// $userInfo = explode('|', $userData);


?>

<?php include_once 'head.php'; ?>

<body class="bg-light">
    <?php include_once 'header.php'; ?>
    <main id="main-mt">
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card text-center shadow-lg">
                        <div class="card-header">
                            <h1 class="h3">Profile Page</h1>
                        </div>
                        <div class="card-body">
                            <!-- Display profile image based on gender -->
                            <img src="img/profile_images/<?= $profileImage ?>" alt="Profile Image" class="rounded-circle mb-3 profile-img">
                            <h6><strong>Name:</strong> <?= $name ?></h6>
                            <h6><strong>Student ID:</strong> <?= $studentId ?></h6>
                            <h6><strong>Email:</strong> <a href="mailto:<?= $email ?>"><?= $email ?></a></h6>
                            <p class="mt-4">
                                I declare that this assignment is my individual work. I have not worked collaboratively nor have I copied from any other student's work or from any other source. I have not engaged another party to complete this assignment. I am aware of the University's policy with regards to plagiarism. I have not allowed, and will not allow, anyone to copy my work with the intention of passing it off as his or her own work.
                            </p>
                        </div>
                        <div class="card-footer">
                            <a href="update_profile.php" class="btn btn-success">Edit Profile</a>
                            <a href="index.php" class="btn btn-dark">Home Page</a>
                            <a href="about.php" class="btn btn-primary">About</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <?php include_once 'footer.php'; ?>
</body>

</html>