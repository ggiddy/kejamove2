/**
 * Calculate distance between origin and destination.
 *
 */
$(document).ready(function(){
    $('#phone').on('focusin', function(){
        var geocoder = new google.maps.Geocoder();
        var moving_from = $('#moving_from').val();
        var moving_to = $('#moving_to').val();

        if(moving_from.length > 0 && moving_to.length > 0){
            var coordinates = [];

            //moving from
            getCoordinates(moving_from, geocoder).then(function(results){
                moving_from_coordinates = {};
                moving_from_coordinates['lat'] = results.geometry.location.lat();
                moving_from_coordinates['lng'] = results.geometry.location.lng();
                window.localStorage.setItem('moving_from', JSON.stringify(moving_from_coordinates));
                coordinates.push({'moving_from': moving_from_coordinates});
            }, function (err) {
                alert('There was a problem with the request. \n Please refresh the page and try again.');
            });

            //moving to
            getCoordinates(moving_to, geocoder).then(function(results){
                moving_to_coordinates = {};
                moving_to_coordinates['lat'] = results.geometry.location.lat();
                moving_to_coordinates['lng'] = results.geometry.location.lng();
                window.localStorage.setItem('moving_to', JSON.stringify(moving_to_coordinates));
                coordinates.push({'moving_to': moving_to_coordinates});

                var origin = new google.maps.LatLng(coordinates[0]['moving_from']);

                var destination = new google.maps.LatLng(coordinates[1]['moving_to']);

                var service = new google.maps.DistanceMatrixService();
                service.getDistanceMatrix(
                    {
                        origins: [origin],
                        destinations: [destination],
                        travelMode: google.maps.TravelMode.DRIVING
                    }, callback);

                function callback(response, status) {
                    $('#distance').val(Math.round((response.rows[0].elements[0].distance.value)/1000));
                    $('#submit_request').removeAttr('disabled');
                }
            }, function (err) {
                alert('There was a problem with the request. \n Please refresh the page and try again.');
            });

        }
    });

    /**
     * Get the coordinates of a place given the address.
     *
     * @param address The address.
     * @param geocoder Geocoder object.
     */
    function getCoordinates(address, geocoder) {

        return $.Deferred(function(dfrd){
            geocoder.geocode({address: address}, function(results, status) {
                if (status == google.maps.GeocoderStatus.OK) {
                    dfrd.resolve(results[0]);
                } else {
                    dfrd.reject(new Error(status));
                }

            });
        }).promise();
    }
});
