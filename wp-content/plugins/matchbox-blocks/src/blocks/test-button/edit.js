import {
	useBlockProps,
	RichText,
	InspectorControls,
} from '@wordpress/block-editor';
import { PanelBody, TextControl, Button } from '@wordpress/components';

export default function Edit({ attributes, setAttributes, className }) {
	const blockProps = useBlockProps({ className });
	return (
		<>
			<InspectorControls>
				<PanelBody title="Data Source">
					<TextControl
						label="Site ID"
						value={attributes.siteId}
						onChange={(siteId) =>
							setAttributes({ siteId: parseInt(siteId, 10) || 0 })
						}
					/>
					<TextControl
						label="Meta Key"
						value={attributes.metaKey}
						onChange={(metaKey) => setAttributes({ metaKey })}
					/>
					<TextControl
						label="Post ID"
						type="number"
						value={attributes.postId}
						onChange={(postId) =>
							setAttributes({ postId: parseInt(postId, 10) })
						}
					/>
				</PanelBody>
			</InspectorControls>

			<div {...blockProps}>
				<RichText
					tagName="span"
					value={attributes.label}
					onChange={(label) => setAttributes({ label })}
					placeholder="Button text…"
				/>
				<a
					href="#"
					className="button"
					onClick={(e) => e.preventDefault()}
					style={{ pointerEvents: 'none' }}
				>
					{attributes.label || 'Button Text'}
				</a>
			</div>
		</>
	);
}
