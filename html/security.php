<?php
header("X-Frame-Options: DENY");
header("Content-Security-Policy: default-src 'self';");

/*function generateCSRFToken() {
    if (empty($_SESSION['csrf_token'])) {
      if (function_exists('random_bytes')) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
      } else {
        $_SESSION['csrf_token'] = bin2hex(openssl_random_pseudo_bytes(32));
      }
    }
    return $_SESSION['csrf_token'];
}*/
?>