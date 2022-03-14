import { __ } from '@wordpress/i18n';
import { useEffect } from '@wordpress/element';
import { dispatch, useSelect } from '@wordpress/data';
import { registerBlockType } from '@wordpress/blocks';
import { InnerBlocks, InspectorControls, useBlockProps } from '@wordpress/block-editor';
import { __experimentalUnitControl as UnitControl, PanelBody, ToggleControl } from '@wordpress/components';
import { JustifyContentControl } from '@blockfactory/components';

import block from './block.json';

registerBlockType( block, {
	category: block.category,
	edit: ( { attributes, setAttributes, ...props } ) => {
		const blockProps = useBlockProps();
		const blockCount = useSelect( select => select( 'core/block-editor' ).getBlockCount( props.clientId ) );

		useEffect( () => {
			// Remove invalid template notice
			dispatch( 'core/block-editor' ).setTemplateValidity( true );
		}, [] );

		const styles = {
			display: 'flex',
			padding: attributes.padding,
			justifyContent: attributes.justifyContent
		}

		return (
			<>
				<InspectorControls>
					<PanelBody title={ __( 'Layout', 'block-factory' ) }>
						<JustifyContentControl
							justifyContent={ attributes.justifyContent }
							onChange={ justifyContent => setAttributes( { justifyContent } ) }
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
							onUnitChange={ paddingUnit => setAttributes( { paddingUnit } ) }
						/>

					</PanelBody>

					<PanelBody title={ __( 'Visibility Conditions', 'block-factory' ) }>
						<p>
							{ __( 'Control the visibility of this block based on conditions', 'block-factory' ) }.
						</p>
					</PanelBody>
				</InspectorControls>

				<div { ...blockProps }>
					{ blockCount === 0 && (
						<div>Insert some blocks, man!</div>
					) }
					<div style={styles}>
						<InnerBlocks templateLock={ attributes.meta?.bf_LockedLayout ? 'all' : null }/>
					</div>
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
