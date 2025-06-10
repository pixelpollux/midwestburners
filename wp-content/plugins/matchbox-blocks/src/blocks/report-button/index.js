import { registerBlockType } from '@wordpress/blocks';
import { useBlockProps } from '@wordpress/block-editor';
import { useState, useEffect } from '@wordpress/element';

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

		// Show data is loading
		const [btnUrl, setBtnUrl] = useState(''); // empty because this is the href
		const [btnText, setbtnText] = useState('Loading...');

		useEffect(() => {
			// TODO add a return if we're not in the relevant cpt

			let is_interfuse_cpt = true;

			if (postId) {
				// `afterburn_report` is the acf field name: `data.acf.afterburn_report`
				// adjust the endpoint URL if the post type is different.
				fetch(`/wp-json/wp/v2/interfuse/${postId}`)
					.then((response) => response.json())
					.then((data) => {
						if (data.type && data.type === 'interfuse') {
							// Button Url
							setBtnUrl(data.acf.afterburn_report);
							// Button Text
							setButtonText('More Details');
						} else {
							// Make sure we're in the Events post type
							is_interfuse_cpt = false;
							setButtonText(
								'This block must be used within a Post Template or Looper that is set to the Interfuse post type.',
							);
							console.error(
								'This block is not being used with a valid post type.',
							);
						}
					})
					.catch((error) => {
						console.error('Error fetching custom field:', error);
						setbtnUrl('#');
						setButtonText('Error loading data');
					});
			}
		}, [postId]);

		// Check for post type and Post Template block
		if (!postId && !is_events_cpt) {
			// If not Post ID then we're not using the Post Template block as a parent block
			// If not flag is_events_cpt is fales, we're not using the Events post type
			return (
				<p>
					This block must be used within a Post Template with the Events post
					type.
				</p>
			);
		}

		const preventDefaultClick = (e) => {
			e.preventDefault();
		};

		return (
			// Content displayed in the editor.
			<div className={`${props.className} kindling-report-button`}>
				<a className="btn-textlink" href={btnUrl} onClick={preventDefaultClick}>
					{btnText}
				</a>
			</div>
		);
	},

	save: () => {
		const blockProps = useBlockProps.save();
		return <div {...blockProps}></div>; // Empty div for server-side rendering.
	},
});
