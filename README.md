Twitter OAuth PHP Proxy
===

PHP OAuth Proxy for systems without keyboard input.

Installation
---

1. Edit inc/config.inc.php.dist, and rename it to inc/config.inc.php.

2. (Optional, but Recommended!) Personalize finish.php.

Usage
---

1. A keyboardless application contacts start.php, and saves the id and key (passed on as a JSON dictionary).

2. The keyboardless application requests the user to contact userauth.php?id=[id], where [id] is the [id] supplied to the application on start.php. 

3. As soon as user accesses the link and logs on to Twitter, finish.php will be called as part of the authentication process and the OAuth details stored on the database.

3. The keyboardless application should be pinging retrieve.php?id=[id]&key=[key] every second or so, depending on whatever is acceptable UX for you, where [id] and [key] are the [id] and [key] received on the start.php. This should be done until the server replies with a OAuth key/secret.

4. The keyboardless application may now use these details to log on to Twitter!

SQL Table
---

    CREATE TABLE IF NOT EXISTS `flow` (
        `id` int(8) NOT NULL AUTO_INCREMENT,
        `key` varchar(256) NOT NULL,
        `oauth_token` varchar(128) NOT NULL,
        `oauth_token_secret` varchar(128) NOT NULL,
        `access_token` varchar(128) NOT NULL,
        `access_token_secret` varchar(128) NOT NULL,
    PRIMARY KEY (`id`));
