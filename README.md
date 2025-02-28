Social Network API

Overview:

    -This project is a RESTful API designed for a social networking platform. It provides endpoints for user authentication, profile management, and interactions between users.

Features:
    -User authentication with JWT
    -Profile creation and management
    -Posts and comments
    -Secure API endpoints

Installation:

    -make the command: composer install
    -You can directly import the database with the "forum.sql" file
    -You need to create an .env file with :
        DB_HOST= ""
        DB_NAME= ""
        DB_USER= ""
        DB_PASS= ""
        JWT_SECRET= ""

API Documentation:

    -For detailed information about API requests and responses, please refer to Swagger.html located in the project directory.

Security:

    -Uses JWT for authentication
    -Follows secure coding practices