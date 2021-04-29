<?php
    $w = null;
    $error = null;
    if(array_key_exists('submit', $_GET)){
      if(!$_GET['city']){
        $error = "Sorry Your input Field is Empty";
      }
      else if($_GET['city'])
      {
        $data = file_get_contents("http://api.openweathermap.org/data/2.5/weather?q=". $_GET['city']."&appid=3130961b497ac01e8b59a2873d4c6e7c");
        $weather = json_decode($data,true);
        if ($weather['cod'] == 200) {
          $temp = $weather['main']['temp'] - 273;
          $w = "<b>".$weather['name'].", ".$weather['sys']['country']. " : </b>".$temp."&deg;C <br>";
          $w .= "<b> Weather Condition: </b>".$weather['weather']['0']['description']."<br>";
          $w .= "<b> Atomosperic Pressure : </b>".$weather['main']['pressure']. " hPa <br>";
          $w .= "<b> Wind Speed : </b>".$weather['wind']['speed']. " meter/sec <br>";
          $w .= "<b> Cloudness : </b>".$weather['clouds']['all']. "% <br>";
          date_default_timezone_set('Asia/Dhaka');
          $w .= "<b> Sunrise : </b>".date("g:i a" , $weather['sys']['sunrise']);
          $w .= "<b> Sunset : </b>".date("g:i a" , $weather['sys']['sunset']) ."<br>";
          $w .= "<b> Current Date and Time : </b>".date("F j, Y, g:i a");
        }
        else{
          $error ="Sorry...!! Could Not find out the Location ";
        }
      }
    }
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

    <title>Weather Details</title>
    <style>
        body{
              margin: 0px;
              padding: 0px;
              box-sizing: border-box;
              background-image: url(./backIMG.jpg);
              font-family: 'Times New Roman', Times, serif;
              font-size: large;
              color: white;
              background-size: cover;
              background-attachment: fixed;
            }
            .container{
              text-align: center;
              justify-content: center;
              align-items: center;
              width: 440px;
            }
            h1{
              font-weight: 700;
              margin-top: 150px;
            }
            input{
            width: 350px;
            padding: 5px;
        }
    </style>
  </head>
  <body>
    <div class="container">
        <h1>Search Global Weather</h1>
        <form action=""method ="GET">
            <p><label for="city">Enter your city Name</label></p>
            <p><input type="text" name="city" id="city" placeholder="City Name"></p>
            <button type="submit" name="submit" class=" btn btn-secondary">Submit</button>
            <p></p>
            <div class="output"> 
            <?php
              if($w)
              {
                echo '<div class="alert alert-success" role="alert">'. $w.'</div>';
              }
              if($error){
                echo '<div class="alert alert-danger" role="alert">'. $error.'</div>';
              }
              ?>
            </div>
        </form>
    </div>
    
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>
  </body>
</html>