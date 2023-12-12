
jQuery( document ).ready(function( $ ) {
    $( function() {
        $( ".mydatepicker" ).datepicker({
        changeMonth: true,
        changeYear: true,
        dateFormat: 'dd-mm-yy'
        });
    } );
});