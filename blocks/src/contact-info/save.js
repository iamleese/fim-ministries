/**
 * React hook that is used to mark the block wrapper element.
 * It provides all the necessary props like the class name.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/packages/packages-block-editor/#useblockprops
 */
import { useBlockProps } from '@wordpress/block-editor';

/**
 * The save function defines the way in which the different attributes should
 * be combined into the final markup, which is then serialized by the block
 * editor into `post_content`.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-edit-save/#save
 *
 * @return {WPElement} Element to render.
 */
export default function save({attributes}) {
  const contacts = attributes.contacts;

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
			<div { ...useBlockProps.save({attributes}) }>
			  <h3>{ __('Contact Information') }</h3>
			  {contactsList}
			</div>
		  );
		} else {
      return null;
    }

}
