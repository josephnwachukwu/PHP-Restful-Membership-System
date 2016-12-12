# PHP-Restful-Membership-System

A Restful Services System for membership using PHP and MySQL. it utilizes Rest.inc.php written by Arun Kumar Sekar

##Prerequisites 

You will need a webserver running PHP4+ and MySQL.
I suggest that you use PhpMyAdmin to administer the database.

##Getting started

Download the latest code from [here](https://github.com/josephnwachukwu/PHP-Restful-Membership-System)

##Installation

1. First install the .htacces file in the root directory of your site or append the contents of the file to your current .htacess file.

2. Next open db.php and enter the settings for your MySQL database by filling out each of the four fields. this is necessary in order to run the setup.php

3. Next install api.php, Rest.inc.php, db.php, setup.php, and functions.php files in the services folder of your site

4. Next run setup.php by navigating to it in the browser

5. Next open any rest client such as Advanced Rest Client and call the test function or call the test function in the browser

6. Next you will have to open the api.php file and make sure all the session settings are correct. you will also need to make sure that the php.mail() settings are correct.

> php mail settings vary from server to server please check with your hosting company to see if using mail() is permitted or if you need to have any additional settings. 

##api.php

###Functions

####login
* searches for the username
* md5s the posted password and compares it to the one in the database
* when found creates the session and sends back the user data

####logout
* kills the php session and sends the appropriate logout message

####register
* inserts the data into the database
* sends an email to the new user to confirm
* sends an email to the owner alerting him of a new member


####forgotPassword

####confirmMembership

####updateProfile
* finds the users profile by id and updates the information with the post data.

####changePassword


## Author

* **Joseph Nwachukwu** - *Initial work* - [Joseph's Github](https://github.com/josephnwachukwu)

## License

This project is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details
