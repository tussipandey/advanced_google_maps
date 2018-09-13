<!DOCTYPE html>
<html>
<head>
<title>nearby search</title>
<meta name="viewport" content="initial-scale=1.0,
user-scalable=no">
<meta charset="utf-8">
<style>
html, body{
height:100%;
}
#map{
height:100%;
}
    
    
    
    
    
    
    
.actions {
 background-color: #FFFFFF;
    top: 300px;
   padding: 10px;
    margin-top: 10px;
    position: absolute;
width: 200px;
    height: 250px;
    right: 10px;
    
    z-index: 2;
    border-top: 1px solid #abbbcc;

    border-left: 1px solid #a7b6c7;
    border-bottom: 1px solid #a1afbf;
    border-right: 1px solid #a7b6c7;

  
    border-radius: 12px;
}
.actions label {
    display: block;
    margin: 2px 0 5px 10px;
  text-align: left;
}
.actions input, .actions select {
    width: 85%;
}
.button {
    background-color: powderblue;
   
    background-image: linear-gradient(top, #d7e5f5, #cbe0f5);
    border-top: 1px solid #abbbcc;
    border-left: 1px solid #a7b6c7;
    border-bottom: 1px solid #a1afbf;
    border-right: 1px solid #a7b6c7;

   
    border-radius: 12px;
    box-shadow: inset 0 1px 0 0 white;
    color: #1a3e66;
    font: normal 11px "Lucida Grande", "Lucida Sans Unicode", "Lucida Sans", Geneva, Verdana, sans-serif;
    line-height: 1;
    margin-bottom: 5px;
    padding: 6px 0 7px 0;

    text-align: center;
    text-shadow: 0 1px 1px #fff;
    width: 150px;
}

.button:hover {
    background-color: green;
    
    background-image: linear-gradient(top, #ccd9e8, #c1d4e8);
    border-top: 1px solid #a1afbf;

    border-left: 1px solid #9caaba;

    border-bottom: 1px solid #96a3b3;

    border-right: 1px solid #9caaba;
    

    box-shadow: inset 0 1px 0 0 #f2f2f2;
    color: #163659;
    cursor: pointer;
}
.button:active {

    border: 1px solid #8c98a7;
   
    box-shadow: inset 0 0 4px 2px #abbccf, 0 0 1px 0 #eeeeee;
}

    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
</style>
</head>
<body>
    
    
    
    
    
    
    
<div id="map"></div>
    <div class="actions">
    <div class="button">
        <label for="where">Location</label>
        <input id="where" type="text" name="where">
        </div>
        <div id="button2" class="button" onclick="findAddress(); return false;">Search</div>
        <div class="button">
        <label for="gtype">Type</label>
            <select id="gtype">
            <option value="atm">ATM</option>
                <option value="bank">Bank</option>
                    <option value="restaurant">Restaurants</option>
                    <option value="hospital">Hospital</option>
                    <option value="police">
                        Police Station</option>
                    <option value="store">Stores</option>
                    <option value="bar">Bar</option>
            
            </select>
        </div>
        <div class="button">
        <label for="radius">Radius</label>
            <select id="radius">
            <option value="500">500</option>
                <option value="1000">1000</option>
                 <option value="1500">1500</option>
                 <option value="2000">2000</option>
                 <option value="5000">5000</option>
            </select>
        </div>
       
        <input type="hidden" id="lat" name="lat" value="12.9716">
        <input type="hidden" id="lng" name="lng" value="77.5946">
        <div id="button1" class="button" onclick="findplaces(); return false;">Search for Objects</div>
        
        
    </div>
    
    
    
    
    
    
    
    
<script
src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCmDLCp3jbSXe1IQ5znG4JWORLgoIqaIDo&libraries=places"></script>
<script
src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/j
query.min.js"></script>
<script>
    var geocoder;
    var map;
    var markers =Array();
    var infos =Array();
    var myLatLng = {lat: 12.8614515, lng: 77.6647081};
geocoder= new google.maps.Geocoder();
var mapOptions = {
center: myLatLng,
zoom: 12,
mapTypeId: google.maps.MapTypeId.ROADMAP
};
var map = new
google.maps.Map(document.getElementById('map'),
mapOptions);


    
    
   
    function clears(){
        if(markers){
            for(i in markers){
                markers[i].setMap(null);
            }
            markers =[];
            infos=[];
        }
    }
    
    function clearsi(){
        if(infos){
            for(i in infos){
              if(infos[i].getMap()){
                  infos[i].close();
              }
            }
           
        }
    }
    
    function findAddress(){
        var address = document.getElementById("where").value;
        geocoder.geocode({'address':
address},
function(results, status){
if(status ==
google.maps.GeocoderStatus.OK){
    var addrLocation = results[0].geometry.location;
    
    map.setCenter(results[0].geometry.location);
    
    document.getElementById("lat").value =results[0].geometry.location.lat();
    
    document.getElementById("lng").value =results[0].geometry.location.lng();
var addMarker = new
google.maps.Marker({
map: map,
position:
addrLocation,
    title :results[0].formatted_address
    
});
    }else{
        alert('geocode failed' +status);
    }
        });
    }
    
    
    function findplaces(){
        var type = document.getElementById("gtype").value;
        var radius = document.getElementById("radius").value;
        var lat = document.getElementById("lat").value;
         var lng = document.getElementById("lng").value;
         var cur_location = new google.maps.LatLng(lat,lng);
        
        
        var request = {
location: cur_location,
radius: radius,
types: [type]
   
};
        

service = new
google.maps.places.PlacesService(map);
service.search(request, createMarkers);
    }
function createMarkers(result, status){
if(status ==
google.maps.places.PlacesServiceStatus.OK){
    clears();
for( var i =0; i<result.length; i++){
createMarker(result[i]);
}
}else if(status== google.maps.places.PlacesServiceStatus.ZERO_RESULTS){
    alert('Sorry,nothing found');
}
}
function createMarker(obj){
var mark = new google.maps.Marker({
map: map,
position: obj.geometry.location,
    title :obj.name,
animation:
google.maps.Animation.DROP
});
    markers.push(mark);
    
    var infowindow = new google.maps.InfoWindow({
        content:'<img src=" '+obj.icon+'"/><font style="color:#000;">' +obj.name +
        '<br />Rating: ' + obj.rating + '<br />Vicinity: ' + obj.vicinity + '</font>'

    });
    
google.maps.event.addListener(mark,
"click", function(){
clearsi;
infowindow.open(map, mark);
});
    infos.push(infowindow);
}
        google.maps.event.addDomListener(window,'load',initialize);
        
        
    
    
    
    


</script>
</body>
</html>