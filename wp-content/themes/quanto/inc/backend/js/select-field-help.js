!( function($) {
	'use strict';

	// Services
	$( function() {
		var $selectCat_help = $( '.select-categories-help' ),
			$inputCat_help = $( '.wpb-input-help' );

		if( ! $( 'body' ).find( $selectCat_help ).length > 0 )  {
			return;
		}

		$( 'body' ).find( '.wpb_el_type_select_cate' ).each( function( ) {
						
			$( this ).find( $selectCat_help ).attr( 'multiple', 'multiple' );
		
			$( this ).find( $selectCat_help ).select2();

			var help_center_cate = [],
				mutiValue = $(this).find( $inputCat_help ).val();

			if( mutiValue.indexOf( ',' ) ) {
				mutiValue = mutiValue.split( ',' );
			}
			if( mutiValue.length > 0 ) {
				for( var i = 0; i < mutiValue.length; i++ ) {
					help_center_cate.push( mutiValue[i] );
				}
			}

			$(this).find( $selectCat_help ).val( help_center_cate ).trigger("change");

			$(this).find( $selectCat_help ).on( 'change', function( e ) {
				$(this).parent().find( $inputCat_help ).val( $(this).val() );
			} );
		} );
	} );

} )(window.jQuery);
