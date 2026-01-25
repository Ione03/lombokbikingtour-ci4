#!/bin/bash

# Database Setup Script for CodeIgniter 4 Migration
# This script will create the MySQL database user with correct permissions

echo "========================================="
echo "CodeIgniter 4 Database Setup"
echo "========================================="
echo ""
echo "This script will set up the database user for the CI4 application."
echo "You will be prompted for your MySQL root password."
echo ""

# Check if MySQL is running
if ! systemctl is-active --quiet mysql; then
    echo "MySQL is not running. Starting MySQL..."
    sudo systemctl start mysql
    if [ $? -ne 0 ]; then
        echo "Failed to start MySQL. Please start it manually."
        exit 1
    fi
fi

# Create database and user
echo "Creating database and user..."
mysql -u root -p <<EOF
-- Create database if it doesn't exist
CREATE DATABASE IF NOT EXISTS lombokbi_dblombokbiking;

-- Drop user if exists (to recreate with correct password)
DROP USER IF EXISTS 'lombokbi'@'localhost';

-- Create user with password
CREATE USER 'lombokbi'@'localhost' IDENTIFIED BY 'Iwanantri03';

-- Grant all privileges
GRANT ALL PRIVILEGES ON lombokbi_dblombokbiking.* TO 'lombokbi'@'localhost';

-- Flush privileges
FLUSH PRIVILEGES;

-- Show created user
SELECT User, Host FROM mysql.user WHERE User='lombokbi';
EOF

if [ $? -eq 0 ]; then
    echo ""
    echo "========================================="
    echo "✓ Database setup completed successfully!"
    echo "========================================="
    echo ""
    echo "Database: lombokbi_dblombokbiking"
    echo "User: lombokbi"
    echo "Password: Iwanantri03"
    echo ""
    echo "If you need to import the database, run:"
    echo "mysql -u lombokbi -p lombokbi_dblombokbiking < /path/to/dblombokbikingtour.sql"
    echo ""
else
    echo ""
    echo "========================================="
    echo "✗ Database setup failed!"
    echo "========================================="
    echo ""
    echo "Please check your MySQL root password and try again."
    exit 1
fi
