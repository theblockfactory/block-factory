import { defaultHooks } from '@wordpress/hooks';
import { registerPlugin } from '@wordpress/plugins';
import { useSelect } from '@wordpress/data';
import { Layout } from './SettingsPanels';

const settingsPanels = defaultHooks.applyFilters( 'SettingsPanels', [
	Layout,
] );

settingsPanels.map( Panel => registerPlugin( Panel.getName(), {
	render: () => {
		if ( 'bf_blocks' === useSelect( select => select( 'core/editor' ).getCurrentPostType() ) ) {
			return <Panel/>;
		}
	},
} ) );
