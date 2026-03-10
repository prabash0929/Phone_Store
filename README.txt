Phone Store Demo - Upgraded project
----------------------------------
1. Import 'schema.sql' into your MySQL (phpMyAdmin) to create database and sample data.
   - Database name: phone_store_demo
   - Default admin: username=admin password=admin123

2. Put this folder into your WAMP/XAMPP www/htdocs folder (already created if you downloaded the zip).
3. Ensure PHP has file_uploads enabled if you want to add product images via admin.
4. Access site: http://localhost/phone_store_demo/index.php
5. Admin panel: http://localhost/phone_store_demo/admin/login.php

Notes:
- Edit config/db.php if your MySQL credentials differ.
- This project is a demo. For production, use password_hash, prepared statements everywhere, input validation, and CSRF protection.
