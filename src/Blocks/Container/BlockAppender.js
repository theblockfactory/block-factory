const { Inserter, InnerBlocks } = wp.blockEditor;
const { IconButton } = wp.components;
const { registerBlockType } = wp.blocks;

export default function BlockAppender( { rootClientId } ) {
	return (
		<Inserter
			rootClientId={ rootClientId }
			renderToggle={ ( { onToggle, disabled } ) => (
				<IconButton
					onClick={ onToggle }
					disabled={ disabled }
					icon="plus"
				/>
			) }
			isAppender
		/>
	);
}
