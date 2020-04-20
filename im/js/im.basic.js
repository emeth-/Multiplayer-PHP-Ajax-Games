///////////////////////////////////
//         ajax im 3.41          //
//    AJAX Instant Messenger     //
//   Copyright (c) 2006-2008     //
//    http://www.ajaxim.com/     //
//   Do not remove this notice   //
///////////////////////////////////


/**
 * AjaxIM Class
 *
 * @author Joshua Gross
 **/
var AjaxIM = {
   windows: {},                 // JavaScript object to hold all IM windows
   sendBoxWithFocus: null,      // current box that has focus

   /**
    * Create new IM window
    *
    * @author Joshua Gross
    * @update Benjamin Hutchins
    **/
   create: function(name, imTitle) {
      var buddyicon = typeof Buddylist.listObjects[name] == 'undefined' ? 'none' : Buddylist.listObjects[name].icon;
      var iconsrc = (buddyicon=='none'?defaultIcon:pathToIcons+name+'.'+buddyicon);
      var imLeft = Math.round(Math.random()*(Browser.width()-360))+'px';
      var imTop  = Math.round(Math.random()*(Browser.height()-400))+'px';
   
      var winId = randomString(32) + '_im';

      this.windows[name] = new IMWindow({id: winId, className: "dialog", width: 320, height: 335, top: imTop, left: imLeft, resizable: true, title: imTitle, draggable: true, detachable: imDetachable, minWidth: 320, minHeight: 150, showEffectOptions: {duration: 0}, hideEffectOptions: {duration: 0}});

      this.windows[name].setConstraint(true, {left: 0, right: 0, top: 0, bottom: 0});
      
      this.windows[name].getContent().innerHTML = '<div class="userToolbar" id="' + winId + '_userFuncs">' +
                                                  '<img src="themes/'+theme+'/window/addbuddy.png" class="toolbarButton" onclick="Dialogs.newBuddy();$(\'newBuddyUsername\').value=\'' + name + '\'" alt="' + Languages.get('addBuddyButton') + '" title="' + Languages.get('addBuddyButton') + '" onmouseover="buttonHover(this);" onmouseout="buttonNormal(this);" onmousedown="buttonDown(this);" onmouseup="buttonNormal(this);" /> ' +
                                                  '<img src="themes/'+theme+'/window/block.png" class="toolbarButton" onclick="Dialogs.blockBuddy(\'' + name + '\');" alt="" title="" onmouseover="buttonHover(this);" onmouseout="buttonNormal(this);" onmousedown="buttonDown(this);" onmouseup="buttonNormal(this);" />' +
                                                  '</div>' +
                                                  (useIcons?(defaultIcon==""&&buddyicon=="none"?'':'<img src="'+iconsrc+'" id="buddyIcon_'+name+'" alt="Buddy Icon" class="buddyIcon" onmouseover="IM.buddyIconHover(this);" onmouseout="IM.buddyIconNormal(this);" />'):'') +
                                                  '<div class="rcvdMessages" id="' + winId + '_rcvd"></div>' + "\n" +
                                                  '<div class="imToolbar" id="' + winId + '_toolbar" onmousemove="return false;" onselectstart="return false;"><img src="themes/'+theme+'/window/bold_off.png" onmouseover="buttonHover(this);" onmouseout="buttonNormal(this);" onclick="IM.windows[\'' + name + '\'].toggleBold();" onmousedown="return false;" alt="' + Languages.get('bold') + '" id="' + winId + '_bold" /> ' +
                                                  '<img src="themes/'+theme+'/window/italic_off.png" onmouseover="buttonHover(this);" onmouseout="buttonNormal(this);" onclick="IM.windows[\'' + name + '\'].toggleItalic();" onmousedown="return false;" alt="' + Languages.get('italic') + '" id="' + winId + '_italic" /> '+
                                                  '<img src="themes/'+theme+'/window/underline_off.png" onmouseover="buttonHover(this);" onmouseout="buttonNormal(this);" onclick="IM.windows[\'' + name + '\'].toggleUnderline();" onmousedown="return false;" alt="' + Languages.get('underline') + '" id="' + winId + '_underline" /></div>' +
                                                  ' <a href="#" class="setFontLink" id="' + winId + '_setFont" onclick="IM.windows[\'' + name + '\'].toggleFontList();return false;" onselectstart="return false;">Tahoma</a>' +
                                                  ' <a href="#" class="setFontSizeLink" id="' + winId + '_setFontSize" onclick="IM.windows[\'' + name + '\'].toggleFontSizeList();return false;" onselectstart="return false;">12</a>' +
                                                  ' <a href="#" class="setFontColorLink" id="' + winId + '_setFontColor" onclick="IM.windows[\'' + name + '\'].toggleFontColorList();return false;" onselectstart="return false;"><div id="' + winId + '_setFontColorColor" style="width:14px;height:14px;display:block;"></div></a>' +
                                                  ' <a href="#" class="insertEmoticonLink" id="' + winId + '_insertEmoticon" onclick="IM.windows[\'' + name + '\'].toggleEmoticonList();return false;" onselectstart="return false;"><img src="themes/' + theme + '/emoticons/mini_smile.gif" width="14" height="14" style="border:0;" /></a>' +
                                                  "\n" + '<div style="overflow:auto;"><textarea class="inputText" id="' + winId + '_sendBox" onfocus="blinkerOn(false);IM.sendBoxWithFocus=this;" onblur="IM.sendBoxWithFocus=null;" onkeypress="return IM.windows[\'' + name + '\'].keyHandler(event);"></textarea></div>';
      
      this.windows[name].setUsername(name);

      $(winId + '_rcvd').setStyle({height: (this.windows[name].getSize().height - 135) + 'px', width: (this.windows[name].getSize().width - 10) + 'px'});
      $(winId + '_toolbar').setStyle({top: (this.windows[name].getSize().height - 73) + 'px', width: (this.windows[name].getSize().width - 10) + 'px'});
      $(winId + '_setFont').setStyle({top: (this.windows[name].getSize().height - 65) + 'px'});
      $(winId + '_setFontSize').setStyle({top: (this.windows[name].getSize().height - 65) + 'px'});
      $(winId + '_setFontColor').setStyle({top: (this.windows[name].getSize().height - 65) + 'px'});
      $(winId + '_setFontColorColor').setStyle({backgroundColor: '#000'});
      $(winId + '_insertEmoticon').setStyle({top: (this.windows[name].getSize().height - 65) + 'px'});
      $(winId + '_sendBox').setStyle({top: (this.windows[name].getSize().height - 45) + 'px', left: '2px', width: (this.windows[name].getSize().width - 16) + 'px', fontWeight: '400', fontStyle: 'normal', textDecoration: 'none'});

      this.windows[name].show();
      this.windows[name].toFront();
      Windows.focusedWindow = this.windows[name];
      setTimeout("$('"+winId+"_sendBox').focus();", 250);
      if (vanishingIcons){setTimeout("if($('buddyIcon_"+name+"')){$('buddyIcon_"+name+"').hide();}", vanishingSpeed);}
   },

   /**
    * Sends a message to the server
    *
    * @arguments
    *   username - who the message is being sent to
    *   message - the message to send
    *   chatroom - (bool) is this a chatroom
    *   isBold - (bool) is the message bolded
    *   isItalic - (bool) is the message italicized
    *   isUnderline - (bool) is the message underlined
    *   fontName - font family for the message
    *   fontSize - font size for the message
    *   fontColor - font color for the message
    *
    * @author Joshua Gross
    **/
   sendMessage: function(username, message, chatroom, isBold, isItalic, isUnderline, fontName, fontSize, fontColor) {
      var xhConn = new XHConn();

      xhConn.connect(pingTo, "POST", "call=send&recipient="+username+"&chatroom="+chatroom+"&bold="+isBold+"&italic="+isItalic+"&underline="+isUnderline+"&font="+fontName+"&fontsize="+fontSize+"&fontcolor="+fontColor+"&message="+encodeURIComponent(message),
         function(xh) {
            var error = null;

            switch(xh.responseText) {
               case 'sent':
                  // do nothing
               break;

               case 'sent_offline':
                  error = Languages.get('notifySentButOffline');
               break;

               case 'not_online':
                  error = Languages.get('errorNotLoggedIn');
               break;

               case 'too_long':
                  error = Languages.get('errorMsgTooLong');
               break;

               case 'not_logged_in':
                  if (typeof System != 'undefined') {
                     System.logout();
                  } else {
                     self.opener.System.logout();
                  }
               break;

               default:
                  error = Languages.get('errorUnknown');
               break;
            }

            if(chatroom == 'true')
               Chatroom.windows[username].sendResult(message, isBold, isItalic, isUnderline, fontName, fontSize, fontColor, error);
            else
               IM.windows[username].sendResult(message, isBold, isItalic, isUnderline, fontName, fontSize, fontColor, error);
         }
      );

      if(audioNotify == true) soundManager.play('msg_out');
   },

   /**
    * Replaces emotes with images
    *
    * @arguments
    *   str - the message to run replaces on
    *   itemsList - array of emotes
    **/
   emoteReplace: function(str, itemsList) {
      var r;
      for(var s in itemsList) {
         if(str.indexOf(s) > -1)
            str = str.replace(new RegExp(regExpEscape(s), 'g'), '<img src="themes/' + theme + '/emoticons/' + itemsList[s] + '" alt="' + itemsList[s] + '" title="' + s + '" />');
      }
      return str;
   },

   /**
    * Start a new message with a user that might not be in your buddy list,
    * ran via Dialogs.newIM()
    *
    * @author Joshua Gross
    **/
   newIMWindow: function() {
      if($('sendto').value.replace(/^\s*|\s*$/g,"").length > 0) {
         var toWhom = $('sendto').value;
   
         if(typeof(this.windows[toWhom]) == 'undefined') {
            this.create(toWhom, toWhom);
         } else {
            if(!this.windows[toWhom].isVisible()) {
               this.windows[toWhom].show();
               setTimeout("scrollToBottom('" + this.windows[toWhom].getId() + "_rcvd')", 125);
            }
         }
         
         Windows.close('newIM');
         this.windows[toWhom].toFront();
         setTimeout("$('" + this.windows[toWhom].getId() + "_sendBox').focus()", 125);
      } else {
         $('newim_error_msg').innerHTML = Languages.get('newIMProper');
      }
   },

   /**
    * @author Joshua Gross
    **/
   handleClose: function(eventName, win) {
      if(win.getId().indexOf('_im') == -1 && win.getId().indexOf('_chat') == -1) return;
   
      if(typeof(win.room) !== 'undefined') Chatroom.leave(win.room);
           
      var rcvdBox = $(win.getId() + '_rcvd');
      if(imHistory == true) {
         rcvdBox.innerHTML = '<span class="imHistory">' +
                             rcvdBox.innerHTML.replace(new RegExp('\(' + Languages.get('autoreply') + ':\)/g'), Languages.get('autoreply') + ':').replace(/<(?![Bb][Rr] ?\/?)([^>]+)>/ig, '') +
                             "</span>\n";
      } else {
         rcvdBox.innerHTML = '';
      }
   },

   /**
    * @author Joshua Gross
    **/
   handleMinimize: function(eventName, win) {
      if(win.getId().indexOf('_im') == -1) return;
      
      var curIM = $(win.getId() + '_rcvd');
      curIM.scrollTop = curIM.scrollHeight - curIM.clientHeight + 6;
   },

   /**
    * Create a timestamp to use in a chat window based off the
    * configuration variable 'timestamp'
    *
    * @author Joshua Gross
    **/
   createTimestamp: function() {
      Stamp = new Date();
      var tH = String(Stamp.getHours()); var ti = String(Stamp.getMinutes()); var ts = String(Stamp.getSeconds());
      var th = tH > 12 ? tH - 12 : tH; var ta = tH > 12 ? 'pm' : 'am'; var tA = tH > 12 ? 'PM' : 'AM';
      var td = String(Stamp.getDate()); var tm = String(Stamp.getMonth() + 1);
      var tM = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'July', 'Aug', 'Sep', 'Nov', 'Dec'][tm - 1];
      var tY = String(Stamp.getFullYear()); var ty = tY.substring(2);
      
      tu = tm; tx = td; tQ = tH;
      
      tH = (tH.length > 1) ? tH : "0"+tH; ti = (ti.length > 1) ? ti : "0"+ti;
      tq = (th.length > 1) ? th : "0"+th; ts = (ts.length > 1) ? ts : "0"+ts;
      td = (td.length > 1) ? td : "0"+td; tm = (tm.length > 1) ? tm : "0"+tm;
      if(typeof timestamp == 'undefined') {
         timestamp = self.opener.timestamp;
      }
      return timestamp.replace(/H/, tH).replace(/h/, th).replace(/i/, ti).replace(/s/, ts)
                          .replace(/d/, td).replace(/Y/, tY).replace(/y/, ty).replace(/m/, tm)
                          .replace(/u/, tu).replace(/x/, tx).replace(/Q/, tQ).replace(/q/, tq)
                          .replace(/a/, ta).replace(/A/, tA).replace(/M/, tM);
   },

   /**
    * Append status changes to chat window
    *
    * @author Benjamin Hutchins
    **/
   notifyUser: function(username, error) {
      if(typeof(IM.windows[username]) != 'undefined') {
         if(IM.windows[username].isVisible()) {
            IM.windows[username].sendResult('', '', '', '', '', '', '', error);
         }
      }
   },

   /**
    * Add effects to a buddy icon.
    *
    * @arguments
    *   el - buddy icon element
    *
    * @author Benjamin Hutchins
    **/
   buddyIconHover: function(el) {
      /*var clone = new Element('img', {
      'src': $(el).src,
      //   'id': $(el).id + '_clone',
      //   'class': 'buddyIconClone',
       //  'alt': '' // valid XHTML
      }).insert(Element.getOffsetParent(el), 'content'); //.setStyle({'position': 'absolute', 'top': el.offsetTop, 'left': el.offsetLeft});
      //clonePosition(clone, el, {setLeft:true, setTop:true});*/
   },

   /**
    * Restore effects set by IM.buddyIconHover back to 'Normal'
    *
    * @arguments
    *   el - buddy icon element
    *
    * @author Benjamin Hutchins
    **/
   buddyIconNormal: function(el) {
      if ($(el.id + '_clone')) {
         $(el.id + '_clone').remove();
      }
   }
};


