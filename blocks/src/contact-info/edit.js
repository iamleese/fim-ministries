import { __ } from '@wordpress/i18n';
import { useBlockProps } from '@wordpress/block-editor';
import { TextControl, Button }  from '@wordpress/components';
import {useEffect, useState} from '@wordpress/element';
/**
 * Lets webpack process CSS, SASS or SCSS files referenced in JavaScript files.
 * Those files can contain any CSS code that gets applied to the editor.
 *
 * @see https://www.npmjs.com/package/@wordpress/scripts#using-css
 */
import './editor.scss';

/**
 * The edit function describes the structure of your block in the context of the
 * editor. This represents what the editor will render when the block is used.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-edit-save/#edit
 *
 * @return {WPElement} Element to render.
 */
export default function Edit( {attributes, setAttributes, isSelected}) {

  const [ isEditingContact, setIsEditingContact ] = useState( false );
  const [ isNewContact, setIsNewContact ] = useState(true);

  const position = attributes.contact_position;
  const name = attributes.contact_name;
  const phone = attributes.contact_phone;
  const email = attributes.contact_email;

  function checkNew(){
    if( !position && !name && !phone && !email){
      setIsNewContact(true);
    } else {
      setIsNewContact(false);
    }
  }



  useEffect( () => {
		if ( ! isSelected ) {
			setIsEditingContact( false );
		}

    checkNew();

	}, [ isSelected ] );


  function toggleEditing( event ) {
		event.preventDefault();
		if(isEditingContact == false){
			setIsEditingContact( true );
		} else {
			setIsEditingContact( false );
		}
	}



  console.log(isNewContact);


	return (
		<div { ...useBlockProps() }>

    {isEditingContact && (
      <div className="contact-edit">
        <TextControl
        className="contact-position"
        placeholder={__('Position')}
        value={position}
        onChange={ (val) => (setAttributes({contact_position : val }) , checkNew()) }
        />
        <TextControl
        className="contact-name"
        placeholder={__('Contact Name')}
        value={name}
        onChange={ (val) => setAttributes({contact_name : val })}
        />
        <TextControl
        className="contact-phone"
        placeholder={__('555-123-4567')}
        value={phone}
        onChange={ (val) => setAttributes({contact_phone : val })}
        />
        <TextControl
        className="contact-email"
        placeholder={__('yourname@address.com')}
        value={email}
        onChange={ (val) => setAttributes({contact_email : val })}
        />

        <Button
  				variant = 'tertiary'
  				onClick= { toggleEditing }
  			>{__('Save Contact') }</Button>

      </div>
    )}

    {!isEditingContact && !isNewContact && (
      <div>
      <Button
        className='edit_contact'
        onClick= {toggleEditing}
      >
      <span>Edit Contact</span>
      </Button>
      {position ? <h4 className="contact-position" >{position}</h4> : ''}
      {name ? <span className="contact-name" >{name}</span> : '' }
      {phone ? <span className="contact-phone" >{phone}</span> : ''}
      {email ? <span className="contact-email" ><a href={email}>{__('Email')}</a></span> : ''}
      </div>
    )}

    { isNewContact && !isEditingContact && (
      <div className="new-contact-container">
      <Button
        className='edit_contact'
        onClick= {toggleEditing}
      >
      <span>Edit Contact</span>
      </Button>
      <h4 className="contact-position" >{__('Position')}</h4>
      <span className="contact-name" >{__('Sam Smith')}</span>
      <span className="contact-phone" >(123) 456-7890</span>
      <span className="contact-email" >{__('Email')}</span>
      </div>
    )}

		</div>
	);
}
