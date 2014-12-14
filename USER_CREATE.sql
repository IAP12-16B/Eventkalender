CREATE USER 'eventkalender'@'localhost' IDENTIFIED BY '12345';
GRANT SELECT, UPDATE, INSERT, DELETE ON `Eventkalender`.* TO 'eventkalender'@'localhost';
FLUSH PRIVILEGES;
