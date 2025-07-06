import { registerBlockType } from '@wordpress/blocks';
import Edit from './edit';
import './editor.css';
import './style.css';

registerBlockType('kindling/dynamic-button', {
	title: 'Dynamic Button',
	description: 'Pulls a URL via ACF and renders it as a button link.',
	category: 'design',
	icon: 'admin-links',
	attributes: {
		label: { type: 'string', default: 'Click me' },
		siteId: { type: 'integer' },
		metaKey: { type: 'string' },
		postId: { type: 'integer' },
	},
	edit: Edit,
	save: () => null, // Rendered in PHP
});
