function sectionsFilterLayout( ) {
	jQuery( ".section-layout-type" ).each( function( ) {
		var items = jQuery( this ).parent( ).parent( );
		var name = jQuery( this ).val( );

		items.find( "[data-layout-type]" ).hide( );
		items.find( "[data-layout-type~=" + name + "]" ).show( );
	} );
}

jQuery( document ).ready( function( ) {
	
	jQuery( document ).on( "click", ".meta-item-upload", function( e ) {
		e.preventDefault( );
		var area = jQuery( this ).prev( );

		frame = wp.media( {
			title: naxos_options_lng.insert_media,
			frame: "post",
			multiple: false,
			library: { type: "image" },
			button: { text: naxos_options_lng.insert_media },
		} );

		frame.on( "close", function( data ) {
			var imageArray = [];

			images = frame.state( ).get( "selection" );
			images.each( function( image ) {
				imageArray.push( image.attributes.url );
			} );

			area.val( imageArray.join( ", " ) );
		} );

		frame.open( );
	} );
	
} );