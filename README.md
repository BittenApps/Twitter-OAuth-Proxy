Twitter OAuth PHP Proxy
===

(This is still a draft)

How-to
---

1. Application contacts start.php, and saves the id and key.

2. User contacts userauth.php?id=[id], where [id] is the [id] supplied to the application on start.php

3. Application pings retrieve.php?id=[id]&key=[key], where [id] and [key] are the [id] and [key] received on the start.php call until a oauth key/secret can be acquired.