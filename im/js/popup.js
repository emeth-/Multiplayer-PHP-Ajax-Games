///////////////////////////////////
//         ajax im 3.41          //
//    AJAX Instant Messenger     //
//   Copyright (c) 2006-2008     //
//    http://www.ajaxim.com/     //
//   Do not remove this notice   //
///////////////////////////////////

/**
 * IM Class
 *
 * @author Joshua Gross
 **/
var IM = {
   /**
    * Handle resize of window
    *
    * @author Joshua Gross
    **/
   handleResize: function(e) {
      var rcvdBox = $(winName + '_rcvd');
      rcvdBox.style.height = (browserHeight() - 133) + 'px';
      rcvdBox.style.width = (browserWidth() - 15) + 'px';

      $(winName + '_toolbar').style.top = (browserHeight() - 93) + 'px';
      $(winName + '_toolbar').style.width = (browserWidth() - 10) + 'px';  
      $(winName + '_setFont').style.top = (browserHeight() - 85) + 'px';
      $(winName + '_setFontSize').style.top = (browserHeight() - 85) + 'px';
      $(winName + '_setFontColor').style.top = (browserHeight() - 85) + 'px';
      $(winName + '_insertEmoticon').style.top = (browserHeight() - 85) + 'px';
      $(winName + '_sendBox').style.top = (browserHeight() - 65) + 'px';
      $(winName + '_sendBox').style.width = (browserWidth() - 16) + 'px';

      rcvdBox.scrollTop = rcvdBox.scrollHeight - rcvdBox.clientHeight + 6;
   }
};
Object.extend(IM, AjaxIM);

/**
 * A class to mantain an IM Window's guts.
 *
 * @author Joshua Gross
 **/
var IMWindow = Class.create(AjaxIMWindow);
IMWindow.addMethods({
   /**
    * Checks to see if there is a message, if there is,
    * send it to the server.
    *
    * @author Joshua Gross
    * @update Benjamin Hitchins
    **/
   send: function($super) {
      $super();
      var winId = this.getId();
      var sendBox = $(winId + '_sendBox');

      var isBold      = (sendBox.style.fontWeight == '400' ? 'false' : 'true');
      var isItalic    = (sendBox.style.fontStyle == 'normal' ? 'false' : 'true');
      var isUnderline = (sendBox.style.textDecoration == 'none' ? 'false' : 'true');
      var fontName    = $(winId + '_setFont').innerHTML;
      var fontSize    = $(winId + '_setFontSize').innerHTML;
      var fontColor   = $(winId + '_setFontColorColor').style.backgroundColor;

      if(trim(sendBox.value).length > 0) {
         var message = sendBox.value;
         sendBox.value = '';
         IM.sendMessage(this.username, message.replace(/&/g, "&amp;").replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/\n/g, "<br/>"), '', isBold, isItalic, isUnderline, fontName, fontSize, fontColor);

	 self.opener.Status.lastIM = new Date().getTime();
         if (typeof(Status) != 'undefined' && self.opener.Status.wasSetAutoAway) {
            self.opener.Status.set(1, Languages.get('available'));
         }
      }

      scrollToBottom(winId + '_rcvd');
      sendBox.focus();
   }
});
