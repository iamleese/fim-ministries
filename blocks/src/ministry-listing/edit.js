/*
* Import dependencies
*/
import { __ } from '@wordpress/i18n';
import { useBlockProps, InspectorControls } from '@wordpress/block-editor';
import { useState, useEffect } from '@wordpress/element';
import apiFetch from '@wordpress/api-fetch';


import './editor.scss';

export default function Edit() {

        const [massTimes, setMassTimes] = useState(null);
        const [getMassTimes, setGetMassTimes ] = useState( false );

        useEffect( () => {
          apiFetch( { path: '/wp/v2/settings/fim_parish_info_mass_times' }).then(
            (result) => {

              setGetMassTimes(true);
              setMassTimes( result );
              }
          )
        }, []);


        if(getMassTimes === true && massTimes){

          const

          massTimes.forEach(function(massTimeGroup){

          });

        }




        return (
          <div { ...useblockProps() }>


          </div>
        );
}
