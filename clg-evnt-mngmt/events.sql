CREATE TABLE events (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(255) NOT NULL,
  slots INT NOT NULL,
  description TEXT NOT NULL,
  imageUrl VARCHAR(255) NOT NULL
);

CREATE INDEX event_name_index ON events (name);

CREATE TABLE registrations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    event VARCHAR(255) NOT NULL,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    rollNo VARCHAR(20) NOT NULL,
    contactNo VARCHAR(20) NOT NULL,
    branch VARCHAR(100) NOT NULL,
    yearOfStudy VARCHAR(20) NOT NULL,
    registration_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    UNIQUE(event, rollNo),
    FOREIGN KEY (event) REFERENCES events(name)
);

