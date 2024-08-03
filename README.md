# User Management System

A comprehensive user management system built using HTML, CSS, JavaScript (jQuery), PHP, Redis, and MongoDB. This system allows users to register, log in, update their profiles, and view their profile details.

## Features

- **User Registration**: New users can register with their details.
- **User Login**: Registered users can log in with their email and password.
- **Profile Update**: Users can update their profile details.
- **Profile View**: Users can view their profile details on a dedicated page.
- **Edit Profile**: Users can edit their profile details from the profile view page.

## Technologies Used

- **Frontend**: HTML, CSS, JavaScript (jQuery)
- **Backend**: PHP
- **Database**: MongoDB
- **Cache**: Redis
- **Session Management**: Browser Local Storage


3. **Install Dependencies**:
- Make sure you have PHP, MongoDB, and Redis installed on your system.
- Install PHP dependencies using Composer (if any).
- Configure your Redis and MongoDB services to start automatically.

4. **Configure the Project**:
- Update the database configuration in your PHP scripts (`login.php`, `register.php`, `profile.php`, `update_profile.php`) if necessary.
- Make sure the MongoDB client is properly required in your PHP scripts:
  ```php
  require_once __DIR__ . '/../vendor/autoload.php';
  ```

5. **Start the Server**:
- Use a local server environment like XAMPP or MAMP.
- Place the project files in the server's root directory (e.g., `htdocs` for XAMPP).


## Usage

### Registration

1. Navigate to the registration page by clicking the "Register" button on the home page.
2. Fill in the registration form and submit.

### Login

1. Navigate to the login page by clicking the "Login" button on the home page.
2. Enter your email and password to log in.

### Profile Update

1. After logging in, you will be redirected to the profile view page.
2. Submit the form to save changes.

### View Profile

1. After logging in, you can view your profile details on the profile view page.
2. Click the "Home" button to return to the home page.
3.Click the "Edit Profile" button to update your profile details.

## Screenshots

![Index Page](screenshots/home.png)
![Register Page](screenshots/register.png)
![Login Page](screenshots/login.png)
![Profile View Page](screenshots/view_profile.png)
![Profile Update Page](screenshots/update_profile.png)





## Acknowledgements
- [Bootstrap]for the CSS framework.
- [jQuery] for simplifying JavaScript.
- [MongoDB & SQL] for the  database.
- [Redis] for caching.


