## About BikeAnon

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- Allow user login, using path -> /api/auth/login (POST)
    - Email: admin@gmail.com (Role Admin)
    - Email: user@gmail.com (Role User)
    - Both Passwords: 123456
- Information about current user, using path -> /api/auth/me
- Logout, using path -> /api/auth/logout
- Refresh the current token, using path -> /api/auth/refresh
- Make a path, where a login user can upload a csv file, using the following path -> /api/csv (POST), the body must contain the following data:
    - name
    - csv_file (Must be a csv file, and max size is 2MB)
    
Once the file is upload, a email will be send it to the admin, with the number of rows in this file, also this file is save in server along a reference in the database.
You should add in .env, the mailtrap credentials and JWT_SECRET=YGK7gw5JULl8Xf5RO94DWO8U9SWMSwU7E7OH60n4OMdt7NaGqqF9XDoFAtDDaEq2 or execute:

- php artisan jwt:secret

### Version 1.2
- Fix response key, when a file is upload.
