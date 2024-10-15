<!-- update_profile.php -->
<?php
session_name('paing_chan'); // name the session to prevent conflicts with other applications
session_start();

// Redirect to login page if user is not logged in
if (empty($_SESSION['loggedin']) || empty($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

// Path to the user data file
$file_path = "data/User/user.txt";

// Initialize variables
$message = '';
$success = false;

$email = $_SESSION['email'];

// Ensure the uploads directory exists
$upload_dir = "img/profile_images/";
if (!is_dir($upload_dir)) {
    mkdir($upload_dir, 0755, true);
}

// Helper function to update user data
function update_user_data($updated_data, $file_path, $email)
{
    if (file_exists($file_path)) {
        $file_contents = file($file_path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        $new_content = [];

        foreach ($file_contents as $line) {
            $userInfo = explode('|', $line);
            $existing_email = trim(explode(':', $userInfo[5])[1]); // Fetch the email from userInfo
            if ($existing_email == $email) {
                // Update the user info
                $new_line = implode('|', [
                    'Student ID:' . $updated_data['student_id'],
                    'First Name:' . $updated_data['first_name'],
                    'Last Name:' . $updated_data['last_name'],
                    'DOB:' . $updated_data['dob'],
                    'Gender:' . $updated_data['gender'],
                    'Email:' . $updated_data['email'],
                    'Hometown:' . $updated_data['hometown'],
                    'Password:' . trim(explode(':', $userInfo[7])[1]), // Keep the existing password
                    'Image:' . $updated_data['image'], // Updated image path
                ]);
                $new_content[] = $new_line; // Append the updated user data
            } else {
                $new_content[] = $line; // Append other users' data unchanged
            }
        }

        // Write the updated content back to the file
        file_put_contents($file_path, implode(PHP_EOL, $new_content) . PHP_EOL);
        return true;
    }
    return false;
}

// Helper function to get user data by username
function get_user_by_username($username, $file_path, $email)
{
    if (file_exists($file_path)) {
        $file_contents = file($file_path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($file_contents as $line) {

            $userInfo = explode('|', $line);
            $existing_email = trim(explode(':', $userInfo[5])[1]);
            if ($existing_email == $email) {
                $user_data = $userInfo;
                // Check if the line has at least 9 fields
                if (count($user_data) >= 9) {

                    return [
                        'student_id' => trim(explode(':', $user_data[0])[1]), // Student ID
                        'first_name' => trim(explode(':', $user_data[1])[1]), // First Name
                        'last_name' => trim(explode(':', $user_data[2])[1]),  // Last Name
                        'dob' => trim(explode(':', $user_data[3])[1]),        // DOB
                        'gender' => trim(explode(':', $user_data[4])[1]),     // Gender
                        'email' => trim(explode(':', $user_data[5])[1]),      // Email
                        'hometown' => trim(explode(':', $user_data[6])[1]),   // Hometown
                        'image' => trim(explode(':', $user_data[8])[1]),      // Image
                    ];
                }
            }
        }
    }
    return null;
}

// Load user data from the session
if (isset($_SESSION['username'])) {
    $username_parts = explode(' ', $_SESSION['username']);
    $username = trim($username_parts[0]); // Retrieve the first name part of the username stored during login
} else {
    // Handle the case where the session username doesn't exist
    $username = '';
}

$user = get_user_by_username($username, $file_path, $email); // Load the user data by username

// Check if user data was successfully retrieved
if (!$user) {
    // Handle the case where user data is not found
    $message = 'User data not found.';
}

// Process form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve and sanitize form inputs
    $student_id = trim($_POST['student_id']);
    $first_name = trim($_POST['first_name']);
    $last_name = trim($_POST['last_name']);
    $dob = trim($_POST['dob']);
    $gender = trim($_POST['gender']);
    $hometown = trim($_POST['hometown']);
    $email = $_SESSION['email'];

    // Initialize image variable
    $image = $user['image']; // Keep existing image if no new image is uploaded

    // Handle image upload
    if (!empty($_FILES['image']['name'])) {
        // Validate the uploaded file (optional but recommended)
        $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];
        $file_ext = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));

        if (in_array($file_ext, $allowed_types)) {
            // Use the original file name instead of generating a unique name
            $new_image_name = basename($_FILES['image']['name']);
            $image_path = $upload_dir . $new_image_name;

            if (move_uploaded_file($_FILES['image']['tmp_name'], $image_path)) {
                $image = $new_image_name; // Update image name in user data
            } else {
                $message = 'Failed to upload image.';
            }
        } else {
            $message = 'Invalid image format. Allowed types: ' . implode(', ', $allowed_types);
        }
    }

    // Validate required fields
    if (empty($first_name) || empty($last_name) || empty($dob) || empty($gender) || empty($hometown) || empty($student_id) || empty($email)) {
        $message = 'Please fill in all required fields.';
    } else {
        // Update user data
        $updated_data = [
            'student_id' => $student_id,
            'first_name' => $first_name,
            'last_name' => $last_name,
            'dob' => $dob,
            'gender' => $gender,
            'email' => $email, // Update the email
            'hometown' => $hometown,
            'username' => $first_name, // Add this to set the username (first name)
            'image' => $image, // Updated image path
        ];

        // If update is successful
        if (update_user_data($updated_data, $file_path, $email)) {
            // Update the session username to reflect the new first name
            $_SESSION['username'] = $first_name . ' ' . $last_name; // Adjust based on how you store username

            // Reload the user data after update
            $user = get_user_by_username($first_name, $file_path, $email); // Refresh user data

            if ($user) {
                $success = true;
                $message = 'Profile updated successfully!';
            } else {
                $message = 'Profile updated, but failed to reload user data.';
            }

            header("Location: profile.php");
            exit();
        } else {
            $message = 'Failed to update profile. Please try again.';
        }
    }
}

