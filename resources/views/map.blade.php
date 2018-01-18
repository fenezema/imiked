<script src="http://maps.google.com/maps/api/js"></script>

<div id="map"></div>
<!-- {!! Mapper::render() !!} -->

<script>
    function initMap() 
    {
      getLocation();
    }

    function getLocation() 
    {
        if (navigator.geolocation)
        {
            navigator.geolocation.getCurrentPosition(showPosition2, showError);
        }
        else 
        {
            view.innerHTML = "Yah browsernya ngga support Geolocation bro!";
        }

    }

    function showPosition2(position) 
    {
        var lati = position.coords.latitude;
        var longi = position.coords.longitude;
        var map = new google.maps.Map(document.getElementById('map'), 
        {
          zoom: 18,
          center: {lat: lati, lng: longi}
        });
        var geocoder = new google.maps.Geocoder;
        var infowindow = new google.maps.InfoWindow;

        document.getElementById('button1').addEventListener('click', function() 
        {
          geocodeLatLng(geocoder, map, infowindow, lati, longi);
          
        });
    }
 
    function showError(error) 
    {
      switch(error.code)
      {
        case error.PERMISSION_DENIED:
          view.innerHTML = "Yah, mau deteksi lokasi tapi ga boleh :("
          break;
        case error.POSITION_UNAVAILABLE:
          view.innerHTML = "Yah, Info lokasimu nggak bisa ditemukan nih"
          break;
        case error.TIMEOUT:
          view.innerHTML = "Requestnya timeout bro"
          break;
        case error.UNKNOWN_ERROR:
          view.innerHTML = "An unknown error occurred."
          break;
      }
    }

    function geocodeLatLng(geocoder, map, infowindow, lati, longi)
    {
      var latlng = {lat: lati, lng: longi};
      geocoder.geocode({'location': latlng}, function(results, status)
      {
        if (status === 'OK') 
        {
          if (results[1]) 
          {
            map.setZoom(18);
            var marker = new google.maps.Marker({
              position: latlng,
              map: map
            });
            infowindow.setContent(results[0].formatted_address);

            infowindow.open(map, marker);

            var alamat_=results[0].formatted_address;
            var alamat__ = alamat_.split(',');
            var panjang_kotah=alamat__.length;
            var kecah=alamat__[panjang_kotah-4];
            var kotah=alamat__[panjang_kotah-3];
            if(kecah===" Kec. Kota Kediri" || kecah===" Mojoroto" || kecah===" Pesantren"){
              kotah="Kota Kediri";
            }
            console.log(kecah);
            console.log(kotah);
            $('#lokasi').val(alamat_);
            $('#kotah').val(kotah);
            $('#kecah').val(kecah);
            $('#lat').val(lati);
            $('#lon').val(longi);
            $('#lokasi2').empty();
            $('#lokasi2').append(alamat_);
            $('#ketlokasi').show();
          } 
          else 
          {
            window.alert('No results found');
          }
        } 
        else 
        {
          window.alert('Geocoder failed due to: ' + status);
        }
      });
    }
    
    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDKZ_EO7i_GnSTbyGarNz8g1c6JqlXcho4&callback=initMap">
    </script>