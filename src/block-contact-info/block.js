/**
 * BLOCK: fim-ministries
 *
 * Registering a basic block with Gutenberg.
 * Simple block, renders and saves the same position without any interactivity.
 */

//  Import CSS.
import './style.scss';
import './editor.scss';
const { __ } = wp.i18n; // Import __() from wp.i18n
const registerBlockType = wp.blocks.registerBlockType; // The registerBlockType() to register blocks.
const { PlainText } = wp.editor;
const { withState } = wp.compose;
const { TextControl } = wp.components;
var el = wp.element.createElement;

/**
 * Register: a Gutenberg Block.
 *
 * Registers a new block provided a unique name and an object defining its
 * behavior. Once registered, the block is made editor as an option to any
 * editor interface where blocks are implemented.
 *
 * @link https://wordpress.org/gutenberg/handbook/block-tesapi/
 * @param  {string}   name     Block name.
 * @param  {Object}   settings Block settings.
 * @return {?WPBlock}          The block, if it has been successfully
 *                             registered; otherwise `undefined`.
 */
registerBlockType("fim-ministries/contact-info", {
  // Block name. Block names must be string that contains a namespace prefix. Example: my-plugin/my-custom-block.
  title: __("Ministry Contact"), // Block title.
  icon: "admin-users", // Block icon from Dashicons → https://developer.wordpress.org/resource/dashicons/.
  category: "ministry-blocks", // Block category — Group blocks together based on common traits E.g. common, formatting, layout widgets, embed.
  keywords: [__("Ministry Contact"), __("fim-ministries")],
  attributes: {
	   contacts: {
			source: 'query',
			selector: '.contact.item',
		   	default: [],
			query: {
				index: {
				  source: 'text',
				  selector: '.contact-index'
				},
				position: {
				  source: 'text',
				  selector: '.contact-position'
				},
				name: {
				  source: 'text',
				  selector: '.contact-name'
				},
				phone: {
				  source: 'text',
				  selector: '.contact-phone'
				},
				email: {
				  source: 'text',
				  selector: '.contact-email'
				}
			  }
		},
	  	/*backwards compatibility*/
		
	  },

	  /**
	   * The edit function describes the structure of your block in the context of the editor.
	   * This represents what the editor will render when the block is used.
	   *
	   * The "edit" property must be a valid function.
	   *
	   * @link https://wordpress.org/gutenberg/handbook/block-api/block-edit-save/
	   */

	  // The "edit" property must be a valid function.
	  edit: props => {
		const { contacts } = props.attributes;
		  				  
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
					  props.setAttributes({
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
					  props.setAttributes({
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
					  props.setAttributes({
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
					  props.setAttributes({
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
					onClick={() => {
					  const newContacts = contacts
						.filter(item => item.index != contact.index)
						.map(c => {
						  if (c.index > contact.index) {
							c.index -= 1;
						  }

						  return c;
						});

					  props.setAttributes({
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
		  <div className={props.className}>
			<h3 className="contactinfo-header">Contact Information</h3>
			{contactList}
			<button
			  className="add-more-contacts"
			  onClick={position =>
				props.setAttributes({
				  contacts: [
					...props.attributes.contacts,
					{
					  index: props.attributes.contacts.length,
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
	  },

	  /**
	   * The save function defines the way in which the different attributes should be combined
	   * into the final markup, which is then serialized by Gutenberg into post_content.
	   *
	   * The "save" property must be specified and must be a valid function.
	   *
	   * @link https://wordpress.org/gutenberg/handbook/block-api/block-edit-save/
	   */
	  save: props => {
		const {contacts } = props.attributes;
		  
		const contactsList = contacts.map(function(contact) {
		  return (
			  <div className="contact item" key={contact.index}>
			  <span className="contact-index" style={{ display: "none" }}>
              {contact.index}
            	</span>
				{contact.position && (
					<p className="contact-position contact-info">{contact.position}</p>
				)}
				{contact.name && (
					<p className="contact-name contact-info">{contact.name}</p>
				)}
	  			{contact.phone && (
					<p className="contact-phone contact-info">{contact.phone}</p>
				)}
				{contact.email && (
					<p className="contact-email contact-info"><a href={'mailto:'+contact.email}>{contact.email}</a></p>
				)}
			  </div>
		  );
		});
		
		if (contacts.length > 0) {
		  return (
			<div className="contacts-list">
			  <h3>{ __('Contact Information') }</h3>
			  {contactsList}
			</div>
		  );
		} else return null;
	  }
	});