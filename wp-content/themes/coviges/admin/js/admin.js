(function($) {

	"use strict";
    
    jQuery('#naxos_home_section').hide();
    
    jQuery('#page_template').on('change', function() {
        var selected = $('#page_template option:selected').val();

        if (selected==='templates/front.php') {
            jQuery('#naxos_home_section').fadeIn(200);
        } else {
            jQuery('#naxos_home_section').hide();
        }
    }).trigger('change');

})(jQuery);