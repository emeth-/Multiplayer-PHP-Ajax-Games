///////////////////////////////////
//         ajax im 3.41          //
//    AJAX Instant Messenger     //
//   Copyright (c) 2006-2008     //
//    http://www.ajaxim.com/     //
//   Do not remove this notice   //
///////////////////////////////////


/**
 * Chatroom Class
 **/
var Chatroom = {
   windows: {},    // JavaScript object to store all chatroom windows

   /**
    * Create a new chatroom
    *
    * @arguments
    *   name - chatroom name
    *   imTitle - window title, default is chatroom name
    *
    * @author Joshua Gross
    **/
   create: function(name, imTitle) {
      var imLeft = Math.round(Math.random()*(Browser.width()-360))+'px';
      var imTop  = Math.round(Math.random()*(Browser.height()-400))+'px';
   
      var winId = randomString(32) + '_chat';
   
      this.windows[name] = new ChatWindow({id: winId, className: "dialog", width: 475, height: 340, top: imTop, left: imLeft, resizable: true, title: imTitle, draggable: true, detachable: false, minWidth: 475, minHeight: 150, showEffectOptions: {duration: 0}, hideEffectOptions: {duration: 0}});
      
      this.windows[name].setConstraint(true, {left: 0, right: 0, top: 0, bottom: 0});
      
      this.windows[name].getContent().innerHTML = '<div class="rcvdMessages" id="' + winId + '_rcvd"></div>' + "\n" +
                                                   '<div class="chatUserList" id="' + winId + '_userlist"><ul id="' + winId + '_ul" class="sortable box"><li style="display:none"></li></ul></div>' + "\n" +
                                                   '<div class="imToolbar" id="' + winId + '_toolbar" onmousemove="return false;" onselectstart="return false;"><img src="themes/'+theme+'/window/bold_off.png" onmouseover="buttonHover(this);" onmouseout="buttonNormal(this);" onclick="Chatroom.windows[\'' + name + '\'].toggleBold();" onmousedown="return false;" alt="' + Languages.get('bold') + '" id="' + winId + '_bold" /> ' +
                                                   '<img src="themes/'+theme+'/window/italic_off.png" onmouseover="buttonHover(this);" onmouseout="buttonNormal(this);" onclick="Chatroom.windows[\'' + name + '\'].toggleItalic();" onmousedown="return false;" alt="' + Languages.get('italic') + '" id="' + winId + '_italic" /> '+
                                                   '<img src="themes/'+theme+'/window/underline_off.png" onmouseover="buttonHover(this);" onmouseout="buttonNormal(this);" onclick="Chatroom.windows[\'' + name + '\'].toggleUnderline();" onmousedown="return false;" alt="' + Languages.get('underline') + '" id="' + winId + '_underline" /></div>' +
                                                   ' <a href="#" class="setFontLink" id="' + winId + '_setFont" onclick="Chatroom.windows[\'' + name + '\'].toggleFontList();return false;" onselectstart="return false;">Tahoma</a>' +
                                                   ' <a href="#" class="setFontSizeLink" id="' + winId + '_setFontSize" onclick="Chatroom.windows[\'' + name + '\'].toggleFontSizeList();return false;" onselectstart="return false;">12</a>' +
                                                   ' <a href="#" class="setFontColorLink" id="' + winId + '_setFontColor" onclick="Chatroom.windows[\'' + name + '\'].toggleFontColorList();return false;" onselectstart="return false;"><div id="' + winId + '_setFontColorColor" style="width:14px;height:14px;display:block;"></div></a>' +
                                                   ' <a href="#" class="insertEmoticonLink" id="' + winId + '_insertEmoticon" onclick="Chatroom.windows[\'' + name + '\'].toggleEmoticonList();return false;" onselectstart="return false;"><img src="themes/' + theme + '/emoticons/mini_smile.gif" width="14" height="14" style="border:0;" /></a>' +
                                                   "\n" + '<div style="overflow:auto;"><textarea class="inputText" id="' + winId + '_sendBox" onfocus="blinkerOn(false);" onkeypress="return Chatroom.windows[\'' + name + '\'].keyHandler(event);"></textarea></div>';
      
      this.windows[name].setRoom(name);
      
      $(winId + '_userlist').setStyle({left:   (this.windows[name].getSize().width - 155) + 'px', height: (this.windows[name].getSize().height - 12) + 'px'});
      $(winId + '_rcvd').setStyle({marginTop: '5px', height: (this.windows[name].getSize().height - 103) + 'px', width: (this.windows[name].getSize().width - 170) + 'px'});
      $(winId + '_toolbar').setStyle({top:   (this.windows[name].getSize().height - 73) + 'px', width: (this.windows[name].getSize().width - 170) + 'px'});
      $(winId + '_setFont').setStyle({top: (this.windows[name].getSize().height - 65) + 'px'});
      $(winId + '_setFontSize').setStyle({top: (this.windows[name].getSize().height - 65) + 'px'});
      $(winId + '_setFontColor').setStyle({top: (this.windows[name].getSize().height - 65) + 'px'});
      $(winId + '_setFontColorColor').setStyle({backgroundColor: '#000'});
      $(winId + '_insertEmoticon').setStyle({top: (this.windows[name].getSize().height - 65) + 'px'});

      var sendBox = $(winId + '_sendBox');
      sendBox.setStyle({top:            (this.windows[name].getSize().height - 45) + 'px',
                        left:           '2px',
                        width:          (this.windows[name].getSize().width - 175) + 'px',
                        fontWeight:     '400',
                        fontStyle:      'normal',
                        textDecoration: 'none'});

      this.windows[name].show();
      this.windows[name].toFront();
      Windows.focusedWindow = this.windows[name];
      setTimeout("$('"+winId+"_sendBox').focus();", 250);
   },
   
   /**
    * Process chatroom window resize
    *
    * @arguments
    *   name - chatroom name
    *
    * @author Joshua Gross
    **/
   handleResize: function(name) {
      var winId = this.windows[name].getId();

      $(winId + '_userlist').setStyle({left: (this.windows[name].getSize().width - 155) + 'px', height: (this.windows[name].getSize().height - 12) + 'px'});
      $(winId + '_rcvd').setStyle({height: (this.windows[name].getSize().height - 103) + 'px', width: (this.windows[name].getSize().width - 170) + 'px'});
      $(winId + '_toolbar').setStyle({top: (this.windows[name].getSize().height - 73) + 'px', width: (this.windows[name].getSize().width - 170) + 'px'});
      $(winId + '_setFont').setStyle({top: (this.windows[name].getSize().height - 65) + 'px'});
      $(winId + '_setFontSize').setStyle({top: (this.windows[name].getSize().height - 65) + 'px'});
      $(winId + '_setFontColor').setStyle({top: (this.windows[name].getSize().height - 65) + 'px'});
      $(winId + '_setFontColorColor').setStyle({backgroundColor: '#000'});
      $(winId + '_insertEmoticon').setStyle({top: (this.windows[name].getSize().height - 65) + 'px'});
      $(winId + '_sendBox').setStyle({top: (this.windows[name].getSize().height - 45) + 'px', left: '2px', width: (this.windows[name].getSize().width - 175) + 'px'});
   },

   /**
    * Send request to server to enter a chatroom
    *
    * @argument
    *   room - room name user is entering
    *
    * @author Joshua Gross
    **/
   join: function(room) {
      room = room.toLowerCase();
      
      var xhConn = new XHConn();
      xhConn.connect(pingTo, "POST", "call=joinroom&room="+room,
         function(xh) {
            if(xh.responseText.indexOf('"') == -1) {
               switch(xh.responseText) {
                  case 'already_joined':
                     $('newroom_error_msg').innerHTML = Languages.get('alreadyInRoom').replace('%1', room);
                     break;
                  case 'room_is_user':
                     $('newroom_error_msg').innerHTML = Languages.get('invalidRoom');
                     break;
                  case 'invalid_chars':
                     $('newroom_error_msg').innerHTML = Languages.get('invalidRoomChars');
                     break;
               }
            } else {
               if(!$(room + '_im')) {
                  Chatroom.create(room, room);
               } else {
                  if(!Chatroom.windows[room].isVisible()) {
                     Chatroom.windows[room].show();
                     setTimeout("scrollToBottom('" + room + "_rcvd')", 125);
                  }
               }
               var users = xh.responseText.parseJSON().users;
               for(var i=0; i<users.length; i++)
                  if(!$(users[i]+'_'+name+'_chatUser')) Chatroom.windows[room].addUser(users[i]);
               Windows.close('newRoom');
               Chatroom.windows[room].toFront();
               setTimeout("$('"+Chatroom.windows[room].getId()+"_sendBox').focus()", 125);
            }
           });
   },

   /**
    * Proccess the leaving of a chatroom
    *
    * @arguments
    *   room - room name the user is leaving
    *
    * @author Joshua Gross
    **/
   leave: function(room) {
      var xhConn = new XHConn();
      xhConn.connect(pingTo, "POST", "call=leaveroom&room="+room, null);
   }
};

