<?php
session_start();
require_once 'config/database.php';
require_once 'includes/functions.php';

// Get featured tours
$featured_tours = getFeaturedTours($conn, 6);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Saarthi Voyages - Tours & Travels Booking</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
</head>
<body>
    <!-- Navigation -->
    <?php include 'includes/header.php'; ?>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="hero-overlay"></div>
        <div class="container">
            <div class="row align-items-center min-vh-100">
                <div class="col-lg-6">
                    <h1 class="display-4 text-white fw-bold mb-4">
                        Discover Amazing Destinations
                    </h1>
                    <p class="lead text-white mb-4">
                        Explore the world with our curated tours and unforgettable travel experiences.
                    </p>
                    <a href="tours.php" class="btn btn-primary btn-lg me-3">
                        <i class="fas fa-search me-2"></i>Explore Tours
                    </a>
                    <a href="about.php" class="btn btn-outline-light btn-lg">
                        <i class="fas fa-info-circle me-2"></i>Learn More
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Search Section -->
    <section class="search-section py-5 bg-light">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <form action="tours.php" method="GET" class="search-form">
                        <div class="row g-3">
                            <div class="col-md-3">
                                <input type="text" name="destination" class="form-control" placeholder="Destination">
                            </div>
                            <div class="col-md-3">
                                <select name="category" class="form-select">
                                    <option value="">All Categories</option>
                                    <option value="adventure">Adventure</option>
                                    <option value="cultural">Cultural</option>
                                    <option value="beach">Beach</option>
                                    <option value="mountain">Mountain</option>
                                    <option value="city">City</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <input type="number" name="duration" class="form-control" placeholder="Duration (days)">
                            </div>
                            <div class="col-md-3">
                                <button type="submit" class="btn btn-primary w-100">
                                    <i class="fas fa-search me-2"></i>Search
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Tours -->
    <section class="featured-tours py-5">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center mb-5">
                    <h2 class="section-title">Featured Tours</h2>
                    <p class="text-muted">Discover our most popular destinations</p>
                </div>
            </div>
            <div class="row">
                <?php foreach ($featured_tours as $tour): ?>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card tour-card h-100">
                        <img src="<?php echo $tour['image']; ?>" class="card-img-top" alt="<?php echo $tour['title']; ?>">
                        <div class="card-body">
                            <div class="tour-category mb-2">
                                <span class="badge bg-primary"><?php echo ucfirst($tour['category']); ?></span>
                            </div>
                            <h5 class="card-title"><?php echo $tour['title']; ?></h5>
                            <p class="card-text text-muted"><?php echo substr($tour['description'], 0, 100); ?>...</p>
                            <div class="tour-details d-flex justify-content-between align-items-center">
                                <div>
                                    <i class="fas fa-clock text-muted me-1"></i>
                                    <span class="text-muted"><?php echo $tour['duration']; ?> days</span>
                                </div>
                                <div>
                                    <i class="fas fa-map-marker-alt text-muted me-1"></i>
                                    <span class="text-muted"><?php echo $tour['destination']; ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer bg-white border-0">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="price">
                                    <span class="text-primary fw-bold">₹<?php echo number_format($tour['price']); ?></span>
                                    <small class="text-muted">per person</small>
                                </div>
                                <a href="tour-details.php?id=<?php echo $tour['id']; ?>" class="btn btn-outline-primary">
                                    View Details
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            <div class="text-center mt-4">
                <a href="tours.php" class="btn btn-primary btn-lg">View All Tours</a>
            </div>
        </div>
    </section>

    <!-- Why Choose Us -->
    <section class="why-choose-us py-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center mb-5">
                    <h2 class="section-title">Why Choose Us</h2>
                    <p class="text-muted">Experience the difference with our premium services</p>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="text-center">
                        <div class="feature-icon mb-3">
                            <i class="fas fa-shield-alt fa-3x text-primary"></i>
                        </div>
                        <h5>Safe & Secure</h5>
                        <p class="text-muted">Your safety is our top priority with comprehensive travel insurance.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="text-center">
                        <div class="feature-icon mb-3">
                            <i class="fas fa-rupee-sign fa-3x text-primary"></i>
                        </div>
                        <h5>Best Prices</h5>
                        <p class="text-muted">Competitive pricing with no hidden fees or surprise charges.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="text-center">
                        <div class="feature-icon mb-3">
                            <i class="fas fa-headset fa-3x text-primary"></i>
                        </div>
                        <h5>24/7 Support</h5>
                        <p class="text-muted">Round-the-clock customer support for all your travel needs.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="text-center">
                        <div class="feature-icon mb-3">
                            <i class="fas fa-star fa-3x text-primary"></i>
                        </div>
                        <h5>Expert Guides</h5>
                        <p class="text-muted">Professional and experienced tour guides for authentic experiences.</p>
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
