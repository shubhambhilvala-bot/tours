<?php
session_start();
require_once 'config/database.php';
require_once 'includes/functions.php';

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
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $tour['title']; ?> - Saarthi Voyages</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
</head>
<body>
    <!-- Navigation -->
    <?php include 'includes/header.php'; ?>

    <!-- Tour Details -->
    <section class="py-5" style="margin-top: 76px;">
        <div class="container">
            <nav aria-label="breadcrumb" class="mb-4">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item"><a href="tours.php">Tours</a></li>
                    <li class="breadcrumb-item active"><?php echo $tour['title']; ?></li>
                </ol>
            </nav>

            <div class="row">
                <!-- Tour Images and Details -->
                <div class="col-lg-8">
                    <div class="card mb-4">
                        <img src="<?php echo $tour['image']; ?>" class="card-img-top" alt="<?php echo $tour['title']; ?>" style="height: 400px; object-fit: cover;">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <div>
                                    <span class="badge bg-primary mb-2"><?php echo ucfirst($tour['category']); ?></span>
                                    <h2 class="card-title"><?php echo $tour['title']; ?></h2>
                                    <p class="text-muted">
                                        <i class="fas fa-map-marker-alt me-2"></i><?php echo $tour['destination']; ?>
                                    </p>
                                </div>
                                <div class="text-end">
                                    <div class="price-display">
                                        <span class="h3 text-primary fw-bold">₹<?php echo number_format($tour['price']); ?></span>
                                        <small class="text-muted d-block">per person</small>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-4">
                                <div class="col-md-3">
                                    <div class="text-center">
                                        <i class="fas fa-clock fa-2x text-primary mb-2"></i>
                                        <h6>Duration</h6>
                                        <p class="text-muted"><?php echo $tour['duration']; ?> days</p>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="text-center">
                                        <i class="fas fa-users fa-2x text-primary mb-2"></i>
                                        <h6>Group Size</h6>
                                        <p class="text-muted">2-15 people</p>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="text-center">
                                        <i class="fas fa-star fa-2x text-primary mb-2"></i>
                                        <h6>Rating</h6>
                                        <p class="text-muted">4.8/5 (120 reviews)</p>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="text-center">
                                        <i class="fas fa-calendar fa-2x text-primary mb-2"></i>
                                        <h6>Next Departure</h6>
                                        <p class="text-muted"><?php echo date('M j, Y', strtotime('+1 week')); ?></p>
                                    </div>
                                </div>
                            </div>

                            <h5>Description</h5>
                            <p class="card-text"><?php echo nl2br($tour['description']); ?></p>
                        </div>
                    </div>

                    <!-- Tour Highlights -->
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5 class="mb-0"><i class="fas fa-star me-2"></i>Tour Highlights</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <ul class="list-unstyled">
                                        <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Professional tour guide</li>
                                        <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Comfortable accommodation</li>
                                        <li class="mb-2"><i class="fas fa-check text-success me-2"></i>All meals included</li>
                                        <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Transportation provided</li>
                                    </ul>
                                </div>
                                <div class="col-md-6">
                                    <ul class="list-unstyled">
                                        <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Entrance fees included</li>
                                        <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Travel insurance</li>
                                        <li class="mb-2"><i class="fas fa-check text-success me-2"></i>24/7 support</li>
                                        <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Free cancellation</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Itinerary -->
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5 class="mb-0"><i class="fas fa-route me-2"></i>Itinerary</h5>
                        </div>
                        <div class="card-body">
                            <div class="timeline">
                                <div class="timeline-item mb-3">
                                    <div class="d-flex">
                                        <div class="timeline-marker bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px;">
                                            <span class="fw-bold">1</span>
                                        </div>
                                        <div>
                                            <h6>Day 1: Arrival</h6>
                                            <p class="text-muted">Arrive at destination, check-in to hotel, welcome dinner</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="timeline-item mb-3">
                                    <div class="d-flex">
                                        <div class="timeline-marker bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px;">
                                            <span class="fw-bold">2</span>
                                        </div>
                                        <div>
                                            <h6>Day 2: City Tour</h6>
                                            <p class="text-muted">Explore the city with guided tour, visit main attractions</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="timeline-item mb-3">
                                    <div class="d-flex">
                                        <div class="timeline-marker bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px;">
                                            <span class="fw-bold">3</span>
                                        </div>
                                        <div>
                                            <h6>Day 3: Adventure</h6>
                                            <p class="text-muted">Adventure activities and outdoor experiences</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Reviews -->
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0"><i class="fas fa-comments me-2"></i>Customer Reviews</h5>
                        </div>
                        <div class="card-body">
                            <div class="review-item mb-3 pb-3 border-bottom">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <h6>John Doe</h6>
                                        <div class="text-warning mb-2">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                        </div>
                                    </div>
                                    <small class="text-muted">2 days ago</small>
                                </div>
                                <p class="mb-0">Amazing experience! The tour was well-organized and our guide was very knowledgeable.</p>
                            </div>
                            <div class="review-item mb-3 pb-3 border-bottom">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <h6>Jane Smith</h6>
                                        <div class="text-warning mb-2">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="far fa-star"></i>
                                        </div>
                                    </div>
                                    <small class="text-muted">1 week ago</small>
                                </div>
                                <p class="mb-0">Great tour with beautiful scenery. Highly recommended!</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Booking Sidebar -->
                <div class="col-lg-4">
                    <div class="card sticky-top" style="top: 100px;">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0"><i class="fas fa-calendar-check me-2"></i>Book This Tour</h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label">Select Date</label>
                                <input type="date" class="form-control" id="tour-date" min="<?php echo date('Y-m-d'); ?>">
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Number of People</label>
                                <div class="input-group">
                                    <button type="button" class="btn btn-outline-secondary" onclick="changeQuantity(-1)">-</button>
                                    <input type="number" class="form-control text-center" id="num-people" value="1" min="1" max="15">
                                    <button type="button" class="btn btn-outline-secondary" onclick="changeQuantity(1)">+</button>
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Total Price</label>
                                <div class="d-flex justify-content-between">
                                    <span>Price per person:</span>
                                    <span>₹<?php echo number_format($tour['price']); ?></span>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <span>Number of people:</span>
                                    <span id="people-display">1</span>
                                </div>
                                <hr>
                                <div class="d-flex justify-content-between fw-bold">
                                    <span>Total:</span>
                                    <span id="total-price">₹<?php echo number_format($tour['price']); ?></span>
                                </div>
                            </div>
                            
                            <?php if (isLoggedIn()): ?>
                                <a href="book-tour.php?id=<?php echo $tour['id']; ?>" class="btn btn-primary btn-lg w-100">
                                    <i class="fas fa-credit-card me-2"></i>Book Now
                                </a>
                            <?php else: ?>
                                <a href="login.php?redirect=<?php echo urlencode($_SERVER['REQUEST_URI']); ?>" class="btn btn-primary btn-lg w-100">
                                    <i class="fas fa-sign-in-alt me-2"></i>Login to Book
                                </a>
                            <?php endif; ?>
                            
                            <div class="text-center mt-3">
                                <small class="text-muted">
                                    <i class="fas fa-shield-alt me-1"></i>Free cancellation up to 24 hours before departure
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
        // Price calculation
        const basePrice = <?php echo $tour['price']; ?>;
        const peopleInput = document.getElementById('num-people');
        const peopleDisplay = document.getElementById('people-display');
        const totalPrice = document.getElementById('total-price');
        
        function updatePrice() {
            const people = parseInt(peopleInput.value);
            const total = basePrice * people;
            peopleDisplay.textContent = people;
            totalPrice.textContent = '₹' + total.toLocaleString();
        }
        
        function changeQuantity(change) {
            const currentValue = parseInt(peopleInput.value);
            const newValue = Math.max(1, Math.min(15, currentValue + change));
            peopleInput.value = newValue;
            updatePrice();
        }
        
        peopleInput.addEventListener('input', updatePrice);
        updatePrice();
    </script>
</body>
</html>
