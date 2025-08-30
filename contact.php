<?php
session_start();
require_once 'config/database.php';
require_once 'includes/functions.php';

$success = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = sanitize($_POST['name']);
    $email = sanitize($_POST['email']);
    $subject = sanitize($_POST['subject']);
    $message = sanitize($_POST['message']);
    
    // Validation
    if (empty($name) || empty($email) || empty($subject) || empty($message)) {
        $error = 'Please fill in all fields';
    } elseif (!validateEmail($email)) {
        $error = 'Please enter a valid email address';
    } else {
        // In a real application, you would send an email here
        // For now, we'll just show a success message
        $success = 'Thank you for your message! We will get back to you soon.';
        
        // Clear form data
        $_POST = array();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - Saarthi Voyages</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
</head>
<body>
    <!-- Navigation -->
    <?php include 'includes/header.php'; ?>

    <!-- Page Header -->
    <section class="bg-primary text-white py-5" style="margin-top: 76px;">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <h1 class="display-4 fw-bold">Contact Us</h1>
                    <p class="lead">Get in touch with our travel experts</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Content -->
    <section class="py-5">
        <div class="container">
            <div class="row">
                <!-- Contact Information -->
                <div class="col-lg-4 mb-5">
                    <h3 class="mb-4">Get in Touch</h3>
                    <p class="text-muted mb-4">Have questions about our tours? Need help with your booking? We're here to help!</p>
                    
                    <div class="contact-info">
                        <div class="d-flex mb-3">
                            <div class="flex-shrink-0">
                                <i class="fas fa-map-marker-alt fa-2x text-primary"></i>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h6>Address</h6>
                                <p class="text-muted mb-0">123 Travel Street<br>Tourism City, TC 12345<br>United States</p>
                            </div>
                        </div>
                        
                        <div class="d-flex mb-3">
                            <div class="flex-shrink-0">
                                <i class="fas fa-phone fa-2x text-primary"></i>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h6>Phone</h6>
                                <p class="text-muted mb-0">+1 (555) 123-4567<br>+1 (555) 987-6543</p>
                            </div>
                        </div>
                        
                        <div class="d-flex mb-3">
                            <div class="flex-shrink-0">
                                <i class="fas fa-envelope fa-2x text-primary"></i>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h6>Email</h6>
                                <p class="text-muted mb-0">info@saarthivoyages.com<br>support@saarthivoyages.com</p>
                            </div>
                        </div>
                        
                        <div class="d-flex mb-3">
                            <div class="flex-shrink-0">
                                <i class="fas fa-clock fa-2x text-primary"></i>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h6>Business Hours</h6>
                                <p class="text-muted mb-0">Monday - Friday: 9:00 AM - 6:00 PM<br>Saturday: 10:00 AM - 4:00 PM<br>Sunday: Closed</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="social-links mt-4">
                        <h6 class="mb-3">Follow Us</h6>
                        <a href="#" class="btn btn-outline-primary me-2">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="btn btn-outline-primary me-2">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="btn btn-outline-primary me-2">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="btn btn-outline-primary">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                    </div>
                </div>
                
                <!-- Contact Form -->
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            <h4 class="mb-0"><i class="fas fa-envelope me-2"></i>Send us a Message</h4>
                        </div>
                        <div class="card-body p-4">
                            <?php if ($success): ?>
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <i class="fas fa-check-circle me-2"></i><?php echo $success; ?>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                </div>
                            <?php endif; ?>
                            
                            <?php if ($error): ?>
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <i class="fas fa-exclamation-triangle me-2"></i><?php echo $error; ?>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                </div>
                            <?php endif; ?>
                            
                            <form method="POST" class="needs-validation" novalidate>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="name" class="form-label">Full Name *</label>
                                        <input type="text" class="form-control" id="name" name="name" 
                                               value="<?php echo isset($_POST['name']) ? $_POST['name'] : ''; ?>" 
                                               required>
                                        <div class="invalid-feedback">
                                            Please enter your full name.
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6 mb-3">
                                        <label for="email" class="form-label">Email Address *</label>
                                        <input type="email" class="form-control" id="email" name="email" 
                                               value="<?php echo isset($_POST['email']) ? $_POST['email'] : ''; ?>" 
                                               required>
                                        <div class="invalid-feedback">
                                            Please enter a valid email address.
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="subject" class="form-label">Subject *</label>
                                    <input type="text" class="form-control" id="subject" name="subject" 
                                           value="<?php echo isset($_POST['subject']) ? $_POST['subject'] : ''; ?>" 
                                           required>
                                    <div class="invalid-feedback">
                                        Please enter a subject.
                                    </div>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="message" class="form-label">Message *</label>
                                    <textarea class="form-control" id="message" name="message" rows="5" 
                                              required><?php echo isset($_POST['message']) ? $_POST['message'] : ''; ?></textarea>
                                    <div class="invalid-feedback">
                                        Please enter your message.
                                    </div>
                                </div>
                                
                                <div class="mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="newsletter">
                                        <label class="form-check-label" for="newsletter">
                                            Subscribe to our newsletter for travel updates and special offers
                                        </label>
                                    </div>
                                </div>
                                
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-primary btn-lg">
                                        <i class="fas fa-paper-plane me-2"></i>Send Message
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="bg-light py-5">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center mb-4">
                    <h2 class="section-title">Frequently Asked Questions</h2>
                    <p class="text-muted">Find answers to common questions about our tours</p>
                </div>
            </div>
            
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <div class="accordion" id="faqAccordion">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="faq1">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse1">
                                    How do I book a tour?
                                </button>
                            </h2>
                            <div id="collapse1" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    You can book a tour by browsing our tours page, selecting your preferred tour, and completing the booking form. You'll need to create an account or log in to complete the booking process.
                                </div>
                            </div>
                        </div>
                        
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="faq2">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse2">
                                    What is included in the tour price?
                                </button>
                            </h2>
                            <div id="collapse2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Our tour prices typically include accommodation, transportation, meals, entrance fees, and professional guides. Please check the specific tour details for a complete list of inclusions.
                                </div>
                            </div>
                        </div>
                        
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="faq3">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse3">
                                    Can I cancel my booking?
                                </button>
                            </h2>
                            <div id="collapse3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Yes, you can cancel your booking up to 24 hours before the tour departure date for a full refund. Cancellations made within 24 hours may be subject to cancellation fees.
                                </div>
                            </div>
                        </div>
                        
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="faq4">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse4">
                                    Do you offer group discounts?
                                </button>
                            </h2>
                            <div id="collapse4" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Yes, we offer special discounts for groups of 6 or more people. Please contact us directly for group booking inquiries and custom pricing.
                                </div>
                            </div>
                        </div>
                        
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="faq5">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse5">
                                    What should I pack for my tour?
                                </button>
                            </h2>
                            <div id="collapse5" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Packing requirements vary by destination and tour type. We'll send you a detailed packing list after booking, including weather-appropriate clothing, essential items, and any special equipment needed.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Map Section -->
    <section class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center mb-4">
                    <h3 class="section-title">Find Us</h3>
                    <p class="text-muted">Visit our office or get directions</p>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body p-0">
                            <!-- Placeholder for map - in real implementation, you would embed Google Maps or similar -->
                            <div class="bg-light text-center py-5" style="height: 400px;">
                                <i class="fas fa-map fa-4x text-muted mb-3"></i>
                                <h5 class="text-muted">Interactive Map</h5>
                                <p class="text-muted">Google Maps integration would be displayed here</p>
                                <a href="#" class="btn btn-primary">
                                    <i class="fas fa-directions me-2"></i>Get Directions
                                </a>
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
</body>
</html>
