Twitter OAuth PHP Proxy
===

(This is still a draft)

Installation
---

1. Edit inc/config.inc.php.dist, and rename it to inc/config.inc.php.

2. (Optional) Personalize finish.php.

Usage
---

1. Application contacts start.php, and saves the id and key.

2. User contacts userauth.php?id=[id], where [id] is the [id] supplied to the application on start.php. (As soon as user logs in, finish.php will be pinged and the OAuth details stored on the database.)

3. Application pings retrieve.php?id=[id]&key=[key], where [id] and [key] are the [id] and [key] received on the start.php call until a oauth key/secret can be acquired.

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