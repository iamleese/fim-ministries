/*
* Import dependencies
*/
import { __ } from '@wordpress/i18n';
import { useBlockProps } from '@wordpress/block-editor';

import './editor.scss';

export default function Edit({ attributes, setAttributes }) {

        const blockProps = useBlockProps();


        return (
          <div { ...blockProps }>
          Displays the Category Description


          </div>
        );
}
