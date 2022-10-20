!function(){"use strict";var e,t={319:function(){var e=window.wp.blocks,t=window.wp.element,n=window.wp.i18n,a=window.wp.blockEditor;window.wp.compose,window.wp.components;var o=JSON.parse('{"u2":"fim-ministries/contact-info"}');(0,e.registerBlockType)(o.u2,{edit:function(e){let{attributes:o,setAttributes:c}=e;const i=o.contacts,s=i.sort(((e,t)=>e.index-t.index)).map((e=>(0,t.createElement)("div",{className:"contact-block"},(0,t.createElement)(a.PlainText,{className:"position-plain-text",style:{height:58},placeholder:(0,n.__)("Position"),value:e.position,onChange:t=>{const n=Object.assign({},e,{position:t});c({contacts:[...i.filter((t=>t.index!=e.index)),n]})}}),(0,t.createElement)(a.PlainText,{className:"name-plain-text",style:{height:58},placeholder:(0,n.__)("Contact Name"),value:e.name,onChange:t=>{const n=Object.assign({},e,{name:t});c({contacts:[...i.filter((t=>t.index!=e.index)),n]})}}),(0,t.createElement)(a.PlainText,{className:"phone-plain-text",style:{height:58},placeholder:(0,n.__)("Phone Number"),value:e.phone,onChange:t=>{const n=Object.assign({},e,{phone:t});c({contacts:[...i.filter((t=>t.index!=e.index)),n]})}}),(0,t.createElement)(a.PlainText,{className:"email-plain-text",style:{height:58},placeholder:(0,n.__)("Email"),value:e.email,onChange:t=>{const n=Object.assign({},e,{email:t});c({contacts:[...i.filter((t=>t.index!=e.index)),n]})}}),(0,t.createElement)("button",{className:"remove-contact",variant:"tertiary",onClick:()=>{const t=i.filter((t=>t.index!=e.index)).map((t=>(t.index>e.index&&(t.index-=1),t)));c({contacts:t})}},(0,n.__)("Remove Contact")))));return(0,t.createElement)("div",(0,a.useBlockProps)(),(0,t.createElement)("h3",{className:"contactinfo-header"},"Contact Information"),s,(0,t.createElement)("button",{className:"add-more-contacts",variant:"secondary",onClick:()=>c({contacts:[...o.contacts,{index:o.contacts.length,position:""}]})},(0,n.__)("+ Add a Contact")))},save:function(e){let{attributes:n}=e;const o=n.contacts,c=o.map((function(e){return(0,t.createElement)("div",{className:"contact item",key:e.index},(0,t.createElement)("span",{className:"contact-index",style:{display:"none"}},e.index),e.position&&(0,t.createElement)("p",{className:"contact-position contact-info"},e.position),e.name&&(0,t.createElement)("p",{className:"contact-name contact-info"},e.name),e.phone&&(0,t.createElement)("p",{className:"contact-phone contact-info"},e.phone),e.email&&(0,t.createElement)("p",{className:"contact-email contact-info"},(0,t.createElement)("a",{href:"mailto:"+e.email},e.email)))}));return o.length>0?(0,t.createElement)("div",a.useBlockProps.save({attributes:n}),(0,t.createElement)("h3",null,__("Contact Information")),c):null}})}},n={};function a(e){var o=n[e];if(void 0!==o)return o.exports;var c=n[e]={exports:{}};return t[e](c,c.exports,a),c.exports}a.m=t,e=[],a.O=function(t,n,o,c){if(!n){var i=1/0;for(m=0;m<e.length;m++){n=e[m][0],o=e[m][1],c=e[m][2];for(var s=!0,l=0;l<n.length;l++)(!1&c||i>=c)&&Object.keys(a.O).every((function(e){return a.O[e](n[l])}))?n.splice(l--,1):(s=!1,c<i&&(i=c));if(s){e.splice(m--,1);var r=o();void 0!==r&&(t=r)}}return t}c=c||0;for(var m=e.length;m>0&&e[m-1][2]>c;m--)e[m]=e[m-1];e[m]=[n,o,c]},a.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},function(){var e={582:0,84:0};a.O.j=function(t){return 0===e[t]};var t=function(t,n){var o,c,i=n[0],s=n[1],l=n[2],r=0;if(i.some((function(t){return 0!==e[t]}))){for(o in s)a.o(s,o)&&(a.m[o]=s[o]);if(l)var m=l(a)}for(t&&t(n);r<i.length;r++)c=i[r],a.o(e,c)&&e[c]&&e[c][0](),e[c]=0;return a.O(m)},n=self.webpackChunkblocks=self.webpackChunkblocks||[];n.forEach(t.bind(null,0)),n.push=t.bind(null,n.push.bind(n))}();var o=a.O(void 0,[84],(function(){return a(319)}));o=a.O(o)}();