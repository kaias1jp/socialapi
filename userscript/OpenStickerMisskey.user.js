// ==UserScript==
// @name         OpenSticker Assist Misskey
// @namespace    http://tampermonkey.net/
// @version      0.1
// @description  opensticker assist userscript
// @author       kaias1jp
// @match        https://*
// @grant        GM_addStyle
// @grant        GM_getResourceText
// @resource     CSS1 https://socialapi.app/api/opensticker/css/misskey/opensticker.css
// ==/UserScript==
function getMeta(metaName) {
  const metas = document.getElementsByTagName('meta');

  for (let i = 0; i < metas.length; i++) {
    if (metas[i].getAttribute('name') === metaName) {
      return metas[i].getAttribute('content');
    }
  }

  return '';
}
(function() {
    'use strict';
    if (getMeta("application-name") == "Misskey") {
    // Your code here...
    GM_addStyle(GM_getResourceText('CSS1'));
    }
})();
