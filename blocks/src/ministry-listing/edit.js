/*
* Import dependencies
*/
import { __ } from '@wordpress/i18n';
import { useBlockProps, InspectorControls } from '@wordpress/block-editor';
import { useState, useEffect } from '@wordpress/element';
import ServerSideRender from '@wordpress/server-side-render';
import { ToggleControl, SelectControl, Panel, PanelBody, PanelRow } from '@wordpress/components';
import apiFetch from '@wordpress/api-fetch';


import './editor.scss';

export default function Edit( { attributes, setAttributes } ) {

        var hide_empty = attributes.hide_empty;
        var category = attributes.category;
        var category_name = attributes.category_name;

        const [singleClass, setSingleClass] = useState(null);

        var singleCategoryClass = category ? 'single-category' : '';

        const blockProps = useBlockProps({
          className : singleCategoryClass 
        });

        const [categories, setCategories ] = useState(null);
        const [getCategories, setGetCategories ] = useState( false );

        useEffect( () => {
          apiFetch( { path: '/wp/v2/ministry-category' }).then(
            (result) => {

              setGetCategories(true);
              setCategories( result );
              }
          )
        }, []);

        const categoryOptions = []

        categoryOptions.push({label: __('All Categories'),
        value: ''});

        if(getCategories === true && categories){

          categories.forEach(function(category){
              categoryOptions.push({
                  label: category.name,
                  value: category.id
            })
          });

        }



        function nameToggle(cat, nameval){

          if( cat != '' ){
            return(
              <PanelRow>
            <ToggleControl
              label="Hide Category Name"
              checked = { nameval }
              onChange={ (val) => { setAttributes( { category_name: val } ) } }
            />
            </PanelRow>
            );
          } else {
            return null;
          }
        }





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
                <SelectControl
                      label="Category"
                      value={ category }
                      options={ categoryOptions }
                      onChange={ ( val ) => { setAttributes( { category: val } ) } }
                  />
                  </PanelRow>


                  {nameToggle(category,category_name)}
                  <PanelRow>
                  <ToggleControl
                    label="Hide Empty Categories"
                    checked = { hide_empty }
                    help={
                        hide_empty
                            ? 'Hiding empty categories'
                            : 'Showing empty categories'
                    }
                    onChange={ (val) => { setAttributes( { hide_empty: val } ) } }
                  />
                  </PanelRow>

              </PanelBody>
          </Panel>
          </InspectorControls>

          </div>
        );
}
