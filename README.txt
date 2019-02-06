1. This project is completed with HTML, JavaScript with JQuery, PHP and MySQL.
2. The Portal page is the login.html
3. Information of the MySQL database is hardcoded in the PHP files. Please modify before test.
4. The database table form is:
Table name: application_users
fields:
user_id: primary key auto increment
register_time: date not null
username: varchar(40) not null
email: varchar(40) not null
user_password: varchar(40) not null
user_type: (user or manager) varchar(40) not null
upload_file: varchar(40)

5. manager is not allowed to register (can only be directly insert into mysql table)
6. the validation is accomplished with a JQuery plugin.