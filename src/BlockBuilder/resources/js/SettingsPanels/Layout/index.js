import { __ } from '@wordpress/i18n';
import { dispatch, useSelect } from '@wordpress/data';
import { ToggleControl } from '@wordpress/components';
import { PluginDocumentSettingPanel } from '@wordpress/edit-post';

const Layout = () => {

	const meta = useSelect( select => select( 'core/editor' ).getEditedPostAttribute( 'meta' ) );
	const updateMeta = value => dispatch( 'core/editor' ).editPost( { meta: { ...value } } );

	return (
		<PluginDocumentSettingPanel
			icon="none"
			name={ Layout.getName() }
			title={ __( 'Layout', 'block-factory' ) }
		>
			<ToggleControl
				label={ __( 'Lock Layout', 'block-factory' ) }
				checked={ meta?.bf_LockedLayout }
				onChange={ bf_LockedLayout => updateMeta( { bf_LockedLayout } ) }
			/>

		</PluginDocumentSettingPanel>
	);
};

Layout.getName = () => 'bf-block-styles';

export default Layout;
