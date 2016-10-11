//Creating a app using different api
//this page is the front page allowing user to use one of three api's (Google, Twitter and Foursquare)
<html>
    
    
    <head> 
        <meta charset="utf-8">
        <title> Foursquare Search</title>
    <h1><b>Foursquare Search</b>
    <form action="index.php">
          <input type="submit" name="4home" style="border-radius: 50%; background-color: white"value="Home"/>
    </form></h1>
        <style>body{background-image: url(foursquare.png) } h1{color: #ff3385} </style>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
 <script type="text/javascript" src="http://maps.google.com/maps/api/js?key=AIzaSyBGujDL0_L8qzW5mgdSB9FIpsqVggeYLOo"></script>
<script type="text/javascript" src="gmaps.js"></script>

<div id ="map" style="width:1019px; height: 622px"></div>

</head>

<body>
<script type ="text/javascript">
    $(document).ready(function(){
           map = new GMaps({
           div: '#map',
           lat: 33,
           lng: -84,
           zoom: 5,
        });
        
        
        
        
  
<?php


if(isset($_GET['query'])&&(isset($_GET['near']))&&(isset($_GET['radius']))&& (isset($_GET['fourSearch']))){


    $client_id ='LLLH1C4MLEJMCC1P1NH2RXCGFCCLYTNPWVWVL3O54JHQO5VL' ;
    $client_secret = 'OX5GB0ZYCSFIFYBVXA42JKSLGX4T2TG2DRUZOTROP3FTIUJU' ;

    $url = 'https://api.foursquare.com/v2/venues/search';  
    $url .= '?query='.urlencode($_GET['query']) ;                     
    $url .= '&near='.urlencode($_GET['near']) ;                    
    $url .= '&radius='.$_GET['radius'] ;                                   
    $url .= '&client_id='.$client_id ;                                         
    $url .= '&client_secret='.$client_secret ;                           
    $url .= '&v=20161011' ;                                                            

    $file = file_get_contents($url);
    $data = json_decode($file, true);
    $items = $data['response']['venues'];
    $size = count($items);
    
    if($size > 0){
        foreach ($items as $i){
            echo "map.addMarker({\n";
            echo "lat: ". $i["location"]["lat"].",\n";
            echo "lng: ". $i["location"]["lng"].",\n";
            echo "infoWindow:{\n";
        echo "content: '<p>lat: ".$i["location"]["lat"]."lng: ".$i["location"]["lng"]. "</p>'}\n";
        echo "});\n";
        }
    } 
    else{
        echo "Nothing Found";
    }
}    
?>
        
});

</script>
</body>
</html>
