Installation :
1) Copy paste the Source code (anand folder) into your apache root diectory
2) Change the Mysql configuration (user name, pass & DB) in .env
3) Import the file in docs/import.sql
Thats it  :)

Usage :
Admin Login :
username: admin@admin.com
password:password
http://url_of_your_application/admin/login the admin login page (after logging in will redirect you to the admin panel)

User Login :
Manager Accounts :
username: manager1@localhost.com
password:manager1
username: manager2@localhost.com
password:manager3

Salesman Accounts :
username: salesman1@localhost.com
password:salesman1
username: salesman2@localhost.com
password:salesman2

http://url_of_your_application/login the client login page (after logging in will redirect you to the dashboard page)
http://url_of_your_application/user/signup the new user signup form (to register a new user)

If you want to add more account please login to admin panel and add new account and add permission as manager/salesman to it


Important Info :
I have user Laravel ACL concept for more info please check https://github.com/intrip/laravel-authentication-acl/blob/1.3/docs/index.md
All the module are CRUD based
UI is built using Bootstrap

