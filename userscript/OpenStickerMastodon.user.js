// ==UserScript==
// @name         OpenSticker Assist Mastodon
// @namespace    http://tampermonkey.net/
// @version      0.1
// @description  opensticker assist userscript
// @author       kaias1jp
// @match        https://*
// @grant        GM_addStyle
// @grant        GM_getResourceText
// @resource     CSS1 https://s.0px.io/mastodon
// ==/UserScript==
function isMastodon() {
  const divs = document.getElementsByTagName('div');

  for (let i = 0; i < divs.length; i++) {
    if (divs[i].getAttribute('id') === 'mastodon') {
      return true;
    }
  }

  return false;
}
(function() {
    'use strict';
    if (isMastodon() == true) {
    // Your code here...
    GM_addStyle(GM_getResourceText('CSS1'));
    }
})();
