

wp.domReady( () => {
	wp.blocks.unregisterBlockStyle( 'core/button', 'outline');
	wp.blocks.unregisterBlockStyle( 'core/button', 'fill');

	wp.blocks.registerBlockStyle( 'core/heading', [ 
		{
			name: 'default',
			label: 'Default',
			isDefault: true,
		},
		{
			name: 'alt',
			label: 'Alternate',
		},
		{
			name: 'uppercase',
			label: 'Uppercase'
		},
		{
			name: 'subheading',
			label: 'Subheading'
		}
	]);

} );
