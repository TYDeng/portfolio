# CSI3140_A4 Web Application
### Group25
* Wenbo Yu 300161788

## Introduction
I chose the Hospital application. MySQL for managing data.

## How to setup application
I‘m not sure how to compile this application on windows. 
My operating system is MacOS.

#### Prerequisites:
Ensure you have PHP and MySQL installed on your system.

You should have a MySQL database server running.

Your project files should be correctly structured in a directory.

![WeChatdeae3eb37550b4a72501be3cc88e95c6](https://github.com/user-attachments/assets/8936a660-c752-4983-aab9-ef3ea9163e01)
#### First make sure change the $username and $password (in db_connect.php) into your MySQL database username and password.


#### Here is possible steps for windows.
#### 1. Set up database
Open Command Prompt or PowerShell.
      cd \path\to\project\sql
#### mysql -u root -p
#### source setup.sql;
#### 2. Start the php
Open Command Prompt or PowerShell.
#### cd \path\to\project
#### php -S localhost:8000
#### Open a web browser and navigate to http://localhost:8000.
### For macos:
Open Terminal.
#### mysql -u root -p < /path/to/your/sql/setup.sql
#### cd /path/to/project
#### php -S localhost:8000
#### Open a web browser and navigate to http://localhost:8000.
## Log in page
### For admin: Username: admin; password: adminpass
### For patient: Patient name; Patient code (created by admin)
![3441722469719_ pic](https://github.com/user-attachments/assets/83bf3ca2-76ad-4deb-8e66-422831f7bd50)

## Admin perspective:
![WeChat0da8411cb9b11e392d4976992f0cc44e](https://github.com/user-attachments/assets/fa30a353-ec11-42c4-9dc4-dcf9080c5e85)

## Patient perspective
![3461722470896_ pic](https://github.com/user-attachments/assets/dca8c038-b4c5-459e-95c3-f5ec0244720e)







