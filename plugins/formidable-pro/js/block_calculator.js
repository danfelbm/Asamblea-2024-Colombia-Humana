(()=>{var e={904:(e,t,r)=>{"use strict";var a=r(439);function n(){}function c(){}c.resetWarningCache=n,e.exports=function(){function e(e,t,r,n,c,o){if(o!==a){var l=new Error("Calling PropTypes validators directly is not supported by the `prop-types` package. Use PropTypes.checkPropTypes() to call them. Read more at http://fb.me/use-check-prop-types");throw l.name="Invariant Violation",l}}function t(){return e}e.isRequired=e;var r={array:e,bigint:e,bool:e,func:e,number:e,object:e,string:e,symbol:e,any:e,arrayOf:t,element:e,elementType:e,instanceOf:t,node:e,objectOf:t,oneOf:t,oneOfType:t,shape:t,exact:t,checkPropTypes:c,resetWarningCache:n};return r.PropTypes=r,r}},88:(e,t,r)=>{e.exports=r(904)()},439:e=>{"use strict";e.exports="SECRET_DO_NOT_PASS_THIS_OR_YOU_WILL_BE_FIRED"}},t={};function r(a){var n=t[a];if(void 0!==n)return n.exports;var c=t[a]={exports:{}};return e[a](c,c.exports,r),c.exports}r.n=e=>{var t=e&&e.__esModule?()=>e.default:()=>e;return r.d(t,{a:t}),t},r.d=(e,t)=>{for(var a in t)r.o(t,a)&&!r.o(e,a)&&Object.defineProperty(e,a,{enumerable:!0,get:t[a]})},r.o=(e,t)=>Object.prototype.hasOwnProperty.call(e,t),(()=>{"use strict";function e(e,t,r){r({[e]:t})}function t(e,t){return e?` ${t}="${e}"`:""}function a(){const e=window.location.pathname,t=e.indexOf("wp-admin");let r="/";return t>-1&&(r=e.substr(0,t)),r}const{Component:n}=wp.element;class c extends n{render(){return React.createElement("div",null,"[formidable",function(e){const{formId:r,title:a,description:n,minimize:c}=e;let o="";return o+=t(r,"id"),o+=t(a,"title"),o+=t(n,"description"),o+=t(c,"minimize"),o}(this.props),"]")}}var o=r(88),l=r.n(o);const{__:i,sprintf:s}=wp.i18n,{Component:m}=wp.element,{SelectControl:p}=wp.components;class d extends m{createOptions(e,t){const r=e.map((e=>({label:e.label,value:e.value})));return[{label:s(i("Select a %s","formidable"),t),value:""},...r]}render(){const{selected:e,items:t,onChange:r,itemName:a,itemNamePlural:n,label:c,help:o}=this.props;return t&&0!==t.length?React.createElement(p,{value:e,options:this.createOptions(t,a),label:c,help:o,onChange:r}):React.createElement("p",{className:"frm-block-select-no-items"},s(i("Currently, there are no %s","formidable"),n))}}d.defaultProps={itemName:"item",itemNamePlural:"items"},d.propTypes={selected:l().oneOfType([l().string,l().number]),items:l().array,onChange:l().func,itemName:l().string,itemNamePlural:l().string,label:l().string,help:l().string};const{__:u}=wp.i18n,{Component:f}=wp.element;class b extends f{render(){const{formId:e,setAttributes:t,forms:r}=this.props;return React.createElement(d,{selected:e,itemName:u("form","formidable"),itemNamePlural:u("forms","formidable"),items:r,onChange:e=>{t({formId:e})}})}}b.propTypes={formId:l().string,setAttributes:l().func.isRequired};const{__:h}=wp.i18n,{Component:v}=wp.element,{InspectorControls:g}=wp.blockEditor,{PanelBody:w,PanelRow:E,ToggleControl:R,ExternalLink:_}=wp.components;class y extends v{render(){const{setAttributes:t,attributes:r,forms:n}=this.props,{formId:o,title:l,description:i,minimize:s}=r;return React.createElement(g,null,React.createElement(w,{title:h("Select Form","formidable"),initialOpen:!0},React.createElement(E,null,React.createElement(b,{formId:o,setAttributes:t,forms:n})),o&&React.createElement(E,null,React.createElement(_,{href:a()+`wp-admin/admin.php?page=formidable&frm_action=edit&id=${o}`},h("Go to form","formidable")))),React.createElement(w,{title:h("Options","formidable"),initialOpen:!1},React.createElement(R,{label:h("Show Form Title","formidable"),checked:l,onChange:r=>{e("title",r?"1":"",t)}}),React.createElement(R,{label:h("Show Form Description","formidable"),checked:i,onChange:r=>{e("description",r?"1":"",t)}}),React.createElement(R,{label:h("Minimize HTML","formidable"),checked:s,onChange:r=>{e("minimize",r?"1":"",t)}})),React.createElement(w,{title:h("Shortcode","formidable"),initialOpen:!1},React.createElement(E,null,React.createElement(c,this.props.attributes))))}}y.propTypes={attributes:l().object,setAttributes:l().func};const{Component:C}=wp.element,{Dashicon:z}=wp.components;class H extends C{loadCustomSvgIcon(){return!!formidable_form_selector.icon.match(/frm_white_label_icon/)&&React.createElement("svg",{xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 20 20",width:"120",height:"120"},React.createElement("path",{d:"M18.1 1.3H2C.9 1.3 0 2 0 3V17c0 1 .8 1.9 1.9 1.9H18c1 0 1.9-.9 1.9-2V3.2c0-1-.8-1.9-1.9-1.9zM18 16.9H2a.2.2 0 0 1-.2-.3V3.4c0-.2 0-.3.2-.3H18c.1 0 .2.1.2.3v13.2c0 .2 0 .3-.2.3zm-1.6-3.6v1c0 .2-.3.4-.5.4H8a.5.5 0 0 1-.5-.5v-1c0-.2.2-.4.5-.4h7.8c.2 0 .4.2.4.5zm0-3.8v1c0 .2-.3.4-.5.4H8a.5.5 0 0 1-.5-.4v-1c0-.2.2-.4.5-.4h7.8c.2 0 .4.2.4.4zm0-3.7v1c0 .2-.3.4-.5.4H8a.5.5 0 0 1-.5-.5v-1c0-.2.2-.4.5-.4h7.8c.2 0 .4.2.4.5zm-9.9.5a1.4 1.4 0 1 1-2.8 0 1.4 1.4 0 0 1 2.8 0zm0 3.7a1.4 1.4 0 1 1-2.8 0 1.4 1.4 0 0 1 2.8 0zm0 3.8a1.4 1.4 0 1 1-2.8 0 1.4 1.4 0 0 1 2.8 0z"}))}render(){return!1!==this.loadCustomSvgIcon()?this.loadCustomSvgIcon():"svg"!==formidable_form_selector.icon?React.createElement(z,{icon:formidable_form_selector.icon}):React.createElement("svg",{xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 599.68 601.37",width:"120",height:"120"},React.createElement("path",{className:"cls-1 orange",d:"M289.6 384h140v76h-140z"}),React.createElement("path",{className:"cls-1",d:"M400.2 147h-200c-17 0-30.6 12.2-30.6 29.3V218h260v-71zM397.9 264H169.6v196h75V340H398a32.2 32.2 0 0 0 30.1-21.4 24.3 24.3 0 0 0 1.7-8.7V264z"}),React.createElement("path",{className:"cls-1",d:"M299.8 601.4A300.3 300.3 0 0 1 0 300.7a299.8 299.8 0 1 1 511.9 212.6 297.4 297.4 0 0 1-212 88zm0-563A262 262 0 0 0 38.3 300.7a261.6 261.6 0 1 0 446.5-185.5 259.5 259.5 0 0 0-185-76.8z"}))}}const{Fragment:k}=wp.element,{__:O}=wp.i18n,{registerBlockType:T,unregisterBlockType:x}=wp.blocks,{Notice:N}=wp.components,{serverSideRender:I}=wp,P=wp.element.createElement("svg",{width:20,height:20},wp.element.createElement("path",{d:"M16.9 0H3a2 2 0 0 0-1.9 1.9V18a2 2 0 0 0 2 1.9h13.7a2 2 0 0 0 1.9-1.9V2a2 2 0 0 0-2-1.9zm0 18.1H3v-10H17v10zm0-11.9H3V2H17v4.3zM5.5 12.6H7c.3 0 .5-.3.5-.5v-1.5c0-.3-.3-.5-.5-.5H5.5c-.3 0-.5.3-.5.5V12c0 .3.3.5.5.5zm7.5 3.8h1.5c.3 0 .5-.3.5-.6v-5.2c0-.3-.3-.5-.5-.5H13c-.3 0-.5.3-.5.5v5.3c0 .2.3.4.5.4zm-7.5 0H7c.3 0 .5-.3.5-.6v-1.4c0-.3-.3-.6-.5-.6H5.5c-.3 0-.5.3-.5.6v1.4c0 .3.3.6.5.6zm3.8-3.8h1.4c.3 0 .6-.3.6-.5v-1.5c0-.3-.3-.5-.6-.5H9.3c-.3 0-.6.3-.6.5V12c0 .3.3.5.6.5zm0 3.8h1.4c.3 0 .6-.3.6-.6v-1.4c0-.3-.3-.6-.6-.6H9.3c-.3 0-.6.3-.6.6v1.4c0 .3.3.6.6.6z"}));x("formidable/calculator"),T("formidable/calculator",{title:O("Calculator Form","formidable"),description:O("Display a Calculator Form","formidable"),icon:P,category:"widgets",keywords:["calculation","formidable"],edit:function({setAttributes:e,attributes:t,isSelected:r}){const{formId:a}=t,n=formidable_block_calculator.forms;return 0===n.length?React.createElement(N,{status:"warning",isDismissible:!1},O("This site does not have any calculator forms.","formidable-pro")):a?React.createElement(k,null,React.createElement(y,{attributes:t,setAttributes:e,forms:n}),r&&React.createElement("style",null,"\n    .components-panel__body.editor-block-inspector__advanced {\n        display:none;\n    }\n"),React.createElement(I,{block:"formidable/calculator",attributes:t})):React.createElement("div",{className:"frm-block-intro-screen"},React.createElement("div",{className:"frm-block-intro-content"},React.createElement(H,null),React.createElement("div",{className:"frm-block-title"},O("Calculator Form","formidable")),React.createElement("div",{className:"frm-block-selector-screen"},React.createElement(b,{formId:a,setAttributes:e,forms:n}))))}})})()})();