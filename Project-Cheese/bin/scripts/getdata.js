var args = require('system').args;
var webPage = require('webpage');
var page = webPage.create();


page.open(args[1], function(status) {

  console.log(page.content);
  phantom.exit();
});