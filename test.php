<?php
// Simple test file to verify functionality
session_start();
require_once 'config/database.php';
require_once 'includes/functions.php';

echo "<h2>Database Connection Test</h2>";

// Test database connection
try {
    $stmt = $conn->query("SELECT COUNT(*) as count FROM users");
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    echo "<p>✅ Database connection successful! Users count: " . $result['count'] . "</p>";
} catch(PDOException $e) {
    echo "<p>❌ Database connection failed: " . $e->getMessage() . "</p>";
}

// Test password hashing
$test_password = "test123";
$hashed = hashPassword($test_password);
$verified = verifyPassword($test_password, $hashed);
echo "<p>✅ Password hashing test: " . ($verified ? "PASSED" : "FAILED") . "</p>";

// Test email validation
$test_email = "test@example.com";
$email_valid = validateEmail($test_email);
echo "<p>✅ Email validation test: " . ($email_valid ? "PASSED" : "FAILED") . "</p>";

// Test sanitize function
$test_input = "<script>alert('test')</script>";
$sanitized = sanitize($test_input);
echo "<p>✅ Sanitize function test: " . (strpos($sanitized, '<script>') === false ? "PASSED" : "FAILED") . "</p>";

echo "<h3>Available Users:</h3>";
try {
    $stmt = $conn->query("SELECT id, name, email, role FROM users LIMIT 5");
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo "<ul>";
    foreach($users as $user) {
        echo "<li>ID: {$user['id']}, Name: {$user['name']}, Email: {$user['email']}, Role: {$user['role']}</li>";
    }
    echo "</ul>";
} catch(PDOException $e) {
    echo "<p>❌ Error fetching users: " . $e->getMessage() . "</p>";
}

echo "<p><a href='register.php'>Go to Registration</a> | <a href='login.php'>Go to Login</a></p>";
?>