/**
 * Chatroom Window Class
 **/
var ChatWindow = Class.create();
Object.extend(ChatWindow.prototype, IMWindow.prototype);
Object.extend(ChatWindow.prototype, {
   curSelected: '', // currnet user selected from the chatroom user list

   /**
    * Set the class' room name variable
    *
    * @author Joshua Gross
    **/
   setRoom: function(name) {
      this.room = name;
   },
   
   /**
    * Add a user to the chatroom user list
    *
    * @arguments
    *   username - user to add
    *
    * @author Joshua Gross
    **/
   addUser: function(username) {
      $(this.getId() + '_ul').innerHTML += '<li id="'+username+'_'+this.room+'_chatUser" class="buddy" onmousedown="Chatroom.windows[\'' + this.room + '\'].clickUser(\''+username+'\');return false;" onselectstart="return false;" onmouseover="Chatroom.windows[\'' + this.room + '\'].selectUser(this, \''+username+'\', true);" onmouseout="Chatroom.windows[\'' + this.room + '\'].selectUser(this, \''+username+'\', false);" ondblclick="Chatroom.windows[\'' + this.room + '\'].onUserDblClick();" style="padding:0px;"><img src="themes/' + theme + '/online.png" alt="" id="'+username+'_'+this.room+'_chatImg" />&nbsp;'+username+'</li>';
      $(username+'_'+this.room+'_chatUser').setStyle({listStyleType: 'none'});
   },
   
   /**
    * Remove a user from the chatroom user list
    *
    * @arguments
    *   username - user to remove
    *
    * @author Joshua Gross
    **/
   deleteUser: function(username) {
      var toDelete = $(username + '_' + this.room + '_chatUser');
      if(typeof(toDelete) !== 'undefined')
         toDelete.parentNode.removeChild(toDelete);
   },

   /**
    * Process mouseover and mousout calls for the user list
    *
    * @arguments
    *   sel - element
    *   username - user's username
    *   selected - is mouse over or did it go out
    *
    * @author Joshua Gross
    **/
   selectUser: function(sel, username, selected) {
      if(selected === false) {
         if(this.curSelected != username) {
            try {
               Element.addClassName(sel, 'listNotSelected');
               Element.removeClassName(sel, 'listSelected');
               Element.removeClassName(sel, 'listHover');
            } catch(e) { }
         } else {
            Element.addClassName(sel, 'listSelected');
            Element.removeClassName(sel, 'listNotSelected');
            Element.removeClassName(sel, 'listHover');
         }
      } else {
         Element.addClassName(sel, 'listHover');
         Element.removeClassName(sel, 'listSelected');
         Element.removeClassName(sel, 'listNotSelected');
      }
   },

   /**
    * Process event when a user is clicked
    *
    * @arguments
    *   username - the username of the user clicked
    *
    * @author Josh Gross
    **/
   clickUser: function(username) {
      if(this.curSelected.length > 0) {
         try {
            var el = $(this.curSelected + '_' + this.room + '_chatUser');
            Element.addClassName(el, 'listNotSelected');
            Element.removeClassName(el, 'listSelected');
            Element.removeClassName(el, 'listHover');
         } catch(e) { }
      }

      this.curSelected = username;

      var oel = $(this.curSelected + '_' + this.room + '_chatUser');
      Element.addClassName(oel, 'listSelected');
      Element.removeClassName(oel, 'listNotSelected');
      Element.removeClassName(oel, 'listHover');
   },

   /**
    * On DoubleClick of a user from the chatroom user
    * list, start a private IM with him/her.
    *
    * @author Joshua Gross
    **/
   onUserDblClick: function() {
      if(this.curSelected.length > 0) {
         if(typeof(IM.windows[this.curSelected]) == 'undefined') {
            IM.create(this.curSelected, this.curSelected);
         } else {
            if(!IM.windows[this.curSelected].isVisible()) {
               IM.windows[this.curSelected].show();
               IM.windows[this.curSelected].toFront();
               setTimeout("scrollToBottom('" + IM.windows[this.curSelected].getId() + "_rcvd')", 125);
               setTimeout("$('" + IM.windows[this.curSelected].getId() + "_sendBox').focus();", 250);
            } else {
               IM.windows[this.curSelected].toFront();
               setTimeout("$('" + IM.windows[this.curSelected].getId() + "_sendBox').focus();", 250);
            }
         }
      }
   }
});


