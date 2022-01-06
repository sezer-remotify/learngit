!( function($) {
	'use strict';

	// Services
	$( function() {
		var $selectCat_card = $( '.select-card-post' ),
			$inputCat_card = $( '.wpb-input-card' );

		if( ! $( 'body' ).find( $selectCat_card ).length > 0 )  {
			return;
		}

		$( 'body' ).find( '.wpb_el_type_select_projects_card' ).each( function( ) {
						
			$( this ).find( $selectCat_card ).attr( 'multiple', 'multiple' );
		
			$( this ).find( $selectCat_card ).select2();

			var category_card = [],
				mutiValue = $(this).find( $inputCat_card ).val();

			if( mutiValue.indexOf( ',' ) ) {
				mutiValue = mutiValue.split( ',' );
			}
			if( mutiValue.length > 0 ) {
				for( var i = 0; i < mutiValue.length; i++ ) {
					category_card.push( mutiValue[i] );
				}
			}

			$(this).find( $selectCat_card ).val( category_card ).trigger("change");

			$(this).find( $selectCat_card ).on( 'change', function( e ) {
				$(this).parent().find( $inputCat_card ).val( $(this).val() );
			} );
		} );
	} );

} )(window.jQuery);
