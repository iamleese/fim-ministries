!function(){"use strict";var e,t={147:function(e,t,n){var r=window.wp.blocks,o=window.wp.element,i=window.wp.i18n,l=window.wp.blockEditor,a=window.wp.serverSideRender,c=n.n(a),u=window.wp.components,s=window.wp.apiFetch,f=n.n(s),p=JSON.parse('{"u2":"fim-ministries/ministry-listing"}');(0,r.registerBlockType)(p.u2,{edit:function(e){let{attributes:t,setAttributes:n}=e;var r=t.hide_empty,a=t.category,s=t.category_name;const[p,m]=(0,o.useState)(null);var d=a?"single-category":"";const g=(0,l.useBlockProps)({className:d}),[v,w]=(0,o.useState)(null),[y,h]=(0,o.useState)(!1);(0,o.useEffect)((()=>{f()({path:"/wp/v2/ministry-category"}).then((e=>{h(!0),w(e)}))}),[]);const b=[];return b.push({label:(0,i.__)("All Categories"),value:""}),!0===y&&v&&v.forEach((function(e){b.push({label:e.name,value:e.id})})),(0,o.createElement)("div",g,(0,o.createElement)(c(),{block:"fim-ministries/ministry-listing",attributes:t}),(0,o.createElement)(l.InspectorControls,{key:"setting"},(0,o.createElement)(u.Panel,null,(0,o.createElement)(u.PanelBody,{title:"Category Visibility"},(0,o.createElement)(u.PanelRow,null,(0,o.createElement)(u.SelectControl,{label:"Category",value:a,options:b,onChange:e=>{n({category:e})}})),(E=s,""!=a?(0,o.createElement)(u.PanelRow,null,(0,o.createElement)(u.ToggleControl,{label:"Hide Category Name",checked:E,onChange:e=>{n({category_name:e})}})):null),(0,o.createElement)(u.PanelRow,null,(0,o.createElement)(u.ToggleControl,{label:"Hide Empty Categories",checked:r,help:r?"Hiding empty categories":"Showing empty categories",onChange:e=>{n({hide_empty:e})}}))))));var E},save:function(e){let{attributes:t}=e;return null}})}},n={};function r(e){var o=n[e];if(void 0!==o)return o.exports;var i=n[e]={exports:{}};return t[e](i,i.exports,r),i.exports}r.m=t,e=[],r.O=function(t,n,o,i){if(!n){var l=1/0;for(s=0;s<e.length;s++){n=e[s][0],o=e[s][1],i=e[s][2];for(var a=!0,c=0;c<n.length;c++)(!1&i||l>=i)&&Object.keys(r.O).every((function(e){return r.O[e](n[c])}))?n.splice(c--,1):(a=!1,i<l&&(l=i));if(a){e.splice(s--,1);var u=o();void 0!==u&&(t=u)}}return t}i=i||0;for(var s=e.length;s>0&&e[s-1][2]>i;s--)e[s]=e[s-1];e[s]=[n,o,i]},r.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return r.d(t,{a:t}),t},r.d=function(e,t){for(var n in t)r.o(t,n)&&!r.o(e,n)&&Object.defineProperty(e,n,{enumerable:!0,get:t[n]})},r.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},function(){var e={28:0,357:0};r.O.j=function(t){return 0===e[t]};var t=function(t,n){var o,i,l=n[0],a=n[1],c=n[2],u=0;if(l.some((function(t){return 0!==e[t]}))){for(o in a)r.o(a,o)&&(r.m[o]=a[o]);if(c)var s=c(r)}for(t&&t(n);u<l.length;u++)i=l[u],r.o(e,i)&&e[i]&&e[i][0](),e[i]=0;return r.O(s)},n=self.webpackChunkblocks=self.webpackChunkblocks||[];n.forEach(t.bind(null,0)),n.push=t.bind(null,n.push.bind(n))}();var o=r.O(void 0,[357],(function(){return r(147)}));o=r.O(o)}();