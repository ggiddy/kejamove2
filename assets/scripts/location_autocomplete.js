/**
 * Created by giddy on 25-Jul-16.
 */
/**
 *Provides google autocomplete for locations.
 *
 */
$(document).ready(function(){
    var moving_from = $('#moving_from')[0];
    var moving_to = $('#moving_to')[0];
    var options = {
        componentRestrictions: {country: 'ke'}
    };

    moving_from_autocomplete = new google.maps.places.Autocomplete(moving_from, options);
    moving_to_autocomplete = new google.maps.places.Autocomplete(moving_to, options);
});