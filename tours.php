<?php
session_start();
require_once 'config/database.php';
require_once 'includes/functions.php';

// Get filters from URL
$filters = [];
if (!empty($_GET['destination'])) $filters['destination'] = sanitize($_GET['destination']);
if (!empty($_GET['category'])) $filters['category'] = sanitize($_GET['category']);
if (!empty($_GET['duration'])) $filters['duration'] = (int)$_GET['duration'];
if (!empty($_GET['min_price'])) $filters['min_price'] = (float)$_GET['min_price'];
if (!empty($_GET['max_price'])) $filters['max_price'] = (float)$_GET['max_price'];

// Get tours based on filters
$tours = getTours($conn, $filters);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tours - Saarthi Voyages</title>
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
                    <h1 class="display-4 fw-bold">Explore Our Tours</h1>
                    <p class="lead">Discover amazing destinations and unforgettable experiences</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Search and Filters -->
    <section class="py-4 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0"><i class="fas fa-filter me-2"></i>Filters</h5>
                        </div>
                        <div class="card-body">
                            <form action="tours.php" method="GET">
                                <div class="mb-3">
                                    <label class="form-label">Destination</label>
                                    <input type="text" name="destination" class="form-control" 
                                           value="<?php echo isset($_GET['destination']) ? $_GET['destination'] : ''; ?>" 
                                           placeholder="Enter destination">
                                </div>
                                
                                <div class="mb-3">
                                    <label class="form-label">Category</label>
                                    <select name="category" class="form-select">
                                        <option value="">All Categories</option>
                                        <option value="adventure" <?php echo (isset($_GET['category']) && $_GET['category'] == 'adventure') ? 'selected' : ''; ?>>Adventure</option>
                                        <option value="cultural" <?php echo (isset($_GET['category']) && $_GET['category'] == 'cultural') ? 'selected' : ''; ?>>Cultural</option>
                                        <option value="beach" <?php echo (isset($_GET['category']) && $_GET['category'] == 'beach') ? 'selected' : ''; ?>>Beach</option>
                                        <option value="mountain" <?php echo (isset($_GET['category']) && $_GET['category'] == 'mountain') ? 'selected' : ''; ?>>Mountain</option>
                                        <option value="city" <?php echo (isset($_GET['category']) && $_GET['category'] == 'city') ? 'selected' : ''; ?>>City</option>
                                    </select>
                                </div>
                                
                                <div class="mb-3">
                                    <label class="form-label">Duration (days)</label>
                                    <input type="number" name="duration" class="form-control" 
                                           value="<?php echo isset($_GET['duration']) ? $_GET['duration'] : ''; ?>" 
                                           placeholder="Enter duration">
                                </div>
                                
                                <div class="mb-3">
                                    <label class="form-label">Price Range</label>
                                    <div class="row">
                                        <div class="col-6">
                                            <input type="number" name="min_price" class="form-control" 
                                                   value="<?php echo isset($_GET['min_price']) ? $_GET['min_price'] : ''; ?>" 
                                                   placeholder="Min">
                                        </div>
                                        <div class="col-6">
                                            <input type="number" name="max_price" class="form-control" 
                                                   value="<?php echo isset($_GET['max_price']) ? $_GET['max_price'] : ''; ?>" 
                                                   placeholder="Max">
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="d-grid gap-2">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-search me-2"></i>Apply Filters
                                    </button>
                                    <a href="tours.php" class="btn btn-outline-secondary">
                                        <i class="fas fa-times me-2"></i>Clear Filters
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-9">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h4 class="mb-0"><?php echo count($tours); ?> Tours Found</h4>
                        <div class="d-flex align-items-center">
                            <label class="me-2">Sort by:</label>
                            <select class="form-select" style="width: auto;">
                                <option>Price: Low to High</option>
                                <option>Price: High to Low</option>
                                <option>Duration: Short to Long</option>
                                <option>Duration: Long to Short</option>
                            </select>
                        </div>
                    </div>
                    
                    <?php if (empty($tours)): ?>
                        <div class="text-center py-5">
                            <i class="fas fa-search fa-3x text-muted mb-3"></i>
                            <h5 class="text-muted">No tours found</h5>
                            <p class="text-muted">Try adjusting your search criteria</p>
                            <a href="tours.php" class="btn btn-primary">View All Tours</a>
                        </div>
                    <?php else: ?>
                        <div class="row">
                            <?php foreach ($tours as $tour): ?>
                            <div class="col-lg-4 col-md-6 mb-4 tour-item" data-category="<?php echo $tour['category']; ?>">
                                <div class="card tour-card h-100">
                                    <img src="<?php echo $tour['image']; ?>" class="card-img-top" alt="<?php echo $tour['title']; ?>">
                                    <div class="card-body">
                                        <div class="tour-category mb-2">
                                            <span class="badge bg-primary"><?php echo ucfirst($tour['category']); ?></span>
                                        </div>
                                        <h5 class="card-title"><?php echo $tour['title']; ?></h5>
                                        <p class="card-text text-muted"><?php echo substr($tour['description'], 0, 100); ?>...</p>
                                        <div class="tour-details d-flex justify-content-between align-items-center mb-3">
                                            <div>
                                                <i class="fas fa-clock text-muted me-1"></i>
                                                <span class="text-muted"><?php echo $tour['duration']; ?> days</span>
                                            </div>
                                            <div>
                                                <i class="fas fa-map-marker-alt text-muted me-1"></i>
                                                <span class="text-muted"><?php echo $tour['destination']; ?></span>
                                            </div>
                                        </div>
                                        <div class="tour-features mb-3">
                                            <small class="text-muted">
                                                <i class="fas fa-utensils me-1"></i>Meals included
                                                <i class="fas fa-hotel ms-3 me-1"></i>Hotel included
                                                <i class="fas fa-plane ms-3 me-1"></i>Transport included
                                            </small>
                                        </div>
                                    </div>
                                    <div class="card-footer bg-white border-0">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="price">
                                                <span class="text-primary fw-bold">₹<?php echo number_format($tour['price']); ?></span>
                                                <small class="text-muted">per person</small>
                                            </div>
                                            <div>
                                                <a href="tour-details.php?id=<?php echo $tour['id']; ?>" class="btn btn-outline-primary btn-sm me-2">
                                                    View Details
                                                </a>
                                                <?php if (isLoggedIn()): ?>
                                                    <a href="book-tour.php?id=<?php echo $tour['id']; ?>" class="btn btn-primary btn-sm">
                                                        Book Now
                                                    </a>
                                                <?php else: ?>
                                                    <a href="login.php" class="btn btn-primary btn-sm">
                                                        Login to Book
                                                    </a>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                        
                        <!-- Pagination -->
                        <nav aria-label="Tours pagination" class="mt-4">
                            <ul class="pagination justify-content-center">
                                <li class="page-item disabled">
                                    <a class="page-link" href="#" tabindex="-1">Previous</a>
                                </li>
                                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item">
                                    <a class="page-link" href="#">Next</a>
                                </li>
                            </ul>
                        </nav>
                    <?php endif; ?>
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
