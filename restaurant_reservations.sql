-- Create Customers Table
CREATE TABLE Customers (
    customerId INT NOT NULL UNIQUE AUTO_INCREMENT,
    customerName VARCHAR(45) NOT NULL,
    contactInfo VARCHAR(200),
    PRIMARY KEY (customerId)
);

-- Create Reservations Table
CREATE TABLE Reservations (
    reservationId INT NOT NULL UNIQUE AUTO_INCREMENT,
    customerId INT NOT NULL,
    reservationTime DATETIME NOT NULL,
    numberOfGuests INT NOT NULL,
    specialRequests VARCHAR(200),
    PRIMARY KEY (reservationId),
    FOREIGN KEY (customerId) REFERENCES Customers(customerId)
);

-- Create DiningPreferences Table
CREATE TABLE DiningPreferences (
    preferenceId INT NOT NULL UNIQUE AUTO_INCREMENT,
    customerId INT NOT NULL,
    favoriteTable VARCHAR(45),
    dietaryRestrictions VARCHAR(200),
    PRIMARY KEY (preferenceId),
    FOREIGN KEY (customerId) REFERENCES Customers(customerId)
);

INSERT INTO Customers(customerName, contactInfo) VALUES
('Frank Daniel', 'frank.daniel@gmail.com'),
('Kelvin Daniel', 'kelvin.daniel@gmail.com'),
('Juliet Daniel', 'juliet.daniel@gmail.com');

-- Insert values into Reservations table
INSERT INTO Reservations (customerId, reservationTime, numberOfGuests, specialRequests) VALUES
(1, '2024-12-20 19:00:00', 4, 'Birthday celebration'),
(2, '2024-12-21 18:30:00', 2, 'Window seat, please'),
(3, '2024-12-22 20:00:00', 3, 'Vegan options requested');

-- Insert values into DiningPreferences table
INSERT INTO DiningPreferences (customerId, favoriteTable, dietaryRestrictions) VALUES
(1, 'Table 5', 'No peanuts'),
(2, 'Table 2', 'Gluten-free'),
(3, 'Table 8', 'Vegetarian'); 
