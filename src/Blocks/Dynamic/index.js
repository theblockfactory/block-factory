import { __ } from '@wordpress/i18n';
import { useMemo } from '@wordpress/element';
import { parse, registerBlockType } from '@wordpress/blocks';
import { InnerBlocks, InspectorControls, useBlockProps } from '@wordpress/block-editor';
import { PanelBody } from '@wordpress/components';

const extractBlocks = ( { name, attributes, innerBlocks }, meta ) => {
  return [
    name,
    {
      ...attributes,
      meta,
    },
    innerBlocks.map( innerBlock => extractBlocks( innerBlock, meta ) ),
  ];
};

window.BlockFactory.blocks.map( block => registerBlockType( block, {
  category: block.category,
  edit: ( { attributes, setAttributes } ) => {

    const blocks = useMemo( () => parse( block.content ), [] );
    const blockTemplate = useMemo( () => blocks.map( extractedBlock => extractBlocks( extractedBlock, block.meta ) ), [] );
    const blockProps = useBlockProps();

    return (
      <>
        <InspectorControls>
          <PanelBody title={ __( 'Edit', 'block-factory' ) }>
            <>
              Edit block
            </>
          </PanelBody>
        </InspectorControls>

        <div { ...blockProps }>
          <InnerBlocks
            templateLock={ block.meta?.bf_LockedLayout ? 'all' : null }
            template={ blockTemplate[ 0 ][ 2 ] }/>
        </div>
      </>
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
