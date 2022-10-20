import { __ } from '@wordpress/i18n';
import { useBlockProps, PlainText } from '@wordpress/block-editor';
import { withState }  from '@wordpress/compose';
import { TextControl }  from '@wordpress/components';
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
export default function Edit( {attributes, setAttributes}) {

  const contacts = attributes.contacts;

  const contactList = contacts
   .sort((a, b) => a.index - b.index)
    .map(contact => {
     return (
      <div className="contact-block" >
        <PlainText
        className="position-plain-text"
        style={{ height: 58 }}
        placeholder={__('Position')}
        value={contact.position}
        onChange={position => {
          const newObject = Object.assign({}, contact, {
          position: position
          });
          setAttributes({
          contacts: [
            ...contacts.filter(
            item => item.index != contact.index
            ),
            newObject
          ]
          });
        }}
        />
       <PlainText
        className="name-plain-text"
        style={{ height: 58 }}
        placeholder={__('Contact Name')}
        value={contact.name}
        onChange={name => {
          const newObject = Object.assign({}, contact, {
          name: name
          });
          setAttributes({
          contacts: [
            ...contacts.filter(
            item => item.index != contact.index
            ),
            newObject
          ]
          });
        }}
        />
      <PlainText
        className="phone-plain-text"
        style={{ height: 58 }}
        placeholder={__('Phone Number')}
        value={contact.phone}
        onChange={phone => {
          const newObject = Object.assign({}, contact, {
          phone: phone
          });
          setAttributes({
          contacts: [
            ...contacts.filter(
            item => item.index != contact.index
            ),
            newObject
          ]
          });
        }}
        />
        <PlainText
        className="email-plain-text"
        style={{ height: 58 }}
        placeholder={__('Email')}
        value={contact.email}
        onChange={email => {
          const newObject = Object.assign({}, contact, {
          email: email
          });
          setAttributes({
          contacts: [
            ...contacts.filter(
            item => item.index != contact.index
            ),
            newObject
          ]
          });
        }}
        />



      <button
        className="remove-contact"
        variant="tertiary"
        onClick={() => {
          const newContacts = contacts
          .filter(item => item.index != contact.index)
          .map(c => {
            if (c.index > contact.index) {
            c.index -= 1;
            }

            return c;
          });

          setAttributes({
          contacts: newContacts

          });
        }}
        >
        {__("Remove Contact")}
        </button>

      </div>
    );
    });



	return (
		<div { ...useBlockProps() }>
    <h3 className="contactinfo-header">Contact Information</h3>
    {contactList}
    <button
      className="add-more-contacts"
      variant="secondary"
      onClick= { () =>
          setAttributes({
            contacts: [
              ...attributes.contacts,
              {
                index: attributes.contacts.length,
                position: ""
              }
            ]
          })
      }
    >
      {__('+ Add a Contact')}
    </button>

		</div>
	);
}
