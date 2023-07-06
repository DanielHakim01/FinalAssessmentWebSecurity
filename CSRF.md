### 5. CSRF Prevention

# Content Security Policy
CSP header sets the policy to allow content only from the same origin ('self')
Preventing clickjacking attacks (X-Frame-Options)
Enforcing a content security policy to mitigate cross-site scripting (XSS) and other code injection vulnerabilities (Content-Security-Policy).

header("Content-Security-Policy: default-src 'self';");

# X-Frame-Options

------

// header("X-Frame-Options: DENY");
------

This option specifies that the page should not be displayed in any frame or iframe. It provides the strongest protection but completely prevents the page from being embedded anywhere.

------


// header("X-Frame-Options: SAMEORIGIN");

------

 This option allows the page to be displayed in a frame or iframe only if the site embedding the page has the same origin (same domain, protocol, and port) as the page itself. It provides a balance between security and usability, allowing the page to be embedded on the same domain.

# Security Purpose 
 Control the framing behavior of your web pages and protect them from being maliciously embedded in iframes on other websites. It helps to ensure that your website is displayed within a trusted context and prevents potential security vulnerabilities.


# Shortcut
Rather than making a file containing X-Frame-Options and CSP, we insert 2 lines of code in the httpd.config file as apache configuration  and it will automatically called the CSP and X-Frame-Options in every header

------
Header always set X-Frame-Options "SAMEORIGIN" 
------

Header always set Content-Security-Policy "default-src 'self'"
------

