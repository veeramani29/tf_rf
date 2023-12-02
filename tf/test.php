			
					<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <title>...::Reservation Factory</title>
  <script src="//code.jquery.com/jquery-1.9.1.min.js"></script>
  <script src='http://jqueryjs.googlecode.com/files/jquery-1.3.2.min.js' type='text/javascript'/></script>
<script src="https://www.google.com/jsapi?key=AIzaSyDtTjeCCO8w-u5BX0u5eRZJyWjJa9fr43c"></script>

   </head>
  <body>
  <div id="content"></div>


  </body>
   </html >
   
 <script type="text/javascript">
google.load("language", "1");

function initialize() {
    var content = document.getElementById('content');
    content.innerHTML = '<div id="text">Hola, me alegro mucho de verte.<\/div><div id="translation"/>';
    var text = document.getElementById("text").innerHTML;
     
    google.language.translate(text, 'es', 'en', function(result) {
        var translated = document.getElementById("translation");
       alert(result);
        if (result.translation) {
            translated.innerHTML = result.translation;
        }
    });
}
google.setOnLoadCallback(initialize);

</script>






<div id="languageBlock">
	<p>Lights go out and I can't be saved <br />
	Tides that I tried to swim against  <br />
	Brought me down upon my knees  <br />
	Oh I beg, I beg and plead </p>

	<p>Singin', come out if things aren't said  <br />
	Shoot an apple off my head  <br />
	And a, trouble that can't be named  <br />
	Tigers waitin' to be tamed </p>

	<p>Singing, yooooooooooooo ohhhhhh  <br />
	Yoooooooooooo ohhhhhh </p>

	<p>Home, home, where I wanted to go <br /> 
	Home, home, where I wanted to go  <br />
	Home, home, where I wanted to go  <br />
	Home, home, where I wanted to go</p>
</div>
  