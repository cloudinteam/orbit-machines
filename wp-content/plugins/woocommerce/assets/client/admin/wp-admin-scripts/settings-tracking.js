!function(){"use strict";var e={};(function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})})(e),window.wp.i18n;var t=window.wc.data,o=window.wp.data;const n="customer-effort-score-exit-page";let r=!1;(0,o.resolveSelect)(t.OPTIONS_STORE_NAME).getOption("woocommerce_allow_tracking").then((e=>{r="yes"===e}));const c={},i=(e,t)=>{c[e]=o=>{t()&&r&&(e=>{if(!window.localStorage)return;let t=(()=>{if(!window.localStorage)return[];const e=window.localStorage.getItem(n),t=e?JSON.parse(e):[];return Array.isArray(t)?t:[]})();t.find((t=>t===e))||t.push(e),t=t.slice(-10),window.localStorage.setItem(n,JSON.stringify(t))})(e)},window.addEventListener("unload",c[e])};function a(e){const t=e.querySelectorAll("input, select, textarea"),o={};for(const e of t){const t=e.name||e.id;if("button"!==e.type&&"image"!==e.type&&"submit"!==e.type&&t)switch(e.type){case"checkbox":o[t]=+e.checked;break;case"radio":void 0===o[t]&&(o[t]=""),e.checked&&(o[t]=e.value);break;case"select-multiple":const n=[];for(const t of e.options)t.selected&&n.push(t.value);o[t]=n;break;default:o[t]=e.value}}return o}const s=document.forms;if(s&&s.mainform){let e=!1;const t=document.querySelector(".woocommerce-save-button");t&&t.addEventListener("click",(()=>{e=!0}));const o=a(s.mainform);i("settings_change",(()=>{if(e)return!1;const t=s.mainform?a(s.mainform):{};let n=!1;for(const e of Object.keys(o))if(("object"==typeof o[e]?JSON.stringify(o[e]):o[e])!==("object"==typeof t[e]?JSON.stringify(t[e]):t[e])){n=!0;break}return n}))}(window.wc=window.wc||{}).settingsTracking=e}();