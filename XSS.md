### 4. XSS Prevention 

## To prevent XSS, we do not echo back our user's inputs back to them. This can avoid reflected XSS.

## Asides from reflected XSS, another common XSS attack is stored XSS. To avoid this we sanitize user input. This can be found in user registration & login, and booking for venue.


In confirm.php

-----
    <label for="fullName">Full Name:</label>
    <input type="text" id="fullName" name="fullName" pattern="[A-Za-z ]+" title="Please enter letters and spaces only" required>

      <br><br>

      <label for="matricID">Matric ID:</label>
      <input type="text" id="matricID" name="matricID" pattern="[0-9]+" title="Please enter numbers only" required>
      <br><br>


-----
