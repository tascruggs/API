// using twitter api to search for tweets related to a keyword given by user in a area
<html>
    <head>
    <title> Twitter Search</title>
    <h1><b>Twitter Search</b>
        <form action="index.php">
            <input type="submit" name="homeT"  style="border-radius: 50%; background-color: white"value="Home"/>
    </form>
    </h1>
    <style>body{background-image: url(twittercloud.png) } h1{color: whitesmoke} </style>
    </head>

<body><b>
<?php


require_once('TwitterAPIExchange.php');

/** Set access tokens here  **/

$settings = array(
'oauth_access_token' => "2153503403-glr8uMYc90hO41RW0TAAntHJ4dVqszuLSieXWlp",
'oauth_access_token_secret' => "mPW0ejex9bNgw81mYxBHZogGv1OnRm1FHnQ1YAFhCFY8g",
'consumer_key' => "XoNTb4fyh6nXSWrJbI3ah2GM9",
'consumer_secret' => "SqzaX7LJeIGCCwRfKi9oIKrbKpxn82CHHmbKbxAPQb04AfnYYj"
);

$url = "https://api.twitter.com/1.1/search/tweets.json";


$requestMethod = "GET";

$name = $_GET['key'];


$getfield = "?q=".$name."&geocode=".$_GET['lat'].",".$_GET['lng'].",".$_GET['range']."mi"."&count=100";

$twitter = new TwitterAPIExchange($settings);

$string = json_decode($twitter->setGetfield($getfield)->buildOauth($url, $requestMethod)->performRequest(),TRUE);


//echo "<pre>";
//print_r($string);
//echo "</pre>";

foreach($string as $item)
{
   for($i=0; $i<=sizeof($item); $i++){
       
       if(array_key_exists($i,$item)){
       
        echo "Time and Date of Tweet: ".$item[$i]['created_at']."<br />";
        echo "Tweet: ".$item[$i]['text']."<br />";
        echo "Source: ". $item[$i]['source']."<br />";
        echo "Geo Location: ".$item[$i]['geo']['coordinates'][0]."  ".$item[$i]['geo']['coordinates'][1]."<br />";
        echo "Place: ".$item[$i]['place']['full_name']."<br />";
        echo "Tweeted by: ".$item[$i]['user']['name']."<br />";
        echo "Screen name: ". $item[$i]['user']['screen_name']."<br />";
        echo "Followers: ".$item[$i]['user']['followers_count']."<br />";
        echo "Friends: ". $item[$i]['user']['friends_count']."<br />";
        echo "Listed: ".$item[$i]['user']['listed_count']."<br /><hr />";
      }
   }  
}





?>

</b>
</body>
</html>
