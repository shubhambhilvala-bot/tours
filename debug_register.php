<?php
session_start();
require_once 'config/database.php';
require_once 'includes/functions.php';

$error = '';
$success = '';
$debug_info = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $debug_info[] = "Form submitted via POST";
    
    $name = isset($_POST['name']) ? sanitize($_POST['name']) : '';
    $email = isset($_POST['email']) ? sanitize($_POST['email']) : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    $confirm_password = isset($_POST['confirm_password']) ? $_POST['confirm_password'] : '';
    $phone = isset($_POST['phone']) ? sanitize($_POST['phone']) : '';
    
    $debug_info[] = "Name: " . $name;
    $debug_info[] = "Email: " . $email;
    $debug_info[] = "Phone: " . $phone;
    $debug_info[] = "Password length: " . strlen($password);
    $debug_info[] = "Confirm password length: " . strlen($confirm_password);
    
    // Validation
    if (empty($name) || empty($email) || empty($password) || empty($confirm_password)) {
        $error = 'All fields are required';
        $debug_info[] = "Validation failed: Empty fields";
    } elseif (!validateEmail($email)) {
        $error = 'Please enter a valid email address';
        $debug_info[] = "Validation failed: Invalid email";
    } elseif (strlen($password) < 6) {
        $error = 'Password must be at least 6 characters long';
        $debug_info[] = "Validation failed: Password too short";
    } elseif ($password !== $confirm_password) {
        $error = 'Passwords do not match';
        $debug_info[] = "Validation failed: Passwords don't match";
    } else {
        $debug_info[] = "Validation passed";
        
        // Check if email already exists
        try {
            $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
            $stmt->execute([$email]);
            
            if ($stmt->rowCount() > 0) {
                $error = 'Email address already registered';
                $debug_info[] = "Email already exists";
            } else {
                $debug_info[] = "Email is available";
                
                // Create new user
                $hashed_password = hashPassword($password);
                $debug_info[] = "Password hashed successfully";
                
                $stmt = $conn->prepare("INSERT INTO users (name, email, password, phone, role, created_at) VALUES (?, ?, ?, ?, 'user', NOW())");
                
                if ($stmt->execute([$name, $email, $hashed_password, $phone])) {
                    $success = 'Registration successful! Please login to continue.';
                    $debug_info[] = "User created successfully";
                    $_POST = array();
                } else {
                    $error = 'Registration failed. Please try again.';
                    $debug_info[] = "Database insert failed";
                }
            }
        } catch(PDOException $e) {
            $error = 'Registration failed: ' . $e->getMessage();
            $debug_info[] = "Database error: " . $e->getMessage();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Debug Register - Saarthi Voyages</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
</head>
<body>
    <!-- Navigation -->
    <?php include 'includes/header.php'; ?>

    <!-- Registration Form -->
    <section class="py-5" style="margin-top: 76px; min-height: calc(100vh - 76px); background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-md-10">
                    <div class="card shadow-custom">
                        <div class="card-header bg-primary text-white text-center py-4">
                            <h3 class="mb-0">
                                <i class="fas fa-user-plus me-2"></i>Debug Registration
                            </h3>
                            <p class="mb-0 mt-2">Debug version to identify issues</p>
                        </div>
                        <div class="card-body p-5">
                            <?php if ($error): ?>
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <i class="fas fa-exclamation-triangle me-2"></i><?php echo $error; ?>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                </div>
                            <?php endif; ?>
                            
                            <?php if ($success): ?>
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <i class="fas fa-check-circle me-2"></i><?php echo $success; ?>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                </div>
                            <?php endif; ?>
                            
                            <!-- Debug Information -->
                            <?php if (!empty($debug_info)): ?>
                                <div class="alert alert-info">
                                    <h6>Debug Information:</h6>
                                    <ul class="mb-0">
                                        <?php foreach($debug_info as $info): ?>
                                            <li><?php echo htmlspecialchars($info); ?></li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            <?php endif; ?>
                            
                            <form method="POST" class="needs-validation" novalidate id="debugRegisterForm">
                                <div class="mb-3">
                                    <label for="name" class="form-label">
                                        <i class="fas fa-user me-2"></i>Full Name
                                    </label>
                                    <input type="text" class="form-control" id="name" name="name" 
                                           value="<?php echo isset($_POST['name']) ? $_POST['name'] : ''; ?>" 
                                           required>
                                    <div class="invalid-feedback">
                                        Please enter your full name.
                                    </div>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="email" class="form-label">
                                        <i class="fas fa-envelope me-2"></i>Email Address
                                    </label>
                                    <input type="email" class="form-control" id="email" name="email" 
                                           value="<?php echo isset($_POST['email']) ? $_POST['email'] : ''; ?>" 
                                           required>
                                    <div class="invalid-feedback">
                                        Please enter a valid email address.
                                    </div>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="phone" class="form-label">
                                        <i class="fas fa-phone me-2"></i>Phone Number
                                    </label>
                                    <input type="tel" class="form-control" id="phone" name="phone" 
                                           value="<?php echo isset($_POST['phone']) ? $_POST['phone'] : ''; ?>" 
                                           required>
                                    <div class="invalid-feedback">
                                        Please enter your phone number.
                                    </div>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="password" class="form-label">
                                        <i class="fas fa-lock me-2"></i>Password
                                    </label>
                                    <input type="password" class="form-control" id="password" name="password" 
                                           required minlength="6">
                                    <div class="invalid-feedback">
                                        Password must be at least 6 characters long.
                                    </div>
                                </div>
                                
                                <div class="mb-4">
                                    <label for="confirm_password" class="form-label">
                                        <i class="fas fa-lock me-2"></i>Confirm Password
                                    </label>
                                    <input type="password" class="form-control" id="confirm_password" name="confirm_password" 
                                           required>
                                    <div class="invalid-feedback">
                                        Please confirm your password.
                                    </div>
                                </div>
                                
                                <div class="mb-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="terms" required>
                                        <label class="form-check-label" for="terms">
                                            I agree to the <a href="#" class="text-decoration-none">Terms of Service</a> and 
                                            <a href="#" class="text-decoration-none">Privacy Policy</a>
                                        </label>
                                        <div class="invalid-feedback">
                                            You must agree before submitting.
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-primary btn-lg" id="submitBtn">
                                        <i class="fas fa-user-plus me-2"></i>Create Account
                                    </button>
                                </div>
                            </form>
                            
                            <hr class="my-4">
                            
                            <div class="text-center">
                                <p class="mb-0">Already have an account? 
                                    <a href="login.php" class="text-decoration-none fw-bold">Login here</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <?php include 'includes/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/script.js"></script>
    <script>
        // Debug form handling
        document.getElementById('debugRegisterForm').addEventListener('submit', function(e) {
            console.log('Debug registration form submitted');
            
            const submitBtn = document.getElementById('submitBtn');
            const originalText = submitBtn.innerHTML;
            
            // Show processing state
            submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>Processing...';
            submitBtn.disabled = true;
            
            // Re-enable after 5 seconds if no response
            setTimeout(() => {
                if (submitBtn.disabled) {
                    submitBtn.innerHTML = originalText;
                    submitBtn.disabled = false;
                    console.log('Button re-enabled after timeout');
                }
            }, 5000);
        });
    </script>
</body>
</html>
