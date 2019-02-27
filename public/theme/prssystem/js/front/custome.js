var CSRF_TOKEN=CSRF_TOKEN;
var POST_LOCATION_URL=POST_LOCATION_URL;
//METHOD FOR CHANGE THE CATEGORY LIST ON THE FILTER PAGE

 
function getList(v){
	$('#catForm').submit();
}
	
	
	
function getLocationArea(lat,lng){
//console.log(url);
//console.log(postJson);
var postJson={_token:CSRF_TOKEN,lat:lat,lng:lng};
$.ajax({
	type:'POST',
	url:POST_LOCATION_URL,
	data:postJson,        
	success:function(res){
		var result = JSON.parse(res);
		if(result.error=='success'){
			//$('#location').html(result.data.political+, +result.data.locality+,+result.data.administrative_area_level_1+, +result.data.postal_code);
			$('#location').html(result.data.formatted_address);
			$('#headlocation').html('<span class="icon-location-pin"></span> '+result.data.locality+', '+result.data.postal_code);
			$('#myInput2').val('<span class="icon-location-pin"></span> '+result.data.political);
			//console.log(result.data.formatted_address);
		}
	}
});
};

var x = document.getElementById("demo");
getLocation();
function getLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);
		
    } else { 
        x.innerHTML = "Geolocation is not supported by this browser.";
    }
}

function showPosition(position) {
	var lat = position.coords.latitude;
	var lng = position.coords.longitude;
	getLocationArea(lat,lng);
    //x.innerHTML = "Latitude: " + position.coords.latitude + 
    //"<br>Longitude: " + position.coords.longitude;
}


function parseURLParams(url) {
    var queryStart = url.indexOf("?") + 1,
        queryEnd   = url.indexOf("#") + 1 || url.length + 1,
        query = url.slice(queryStart, queryEnd - 1),
        pairs = query.replace(/\+/g, " ").split("&"),
        parms = {}, i, n, v, nv;

    if (query === url || query === "") return;

    for (i = 0; i < pairs.length; i++) {
        nv = pairs[i].split("=", 2);
        n = decodeURIComponent(nv[0]);
        v = decodeURIComponent(nv[1]);

        if (!parms.hasOwnProperty(n)) parms[n] = [];
        parms[n].push(nv.length === 2 ? v : null);
    }
    return parms;
}
var urlString = "http://maps.googleapis.com/maps/api/geocode/json?latlng=28.6219683,77.4266391&sensor=true";
    urlParams = parseURLParams(urlString);

	