/**
 * Class to handle the window of the chat rooms
 **/
var ChatroomList = {
   curSelected: '',  // current selected chat room

   /**
    * Get list of chat rooms that exist
    *
    * @author Joshua Gross
    **/
   get: function(applyTo) {
         var xhConn = new XHConn();

         xhConn.connect(pingTo, "POST", "call=roomlist", function(xh) {
            var rooms = xh.responseText.parseJSON();

            applyTo.innerHTML = '<ul id="join_room_ul" class="sortable box" style="padding: 0px; margin: 0px;"><li style="display:none;"></li>';

            if(rooms.length > 0 || predefRooms.length > 0) {
               for(var i=0; i<rooms.length; i++) {
                  var hexmd5 = hex_md5(rooms[i]);
                  if (!$('chatroom_list_' + hexmd5)) {
                     applyTo.innerHTML += '<li id="chatroom_list_' + hexmd5 + '" class="buddy" style="padding-left:1%;" onmousedown="ChatroomList.clickRoom(\'' + rooms[i] + '\');return false;" onmouseover="ChatroomList.selectRoom(this, \'' + rooms[i] + '\', true);" onmouseout="ChatroomList.selectRoom(this, \'' + rooms[i] + '\', false);">' + rooms[i] + '</li>';
                  }
               }
               
               for(var i=0; i<predefRooms.length; i++) {
                  var hexmd5 = hex_md5(predefRooms[i]);
                  if (!$('chatroom_list_' + hexmd5)) {
                     applyTo.innerHTML += '<li id="chatroom_list_' + hexmd5 + '" class="buddy" style="padding-left:1%;" onmousedown="ChatroomList.clickRoom(\'' + predefRooms[i] + '\');return false;" onmouseover="ChatroomList.selectRoom(this, \'' + predefRooms[i] + '\', true);" onmouseout="ChatroomList.selectRoom(this, \'' + predefRooms[i] + '\', false);">' + predefRooms[i] + '</li>';
                  }
               }
            } else {
               applyTo.innerHTML += '<li class="buddy" style="margin: 2px 0px 0px 0px; padding: 0px; text-align: center;">' + Languages.get('noRoomsExist') + '</li>';
            }
            applyTo.innerHTML += '</ul>';
         });
   },

   /**
    * Proccess mouseover and mouseout of list items
    *
    * @arguments
    *   sel - list element
    *   roomname - chatroom name
    *   selected - did mouse go over or out
    *
    * @author Joshua Gross
    **/
   selectRoom: function(sel, roomname, selected) {
      if(selected === false) {
         if(this.curSelected != roomname) {
            try {
               Element.addClassName(sel, 'listNotSelected').removeClassName('listSelected').removeClassName('listHover');
            } catch(e) { }
         } else {
            Element.addClassName(sel, 'listSelected').removeClassName('listNotSelected').removeClassName('listHover');
         }
      } else {
         Element.addClassName(sel, 'listHover').removeClassName('listSelected').removeClassName('listNotSelected');
      }
   },

   /**
    * Process the clicking of a room
    *
    * @arguments
    *   roomname - room that was clicked
    *
    * @author Joshua Gross
    **/
   clickRoom: function(roomname) {
      if(this.curSelected.length > 0) {
         try {
             Element.addClassName($('chatroom_list_' + hex_md5(this.curSelected)), 'listNotSelected').removeClassName('listSelected').removeClassName('listHover');
         } catch(e) { }
      }
      
      this.curSelected = roomname;
      $('roomname').value = roomname;
      
      Element.addClassName($('chatroom_list_' + hex_md5(roomname)), 'listSelected').removeClassName('listNotSelected').removeClassName('listHover');
   }
};
