import { __ } from '@wordpress/i18n';
import { useBlockProps, InnerBlocks } from '@wordpress/block-editor';
import {useEffect, useState} from '@wordpress/element';

import './editor.scss';


export default function Edit() {

	return (
		<div { ...useBlockProps() }>
      <InnerBlocks
      allowedBlocks={['fim-ministries/contact-info']}
      template = {[['fim-ministries/contact-info', {}]]}
      />
		</div>
	);
}
