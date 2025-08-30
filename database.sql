-- Database setup for Saarthi Voyages Tours & Travels Booking System

-- Create database
CREATE DATABASE IF NOT EXISTS tours_booking;
USE tours_booking;

-- Users table
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    phone VARCHAR(20),
    role ENUM('user', 'admin') DEFAULT 'user',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Tours table
CREATE TABLE tours (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(200) NOT NULL,
    description TEXT,
    destination VARCHAR(100) NOT NULL,
    category ENUM('adventure', 'cultural', 'beach', 'mountain', 'city') NOT NULL,
    duration INT NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    image VARCHAR(255),
    featured BOOLEAN DEFAULT FALSE,
    status ENUM('active', 'inactive') DEFAULT 'active',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Bookings table
CREATE TABLE bookings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    tour_id INT NOT NULL,
    booking_date DATE NOT NULL,
    num_people INT NOT NULL,
    total_amount DECIMAL(10,2) NOT NULL,
    status ENUM('pending', 'confirmed', 'cancelled', 'completed') DEFAULT 'pending',
    special_requests TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (tour_id) REFERENCES tours(id) ON DELETE CASCADE
);

-- Reviews table
CREATE TABLE reviews (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    tour_id INT NOT NULL,
    rating INT NOT NULL CHECK (rating >= 1 AND rating <= 5),
    comment TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (tour_id) REFERENCES tours(id) ON DELETE CASCADE
);

-- Insert sample data

-- Sample users
INSERT INTO users (name, email, password, phone, role) VALUES
('Admin User', 'admin@saarthivoyages.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '+1234567890', 'admin'),
('John Doe', 'john@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '+1234567891', 'user'),
('Jane Smith', 'jane@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '+1234567892', 'user');

-- Sample tours
INSERT INTO tours (title, description, destination, category, duration, price, image, featured) VALUES
('Paris Adventure', 'Experience the magic of Paris with our comprehensive city tour. Visit the Eiffel Tower, Louvre Museum, Notre-Dame Cathedral, and more iconic landmarks. Enjoy guided tours, skip-the-line access, and authentic French cuisine.', 'Paris, France', 'city', 5, 1299.99, 'https://images.unsplash.com/photo-1502602898534-47d22c27d1f2?ixlib=rb-4.0.3&auto=format&fit=crop&w=2074&q=80', 1),
('Bali Cultural Experience', 'Immerse yourself in the rich culture of Bali. Visit ancient temples, traditional villages, rice terraces, and experience local customs and traditions. Includes traditional dance performances and cooking classes.', 'Bali, Indonesia', 'cultural', 7, 899.99, 'https://images.unsplash.com/photo-1537953773345-d172ccf13cf1?ixlib=rb-4.0.3&auto=format&fit=crop&w=2074&q=80', 1),
('Swiss Alps Adventure', 'Conquer the majestic Swiss Alps with our adventure tour. Enjoy hiking, mountain biking, and breathtaking views. Stay in charming mountain lodges and experience authentic Swiss hospitality.', 'Swiss Alps', 'mountain', 6, 1499.99, 'https://images.unsplash.com/photo-1506905925346-21bda4d32df4?ixlib=rb-4.0.3&auto=format&fit=crop&w=2074&q=80', 1),
('Maldives Beach Paradise', 'Relax in the pristine beaches of Maldives. Stay in overwater bungalows, enjoy water sports, snorkeling, and spa treatments. Perfect for a romantic getaway or peaceful retreat.', 'Maldives', 'beach', 8, 2499.99, 'https://images.unsplash.com/photo-1514282401047-d79a71a590e8?ixlib=rb-4.0.3&auto=format&fit=crop&w=2074&q=80', 1),
('New Zealand Adventure', 'Explore the stunning landscapes of New Zealand. From fjords to mountains, beaches to forests, experience the best of both islands. Includes adventure activities like bungee jumping and jet boating.', 'New Zealand', 'adventure', 10, 1899.99, 'https://images.unsplash.com/photo-1506905925346-21bda4d32df4?ixlib=rb-4.0.3&auto=format&fit=crop&w=2074&q=80', 1),
('Tokyo City Explorer', 'Discover the vibrant city of Tokyo with our comprehensive tour. Visit modern districts, ancient temples, and experience the unique blend of tradition and technology. Includes sushi-making classes and tea ceremonies.', 'Tokyo, Japan', 'city', 6, 1599.99, 'https://images.unsplash.com/photo-1540959733332-eab4deabeeaf?ixlib=rb-4.0.3&auto=format&fit=crop&w=2074&q=80', 0),
('Machu Picchu Trek', 'Embark on an unforgettable journey to the ancient Incan citadel of Machu Picchu. Trek through the Andes mountains, explore ancient ruins, and learn about Incan history and culture.', 'Peru', 'adventure', 7, 1299.99, 'https://images.unsplash.com/photo-1587595431973-160d0d94add1?ixlib=rb-4.0.3&auto=format&fit=crop&w=2074&q=80', 0),
('Santorini Sunset', 'Experience the magical sunsets of Santorini. Stay in traditional white-washed buildings, explore volcanic beaches, and enjoy Mediterranean cuisine. Perfect for romance and relaxation.', 'Santorini, Greece', 'beach', 5, 1799.99, 'https://images.unsplash.com/photo-1570077188670-e3a8d69ac5ff?ixlib=rb-4.0.3&auto=format&fit=crop&w=2074&q=80', 0);

-- Sample bookings
INSERT INTO bookings (user_id, tour_id, booking_date, num_people, total_amount, status) VALUES
(2, 1, '2024-06-15', 2, 2599.98, 'confirmed'),
(3, 3, '2024-07-20', 1, 1499.99, 'pending'),
(2, 5, '2024-08-10', 4, 7599.96, 'confirmed');

-- Sample reviews
INSERT INTO reviews (user_id, tour_id, rating, comment) VALUES
(2, 1, 5, 'Amazing experience! The tour was well-organized and our guide was very knowledgeable about Paris history.'),
(3, 3, 4, 'Great adventure in the Swiss Alps. The views were breathtaking and the activities were well-planned.'),
(2, 5, 5, 'New Zealand was incredible! The landscapes are stunning and the adventure activities were thrilling.');

-- Create indexes for better performance
CREATE INDEX idx_tours_category ON tours(category);
CREATE INDEX idx_tours_featured ON tours(featured);
CREATE INDEX idx_bookings_user_id ON bookings(user_id);
CREATE INDEX idx_bookings_tour_id ON bookings(tour_id);
CREATE INDEX idx_reviews_tour_id ON reviews(tour_id);
