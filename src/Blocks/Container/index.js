import { __ } from '@wordpress/i18n';
import { Fragment } from '@wordpress/element';
import { registerBlockType } from '@wordpress/blocks';
import { InnerBlocks, InspectorControls, useBlockProps } from '@wordpress/block-editor';
import { PanelBody, ToggleControl } from '@wordpress/components';

import block from './block.json';

registerBlockType( block, {
	edit: ( { attributes, setAttributes } ) => {
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
					<InnerBlocks/>
				</div>

			</Fragment>
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
