<!DOCTYPE html>
<html>
<head>
<style>
body {
    background-color: lightblue;
}
</style>
  <meta charset="utf-8">
  <title>Foursquare Search</title>
  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
  <script type="text/javascript" src="http://maps.google.com/maps/api/js?key=AIzaSyDw__NHqvfgFy9O_i_Q0bs8vaTOTSPSJQU"></script>
  <script type="text/javascript" src="gmaps.js"></script>

  <form method="get" action="">

    <br><center>Keyword:
    <input type="text" name="query"  style="width: 200px; height: 19px"></center><br>
    <br><center>City Name:
    <input type="text" name="near"  style="width: 200px; height: 19px"></center><br>
    <br><center>Radius (<100,000 meters):
    <input type="text" name="radius"  style="width: 150px; height: 19px"></center><br>

    <br>
    <center><input type="submit" value="Search (Foursquare API)"  style="width: 246px; height: 40px" /></center<br>
    </form>
    <div id="map" style="width: 2000px; height: 622px"></div>


  <script type="text/javascript">

  $(document).ready(function()
  {
        map = new GMaps({
        div: '#map',
        lat: 34.3,
        lng: -118.14,
        zoom:3,
      });


  <?php

  $client_id ='N51TH0OVGBS0OP01PDTP1OURMSLKYCOY2XLZCGD2Q5P0JSVB' ;
  $client_secret = 'EY5UQPOPFNIKJFVNS1R2ITGLMC2ITEJO2D2IWHHU5IC3QTPC' ;

  $url = 'https://api.foursquare.com/v2/venues/search';     //set the resource link
  $url .= '?query='.urlencode($_GET['query']) ;                      //   set GET parameters
  $url .= '&near='.urlencode($_GET['near']) ;                        //   set GET parameters
  $url .= '&radius='.$_GET['radius'] ;                                       //   set GET parameters
  $url .= '&client_id='.$client_id ;                                           //   set GET parameters
  $url .= '&client_secret='.$client_secret ;                           //   set GET parameters
  $url .= '&v=20160926' ;                                                  //   set GET parameters  //specify today’s date

  $file = file_get_contents($url);
  $data = json_decode($file, true);
  $items= $data['response']['venues'];                   // can you understand it?
  $size = count($items);

  // loop  through all the returned businesses
  foreach ($items as $item)
  {
    echo "map.addMarker({\n";
      echo "lat:".$item["location"]['lat'].",\n";
      echo "lng:".$item["location"]['lng'].",\n";
      $name = str_replace("'","\'", $item["name"]);
      echo "title:'".$name."',\n";

      if(isset($item["contact"]["phone"]))
      {
        $phone = $item["contact"]["formattedPhone"];
      }
      if(isset($item["location"]["address"])){
        $address = $item["location"]["address"];
      }
      echo "});\n";
  }

?>

});

</script>
</body>
</html>
