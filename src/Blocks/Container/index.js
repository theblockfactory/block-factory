import { __ } from '@wordpress/i18n';
import { registerBlockType } from '@wordpress/blocks';
import { InnerBlocks, InspectorControls, useBlockProps } from '@wordpress/block-editor';
import { PanelBody, ToggleControl, __experimentalUnitControl as UnitControl } from '@wordpress/components';
import { JustifyContentControl } from '@blockfactory/components';
import { useState } from '@wordpress/element';

const Example = () => {
	const [ value, setValue ] = useState( '10px' );

	return;
};

import block from './block.json';

registerBlockType( block, {
	category: block.category,
	edit: ( { attributes, setAttributes } ) => {
		const blockProps = useBlockProps();

		return (
			<>
				<InspectorControls>
					<PanelBody title={ __( 'Layout', 'block-factory' ) }>
						<JustifyContentControl
							justifyContent={ attributes.textAlign }
							onChange={ textAlign => setAttributes( { textAlign } ) }
						/>

						<ToggleControl
							label={ __( 'Allow to wrap to multiple lines', 'block-factory' ) }
							onChange={ flexWrap => setAttributes( { flexWrap } ) }
							checked={ attributes.flexWrap }
						/>

						<UnitControl
							label={ __( 'Padding', 'block-factory' ) }
							value={ attributes.padding }
							unit={ attributes.paddingUnit }
							onChange={ padding => setAttributes( { padding } ) }
							onUnitChange={  paddingUnit => setAttributes( { paddingUnit } ) }
						/>

					</PanelBody>
				</InspectorControls>

				<div { ...blockProps }>
					<InnerBlocks/>
				</div>
			</>
		);
	},
	save: () => {
		const blockProps = useBlockProps.save();

		return (
			<div { ...blockProps }>
				<InnerBlocks.Content/>
			</div>
		);
	},
} );
