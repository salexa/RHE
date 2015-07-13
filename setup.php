<html><head><title>Setting up database</title></head><body>

<h3>Setting up...</h3>

<?php // Example 21-3: setup.php
include_once 'functions_rhe.php';

createTable('ItemsForSale',
            'itemid INT NOT NULL AUTO_INCREMENT,
            itemname VARCHAR(24),
            description VARCHAR(4096),
            price VARCHAR(12),
            city VARCHAR(24),
            state VARCHAR(2),
            postdate DATETIME NOT NULL,
            useremail VARCHAR(50),
            category VARCHAR(20),
            salephoto VARCHAR(30),
            salephotoB VARCHAR(20),
            salephotoC VARCHAR(20),
            status VARCHAR(15),
            userKey VARCHAR(11),
            PRIMARY KEY (itemid),
            INDEX(itemname(6))');

createTable('ItemsForWanted',
            'itemid INT NOT NULL AUTO_INCREMENT,
            itemname VARCHAR(24),
            description VACHAR(4096),
            price VARCHAR(12),
            city VARCHAR(24),
            state VARCHAR(2),
            postdate DATETIME NOT NULL,
            useremail VARCHAR(50),
            category VARCHAR(20),
            wantedphoto VARCHAR(30),
            PRIMARY KEY (itemid),
            INDEX(itemname(6))');


?>

<br />...done.
</body></html>
