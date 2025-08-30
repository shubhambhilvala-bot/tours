<?php
session_start();
require_once 'config/database.php';
require_once 'includes/functions.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - Saarthi Voyages</title>
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
                    <h1 class="display-4 fw-bold">About Saarthi Voyages</h1>
                    <p class="lead">Discovering the world, one adventure at a time</p>
                </div>
            </div>
        </div>
    </section>

    <!-- About Content -->
    <section class="py-5">
        <div class="container">
            <div class="row align-items-center mb-5">
                <div class="col-lg-6">
                    <h2 class="section-title">Our Story</h2>
                    <p class="lead text-muted">Founded in 2010, Saarthi Voyages has been helping travelers create unforgettable memories around the world.</p>
                    <p>We believe that travel has the power to transform lives, broaden perspectives, and create lasting connections. Our mission is to make extraordinary travel experiences accessible to everyone, while ensuring the highest standards of quality, safety, and sustainability.</p>
                    <p>With over a decade of experience in the travel industry, our team of passionate travel experts has curated the most amazing tours and experiences across six continents. From the bustling streets of Tokyo to the serene beaches of the Maldives, we've got you covered.</p>
                </div>
                <div class="col-lg-6">
                    <img src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?ixlib=rb-4.0.3&auto=format&fit=crop&w=2071&q=80" 
                         alt="Our Team" class="img-fluid rounded shadow">
                </div>
            </div>

            <!-- Our Values -->
            <div class="row mb-5">
                <div class="col-12 text-center mb-4">
                    <h2 class="section-title">Our Values</h2>
                    <p class="text-muted">The principles that guide everything we do</p>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="text-center">
                        <div class="feature-icon mb-3">
                            <i class="fas fa-heart fa-3x text-primary"></i>
                        </div>
                        <h5>Passion</h5>
                        <p class="text-muted">We're passionate about travel and sharing that passion with our customers.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="text-center">
                        <div class="feature-icon mb-3">
                            <i class="fas fa-shield-alt fa-3x text-primary"></i>
                        </div>
                        <h5>Safety</h5>
                        <p class="text-muted">Your safety is our top priority. We ensure all tours meet the highest safety standards.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="text-center">
                        <div class="feature-icon mb-3">
                            <i class="fas fa-leaf fa-3x text-primary"></i>
                        </div>
                        <h5>Sustainability</h5>
                        <p class="text-muted">We're committed to sustainable tourism practices that protect our planet.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="text-center">
                        <div class="feature-icon mb-3">
                            <i class="fas fa-star fa-3x text-primary"></i>
                        </div>
                        <h5>Excellence</h5>
                        <p class="text-muted">We strive for excellence in every aspect of our service and customer experience.</p>
                    </div>
                </div>
            </div>

            <!-- Statistics -->
            <div class="row mb-5">
                <div class="col-12">
                    <div class="card bg-primary text-white">
                        <div class="card-body py-5">
                            <div class="row text-center">
                                <div class="col-lg-3 col-md-6 mb-3">
                                    <h3 class="fw-bold">10+</h3>
                                    <p class="mb-0">Years of Experience</p>
                                </div>
                                <div class="col-lg-3 col-md-6 mb-3">
                                    <h3 class="fw-bold">50+</h3>
                                    <p class="mb-0">Destinations</p>
                                </div>
                                <div class="col-lg-3 col-md-6 mb-3">
                                    <h3 class="fw-bold">10,000+</h3>
                                    <p class="mb-0">Happy Travelers</p>
                                </div>
                                <div class="col-lg-3 col-md-6 mb-3">
                                    <h3 class="fw-bold">98%</h3>
                                    <p class="mb-0">Satisfaction Rate</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Our Team -->
            <div class="row mb-5">
                <div class="col-12 text-center mb-4">
                    <h2 class="section-title">Meet Our Team</h2>
                    <p class="text-muted">The passionate people behind Saarthi Voyages</p>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card text-center">
                        <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?ixlib=rb-4.0.3&auto=format&fit=crop&w=687&q=80" 
                             class="card-img-top" alt="CEO" style="height: 250px; object-fit: cover;">
                        <div class="card-body">
                            <h5 class="card-title">John Smith</h5>
                            <p class="text-muted">CEO & Founder</p>
                            <p class="card-text">With over 15 years in the travel industry, John leads our mission to create extraordinary travel experiences.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card text-center">
                        <img src="https://images.unsplash.com/photo-1494790108755-2616b612b786?ixlib=rb-4.0.3&auto=format&fit=crop&w=687&q=80" 
                             class="card-img-top" alt="Operations Manager" style="height: 250px; object-fit: cover;">
                        <div class="card-body">
                            <h5 class="card-title">Sarah Johnson</h5>
                            <p class="text-muted">Operations Manager</p>
                            <p class="card-text">Sarah ensures every tour runs smoothly and every customer has an exceptional experience.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card text-center">
                        <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-4.0.3&auto=format&fit=crop&w=687&q=80" 
                             class="card-img-top" alt="Travel Expert" style="height: 250px; object-fit: cover;">
                        <div class="card-body">
                            <h5 class="card-title">Michael Brown</h5>
                            <p class="text-muted">Travel Expert</p>
                            <p class="card-text">Michael's extensive knowledge of destinations helps us create the perfect itineraries.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Why Choose Us -->
            <div class="row">
                <div class="col-12 text-center mb-4">
                    <h2 class="section-title">Why Choose Saarthi Voyages?</h2>
                    <p class="text-muted">What makes us different from the rest</p>
                </div>
                <div class="col-lg-6 mb-4">
                    <div class="d-flex">
                        <div class="flex-shrink-0">
                            <i class="fas fa-map-marked-alt fa-2x text-primary me-3"></i>
                        </div>
                        <div>
                            <h5>Expert Local Guides</h5>
                            <p class="text-muted">Our tours are led by knowledgeable local guides who share their passion and insights about each destination.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 mb-4">
                    <div class="d-flex">
                        <div class="flex-shrink-0">
                            <i class="fas fa-users fa-2x text-primary me-3"></i>
                        </div>
                        <div>
                            <h5>Small Group Tours</h5>
                            <p class="text-muted">We keep our groups small to ensure personalized attention and a more intimate travel experience.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 mb-4">
                    <div class="d-flex">
                        <div class="flex-shrink-0">
                            <i class="fas fa-handshake fa-2x text-primary me-3"></i>
                        </div>
                        <div>
                            <h5>Trusted Partners</h5>
                            <p class="text-muted">We work with carefully selected local partners to ensure quality accommodations and authentic experiences.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 mb-4">
                    <div class="d-flex">
                        <div class="flex-shrink-0">
                            <i class="fas fa-clock fa-2x text-primary me-3"></i>
                        </div>
                        <div>
                            <h5>24/7 Support</h5>
                            <p class="text-muted">Our customer support team is available around the clock to assist you before, during, and after your trip.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Action -->
    <section class="bg-light py-5">
        <div class="container">
            <div class="row justify-content-center text-center">
                <div class="col-lg-8">
                    <h3 class="mb-3">Ready to Start Your Adventure?</h3>
                    <p class="lead text-muted mb-4">Join thousands of happy travelers who have discovered the world with Saarthi Voyages.</p>
                    <a href="tours.php" class="btn btn-primary btn-lg me-3">
                        <i class="fas fa-search me-2"></i>Explore Tours
                    </a>
                    <a href="contact.php" class="btn btn-outline-primary btn-lg">
                        <i class="fas fa-envelope me-2"></i>Contact Us
                    </a>
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