/**
 * A class to mantain an IM Window's guts.
 *
 * @author Joshua Gross
 **/
var AjaxIMWindow = Class.create();
Object.extend(AjaxIMWindow.prototype, Window.prototype);
Object.extend(AjaxIMWindow.prototype, {
   /**
    * Set the class' username variable
    *
    * @author Joshua Gross
    **/
   setUsername: function(username) {
      this.username = username;
   },

   send: function() {
      // do nothing here.
   },

   /**
    * After a message is sent to the server via IM.sendMessage(),
    * this function is ran to append the message to the user's window
    *
    * @arguments
    *   message - the message to send
    *   isBold - (bool) is the message bolded
    *   isItalic - (bool) is the message italicized
    *   isUnderline - (bool) is the message underlined
    *   fontName - font family for the message
    *   fontSize - font size for the message
    *   fontColor - font color for the message
    *
    * @author Joshua Gross
    * @update Benjamin Hutchins
    **/
   sendResult: function(message, isBold, isItalic, isUnderline, fontName, fontSize, fontColor, result) {
      var winId = this.getId();
      var sendBox = $(winId + '_sendBox');
      var rcvdBox = $(winId + '_rcvd');

      if(result != null) {
         rcvdBox.innerHTML = rcvdBox.innerHTML + '<span class="imError">' + result + '</span><br>';
      }

      if(trim(message).length > 0) {
         message = message.replace(/<br\/>/g, '\n').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/<([^>]+)>/ig, '').replace(/\n/g, '<br/>').replace(/(\s|\n|>|^)(\w+:\/\/[^<\s\n]+)/, '$1<a href="$2" target="_blank">$2</a>');
         message = IM.emoteReplace(message, smilies);
         if(message.replace(/<([^>]+)>/ig, '').indexOf('/me') == 0)
            rcvdBox.innerHTML = rcvdBox.innerHTML + "<b class=\"userA\">" + IM.createTimestamp() + " <i>" + user + ' ' + message.replace(/<([^>]+)>/ig, '').replace(/\/me/, '') + "</i></b><br>\n";
         else
            rcvdBox.innerHTML = rcvdBox.innerHTML + "<b class=\"userA\">" + IM.createTimestamp() + " " + user + ":</b> <span style=\"font-family:" + fontName + ",sans-serif;font-size:" + fontSize + "px;color:" + fontColor + ";\">" + (isBold == 'true' ? "<b>" : "") + (isItalic == 'true' ? "<i>" : "") + (isUnderline == 'true' ? "<u>" : "") + message + (isBold == 'true' ? "</b>" : "") + (isItalic == 'true' ? "</i>" : "") + (isUnderline == 'true' ? "</u>" : "") + "</span><br>\n";
      }

      scrollToBottom(winId + '_rcvd');
   },

   /**
    * @author Joshua Gross
    **/
   toggleBold: function() {
      var winId = this.getId();
      var sendBox = $(winId + '_sendBox');
         
      sendBox.hide(); // horrah weird Opera 9 input refresh!
      if(sendBox.style.fontWeight == '400') {
         $(winId + '_bold').src = 'themes/' + theme + '/window/bold_on.png';
         sendBox.setStyle({fontWeight: '700'});
      } else {
         sendBox.setStyle({fontWeight: '400'});
         $(winId + '_bold').src = 'themes/' + theme + '/window/bold_off.png';
      }
      sendBox.show(); // horrah weird Opera 9 input refresh!
      setTimeout("$('" + winId + "_sendBox').focus();", 125);
   },

   /**
    * @author Joshua Gross
    **/
   toggleItalic: function() {
      var winId = this.getId();
      var sendBox = $(winId + '_sendBox');
      
      sendBox.hide(); // horrah weird Opera 9 input refresh!
      if(sendBox.style.fontStyle == 'normal') {
         sendBox.setStyle({fontStyle: 'italic'});
         $(winId + '_italic').src = 'themes/' + theme + '/window/italic_on.png';
      } else {
         sendBox.setStyle({fontStyle: 'normal'});
         $(winId + '_italic').src = 'themes/' + theme + '/window/italic_off.png';
      }
      sendBox.show(); // horrah weird Opera 9 input refresh!
      setTimeout("$('" + winId + "_sendBox').focus();", 125);
   },

   /**
    * @author Joshua Gross
    **/
   toggleUnderline: function() {
      var winId = this.getId();
      var sendBox = $(winId + '_sendBox');
      
      sendBox.hide(); // horrah weird Opera 9 input refresh!
      if(sendBox.style.textDecoration == 'none') {
         sendBox.setStyle({textDecoration: 'underline'});
         $(winId + '_underline').src = 'themes/' + theme + '/window/underline_on.png';
      } else {
         sendBox.setStyle({textDecoration: 'none'});
         $(winId + '_underline').src = 'themes/' + theme + '/window/underline_off.png';
      }
      sendBox.show(); // horrah weird Opera 9 input refresh!
      setTimeout("$('" + winId + "_sendBox').focus();", 125);
   },

   /**
    * @author Joshua Gross
    **/
   toggleFontList: function() {
      var fL = $('fontsList');
      var fLBtn = $(this.getId() + '_setFont');
      
      $('emoticonList', 'fontColorList', 'fontSizeList').invoke('hide');

      if($('fontsList').style.display == 'block') {
         fL.hide();
      } else {
         fL.setStyle({left:    Position.cumulativeOffset(fLBtn)[0] + 'px',
                      top:     (Position.cumulativeOffset(fLBtn)[1] + Element.getHeight(fLBtn) - 1) + 'px',
                      zIndex:  Windows.maxZIndex + 20,
                      display: 'block'});
                      
         IM.active = this;
      }
   },

   /**
    * @author Joshua Gross
    **/
   toggleFontSizeList: function() {
      var fsL = $('fontSizeList');
      var fsLBtn = $(this.getId() + '_setFontSize');
      
      $('emoticonList', 'fontsList', 'fontColorList').invoke('hide');

      if($('fontSizeList').style.display == 'block') {
         $('fontSizeList').setStyle({display: 'none'});
      } else {
         fsL.setStyle({left:    Position.cumulativeOffset(fsLBtn)[0] + 'px',
                       top:     (Position.cumulativeOffset(fsLBtn)[1] + Element.getHeight(fsLBtn) - 1) + 'px',
                       zIndex:  Windows.maxZIndex + 20,
                       display: 'block'});

       IM.active = this;
      }
   },

   /**
    * @author Joshua Gross
    **/
   toggleEmoticonList: function() {
      var eL = $('emoticonList');
      var eLBtn = $(this.getId() + '_insertEmoticon');
      
      $('fontsList', 'fontSizeList', 'fontColorList').invoke('hide');

      if($('emoticonList').style.display == 'block') {
         $('emoticonList').setStyle({display: 'none'});
      } else {
         eL.setStyle({left:    Position.cumulativeOffset(eLBtn)[0] + 'px',
                      top:     (Position.cumulativeOffset(eLBtn)[1] + Element.getHeight(eLBtn) - 1) + 'px',
                      zIndex:  Windows.maxZIndex + 20,
                      display: 'block'});

         IM.active = this;
      }
   },

   /**
    * @author Joshua Gross
    **/
   toggleFontColorList: function() {
      var fcL = $('fontColorList');
      var fcLBtn = $(this.getId() + '_setFontColor');
      
      $('fontsList', 'fontSizeList', 'emoticonList').invoke('hide');

      if($('fontColorList').style.display == 'block') {
         $('fontColorList').setStyle({display: 'none'});
      } else {
         fcL.setStyle({left:    Position.cumulativeOffset(fcLBtn)[0] + 'px',
                       top:     (Position.cumulativeOffset(fcLBtn)[1] + Element.getHeight(fcLBtn) - 1) + 'px',
                       zIndex:  Windows.maxZIndex + 20,
                       display: 'block'});

         IM.active = this;
      }
   },

   /**
    * @author Joshua Gross
    **/
   setFont: function(fontname) {
      var winId = this.getId();
      var sendBox = $(winId + '_sendBox');

      sendBox.hide();
      sendBox.setStyle({fontFamily: fontname + ', sans-serif'});
      sendBox.show();
      
      $(winId + '_setFont').innerHTML = fontname;
      setTimeout("$('" + winId + "_sendBox').focus();", 125);
      this.toggleFontList('');
   },
   
   /**
    * @author Joshua Gross
    **/
   setFontSize: function(size) {
      var winId = this.getId();
      var sendBox = $(winId + '_sendBox');
      
      sendBox.hide();
      sendBox.setStyle({fontSize: size + 'px'});
      sendBox.show();
      
      $(winId + '_setFontSize').innerHTML = size;
      setTimeout("$('" + winId + "_sendBox').focus();", 125);
      this.toggleFontSizeList('');
   },

   /**
    * @author Joshua Gross
    **/
   setFontColor: function(color) {
      var winId = this.getId();
      var sendBox = $(winId + '_sendBox');
      
      sendBox.setStyle({color: color});
      
      $(winId + '_setFontColorColor').setStyle({backgroundColor: color});
      setTimeout("$('" + winId + "_sendBox').focus();", 125);
      this.toggleFontColorList('');
   },
   
   /**
    * Adds text to a windows' message box
    *
    * @author Joshua Gross
    **/
   insertText: function(tti) {
      var winId = this.getId();
      var sendBox = $(winId + '_sendBox');
      
      sendBox.value += tti;
      setTimeout("$('" + winId + "_sendBox').focus();", 125);
      this.toggleEmoticonList();
      return false;
   },

   /**
    * Checks for pressing on 'Return' or 'Enter'
    *
    * @author Joshua Gross
    * @update Benjamin Hutchins
    **/
   keyHandler: function(event) {
      event = event || window.event;
      var asc = document.all ? event.keyCode : event.which;
      var shift = event.shiftKey;

      if(useLingo) {
         var message = $(this.getId() + '_sendBox').value;
         if(trim(message).length > 0) {
            for(var i=0; i<lingoPunction.length; i++) {
               if(RegExp(lingoPunction[i][0]+"$").test(message)) {
                  $(this.getId() + '_sendBox').value = Languages.lingoReplace(message, lingoPunction[i]);
                  if(asc == 13 && !shift){}else{return true;}
               }
            }
         }
      }

      if(asc == 13 && !shift) {
         this.send();
         return false;
      }

      return true;
   },
   
   /**
    * Detaches an IM window to a new window
    *
    * @author Joshua Gross
    * @update Benjamin Hutchins
    **/
   detach: function() {
      var winId = this.getId();
      newWin = this.username;
      newWinRcvd = $(winId + '_rcvd').innerHTML;
      this.hide();
      this.popup = window.open('./popup.html', winId + '_im', 'left='+this.getLocation()['left']+',top='+this.getLocation()['top']+',width=320,height=335,toolbar=0,location=1,status=0,menubar=0,resizable=1,scrollbars=0');
      this.detached = true;
   }
});
