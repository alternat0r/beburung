beburung
========

This program allow you to manage your twitter bot easily. It is PHP-CLI based program that run in terminal/console to naturally look geekz style.

Usage
=====

Change the following configuration (config.php) according to your need:

<?php
	define('CONSUMER_KEY', 'REPLACE_WITH_YOUR_KEY_HERE');
	define('CONSUMER_SECRET', 'REPLACE_WITH_YOUR_SECRET_KEY_HERE');
	define('ACCESS_TOKEN', 'REPLACE_WITH_YOUR_TOKEN_HERE');
	define('ACCESS_TOKEN_SECRET', 'REPLACE_WITH_YOUR_TOKEN_SECRET_HERE');
	define('TWITTER_USERNAME', 'REPLACE_WITH_YOUR_TWITTER_USERNAME'); //without @ symbol, example: alternat0r
?>

Example:

<?php
	define('CONSUMER_KEY', 'C7RghQy3pfJJ1IQexIzFgQ');
	define('CONSUMER_SECRET', 'BgckMPde0NEcw9kasegfTQkGLg07DxXsmldsMoaoBU');
	define('ACCESS_TOKEN', '2345430378-20o6Fc5yG7U6RsXsEF25Gvokc6PJ9JcGnBZJrZy');
	define('ACCESS_TOKEN_SECRET', 'XdvwsvZbRKOFE8yhtKE0FA07VD0kbLsgt7crKcQ43A2bi');
	define('TWITTER_USERNAME', 'alternat0r'); //without @ symbol, example: alternat0r
?>

Run it
======

Depend on operating system that you use:

Windows:
Use run.bat to launch the bot and start twitting.

Linux:
Use run.sh to launch the bot and start twitting.

NOTE: I just leave it open-source so that everybody can improve it for their need.