<?php
session_name('paing_chan'); // name the session to prevent conflicts with other applications
session_start();

// Helper function to validate the email format
function validate_email($email)
{
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

// Helper function to check if the email already exists in the User/user.txt file
function email_exists($email, $file_path)
{
    if (file_exists($file_path)) {
        $file_contents = file($file_path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($file_contents as $line) {
            $user_data = explode('|', $line);
            $existing_email = trim(explode(':', $user_data[5])[1]); // Change index for email
            if ($existing_email == $email) {
                return true;
            }
        }
    }
    return false;
}

// Initialize error array for each field and success flag
$student_id_error = $first_name_error = $last_name_error = $dob_error = $gender_error = $email_error = $email_exists_error = $hometown_error = $password_error = $confirm_password_error = "";
$success = false;

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form input
    $student_id = trim($_POST['student_id']);
    $first_name = trim($_POST['first_name']);
    $last_name = trim($_POST['last_name']);
    $dob = trim($_POST['dob']);
    $gender = trim($_POST['gender']);
    $email = trim($_POST['email']);
    $hometown = trim($_POST['hometown']);
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm_password']);

    // Validation rules
    if (empty($student_id)) {
        $student_id_error = "Student ID is required.";
    } elseif (!ctype_digit($student_id)) {
        $student_id_error = "Student ID must be numeric.";
    }

    if (empty($first_name)) {
        $first_name_error = "First name is required.";
    } elseif (!preg_match("/^[a-zA-Z\s]+$/", $first_name)) {
        $first_name_error = "Only letters and white space allowed";
    }

    if (empty($last_name)) {
        $last_name_error = "Last name is required.";
    } elseif (!preg_match("/^[a-zA-Z\s]+$/", $last_name)) {
        $last_name_error = "Only letters and white space allowed";
    }

    if (empty($dob)) {
        $dob_error = "Date of birth is required.";
    }

    if (empty($gender)) {
        $gender_error = "Gender is required.";
    }

    if (empty($email)) {
        $email_error = "Email is required.";
    } elseif (!validate_email($email)) {
        $email_error = "Invalid email format.";
    } elseif (email_exists($email, "data/User/user.txt")) {
        $email_exists_error = "There is an existing account with this email.";
    }

    if (empty($hometown)) {
        $hometown_error = "Hometown is required.";
    }

    if (empty($password)) {
        $password_error = "Password is required.";
    } elseif (strlen($password) < 8 || !preg_match("/[0-9]/", $password) || !preg_match("/[\W]/", $password)) {
        $password_error = "Password must be at least 8 characters long, with at least one number and one symbol.";
    }

    if (empty($confirm_password)) {
        $confirm_password_error = "Confirm password is required.";
    } elseif ($password !== $confirm_password) {
        $confirm_password_error = "Password and confirm password do not match.";
    }

    // If no errors, proceed to save the data
    if (empty($student_id_error) && empty($first_name_error) && empty($last_name_error) && empty($dob_error) && empty($gender_error) && empty($email_error) && empty($email_exists_error) && empty($hometown_error) && empty($password_error) && empty($confirm_password_error)) {
        // Creation of the directory named “User” inside “xampp/data” to store the user text file
        $dir = "data/User";
        $file_path = $dir . "/user.txt";

        // Create the User directory if it doesn't exist
        if (!is_dir($dir)) {
            mkdir($dir, 0755, true);
        }

        // Determine the image based on gender
        $image = ($gender == "Male") ? "boy.jpg" : "girl.png";

        // Format the user data to be saved, including the image
        $user_data = "Student ID:$student_id|First Name:$first_name|Last Name:$last_name|DOB:$dob|Gender:$gender|Email:$email|Hometown:$hometown|Password:$password|Image:$image\n";

        // Use fopen, fwrite, and fclose for file handling
        $file_handle = fopen($file_path, 'a'); // Open the file for appending
        if ($file_handle) {
            fwrite($file_handle, $user_data); // Write the user data
            fclose($file_handle); // Close the file
            $success = true; // Set success flag to true for form submission success
            session_regenerate_id(true); // Regenerate the session ID to prevent fixation
        } else {
            // Handle file opening error
            echo "Error opening the file for writing.";
        }
    }
}
