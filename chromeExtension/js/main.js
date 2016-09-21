window.onload = function() {
     var el = document.getElementById("normal");
     el.addEventListener("click", function(){
          chrome.tabs.query({active: true}, function(tabs) {
               var tab = tabs[0]; // 配列なので1番目の要素を指定する
          });

          executeScripts([{file: "js/jquery-2.1.1.min.js"}, {file: "js/content_scripts/inspect_element.js"}]);
     });
};

executeScripts = function(tabId, injectDetailsArray) {
  var callback, createCallback, i;
  createCallback = function(tabId, injectDetails, innerCallback) {
    return function() {
      return chrome.tabs.executeScript(tabId, injectDetails, innerCallback);
    };
  };
  callback = null;
  if (typeof tabId !== 'number') {
    injectDetailsArray = tabId;
    tabId = null;
  }
  i = injectDetailsArray.length - 1;
  while (i >= 0) {
    callback = createCallback(tabId, injectDetailsArray[i], callback);
    --i;
  }
  if (callback !== null) {
    callback();
  }
};
