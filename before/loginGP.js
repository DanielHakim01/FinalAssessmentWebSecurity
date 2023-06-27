function validate()
{
  var username = document.getElementById('admin').value;
  var password = document.getElementById('password').value;
  if(username == "admin" && password == "password")
  {
    alert("log in successful");
    window.location.href="menuGP.html";
    return false;
  }

  else {
    
      alert("log in failed");
    
  }
}
