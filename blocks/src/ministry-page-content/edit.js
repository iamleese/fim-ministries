/*
* Import dependencies
*/
import { __ } from '@wordpress/i18n';
import { useBlockProps} from '@wordpress/block-editor';
import ServerSideRender from '@wordpress/server-side-render';


import './editor.scss';

export default function Edit({attributes}) {

        return (
          <div>
          <ServerSideRender
              block="fim-ministries/ministry-page-content"
          />
          </div>
        );
}
