jQuery(document).ready(function() {

    //alert("Ide gas");
    // var deo = document.getElementById("#sakrij");
    
    // if(jQuery("#sakrij") != null) {
    //     jQuery("#sakrij").hide();
    // }
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
    // jQuery(".sakrivanje").hide();

    // jQuery("#L").change(function() {
    //     if(this.ckecked) {
    //         jQuery(".sakrivanje").toggle();
    //     }      
    // });


    // myFunction();
    // function myFunction() {
    //     var x = document.getElementById("sakrij");
    //     if (x.style.display === "none") {
    //         x.style.display = "block";
    //     } else {
    //         x.style.display = "none";
    //     }
    // }
});
