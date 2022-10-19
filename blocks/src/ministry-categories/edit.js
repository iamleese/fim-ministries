/*
* Import dependencies
*/
import { __ } from '@wordpress/i18n';
import { useBlockProps, InspectorControls } from '@wordpress/block-editor';
import ServerSideRender from '@wordpress/server-side-render';
import { ToggleControl, Panel, PanelBody, PanelRow, TextControl } from '@wordpress/components';

import './editor.scss';

export default function Edit({ attributes, setAttributes }) {

        const blockProps = useBlockProps();
        var show_subcategories = attributes.show_subcategories;
        var hide_empty = attributes.hide_empty;
        var show_all = attributes.show_all;
        var show_all_text = attributes.show_all_text;


        return (
          <div { ...blockProps }>
          <ServerSideRender
              block="fim-ministries/ministry-categories"
              attributes = { attributes }
          />

          <InspectorControls key="setting">
          <Panel>
              <PanelBody title="Category Visibility">
              <PanelRow>
                <ToggleControl
                  label="Show Sub Categories"
                  checked = { show_subcategories }
                  help={
                      show_subcategories
                          ? 'Showing Sub Categories.'
                          : 'Hiding Sub Categories.'
                  }
                  onChange={ (val) => { setAttributes( { show_subcategories: val } );
                  } }
                />
                </PanelRow>
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
                  <PanelRow>
                    <ToggleControl
                      label="Add All Ministry Link"
                      checked = { show_all }
                      onChange={ (val) => { setAttributes( { show_all: val } );
                      } }
                    />
                    <TextControl
                    label="Show All Ministries Text"
                    value = { show_all_text }
                    onChange = { (val) => { setAttributes ( {show_all_text : val } )} }
                    />
                  </PanelRow>

              </PanelBody>
          </Panel>
          </InspectorControls>


          </div>
        );
}
