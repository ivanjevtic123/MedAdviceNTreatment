//Ivan Jevtic 0550/2018
jQuery(document).ready(function() {

    if((jQuery(".sakrivanje") != null) && (jQuery("#L"))) {
        jQuery(".sakrivanje").hide();
    }
    
    if((jQuery(".sakrivanje") != null) && (jQuery("#L"))) {
        jQuery("#L").change(function() {
            jQuery(".sakrivanje").show();      
        });
    }
    
    if((jQuery(".sakrivanje") != null) && (jQuery("#P"))) {
        jQuery("#P").change(function() {
            jQuery(".sakrivanje").hide();      
        });
    }

    if((jQuery(".sakrivanje") != null) && (jQuery("#M"))) {
        jQuery("#M").change(function() {
            jQuery(".sakrivanje").hide();      
        });
    }
    

});
