<!DOCTYPE html>
<html>
    <head>
    <h1>Favorite Spots Using Google API
        <form action="index.php">
          <input type="submit" name="homeG" style="border-radius: 50%; background-color: white"value="Home"/>
    </form>
    </h1>
        <style>body{background-image: url(google.png) } h3{color: green} </style>
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
        <script type="text/javascript" src="http://maps.google.com/maps/api/js?key=AIzaSyBGujDL0_L8qzW5mgdSB9FIpsqVggeYLOo"></script>
        <script type="text/javascript" src="gmaps.js"></script>
    </head>
    <div id ="map" style="width:1019px; height: 622px"></div>
         <body>
         <script type = "text/javascript">
           $(document).ready(function(){
            var map = new GMaps({
            div: '#map',
            lat: 34.3,
            lng: -118.14,
            zoom: 4,
      });
      
      <?php
      if(!empty($_GET['submit'])){
          echo "Thank you for Adding Your Favorite Spots";
      }
    
          
      $dbUser = "root";
            $dbPass = "troot";
            $dbDatabase = "fav_places";
            $dbHost = "localhost";
    
            $dbConn2 = mysql_connect($dbHost, $dbUser, $dbPass);
    
            if($dbConn2){
                mysql_select_db($dbDatabase);
            }
            else{
                die("<strong>Error:<strong> Couldn't not connect to DB. ");
            }
        
    
            $select = mysql_query("SELECT * FROM places_info")
                or die("failed to query DB " .  mysql_error());
    
            $adds = array();
    
            while($row = mysql_fetch_array($select)){
        
                
                 echo "map.addMarker({\n";
                echo "lat:".$row['latitude'].",\n";
                 echo "lng:". $row['longitude'].",\n";
                echo "title:'". $row['name']."',\n";
            
                echo "});";
          
           }
           
           echo  "\n });" ;
      
           ?>
       </script>
       <form method="get">
           <br>Keyword Display: <br><br>&nbsp;<input name="key" type="text" style="width: 239px; height: 30px" /><br>
            <br>&nbsp;<input type="submit" name="showAll" value="Keyword Display" />
         
       </form>
       <div id ="fav_map" style="width: 600px; height:200"></div>
       
       <script type = "text/javascript">
           $(document).ready(function(){
            var fav_map = new GMaps({
            div: '#map',
            lat: 34.3,
            lng: -118.14,
            zoom: 5,
      });
  
       <?php
       
        if(!empty($_GET['showAll'] && !empty($_GET['key']))){
            $keyword = $_GET['key'];
            $keyword= stripcslashes($keyword);
            $keyword = mysql_real_escape_string($keyword);
            
            $dbUser = "root";
            $dbPass = "troot";
            $dbDatabase = "fav_places";
            $dbHost = "localhost";
    
            $dbConn2 = mysql_connect($dbHost, $dbUser, $dbPass);
    
            if($dbConn2){
                mysql_select_db($dbDatabase);
            }
            else{
                die("<strong>Error:<strong> Couldn't not connect to DB. ");
            }
        
    
            $select_key = mysql_query("SELECT * FROM `places_info` WHERE descrip LIKE '%".$keyword."%'")
                or die("failed to query DB " .  mysql_error());
    
            $adds = array();
    
            while($row = mysql_fetch_array($select_key)){
        
                
                 echo "fav_map.addMarker({\n";
                echo "lat:".$row['latitude'].",\n";
                 echo "lng:". $row['longitude'].",\n";
                echo "title:'". $row['name']."',\n";
            
                echo "});";
                
                
           
           }
           
           echo  "\n });" ;
       
        }
        ?>
       
</script>
    </body>
</html>
