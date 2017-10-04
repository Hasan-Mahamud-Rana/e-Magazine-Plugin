var minHeight = jQuery('figure.mySingleMagazine').parent().parent().attr('class').match(/\d+/);
jQuery('figure.mySingleMagazine a').css( "min-height", minHeight+"px" );