?>
<?php include_once 'head.php'; ?>

<body>
    <?php include_once "header.php"; ?>

    <main id="main-mt" class="d-flex align-items-center justify-content-center p-2">
        <div class="card shadow-lg p-4" id="profile-update-container">
            <h1 class="text-center mb-4">Update Profile</h1>


            <!-- Display error message -->
            <?php if ($message && !$success): ?>
                <div class="alert alert-danger">
                    <?= htmlspecialchars($message) ?>
                </div>
            <?php endif; ?>

            <?php if ($user): ?>
                <form method="POST" action="" enctype="multipart/form-data">
                    <div class="mb-3 text-center">
                        <img src="<?= htmlspecialchars($upload_dir . $user['image']) ?>" alt="Profile Image" class="rounded-circle mb-3 profile-img">
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <input type="file" id="image" name="image" class="form-control mt-3">
                        </div>

                        <div class="col-md-6">

                            <label class="form-label">Gender</label>
                            <div class="d-flex align-items-center">
                                <div class="form-check me-3">
                                    <input class="form-check-input" type="radio" name="gender" id="male" value="Male" <?= $user['gender'] === 'Male' ? 'checked' : '' ?> required>
                                    <label class="form-check-label" for="male">Male</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="gender" id="female" value="Female" <?= $user['gender'] === 'Female' ? 'checked' : '' ?> required>
                                    <label class="form-check-label" for="female">Female</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="student_id" class="form-label">Student ID</label>
                            <input type="text" id="student_id" name="student_id" value="<?= htmlspecialchars($user['student_id']) ?>" class="form-control" pattern="\d*" required>
                        </div>

                        <div class="col-md-6">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" id="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" class="form-control" readonly style="background-color: #e9ecef; border-color: #ced4da; cursor: not-allowed;">
                        </div>



                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="first_name" class="form-label">First Name</label>
                            <input type="text" id="first_name" name="first_name" pattern="[a-zA-Z\s]+" value="<?= htmlspecialchars($user['first_name']) ?>" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label for="dob" class="form-label">Date of Birth</label>
                            <input type="date" id="dob" name="dob" value="<?= htmlspecialchars($user['dob']) ?>" class="form-control" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="last_name" class="form-label">Last Name</label>
                            <input type="text" id="last_name" name="last_name" pattern="[a-zA-Z\s]+" value="<?= htmlspecialchars($user['last_name']) ?>" class="form-control" required>
                        </div>

                        <div class="col-md-6">
                            <label for="hometown" class="form-label">Hometown</label>
                            <input type="text" id="hometown" name="hometown" value="<?= htmlspecialchars($user['hometown']) ?>" class="form-control" required>
                        </div>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Update Profile</button>
                        <a href="main_menu.php" class="btn btn-danger">Cancel</a>
                    </div>
                </form>
            <?php endif; ?>

        </div>
    </main>

    <?php include_once 'footer.php'; ?>
</body>


</html>