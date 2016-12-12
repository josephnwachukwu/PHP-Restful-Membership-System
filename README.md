# ![logo](https://raw.githubusercontent.com/josephnwachukwu/PHP-Restful-Membership-System/master/porcupine.png) Restful Membership- ystem

A Restful Services System for membership using PHP and MySQL.

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


###Api Calls

####login
* searches the database to for the username and md5'd password
* if it finds the username in the database it will return the row with all the users data or it will return json saying user not found
* next it will check to see what level access you have, whether you are an admin a regular user or you are suspended
* next of your privileges are good then a session will be created and it will send back the proper json data

####logout
* kills the php session with session destroy and sends the appropriate logout message

####register
* checks the database to see if the username and email is already taken
* if email and usernames are unique it inserts data into database with a randomly generated 32 character string that will be used to confirm
* if query is successful then the data is reselected from the database if the data comes back properly an email is sent to the new member asking to confirm their membership
* if the email goes through then the message is sent back to the json saying that the account has been created.


####forgotPassword
* checks the email against the database to see if it exists 
* if the entry is found a temporary password is generated and is updated against the users information in the database
* an email is sent to the user with the link to reset the password

####confirmMembership
* checks the database agaist the user id from the query params
* if it exists in the database check the active flag
* if already active it will display a message saying the user is already active
* if not active it will activate the user by changing the active flag.

####confirmPassword
* checks database against the id given
* if the data is found it then updates the password with the new password from input.
* if the query is successful it sends the appropriate json message.

####updateProfile
* finds the users profile by id and updates the information with the post data.


##Utilizaion

###Calling with angular 1.x
```javascript
var payload = {
  "username": "joseph",
  "password": "lamborghini"
  }
 $http.post('http://yoursite.com/services/login', payload)
  .success(function(data){
    $scope.data = data
  })
  .error(function(data){
  
  })
```
###Calling with jQuery
```
var payload = {
  "username": "joseph",
  "password": "lamborghini"
  }
  
  $post('http://yoursite.com/services/login', payload);
  .done(function( data ) {
    var content = $JSON.parse( data )
  })
```
##Tasks

- [x] Update the htaccess file.
- [X] Document all functions
- [ ] Convert all mysql calls from mysql/mysqli to PDO

## Author

* **Joseph Nwachukwu** - *Initial work* - [Joseph's Github](https://github.com/josephnwachukwu)

## License

This project is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details
