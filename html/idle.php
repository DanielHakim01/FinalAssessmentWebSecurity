<?php
session_start();

// Get the idle timeout in seconds
$idleTimeout = 100; // 1 minute
  
    
// Check if session is active
if (isset($_SESSION['username'])) 
{
  // Check if last activity timestamp is set
  if (isset($_SESSION['last_activity'])) 
  {
    // Get the current timestamp
    $currentTimestamp = time();
  

    // Calculate the idle time
    $idleTime = $currentTimestamp - $_SESSION['last_activity'];
  
    if ($idleTime >= $idleTimeout) 
    {
      // Session is idle, destroy it and redirect to login page
      session_unset();
      session_destroy();
      session_write_close(); // Close the session file
      setcookie(session_name(), '', 0, '/'); // Destroy the session cookie
      header("Location: loginGP.html?error=Session expired due to inactivity.");
      exit();        
    } 
    else 
    {
      // Update last activity timestamp
     $_SESSION['last_activity'] = $currentTimestamp;    
    }
          
  } else 
  {
    // Set the last activity timestamp
     $_SESSION['last_activity'] = time();
          
  }
} else       
{
  // Session is not active, redirect to login page
  header("Location: loginGP.html");
  exit();
        
}
?>