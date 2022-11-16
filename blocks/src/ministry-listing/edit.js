/*
* Import dependencies
*/
import { __ } from '@wordpress/i18n';
import { useBlockProps, InspectorControls } from '@wordpress/block-editor';
import ServerSideRender from '@wordpress/server-side-render';
import { ToggleControl, Panel, PanelBody, PanelRow } from '@wordpress/components';


import './editor.scss';

export default function Edit( { attributes, setAttributes } ) {

        var hide_empty = attributes.hide_empty;

        const blockProps = useBlockProps();

        return (
          <div { ...blockProps }>
          <ServerSideRender
              block="fim-ministries/ministry-listing"
              attributes = { attributes }
          />
          <InspectorControls key="setting">
          <Panel>
              <PanelBody title="Category Visibility">
                <PanelRow>
                  <ToggleControl
                    label="Hide Empty Categories"
                    checked = { hide_empty }
                    help={
                        hide_empty
                            ? 'Hiding empty categories'
                            : 'Showing empty categories'
                    }
                    onChange={ (val) => { setAttributes( { hide_empty: val } );
                    } }

                  />
                  </PanelRow>

              </PanelBody>
          </Panel>
          </InspectorControls>

          </div>
        );
}
