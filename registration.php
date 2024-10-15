<?php include_once 'process_registration.php'; ?>

<?php include_once 'head.php'; ?>

<body>
    <?php include_once 'header.php'; ?>
    <main id="main-mt">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="registration-form">
                        <h1 class="text-center mb-4">Registration Form</h1>

                        <!-- Display success message and meta refresh for redirection -->
                        <?php if ($success): ?>
                            <div class="alert alert-success">
                                Registration Success! Redirecting to Login ...
                            </div>
                            <meta http-equiv="refresh" content="3;url=login.php">
                        <?php endif; ?>

                        <form action="registration.php" method="POST">
                            <!-- Student ID -->

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <input type="text" class="form-control" name="student_id" placeholder="Student ID"
                                        value="<?php echo isset($student_id) ? htmlspecialchars($student_id) : ''; ?>"
                                        pattern="\d*" title="Please enter numbers only.">
                                    <small class="text-danger"><?php echo $student_id_error; ?></small>
                                </div>
                            </div>


                            <div class="row">
                                <!-- First Name -->
                                <div class="col-md-6 mb-3">
                                    <input type="text" class="form-control" name="first_name" pattern="[a-zA-Z\s]+" placeholder="First Name" value="<?php echo isset($first_name) ? htmlspecialchars($first_name) : ''; ?>">
                                    <small class="text-danger"><?php echo $first_name_error; ?></small>
                                </div>

                                <!-- Last Name -->
                                <div class="col-md-6 mb-3">
                                    <input type="text" class="form-control" name="last_name" pattern="[a-zA-Z\s]+" placeholder="Last Name" value="<?php echo isset($last_name) ? htmlspecialchars($last_name) : ''; ?>">
                                    <small class="text-danger"><?php echo $last_name_error; ?></small>
                                </div>
                            </div>

                            <div class="row">
                                <!-- Date of Birth -->
                                <div class="col-md-6 mb-3">
                                    <label for="dob" class="form-label">Date Of Birth:</label>
                                    <input type="date" class="form-control" id="dob" name="dob" value="<?php echo isset($dob) ? htmlspecialchars($dob) : ''; ?>">
                                    <small class="text-danger"><?php echo $dob_error; ?></small>
                                </div>

                                <!-- Gender -->
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Gender:</label><br>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="gender" id="female" value="Female" <?php if (isset($gender) && $gender == 'Female') echo 'checked';
                                                                                                                                else echo 'checked'; ?>>
                                        <label class="form-check-label" for="female">Female</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="gender" id="male" value="Male" <?php if (isset($gender) && $gender == 'Male') echo 'checked'; ?>>
                                        <label class="form-check-label" for="male">Male</label>
                                    </div>
                                    <small class="text-danger d-block"><?php echo $gender_error; ?></small>
                                </div>



                            </div>

                            <div class="row">
                                <!-- Email -->
                                <div class="col-md-6 mb-3">
                                    <input type="text" class="form-control" name="email" placeholder="Email" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,63}" value="<?php echo isset($email) ? htmlspecialchars($email) : ''; ?>">
                                    <small class="text-danger"><?php echo $email_error; ?></small>
                                </div>

                                <!-- Hometown -->
                                <div class="col-md-6 mb-3">
                                    <input type="text" class="form-control" name="hometown" placeholder="Hometown" value="<?php echo isset($hometown) ? htmlspecialchars($hometown) : ''; ?>">
                                    <small class="text-danger"><?php echo $hometown_error; ?></small>
                                </div>
                            </div>

                            <div class="row">
                                <!-- Password -->
                                <div class="col-md-6 mb-3">
                                    <input type="text" class="form-control" name="password" placeholder="Password" value="<?php echo isset($password) ? htmlspecialchars($password) : ''; ?>">
                                    <small class="text-danger"><?php echo $password_error; ?></small>
                                </div>

                                <!-- Confirm Password -->
                                <div class="col-md-6 mb-3">
                                    <input type="text" class="form-control" name="confirm_password" placeholder="Confirm Password" value="<?php echo isset($confirm_password) ? htmlspecialchars($confirm_password) : ''; ?>">
                                    <small class="text-danger"><?php echo $confirm_password_error; ?></small>
                                </div>
                            </div>

                            <!-- Form Buttons -->
                            <div class="d-flex justify-content-between pt-2 gap-1">
                                <button type="submit" class="btn btn-primary">Submit Form</button>
                                <button type="reset" class="btn btn-danger" id="resetBtn">Reset Form</button>
                                <a href=" login.php" class="btn btn-secondary">Back to Login</a>
                            </div>
                            <div class="text-center">
                                <small class="text-danger"><?php echo $email_exists_error; ?></small>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <?php include_once 'footer.php'; ?>
</body>

</html>