import { registerBlockType } from '@wordpress/blocks';
import { InspectorControls, useBlockProps } from '@wordpress/block-editor';
import { PanelBody, TextControl } from '@wordpress/components';
import { useState, useEffect } from '@wordpress/element';
import { __ } from '@wordpress/i18n';

import './style.scss';

registerBlockType('kindling/report-button', {
	title: 'Report Button',
	icon: 'analytics',
	category: 'theme',

	// Blocks used in the Post Template block can recieve context
	usesContext: ['postId'],

	edit: function EditComponent(props) {
		const { context } = props;
		const { postId } = context;

		const [btnUrl, setBtnUrl] = useState('');
		// const [btnText, setBtnText] = useState('');

		useEffect(() => {
			let is_interfuse_cpt = true;

			if (postId) {
				fetch(`/wp-json/wp/v2/interfuse/${postId}`)
					.then((response) => response.json())
					.then((data) => {
						if (data.type && data.type === 'interfuse') {
							if (data.afterburn_report) {
								setBtnUrl(data.afterburn_report);
							}
						} else {
							// Make sure we're in the Events post type
							is_interfuse_cpt = false;
							setBtnUrl(
								'This block must be used within a Post Template with the Interfuse post type.',
							);
							setBtnText(
								'This block must be used within a Post Template with the Interfuse post type.',
							);
							console.error(
								'This block is not being used with an Interfuse post type.',
							);
						}
					})
					.catch((error) => {
						console.error('Error fetching custom field:', error);
						setBtnUrl('No URL');
						setBtnText('No Text');
					});
			}
		}, [postId]);

		// Check for post type and Post Template block
		if (!postId && !is_interfuse_cpt) {
			// If not Post ID then we're not using the Post Template block as a parent block
			// If not flag is_interfuse_cpt is fales, we're not using the Interfuse post type
			return (
				<p>
					This block must be used within a Post Template with the Interfuse post
					type.
				</p>
			);
		}

		const preventDefaultClick = (e) => {
			e.preventDefault();
		};

		return (
			// Content displayed in the editor.
			<div {...props.blockProps}>
				<a
					className="btn-textlink"
					href={btnUrl}
					target="_blank"
					rel="noopener"
					aria-label="Afterburn Report"
				>
					Afterburn Report
				</a>
			</div>
		);
	},

	save: () => {
		// const blockProps = useBlockProps.save();
		// return <div {...blockProps}></div>; // Empty div for server-side rendering.
		return null;
	},
});
