<!DOCTYPE html>
<html>
    <head>
        <title>API </title>
    <h1 style="color:orangered"><b>Testing Different API's</b></h1><br></br>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <title></title>
         
        <style>body{background-image: url(fire.jpg)} h3{color: orangered} </style>
    </head>
  
    
    <div class="row" style="alignment: center" >
        <div class="col-sm-4" style="color:#6600ff" >
            <h3><b>Favorites Spots</b></h3>
      <p>
      <form method="get" action="map.php">
          <br><b>Company Name: </b><br><br>&nbsp;<input name="name" type="text" style="border-radius: 5px;width: 239px; height: 30px" /><br>
                  <br><b>Company Address: </b><br><br>&nbsp;<input name="address" type="text" style="border-radius: 5px;width: 239px; height: 30px" /><br>
    
                  <br><b>Company Description:</b> <br><br>&nbsp;<input name="descrip" type="text" style="border-radius: 5px;width: 239px; height: 30px" /><br>
            <br>&nbsp;<input type="submit" name="submit" style="border-radius: 5px; background-color: orangered" value="Add to Favorites" />
        </form>
    </p>
    <form method="get" action=" map.php"><input type="submit" name="display"style="border-radius: 5px; background-color: orangered" value="Display Favorites" /></form>
    
    <?php
    
    if(isset($_GET['submit'])){
        
        $coName = $_GET['name'];
    
        $coDescrip = $_GET['descrip'];
   
        $address = $_GET['address'];
        $address = urlencode($address);
        $url = 'http://maps.googleapis.com/maps/api/geocode/json?address=' .$address. "&senor=false";
        $gencode = file_get_contents($url);
        $results = json_decode($gencode, true);

        if($results['status'] == 'OK'){
            $lat = $results['results'][0]['geometry']['location']['lat'];
            $lng = $results['results'][0]['geometry']['location']['lng'];
        }  
    

        $coName = stripcslashes($coName);
    
        $coDescrip= stripcslashes($coDescrip);

        $coName = mysql_real_escape_string($coName);
        $coDescrip = mysql_real_escape_string($coDescrip);
        $lat = mysql_real_escape_string($lat);
        $lng = mysql_real_escape_string($lng);

        $dbUser = "root";
        $dbPass = "troot";
        $dbDatabase = "fav_places";
        $dbHost = "localhost";
        
        $dbConn = new mysqli("$dbHost","$dbUser", "$dbPass","$dbDatabase");
 
        if($dbConn->connect_error){
            echo "Failed to conect to MYSQL:". $dbConn->connect_error;
        }
    
        $insert = "INSERT INTO places_info (name, latitude, longitude, descrip)
                VALUES ('$coName','$lat','$lng','$coDescrip')";
        
        //echo $insert ;
    
        if($dbConn->query($insert)== false){
            echo $dbConn->error. "<br>";
        }
    }
    ?>
    
    </div>
           <div class="col-sm-4" style="color:#6600ff">
               <h3><b>Twitter Search</b></h3>
      <p>
      <form method="get" action="Twitter.php">
          <br><b>Specify Keyword:</b> <br><br>&nbsp;<input name="key" type="text" style="border-radius: 5px;width: 239px; height: 30px" /><br>
          <br><b>Specify Latitude: </b><br><br>&nbsp;<input name="lat" type="text" style="border-radius: 5px;width: 239px; height: 30px" /><br>
          <br><b>Specify Longitude: </b><br><br>&nbsp;<input name="lng" type="text" style="border-radius: 5px;width: 239px; height: 30px" /><br>
          <br><b>Specify Range: </b><br><br>&nbsp;<input name="range" type="text" style="border-radius: 5px;width: 239px; height: 30px" /><br>
	<br>&nbsp;<input type="submit" name="hashSearch"style="border-radius: 5px; background-color: orangered" value="Search" />
      </form>
    </p>
    </div>
           
    <div class="col-sm-4" style="color: #6600ff" >
        <h3><b>Foursquare</b></h3> 
      <p>
      <form action="Foursquare.php" method="get">
          <br><b>Specify Keyword: </b><br><br>&nbsp;<input name="query" type="text" style="border-radius: 5px;width: 239px; height: 30px" /><br>
          <br><b>Specify City Name: </b><br><br>&nbsp;<input name="near" type="text" style="border-radius: 5px;width: 239px; height: 30px" /><br>
          <br><b>Specify Range: </b><br><br>&nbsp;<input name="radius" type="text" style="border-radius: 5px;width: 239px; height: 30px" /><br>
    <br>&nbsp;<input type="submit" name="fourSearch"style="border-radius: 5px; background-color: orangered" value="Search" />
      </form>
    </p>
    </div>
  </div> 
    </body>
</html>
