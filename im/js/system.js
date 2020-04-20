///////////////////////////////////
//         ajax im 3.41          //
//    AJAX Instant Messenger     //
//   Copyright (c) 2006-2008     //
//    http://www.ajaxim.com/     //
//   Do not remove this notice   //
///////////////////////////////////


/**
 * Handles session and most requests to the server
 *
 **/
var System = {
   /**
    * Checks to see if a login is valid and,
    * if so logs the user in, else it shows an error.
    *
    * @author Joshua Gross
    * @update Benjamin Hutchins
    **/
   login: function(u, p) {
      var username = (u ? u : $('username').value);
      var password = (p ? p : $('password').value);

      var xhConn = new XHConn();
      xhConn.connect(pingTo, "POST", "call=login&username="+username+"&password="+hex_md5(password),
         function(xh) {
            if(xh.responseText == 'invalid' || xh.responseText == 'banned') {
               $('login_error_msg').innerHTML = (xh.responseText == 'invalid' ? Languages.get('incorrectInfo') : Languages.get('userBanned'));
               $('login_error_msg').show();
               new Effect.Shake('modal');
            } else {
               loggedIn = true;
               user = username;
               pass = hex_md5(password);
               defaultTitle = document.title = document.title + ': ' + user;

               $('languageList').hide();

               if(typeof(Buddylist) != 'undefined') {
                  Buddylist.create();

                  if(trim(xh.responseText).length == 0) System.logout();

                  var response = xh.responseText.parseJSON();

                  pingTimer = setInterval('System.ping()', pingFrequency);
                  $('modal').hide();
                  
                  if(response.blocked && response.blocked.length > 0) {
                     var blockList = response.blocked.parseJSON();
                     Buddylist.blocked = blockList;
                  } else {
                     Buddylist.blocked = {};
                  }
                  
                  var buddy;
                  if(response.buddy && response.buddy.length > 0) {
                     var budList = response.buddy.parseJSON();
                     for(var group in budList) {
                        if(!$(group.replace(/\s/, '_')+'_group') && group != 'toJSONString') Buddylist.addGroup(group);
                        if(!Buddylist.list[group]) Buddylist.list[group] = {};
                        for(i=0; i<budList[group].length; i++) {
                           buddy = budList[group][i];
                           Buddylist.list[group][buddy.username] = {'username': buddy.username, 'blocked': (Buddylist.blocked.inArray(buddy.username) ? true : false), 'status': buddy.is_online, 'icon': buddy.icon}

                           if(typeof(Buddylist.listObjects[buddy.username]) == 'undefined') Buddylist.addBuddy(buddy.username, group, buddy.icon);
                           $(Buddylist.listObjects[buddy.username].obj).setStyle({display: 'block'});
                           if(!blockedBuddyStatus && Buddylist.list[group][buddy.username].blocked) {
                              Buddylist.moveBuddy(buddy.username, Languages.get('offline'));
                              $(Buddylist.listObjects[buddy.username].img).src = 'themes/' + theme + '/blocked.png';
                           } else {
                               if(buddy.is_online == 0 || buddy.is_online == 50) {
                                 Buddylist.moveBuddy(buddy.username, Languages.get('offline'));
                                 $(Buddylist.listObjects[buddy.username].img).src = 'themes/' + theme + '/offline.png';
                              } else if(buddy.is_online == 2) {
                                 Buddylist.moveBuddy(buddy.username, group);
                                 $(Buddylist.listObjects[buddy.username].img).src = 'themes/' + theme + '/away.png';            
                              } else {
                                 Buddylist.moveBuddy(buddy.username, group);
                                 $(Buddylist.listObjects[buddy.username].img).src = 'themes/' + theme + '/online.png';
                              }
                              if(Buddylist.list[group][buddy.username].blocked == true) $(Buddylist.listObjects[buddy.username].img).src = 'themes/' + theme + '/blocked.png';
                           }
                        }
                     }
                  }
               }
               
               if(response.admin == 1) {
                  var s = document.createElement('script');
                  s.src = 'js/admin.js?' + (new Date()).getTime();
                  s.type = 'text/javascript';
                  document.getElementsByTagName('head').item(0).appendChild(s);

                  $('blBottomToolbar').innerHTML += '<a id="admin-button" href="#" onclick="AdminWindows.userSearch();return false;" title="Admin"><img src="themes/' + theme + '/window/admin.png" alt="Admin" style="border:0;" /></a>';
                  $('admin-button').setStyle({'position':'absolute', 'left': '0', 'top': '0'});
               }

               Event.observe(document, 'focus', function() { blinkerOn(false); });
               Event.observe(window, 'focus', function() { blinkerOn(false); });

               Event.observe(document, 'blur', function() { blinkerOn(true); });
               Event.observe(window, 'blur', function() { blinkerOn(true); });

               Event.observe(document, 'keypress',
                  function(event) {
                     event = event || window.event;
                     if(Windows.focusedWindow.getId().indexOf('_im') != -1 && IM.sendBoxWithFocus == null) {
                        var sB = $(Windows.focusedWindow.getId() + '_sendBox');
                        sB.focus(); sB.value += String.fromCharCode(event.charCode);
                     }
                  }
               );

               Event.stopObserving(window, 'resize', recenterModal);
               Status.lastIM = new Date().getTime();
               System.ping();
            }
         }
      );
   },

   /**
    * Check for press of 'return' or 'enter' and run 'func'
    *
    * @author Benjamin Hutchins
    **/
   keyHandler: function(event, func) {
      event = event || window.event;
      var asc = document.all ? event.keyCode : event.which;
      if(asc == 13 && typeof func == 'function') func();
      return asc != 13;
   },

   /**
    * Log out the user
    *
    * @author Joshua Gross
    **/
   logout: function() {
      if(user == '' || pass == '') return;
      var xmlhttp=false; 
      /*@cc_on @*/ 
      /*@if (@_jscript_version >= 5) 
      try { 
         xmlhttp = new ActiveXObject("Msxml2.XMLHTTP"); 
      } catch (e) { 
         try { 
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP"); 
         } catch (E) { 
            xmlhttp = false; 
         } 
      } 
      @end @*/
      if (!xmlhttp && typeof XMLHttpRequest!='undefined') { 
         xmlhttp = new XMLHttpRequest(); 
      }
      xmlhttp.open('POST', pingTo, false);
      xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
      xmlhttp.send('call=logout');
      
      clearTimeout(pingTimer);
   
      defaultTitle = document.title = document.title.replace(': ' + user, '');
      user = '';
      pass = '';
      loggedIn = false;
      
      if(typeof(Status) != 'undefined') {
         Status.state = 0;
         Status.awayMessage = '';
      }
      Element.stopObserving(window, 'resize', recenterModal);

      if(typeof(Buddylist) != 'undefined') Buddylist.destroy();

      for(var name in IM.windows) {
         if(typeof(IM.windows[name].getId) != 'undefined' && typeof($(IM.windows[name].getId())) != 'undefined') {
            try {
               if(IM.windows[name].detached)
                  IM.windows[name].popup.close();
               else
                  IM.windows[name].destroy();
            } catch(e) { }
         }
      }

      for(var name in Chatroom.windows) {
         if(typeof(Chatroom.windows[name].getId) != 'undefined' && typeof($(Chatroom.windows[name].getId())) != 'undefined') {
            try {
               Chatroom.windows[name].destroy();
            } catch(e) { }
         }
      }

      if($('admin-userSearch'))
         Windows.getWindow('admin-userSearch').destroy();

      Dialog.alert('<span class="dialog_long_label">' + Languages.get('signedOff') + '</span>',
                   { windowParameters: {className:'alert', width:alertWidth, height: 85}, 
                     okLabel: Languages.get('reconnect'),
                     ok:function(win) {
                        try {
                           window.location.reload();
                        } catch(e) { }
                     }
                   }
      );
   },

   /**
    * Processes register requests
    *
    * @author Jostua Gross
    **/
   register: function() {
      // if registration is disabled, don't do anything
      if (!allowNewUsers) {
         return;
      }

      var error = '';
      
      var registerButton = $('register_button');
      Event.stopObserving(registerButton, 'click', System.register);
      
      if(($('newpassword').value == $('newpassword2').value)) {
         if(checkEmailAddr($('newemail').value)) {
            if($('newpassword').value.length >= 6 && $('newpassword').value.length <= 20) {
               if($('newusername').value.isAlphaNumeric() && $('newusername').value.length >= 3 && $('newusername').value.length <= 16) {
                  var xhConn = new XHConn();
                  
                  var username = $('newusername').value.toLowerCase();
                  var password = $('newpassword').value;
                  var email    = $('newemail').value;
                  xhConn.connect(pingTo, "POST", "call=register&username="+username+"&password="+password+"&email="+email,
                     function(xh) {
                        switch(xh.responseText) {
                           case 'user_registered':
                              Dialog.alert('<span class="dialog_long_label">' + Languages.get('registerSuccess') + '</span><div style="clear:both"></div>',
                                           {windowParameters: {className:'alert', width:alertWidth},
                                            ok:function(win) { clearInputs(); Dialog.closeInfo(); Dialogs.login(); }});
                              Event.observe(registerButton, 'click', System.register);
                              return;
                           case 'username_taken':
                              error = Languages.get('registerUsernameTaken');
                              break;
                           case 'username_bad':
                              error = Languages.get('registerUsernameBad');
                              break;
                           case 'password_bad_length':
                              error = Languages.get('registerPasswordShort');
                              break;
                           case 'invalid_email':
                              error = Languages.get('registerInvalidEmail');
                              break;
                           case 'email_already_used':
                              error = Languages.get('registerEmailTaken');
                              break;
                           default:
                              error = Languages.get('registerFailed');
                        }
                        
                        $('register_error_msg').innerHTML = error;
                        $('register_error_msg').setStyle({display: 'block'});
                        
                        new Effect.Shake('modal');
                        Event.observe(registerButton, 'click', System.register);
                     });
                     return;
               } else {
                  error = Languages.get('registerUsernameBad');
               }
            } else {
               error = Languages.get('registerPasswordShort');
            }
         } else {
            error = Languages.get('registerInvalidEmail');
         }
      } else {
         error = Languages.get('registerPasswordsMatch');
      }
      
      $('register_error_msg').innerHTML = error;
      $('register_error_msg').setStyle({display: 'block'});
      
      new Effect.Shake('modal');
      
      Event.observe(registerButton, 'click', System.register);
   },

   /**
    * Check how long a user has been idle,
    * if they've been idle more than idleTime allows,
    * set them as away.
    *
    * @author Benjamin Hutchins
    **/
   idle: function() {
      var timeStamp = new Date().getTime() - (idleTime * 60 * 1000);
      if (Status.lastIM < timeStamp && typeof(Status) != 'undefined' && Status.state == 0) {
         Status.set(1, Languages.get('away'));
         Status.wasSetAutoAway = true;
      }
   },

   /**
    * The heart of this script, 
    * ping the server for new events and messages
    *
    * @author Joshua Gross
    **/
   ping: function(initial) {
      // if auto-away is enabled, check the idle timer
      if (idleTime > 0)
         System.idle();

      var xhConn = new XHConn();
      xhConn.connect(pingTo, "POST", "call=ping&away="+(typeof(Status) != 'undefined' ? Status.state : 0)+(initial == true ? '&initial=true' : ''),
         function(xh) {
            var i;

            if((typeof xh.status != 'undefined' && xh.status!=200) || xh.responseText == 'not_logged_in') {
               System.logout();
               return;
            }
                   
            if(trim(xh.responseText).length == 0) return;

            var response = xh.responseText.parseJSON();

            var from, data, chatroom;
            var messageCount = (typeof(response.messages) !== 'undefined' ? response.messages.length : 0);
            for(i=0; i<messageCount; i++) {
               chatroom = response.messages[i].chatroom;
               if(!chatroom) {
                  from = response.messages[i].sender;
                  who = from;
               } else {
                  var fromx = response.messages[i].sender.split('\.');
                  from = fromx[1];
                  who  = fromx[0];
               }
               data = response.messages[i].message;
               
               var winId = null;
               try { winId = window[chatroom ? 'Chatroom' : 'IM'].windows[who].getId(); } catch(e) { };
            
               if(!$(winId)) {
                  window[chatroom ? 'Chatroom' : 'IM'].create(who, who);
               } else {
                  if(!window[chatroom ? 'Chatroom' : 'IM'].windows[who].detached && !window[chatroom ? 'Chatroom' : 'IM'].windows[who].isVisible()) {
                     window[chatroom ? 'Chatroom' : 'IM'].windows[who].show();
                     setTimeout("scrollToBottom('" + window[chatroom ? 'Chatroom' : 'IM'].windows[who].getId() + "_rcvd')", 125);
                  }
               }
               
               var curIM = (!window[chatroom ? 'Chatroom' : 'IM'].windows[who].detached ? $(window[chatroom ? 'Chatroom' : 'IM'].windows[who].getId()+"_rcvd") : window[chatroom ? 'Chatroom' : 'IM'].windows[who].popup.$(window[chatroom ? 'Chatroom' : 'IM'].windows[who].getId()+"_rcvd"));
               
               data = data.replace(/(\s|\n|>|^)(\w+:\/\/[^<\s\n]+)/, '$1<a href="$2" target="_blank">$2</a>');
               data = IM.emoteReplace(data, smilies);
               
               if(data.replace(/<([^>]+)>/ig, '').indexOf('/me') == 0)
                  curIM.innerHTML += "<b class=\"user" + (from == user && chatroom ? 'A' : 'B') + "\">" + IM.createTimestamp() + " <i>" + from + ' ' + data.replace(/<([^>]+)>/ig, '').replace(/\/me/, '') + "</i></b><br>\n";
               else
                  curIM.innerHTML += "<b class=\"user" + (from == user && chatroom ? 'A' : 'B') + "\">" + IM.createTimestamp() + " " + from + ":</b> " + data + "<br>\n";
               curIM.scrollTop = curIM.scrollHeight - curIM.clientHeight + 6;
               
               if(!initial) {
                  if(curIM.innerHTML.toLowerCase().replace(/<\S[^>]*>/g, '').indexOf(user.toLowerCase()+': (' + Languages.get('autoreply').toLowerCase() + ')') == -1 && typeof(Status) != 'undefined' && Status.state == 1 && who == from) {
                     var fontName    = $(winId + '_setFont').innerHTML;
                     var fontSize    = $(winId + '_setFontSize').innerHTML;
                     var fontColor   = $(winId + '_setFontColorColor').style.backgroundColor;
                     window[chatroom ? 'Chatroom' : 'IM'].sendMessage(from, '(' + Languages.get('autoreply') + ') ' + Status.awayMessage, false, false, false, fontName, fontSize, fontColor);
                  }
                  
                  if(Windows.getFocusedWindow().getId() != window[chatroom ? 'Chatroom' : 'IM'].windows[who].getId() && pulsateTitles == true) {
                     new Effect.Pulsate(window[chatroom ? 'Chatroom' : 'IM'].windows[who].getId() + '_top');
                  }
            
                  if(titlebarBlinker == true && useBlinker == true) {
                     clearTimeout(blinkerTimer);
                     blinkerTimer = setTimeout("titlebarBlink('"+who+"', \""+data.replace(/\"/, '\"').replace(/<([^>]+)>/ig, '')+"\", 0, "+chatroom+")", blinkSpeed);
                  }
               }
               
               curIM = null;
            }
            
            if(messageCount > 0 && audioNotify == true) soundManager.play('msg_in');
                   
            from = null; data = null;
            var group = '', buddy = '', event = '';
            var eventCount = (typeof(response.events) !== 'undefined' ? response.events.length : 0);
            
            for(i=0; i<eventCount; i++) {
               from = response.events[i].sender;
               data = response.events[i].event;
               who  = (response.events[i].recipient == user ? from : response.events[i].recipient);
               event = data.split(',');

               switch(event[0]) {
                  case 'status':
                     if(typeof(Buddylist) != 'undefined') {
                        group = response.events[i].group;
                        if(group && !$(group.replace(/\s/, '_')+'_group') && group != 'toJSONString') Buddylist.addGroup(group);

                        if(typeof(Buddylist.listObjects[from]) == 'undefined') {
                           Buddylist.addBuddy(from, group, 'none');
                           Buddylist.list[group][from] = {'username': from, 'blocked': false, 'status': event[1]};
                           $(Buddylist.listObjects[from].obj).setStyle({display: 'block'});
                        } else if (group == null) {
                           group = Buddylist.listObjects[from].group;
                        }

                        Buddylist.list[group][from].status = event[1];

                        if(!blockedBuddyStatus && typeof(Buddylist.list[group][from]) !== 'undefined' && Buddylist.list[group][from].blocked) {
                           Buddylist.moveBuddy(from, Languages.get('offline'));
                           $(Buddylist.listObjects[from].img).src = 'themes/' + theme + '/blocked.png';
                        } else {
                           if(event[1] == 0 || event[1] == 50) {
                              Buddylist.moveBuddy(from, Languages.get('offline'));
                              IM.notifyUser(from, Languages.get('signedoff').replace('%1', from));
                              $(Buddylist.listObjects[from].img).src = (typeof(Buddylist.list[group][from]) !== 'undefined' && Buddylist.list[group][from].blocked ? 'themes/' + theme + '/blocked.png' : 'themes/' + theme + '/offline.png');
                           } else if(event[1] == 2) {
                              Buddylist.moveBuddy(from, group);
                              IM.notifyUser(from, Languages.get('wentaway').replace('%1', from));
                              $(Buddylist.listObjects[from].img).src = (typeof(Buddylist.list[group][from]) !== 'undefined' && Buddylist.list[group][from].blocked ? 'themes/' + theme + '/blocked.png' : 'themes/' + theme + '/away.png');
                           } else {
                              Buddylist.moveBuddy(from, group);
                              IM.notifyUser(from, Languages.get('cameback').replace('%1', from));
                              $(Buddylist.listObjects[from].img).src = (typeof(Buddylist.list[group][from]) !== 'undefined' && Buddylist.list[group][from].blocked ? 'themes/' + theme + '/blocked.png' : 'themes/' + theme + '/online.png');
                           }
                        }
                     }
                     break;
                  case 'chat':
                     var rcvdBox = $(Chatroom.windows[event[2]].getId()+"_rcvd");
                     if(event[1] == 'join') {
                        if(!$(from+'_'+event[2]+'_chatUser') && typeof(Chatroom.windows[event[2]]) != 'undefined') Chatroom.windows[event[2]].addUser(from);
                        rcvdBox.innerHTML = rcvdBox.innerHTML + "<b class=\"userB\">" + IM.createTimestamp() + " <i>"+from+" " + Languages.get('hasJoined') + "</i></b><br>";
                        scrollToBottom(Chatroom.windows[event[2]].getId()+"_rcvd");
                     } else if(event[1] == 'left') {
                        if(typeof(Chatroom.windows[event[2]]) != 'undefined') Chatroom.windows[event[2]].deleteUser(from);
                        rcvdBox.innerHTML = rcvdBox.innerHTML + "<b class=\"userB\">" + IM.createTimestamp() + " <i>"+from+" " + Languages.get('hasLeft') + "</i></b><br>";
                        scrollToBottom(Chatroom.windows[event[2]].getId()+"_rcvd");
                     }
                     break;
               }

               event = null;
            }
            
            from = null; data = null; who = null;            
         }
      );
      
      xhConn = null;
   },

   /**
    * Update a user's budddy profile 
    *
    * @author Benjamin Hutchins
    **/
   changeProfile: function() {
      var profile = $('changeprofile_textarea').value, error = '';
      if(profile.replace(/\s/g, "") != "") {
         var xhConn = new XHConn();
         xhConn.connect(pingTo, "POST", "call=changeprofile&profile="+encodeURIComponent(profile),
            function(xh) {
               if(xh.responseText == 'success') {
                  Dialog.closeInfo();
                  Dialog.alert('<span class="dialog_long_label lang-changeProfileSuccess">' + Languages.get('changeProfileSuccess') + '</span><div style="clear:both"></div>',
                               {windowParameters: {className:'alert', width:alertWidth, height:85},
                                ok: function(win) { Dialog.closeInfo(); Windows.close('changeProfile'); } });
               } else {
                  error = Languages.get('changeProfileFailed');
               }

               if(error.length > 0) {
                  $('changeprofile_error_msg').innerHTML = error;
               }
            }
         );
      } else {
         error = Languages.get('changeProfileEmpty');
      }
      if(error.length > 0) {
         $('changeprofile_error_msg').innerHTML = error;
      }
   },

   /**
    * Update a users's buddy icon
    *
    * @author Benjamin Hutchins
    **/
   changeIcon: function() {
      // get the iframe as a variable
      var i = $('changeicon_iframe');
      if (i.contentDocument) {
         var d = i.contentDocument;
      } else if (i.contentWindow) {
         var d = i.contentWindow.document;
      } else {
         var d = window.frames['changeicon_iframe'].document;
      }

      // if the iframe was never processed, then return empty
      if (d.location.href == "about:blank") {
         return;
      }

      // handle returns from the server
      var error = '', response = d.body.innerHTML;
      if(response == 'success'){
         Dialog.closeInfo();
         Dialog.alert('<span class="dialog_long_label lang-changeBuddyiconSuccess">'+Languages.get('changeBuddyiconSuccess')+'</span><div style="clear:both"></div>',{windowParameters:{className:'alert',width:alertWidth,height:85},ok:function(win){Dialog.closeInfo();Windows.close('changeIcon');}});
      } else if (response == 'nofile') {
         error = Languages.get('changeIconSelectFile');
      } else if (response == 'size') {
         error = Languages.get('changeIconSize');
      } else if (response == 'bad_type') {
         error = Languages.get('changeIconBadType');
      } else if (response == 'bad_extension') {
         error = Languages.get('changeIconBadExtension');
      } else {
         error = Languages.get('changeIconFailed');
      }

      // if there was an error, show it
      if(error.length > 0) {
         $('changeicon_error_msg').innerHTML = error;
      }
   },

   /**
    * Change a user's password
    *
    * @author Joshua Gross
    * @update Benjamin Hutchins
    **/
   changePass: function() {
      var currentPw = $('currentpw').value, newPw = $('newpw').value, error = '';

      if(hex_md5(currentPw) == pass) {
         if(newPw == $('confirmpw').value) {
            var xhConn = new XHConn();
            xhConn.connect(pingTo, "POST", "call=pwdchange&username="+user+"&password="+hex_md5(currentPw)+"&newpwd="+newPw,
               function(xh) {
                  if(xh.responseText == 'pw_changed') {
                     Dialog.closeInfo();
                     Dialog.alert('<span class="dialog_long_label lang-changeSuccess">' + Languages.get('changeSuccess') + '</span><div style="clear:both"></div>', {windowParameters: {className:'alert', width:alertWidth, height:85}, ok: function(win) { Dialog.closeInfo(); Windows.close('changePass'); setTimeout('System.logout();', 250); } });
                  } else if(xh.responseText == 'invalid_pw') {
                     error = Languages.get('currentPassInvalid');
                     $('currentpw').value = '';
                  } else if(xh.responseText == 'password_bad_length') {
                     error = Languages.get('changePasswordShort');
                     $('newpw').value = '';
                     $('confirmpw').value = '';
                  } else {
                     error = Languages.get('changeFailed');
                  }
                  if(error.length > 0) {
                     $('changepass_error_msg').innerHTML = error;
                  }
               }
            );
         } else {
            error = Languages.get('changeNoMatch');
         }
      } else {
         error = Languages.get('currentPassInvalid');
      }
      if(error.length > 0) {
         $('changepass_error_msg').innerHTML = error;
      }
   },

   /**
    * Reset a user's password to something new because they forgot it
    *
    * @author Joshua Gross
    * @update Benjamin Hutchins
    **/
   resetPass: function() {
      var xhConn = new XHConn();
      xhConn.connect(pingTo, "POST", "call=reset&email="+encodeURIComponent($('resetto').value),
         function(xh) {
            var error = '';
            if(xh.responseText == 'pw_reset') {
               Dialog.alert('<span class="dialog_long_label lang-newPasswordEmailed langinsert-clear">' + Languages.get('newPasswordEmailed').replace('%1', $('resetto').value) + '</span><div style="clear:both"></div>', {windowParameters: {className:'alert', width:alertWidth}, ok:function(win) { clearInputs(); Dialog.closeInfo(); Dialogs.login(); }});
            } else if(xh.responseText == 'no_email_on_record') {
               error = Languages.get('noEmailOnRecord');
            } else {
               error = Languages.get('problemResetting');
            }
            
            if (error.length > 0) {
               $('forgotpass_error_msg').innerHTML = error;
               $('forgotpass_error_msg').setStyle({display: 'block'});
               new Effect.Shake('modal');
            }
         }
      );
   }
};
