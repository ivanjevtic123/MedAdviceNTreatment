//Filip Kojic 0285/2018
jQuery(document).ready(function() {

    if(jQuery("#tableNalazi") != null) {
        jQuery("#tableNalazi").hide();
    }

    if(jQuery((("#tableNalazi") != null) && (("#prikaziNalaze") != null))) {
        jQuery("#prikaziNalaze").click(function() {
            jQuery("#tableNalazi").toggle("slow");
        });
    }
});
