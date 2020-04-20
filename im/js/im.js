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
    * Handle resize of windows
    *
    * @author Joshua Gross
    * @update Benjamin Hutchins
    **/
   handleResize: function(eventName, win, detached) {
      if(win.getId() == 'bl') {
         Buddylist.sizeBuddyList();
      } else if(win.getId().indexOf('_im') != -1) {
         var name = win.getId();
         var curIM = $(name + '_rcvd');
         
         curIM.setStyle({height: (win.getSize()['height'] - 135) + 'px', width:  (win.getSize()['width'] - 10) + 'px'});
         
         $(name + '_toolbar').setStyle({top: (win.getSize()['height'] - 73) + 'px', width: (win.getSize()['width'] - 10) + 'px'});
         $(name + '_setFont').setStyle({top: (win.getSize()['height'] - 65) + 'px'});         
         $(name + '_setFontSize').setStyle({top: (win.getSize()['height'] - 65) + 'px'});
         $(name + '_setFontColor').setStyle({top: (win.getSize()['height'] - 65) + 'px'});
         $(name + '_insertEmoticon').setStyle({top: (win.getSize()['height'] - 65) + 'px'});
         $(name + '_sendBox').setStyle({top: (win.getSize()['height'] - 45) + 'px', width: (win.getSize()['width'] - 16) + 'px'});

	 curIM.scrollTop = curIM.scrollHeight - curIM.clientHeight + 6;
      } else if(win.getId().indexOf('_chat') != -1) {
         Chatroom.handleResize(win.room);
      } else if(win.getId().indexOf('admin-') != -1) {
         AdminWindows.handleResize(win);
      }
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
      var chatroom    = (typeof(this.room) !== 'undefined' ? 'true' : 'false');

      if(trim(sendBox.value).length > 0) {
         var message = sendBox.value;
         sendBox.value = '';
         IM.sendMessage((chatroom == 'true' ? this.room : this.username), message.replace(/&/g, "&amp;").replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/\n/g, "<br/>"), chatroom, isBold, isItalic, isUnderline, fontName, fontSize, fontColor);

         Status.lastIM = new Date().getTime();
         if (typeof(Status) != 'undefined' && Status.wasSetAutoAway) {
            Status.set(1, Languages.get('available'));
         }
      }

      scrollToBottom(winId + '_rcvd');
      sendBox.focus();
   }
});
