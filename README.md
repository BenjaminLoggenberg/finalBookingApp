# finalBookingApp

## Overview
**finalBookingApp** is a PHP-based hotel booking application designed to streamline user registration, hotel search, and reservation management. Ideal for small to medium-sized hotels or individuals wanting a simple booking solution, the app includes user authentication, booking management, and a basic profile system.

## Technologies Used
- **PHP**: Main language for server-side application logic.
- **MySQL**: Database management for storing user data, hotel details, and bookings.
- **HTML/CSS & JavaScript**: Front-end technologies for creating an interactive user interface.
  
## Prerequisites
- **Server Environment**: Ensure you have a server supporting PHP (such as Apache).
- **Database**: MySQL server installed and configured.

## Installation
1. **Clone the repository**:
   ```bash
   git clone https://github.com/BenjaminLoggenberg/finalBookingApp.git
   cd finalBookingApp
   ```

2. **Database Setup**:
   - Import the SQL schema provided in `database.sql` to set up the necessary tables.
   - Configure database connection in `config.php` by specifying your MySQL server details.

3. **Server Configuration**:
   - Deploy the application on a server with PHP and MySQL support (e.g., XAMPP, WAMP, or a cloud-based server).
   - Run the application by accessing `index.php` in a browser.

## Usage Guide
1. **Registration**: 
   - New users can register by clicking the "Sign Up" button and completing the form.
   
2. **Login**:
   - Existing users log in with registered credentials to access booking options.

3. **Booking a Hotel**:
   - Browse available hotels and select the desired one.
   - Choose dates, room options, and finalize the booking.

4. **Profile Management**:
   - Update personal information and view booking history in the user profile section.

## License
[MIT License](LICENSE)
