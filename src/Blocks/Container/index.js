const { __ } = wp.i18n;
const { Fragment } = wp.element;
const { useSelect } = wp.data;
const { registerBlockType } = wp.blocks;
const { InspectorControls, useBlockProps, InnerBlocks } = wp.blockEditor;
const { PanelBody, ToggleControl, TextControl, SelectControl } = wp.components;

import block from './block.json';

registerBlockType( block, {
	edit: ( { attributes, setAttributes, clientId, ...props } ) => {
		const blockProps = useBlockProps();

		const {
			lockTemplate,
			hasBlocks,
		} = attributes;

		return (
			<Fragment>
				<InspectorControls>
					<PanelBody title={ block.title }>
						<ToggleControl
							label={ __( 'Lock Template', 'block-factory' ) }
							checked={ lockTemplate }
							onChange={ lockTemplate => setAttributes( { lockTemplate } ) }
							help={ __( 'Disable block layout editing.', 'block-factory' ) }
						/>
					</PanelBody>
				</InspectorControls>

				<div { ...blockProps }>
					<InnerBlocks />
				</div>

			</Fragment>
		);
	},
	save: ( { attributes } ) => {

		const blockProps = useBlockProps.save();

		return (

			<div { ...blockProps }>
				<InnerBlocks.Content/>
			</div>
		);
	},
} );
