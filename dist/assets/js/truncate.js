(function($) {

	$.fn.readMore = function(options) {

		// Options
		var defaults = {
			readMoreLinkClass: "read-more__link",
			readMoreText: "",
			readLessText: "",
			readMoreHeight: 150
		};

		// Merge deafults into options
		options = $.extend(defaults, options);

		var obj = $( this );

		/** Get the options of the selected element.
		*
		*  @param {object} refElement - An array of elements.
		*/
		function getRefElementOptions(refElement) {

			if ( typeof refElement.data( "options" ) !== "undefined" ) {
				this.collapsedHeight = refElement.data( "options" );
			} else {
				this.collapsedHeight = options.readMoreHeight;
			}

		}

		/** Create the read more link for each element selected.
		 *
		 *  @param {object} element - An array of elements.
		 */
		function addReadMoreElement(element) {

			element.each( function() {

				// Get the options for the specific element
				var $target = $( this );

				var refElementOptions = new getRefElementOptions( $target );

				// Create the read-more link
				$( this )
					.after( "<button aria-label='Read More'></button>")
					.next().addClass( options.readMoreLinkClass );
				// Set the initial state of the read more element to be collapsed
				$( this )
					.css({
					"height": refElementOptions.collapsedHeight,
					"overflow": "hidden"
					});
			});
		}

		addReadMoreElement(obj);

		// Action on clicking the read-more link
		$( "." + options.readMoreLinkClass ).click(function() {

			var $target = $( this ).prev();

			var refElementOptions = new getRefElementOptions( $target );

			// Expand or collapse the "more" text
			if ( $target.css( "overflow" ) === "hidden" ) {

				$target.css({
					"height": "auto",
					"overflow": "auto"
					});
				$target.addClass( "expanded" );
			} else {

				$target.css({
					"height": refElementOptions.collapsedHeight,
					"overflow": "hidden"
					});
				$target.removeClass( "expanded" );
			}

			// Change the "read more" word accordingly
			// if ( $( this ).text() === options.readMoreText ) {
			// 	$( this ).html( '<i class="fal fa-plus"></i>' );
			// } else {
			// 	$( this ).html( '<i class="fal fa-minus"></i>' );
			// }

		});
	};

})(jQuery);


$('.staff__bio-full--accordion').readMore({
  readMoreLinkClass:"staff__more-link",
});