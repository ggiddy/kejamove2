/**
 *This scripts generates a front end quote for the user to view.
 */

$(document).ready(function(){

    //constants
    var PICKUP_BASE_CHARGE = 1500;
    var CANTER_BASE_CHARGE = 2500;
    var FH_BASE_CHARGE = 4500;
    var PICKUP_HELPERS = 2;
    var CANTER_HELPERS = 4;
    var FH_HELPERS = 5;
    var HELPER_CHARGE = 800;
    var PICKUP_PACKAGING = 3000;
    var CANTER_PACKAGING =  3500;
    var FH_PACKAGING = 6500;
    var HOUSE_CLEANING_COST = 2000;
    var INTERIOR_DECORATOR_COST = 2000;

    //Get Variables
    var bedrooms = $('#house_size').val();
    var distance = $('#distance').val();
    var house_cleaning_inst = $('#house_cleaning');
    var interior_dec_inst = $('#interior_decorator');
    var total_cost = 0;

    //show email input
    $('#mail_to_self').change(function(){
        if($('#email_quote').is(':checked')){
            $('#email_txt').removeClass('hidden');
            $('#send_mail').removeClass('hidden');
        } else {
            $('#email_txt').addClass('hidden');
            $('#send_mail').addClass('hidden');
        }
    });
    //function that calculates distance charge
    function distance_charge_calc(distance) {
        //minimum moving distance is 3km
        if(distance < 3){distance=3}
        var increament = 5;
        if(distance < 100){increament = 5}
        if(distance > 100 && distance <= 200){increament = 4}
        if(distance > 200 && distance <= 300){increament = 3}
        if(distance > 300 && distance <= 500){increament = 2}
        if(distance > 500){increament = 1}

        var distance_cost=0;
        var dis = 0;
        while(dis < distance){
            dis+=increament;
            distance_cost += 18085*Math.pow(dis, -1.183);
        }

        return Math.ceil(distance_cost);
    }

    //house size logic
    switch(bedrooms){
        case '0': //bedsitter
            //base charge base + 2 helpers
            var base_charge = PICKUP_BASE_CHARGE + PICKUP_HELPERS*HELPER_CHARGE + PICKUP_PACKAGING;
            $('#base_charge_label').removeClass('hidden');
            $('#base_charge_cost').text(base_charge.toLocaleString() + '/=');

            //distance charge
            var distance_charge = distance_charge_calc(distance);
            $('#distance_charge_label').removeClass('hidden');
            $('#distance_charge_cost').text(distance_charge.toLocaleString() + '/=');

            //calculate total cost
            total_cost = base_charge + distance_charge;
            //house cleaning and interior decorator
            house_cleaning_inst.change(function(){
                if(house_cleaning_inst.is(':checked')){
                    $('#cleaning_label').removeClass('hidden');
                    $('#cleaning_cost').text(HOUSE_CLEANING_COST.toLocaleString() + '/=');
                    total_cost += HOUSE_CLEANING_COST;
                    $('#subtotal').text(total_cost.toLocaleString() + '/=');
                } else {
                    location.reload();
                    total_cost = base_charge + distance_charge;
                    $('#cleaning_label').addClass('hidden');
                    $('#cleaning_cost').text('');
                    $('#subtotal').text(total_cost.toLocaleString() + '/=');
                }

            });

            interior_dec_inst.change(function(){
                if(interior_dec_inst.is(':checked')){
                    $('#decorator_label').removeClass('hidden');
                    $('#decorator_cost').text(HOUSE_CLEANING_COST.toLocaleString() + '/=');
                    total_cost += INTERIOR_DECORATOR_COST;
                    $('#subtotal').text(total_cost.toLocaleString() + '/=');
                } else {
                    location.reload();
                    total_cost = base_charge + distance_charge;
                    $('#decorator_label').addClass('hidden');
                    $('#decorator_cost').text('');
                    $('#subtotal').text(total_cost.toLocaleString() + '/=');
                }
            });

            //subtotal
            $('#labels_hr').removeClass('hidden');
            $('#subtotal_label').removeClass('hidden');
            $('#values_hr').removeClass('hidden');
            $('#subtotal').text(total_cost.toLocaleString() + '/=');

            break;

        case '1': //1 bedroom
            var base_charge = CANTER_BASE_CHARGE + CANTER_HELPERS*HELPER_CHARGE + CANTER_PACKAGING;
            $('#base_charge_label').removeClass('hidden');
            $('#base_charge_cost').text(base_charge.toLocaleString() + '/=');

            //distance charge
            var distance_charge = distance_charge_calc(distance);
            $('#distance_charge_label').removeClass('hidden');
            $('#distance_charge_cost').text(distance_charge.toLocaleString() + '/=');

            //calculate total cost
            total_cost = base_charge + distance_charge;
            //house cleaning and interior decorator
            house_cleaning_inst.change(function(){
                if(house_cleaning_inst.is(':checked')){
                    $('#cleaning_label').removeClass('hidden');
                    $('#cleaning_cost').text(HOUSE_CLEANING_COST.toLocaleString() + '/=');
                    total_cost += HOUSE_CLEANING_COST;
                    $('#subtotal').text(total_cost.toLocaleString() + '/=');
                } else {
                    location.reload();
                    total_cost = base_charge + distance_charge;
                    $('#cleaning_label').addClass('hidden');
                    $('#cleaning_cost').text('');
                    $('#subtotal').text(total_cost.toLocaleString() + '/=');
                }

            });

            interior_dec_inst.change(function(){
                if(interior_dec_inst.is(':checked')){
                    $('#decorator_label').removeClass('hidden');
                    $('#decorator_cost').text(HOUSE_CLEANING_COST.toLocaleString() + '/=');
                    total_cost += INTERIOR_DECORATOR_COST;
                    $('#subtotal').text(total_cost.toLocaleString() + '/=');
                } else {
                    location.reload();
                    total_cost = base_charge + distance_charge;
                    $('#decorator_label').addClass('hidden');
                    $('#decorator_cost').text('');
                    $('#subtotal').text(total_cost.toLocaleString() + '/=');
                }
            });

            //subtotal
            $('#labels_hr').removeClass('hidden');
            $('#subtotal_label').removeClass('hidden');
            $('#values_hr').removeClass('hidden');
            $('#subtotal').text(total_cost.toLocaleString() + '/=');

            break;

        case '2':
            var base_charge = FH_BASE_CHARGE + FH_HELPERS*HELPER_CHARGE + FH_PACKAGING;
            $('#base_charge_label').removeClass('hidden');
            $('#base_charge_cost').text(base_charge.toLocaleString() + '/=');

            //distance charge
            var distance_charge = distance_charge_calc(distance);
            $('#distance_charge_label').removeClass('hidden');
            $('#distance_charge_cost').text(distance_charge.toLocaleString() + '/=');

            //calculate total cost
            total_cost = base_charge + distance_charge;
            //house cleaning and interior decorator
            house_cleaning_inst.change(function(){
                if(house_cleaning_inst.is(':checked')){
                    $('#cleaning_label').removeClass('hidden');
                    $('#cleaning_cost').text(HOUSE_CLEANING_COST.toLocaleString() + '/=');
                    total_cost += HOUSE_CLEANING_COST;
                    $('#subtotal').text(total_cost.toLocaleString() + '/=');
                } else {
                    location.reload();
                    total_cost = base_charge + distance_charge;
                    $('#cleaning_label').addClass('hidden');
                    $('#cleaning_cost').text('');
                    $('#subtotal').text(total_cost.toLocaleString() + '/=');
                }

            });

            interior_dec_inst.change(function(){
                if(interior_dec_inst.is(':checked')){
                    $('#decorator_label').removeClass('hidden');
                    $('#decorator_cost').text(HOUSE_CLEANING_COST.toLocaleString() + '/=');
                    total_cost += INTERIOR_DECORATOR_COST;
                    $('#subtotal').text(total_cost.toLocaleString() + '/=');
                } else {
                    location.reload();
                    total_cost = base_charge + distance_charge;
                    $('#decorator_label').addClass('hidden');
                    $('#decorator_cost').text('');
                    $('#subtotal').text(total_cost.toLocaleString() + '/=');
                }
            });

            //subtotal
            $('#labels_hr').removeClass('hidden');
            $('#subtotal_label').removeClass('hidden');
            $('#values_hr').removeClass('hidden');
            $('#subtotal').text(total_cost.toLocaleString() + '/=');
            //base charge
            break;

        default:
    }
});