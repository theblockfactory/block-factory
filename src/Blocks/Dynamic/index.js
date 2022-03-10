import { registerBlockType } from '@wordpress/blocks';
import { InnerBlocks, useBlockProps } from '@wordpress/block-editor';

const extractBlocks = ( { name, attributes, innerBlocks } ) => {
	return [
		name,
		attributes,
		innerBlocks.map( innerBlock => extractBlocks( innerBlock ) ),
	];
};

window.BlockFactory.blocks.map( block => registerBlockType( block, {
	edit: () => {
		const blockProps = useBlockProps();
		const blocks = wp.blocks.parse( block.content );
		const blockTemplate = blocks.map( block => extractBlocks( block ) );

		return (
			<div { ...blockProps }>
				<InnerBlocks templateLock="all" template={ blockTemplate } />
			</div>
		);
	},
	save() {
		const blockProps = useBlockProps.save();

		return (
			<div { ...blockProps }>
				<InnerBlocks.Content/>
			</div>
		);
	},
} ) );
