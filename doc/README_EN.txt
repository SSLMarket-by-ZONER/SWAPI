SWAPI - SSLmarket API demo application
=====================================

You downloaded a Web-based tool for using SSLmarket API. It is designed for customers 
who need to quickly place an order (one-step) with frequently repeated data. These 
customers will benefit from the API without having to program their own intricately 
connected to the API SSLmarketu.

SWAPI does not intend to stand in the order form SSLmarketu and is not intended for 
it. The main difference is the lack of control of the input data, which takes place 
at the orders of SSLmarket.cz. Swap is intended for advanced users who know the product 
parameters and principles of each type certificate validation (DV / OV / EV).

Requirements for SWAPI
----------------------
To run the SWAPI tool server must meet following requirements:
- PHP version 5.2 and higher
- CURL module, enabled feature set 'curl_exec'
- enabled JavaScript and the current version of the Internet browser (Firefox, Chrome, Internet Explorer)

Configuring the environment
---------------------------
Configuration is saved in the 'config.php' file. You can use provided 'config.dist.php' 
file as a template. Rename the file to 'config.php' and then edit. Fill in your 
credentials for SSL Market (user id and password) and also fill in the required 
baseline data. Default order data may be the most often used. This option will 
expedite the issuing of DV certificates, for which does not matter what kind of 
information are presented (the information about company is not a part of the DV certificate).

Testing and Debugging
---------------------
For testing you can use a debug mode - simply set the parameter 'test' to true. 
Yyou will see the result of script and answer from server on screen. You can check 
whether the order data is correct or not. While the debug mode is on you will see 
the server reply, but the order is not saved in SSLmarket.

If you are not sure about the correctness of the order, or you want to check it 
before processing, just add some comment text to 'note' parameter in the order.
The order remains on hold and will not resume automatically until someone confirm 
it manually from our side. To delete such order you could contact SSLmarket support.

Safety Issues
------------------
SWAPI use for identification customer id and password only. Please note that your 
SSLMarket credentials are stored in configuration file. Connection to SSLmarket 
is encrypted (HTTPS), but security of credentials is your task. SWAPI application 
accelerates the order process, but does not care about the security of your credentials. 
If you save the login information to a configuration file, anyone capable of running 
the application has the option to place an order. Anyone with access to the file 
can view and exploit credentials data.

You can restrict access to the Web application (using the HTTP protocol in the browser) 
with .htaccess file - see the examples in the file.

If necessary, do not hesitate to contact customer support info@sslmarket.cz.
