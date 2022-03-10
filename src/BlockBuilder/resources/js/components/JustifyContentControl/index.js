import { __ } from '@wordpress/i18n';
import { Button } from '@wordpress/components';
import { justifyCenter, justifyLeft, justifyRight, justifySpaceBetween } from '@wordpress/icons';

export default ( { justifyContent, onChange } ) => {
	const justificationOptions = [
		{
			value: 'left',
			icon: justifyLeft,
			label: __( 'Justify items left', 'block-factory' ),
		},
		{
			value: 'center',
			icon: justifyCenter,
			label: __( 'Justify items center', 'block-factory' ),
		},
		{
			value: 'right',
			icon: justifyRight,
			label: __( 'Justify items right', 'block-factory' ),
		},
		{
			value: 'space-between',
			icon: justifySpaceBetween,
			label: __( 'Space between items', 'block-factory' ),
		},
	];

	return (
		<fieldset className="block-editor-hooks__flex-layout-justification-controls">
			<legend>{ __( 'Justification', 'block-factory' ) }</legend>
			<div>
				{ justificationOptions.map( ( { value, icon, label } ) => (
					<Button
						key={ value }
						label={ label }
						icon={ icon }
						isPressed={ justifyContent === value }
						onClick={ () => onChange( value ) }
					/>
				) ) }
			</div>
		</fieldset>
	);
};
