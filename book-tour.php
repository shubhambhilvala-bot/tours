<?php
session_start();
require_once 'config/database.php';
require_once 'includes/functions.php';

// Check if user is logged in
if (!isLoggedIn()) {
    header('Location: login.php?redirect=' . urlencode($_SERVER['REQUEST_URI']));
    exit();
}

// Get tour ID from URL
$tour_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if (!$tour_id) {
    header('Location: tours.php');
    exit();
}

// Get tour details
$tour = getTourById($conn, $tour_id);

if (!$tour) {
    header('Location: tours.php');
    exit();
}

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $booking_date = sanitize($_POST['booking_date']);
    $num_people = (int)$_POST['num_people'];
    $total_amount = (float)$_POST['total_amount'];
    $special_requests = sanitize($_POST['special_requests']);
    
    // Validation
    if (empty($booking_date) || $num_people < 1 || $total_amount <= 0) {
        $error = 'Please fill in all required fields correctly';
    } else {
        // Create booking
        $booking_data = [
            'user_id' => $_SESSION['user_id'],
            'tour_id' => $tour_id,
            'booking_date' => $booking_date,
            'num_people' => $num_people,
            'total_amount' => $total_amount
        ];
        
        if (createBooking($conn, $booking_data)) {
            $success = 'Booking created successfully! You will receive a confirmation email shortly.';
        } else {
            $error = 'Booking failed. Please try again.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Tour - Saarthi Voyages</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
</head>
<body>
    <!-- Navigation -->
    <?php include 'includes/header.php'; ?>

    <!-- Booking Form -->
    <section class="py-5" style="margin-top: 76px;">
        <div class="container">
            <nav aria-label="breadcrumb" class="mb-4">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item"><a href="tours.php">Tours</a></li>
                    <li class="breadcrumb-item"><a href="tour-details.php?id=<?php echo $tour['id']; ?>"><?php echo $tour['title']; ?></a></li>
                    <li class="breadcrumb-item active">Book Tour</li>
                </ol>
            </nav>

            <div class="row">
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            <h4 class="mb-0"><i class="fas fa-credit-card me-2"></i>Complete Your Booking</h4>
                        </div>
                        <div class="card-body p-4">
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

                            <form method="POST" class="needs-validation" novalidate>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Tour Date</label>
                                        <input type="date" class="form-control" name="booking_date" 
                                               value="<?php echo isset($_POST['booking_date']) ? $_POST['booking_date'] : ''; ?>" 
                                               min="<?php echo date('Y-m-d'); ?>" required>
                                        <div class="invalid-feedback">
                                            Please select a valid date.
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Number of People</label>
                                        <input type="number" class="form-control" name="num_people" 
                                               value="<?php echo isset($_POST['num_people']) ? $_POST['num_people'] : '1'; ?>" 
                                               min="1" max="15" required>
                                        <div class="invalid-feedback">
                                            Please enter number of people (1-15).
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Special Requests</label>
                                    <textarea class="form-control" name="special_requests" rows="3" 
                                              placeholder="Any special requirements or requests..."><?php echo isset($_POST['special_requests']) ? $_POST['special_requests'] : ''; ?></textarea>
                                </div>

                                <hr class="my-4">

                                <h5 class="mb-3">Personal Information</h5>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Full Name</label>
                                        <input type="text" class="form-control" value="<?php echo getCurrentUser($conn)['name']; ?>" readonly>
                                    </div>
                                    
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Email</label>
                                        <input type="email" class="form-control" value="<?php echo getCurrentUser($conn)['email']; ?>" readonly>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Phone</label>
                                        <input type="tel" class="form-control" value="<?php echo getCurrentUser($conn)['phone']; ?>" readonly>
                                    </div>
                                    
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Emergency Contact</label>
                                        <input type="tel" class="form-control" name="emergency_contact" 
                                               value="<?php echo isset($_POST['emergency_contact']) ? $_POST['emergency_contact'] : ''; ?>" 
                                               placeholder="Emergency contact number">
                                    </div>
                                </div>

                                <hr class="my-4">

                                <h5 class="mb-3">Payment Information</h5>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Card Number</label>
                                        <input type="text" class="form-control" name="card_number" 
                                               placeholder="1234 5678 9012 3456" required>
                                        <div class="invalid-feedback">
                                            Please enter a valid card number.
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-3 mb-3">
                                        <label class="form-label">Expiry Date</label>
                                        <input type="text" class="form-control" name="expiry_date" 
                                               placeholder="MM/YY" required>
                                        <div class="invalid-feedback">
                                            Please enter expiry date.
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-3 mb-3">
                                        <label class="form-label">CVV</label>
                                        <input type="text" class="form-control" name="cvv" 
                                               placeholder="123" required>
                                        <div class="invalid-feedback">
                                            Please enter CVV.
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Cardholder Name</label>
                                    <input type="text" class="form-control" name="cardholder_name" 
                                           value="<?php echo getCurrentUser($conn)['name']; ?>" required>
                                    <div class="invalid-feedback">
                                        Please enter cardholder name.
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="terms" required>
                                        <label class="form-check-label" for="terms">
                                            I agree to the <a href="#" class="text-decoration-none">Terms and Conditions</a> and 
                                            <a href="#" class="text-decoration-none">Cancellation Policy</a>
                                        </label>
                                        <div class="invalid-feedback">
                                            You must agree before submitting.
                                        </div>
                                    </div>
                                </div>

                                <input type="hidden" name="total_amount" id="total_amount" value="<?php echo $tour['price']; ?>">
                                
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-primary btn-lg">
                                        <i class="fas fa-lock me-2"></i>Secure Payment - ₹<span id="display_total"><?php echo number_format($tour['price']); ?></span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Booking Summary -->
                <div class="col-lg-4">
                    <div class="card sticky-top" style="top: 100px;">
                        <div class="card-header bg-light">
                            <h5 class="mb-0"><i class="fas fa-receipt me-2"></i>Booking Summary</h5>
                        </div>
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-3">
                                <img src="<?php echo $tour['image']; ?>" alt="<?php echo $tour['title']; ?>" 
                                     class="rounded me-3" style="width: 60px; height: 60px; object-fit: cover;">
                                <div>
                                    <h6 class="mb-1"><?php echo $tour['title']; ?></h6>
                                    <small class="text-muted"><?php echo $tour['destination']; ?></small>
                                </div>
                            </div>

                            <div class="booking-details">
                                <div class="d-flex justify-content-between mb-2">
                                    <span>Duration:</span>
                                    <span><?php echo $tour['duration']; ?> days</span>
                                </div>
                                <div class="d-flex justify-content-between mb-2">
                                    <span>Category:</span>
                                    <span><?php echo ucfirst($tour['category']); ?></span>
                                </div>
                                <div class="d-flex justify-content-between mb-2">
                                    <span>Price per person:</span>
                                    <span>₹<?php echo number_format($tour['price']); ?></span>
                                </div>
                                <div class="d-flex justify-content-between mb-2">
                                    <span>Number of people:</span>
                                    <span id="summary_people">1</span>
                                </div>
                                <hr>
                                <div class="d-flex justify-content-between fw-bold">
                                    <span>Total Amount:</span>
                                    <span id="summary_total">₹<?php echo number_format($tour['price']); ?></span>
                                </div>
                            </div>

                            <hr class="my-3">

                            <div class="booking-includes">
                                <h6 class="mb-2">What's Included:</h6>
                                <ul class="list-unstyled small">
                                    <li><i class="fas fa-check text-success me-2"></i>Professional guide</li>
                                    <li><i class="fas fa-check text-success me-2"></i>Accommodation</li>
                                    <li><i class="fas fa-check text-success me-2"></i>All meals</li>
                                    <li><i class="fas fa-check text-success me-2"></i>Transportation</li>
                                    <li><i class="fas fa-check text-success me-2"></i>Entrance fees</li>
                                    <li><i class="fas fa-check text-success me-2"></i>Travel insurance</li>
                                </ul>
                            </div>

                            <div class="text-center mt-3">
                                <small class="text-muted">
                                    <i class="fas fa-shield-alt me-1"></i>Secure payment powered by Stripe
                                </small>
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
        // Update booking summary when number of people changes
        const peopleInput = document.querySelector('input[name="num_people"]');
        const totalAmountInput = document.getElementById('total_amount');
        const displayTotal = document.getElementById('display_total');
        const summaryPeople = document.getElementById('summary_people');
        const summaryTotal = document.getElementById('summary_total');
        const basePrice = <?php echo $tour['price']; ?>;

        function updateBookingSummary() {
            const people = parseInt(peopleInput.value) || 1;
            const total = basePrice * people;
            
            summaryPeople.textContent = people;
            summaryTotal.textContent = '$' + total.toLocaleString();
            displayTotal.textContent = total.toLocaleString();
            totalAmountInput.value = total;
        }

        peopleInput.addEventListener('input', updateBookingSummary);
        updateBookingSummary();
    </script>
</body>
</html>
