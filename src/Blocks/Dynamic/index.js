const { Fragment } = wp.element;
const { registerBlockType } = wp.blocks;
const { useBlockProps, InnerBlocks } = wp.blockEditor;

const extractBlocks = ( { name, attributes, innerBlocks } ) => {
	return [
		name,
		attributes,
		innerBlocks.map( innerBlock => extractBlocks( innerBlock ) ),
	];
};

BlockFactory.blocks.map( block => registerBlockType( block, {
	edit: ( { attributes, setAttributes } ) => {


		console.log(block)

		const blockProps = useBlockProps();
		const blocks = wp.blocks.parse( block.content );
		const blockTemplate = blocks.map( block => extractBlocks( block ) );

		return (
			<Fragment>
				<div { ...blockProps }>
					<InnerBlocks templateLock="all" template={ blockTemplate } />
				</div>
			</Fragment>
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
