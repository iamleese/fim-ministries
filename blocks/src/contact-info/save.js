import { __ } from '@wordpress/i18n';
import { useBlockProps } from '@wordpress/block-editor';


export default function save({attributes}) {
  const position = attributes.contact_position;
  const name = attributes.contact_name;
  const phone = attributes.contact_phone;
  const email = attributes.contact_email;

	return (
			<div { ...useBlockProps.save() }>
      {position ? <h4 className="contact-position" >{position}</h4> : ''}
      {name ? <span className="contact-name" >{name}</span> : '' }
      {phone ? <span className="contact-phone" >{phone}</span> : ''}
      {email ? <span className="contact-email" ><a href={email}>{__('Email')}</a></span> : ''}
			</div>
	);


}
