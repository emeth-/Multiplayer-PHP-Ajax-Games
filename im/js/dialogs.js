///////////////////////////////////
//         ajax im 3.41          //
//    AJAX Instant Messenger     //
//   Copyright (c) 2006-2008     //
//    http://www.ajaxim.com/     //
//   Do not remove this notice   //
///////////////////////////////////


/**
 * Dialog and windows class
 *
 * @author Joshua Gross
 **/
var Dialogs = {
   /**
    * Display login modal
    *
    * @author Joshua Gross
    **/
   login: function() {
      clearInputs();
      $('login_error_msg').innerHTML = '';
      this.mainDialogShow('login');
      this.currentMainDialog = 'login';
      setTimeout("try { $('username').focus(); } catch(e) { }", 1125);
   },

   /**
    * Display register modal
    *
    * @author Joshua Gross
    **/
   register: function() {
      clearInputs();
      $('register_error_msg').innerHTML = '';
      Dialogs.mainDialogShow('register');
      this.currentMainDialog = 'register';
      setTimeout("try { $('newusername').focus(); } catch(e) { }", 505);
   },

   /**
    * Display forgot password modal
    *
    * @author Joshua Gross
    **/
   forgotPass: function() {
      clearInputs();
      $('forgotpass_error_msg').innerHTML = '';
      Dialogs.mainDialogShow('forgotPass');
      this.currentMainDialog = 'forgotPass';
      setTimeout("try { $('resetto').focus(); } catch(e) { }", 505);
   },

   /**
    * Display main dialog
    *
    * @author Joshua Gross
    **/
   mainDialogShow: function(dialog) {
      if(this.currentMainDialog) Element.setStyle(this.currentMainDialog + 'Dialog', {'display': 'none'});
      Element.setStyle(dialog + 'Dialog', {'display': 'block'});
   },

   /**
    * New IM window, or IM Anyone. Displays a window to enter a
    * username in attempt to message a new friend.
    *
    * @author Joshua Gross
    **/
   newIM: function() {
      var newIMWin;
       if($('newIM')) {
         Windows.getWindow('newIM').toFront();
         return;
      }  

      newIMWin = new Window({id: 'newIM', className: "dialog", width: 240, height: 120, resizable: false, title: Languages.get('newIM'), draggable: true, closable: true, maximizable: false, minimizable: false, detachable: false, minWidth: 240, minHeight: 120, showEffectOptions: {duration: 0}, hideEffectOptions: {duration: 0}});

      newIMWin.setConstraint(true, {left: 0, right: 0, top: 0, bottom: 0});

      newIMWin.getContent().innerHTML = '<div class="dialog_info lang-newIMPlease langinsert-clear" style="padding:3px;">' + Languages.get('newIMPlease') + '</div> \
                                         <span id="newim_error_msg" class="errorMsg">&nbsp;</span> \
                                         <div id="newim_box" style="padding-left:30px;width:100%;"> \
                                         <div style="display:block;float:left;margin-right:5px;padding-top:4px;">' + Languages.get('username') + ':</div><input type="text" style="width:120px;" id="sendto" name="sendto" onkeypress="handleInput(event, function() { IM.newIMWindow(); })" /> \
                                         </div> \
                                         <div id="newim_buttons">' +
                                         ButtonCtl.create(Languages.get('openIM'), 'IM.newIMWindow();') +
                                         ButtonCtl.create(Languages.get('cancel'), 'Windows.close(\'newIM\');') +
                                         '</div>';

      $('newim_buttons').setStyle({position: 'absolute', top: '110px', left: '25px'});
      newIMWin.setDestroyOnClose();
      newIMWin.showCenter();
      setTimeout("$('sendto').focus();", 125);
   },

   /**
    * Display a window that will allow the user
    * to enter a name for a chat room to be created.
    *
    * @author Joshua Gross
    **/
   newRoom: function() {
      var newRoomWin;
      if($('newRoom')) {
         Windows.getWindow('newRoom').toFront();
         return;
      }
      
      newRoomWin = new Window({id: 'newRoom', className: "dialog", width: 240, height: 300, resizable: false, title: Languages.get('newRoom'), draggable: true, closable: true, maximizable: false, minimizable: false, detachable: false, minWidth: 240, minHeight: 120, showEffectOptions: {duration: 0}, hideEffectOptions: {duration: 0}});
      
      newRoomWin.setConstraint(true, {left: 0, right: 0, top: 0, bottom: 0});
      
      newRoomWin.getContent().innerHTML = '<div class="dialog_info lang-newRoomPlease langinsert-clear" style="padding:3px;">' + Languages.get('newRoomPlease') + '</div> \
                                           <span id="newroom_error_msg" class="errorMsg">&nbsp;</span> \
                                           <div id="newroom_box" style="padding-left:25px;width:100%;"> \
                                           <div style="display:block;margin-right:5px;padding-top:4px;" class="lang-roomname langinsert-replace">' + Languages.get('roomname') + ':</div><input type="text" style="width:187px;margin-left:0px;" id="roomname" name="roomname" onkeypress="handleInput(event, function() {Chatroom.join($(\'roomname\').value); }, function(){$(\'roomname\').value = $(\'roomname\').value.toLowerCase();})" /> \
                                           <div id="newroom_room_list"></div> \
                                           </div> \
                                           <div id="newroom_buttons">' +
                                           ButtonCtl.create(Languages.get('joinRoom'), 'Chatroom.join($(\'roomname\').value);') +
                                           ButtonCtl.create(Languages.get('cancel'), 'Windows.close(\'newRoom\');') +
                                           '</div>';
      
      $('newroom_buttons').setStyle({position: 'absolute', top: '290px', left: '25px'});

      ChatroomList.get($('newroom_room_list'));

      newRoomWin.setDestroyOnClose();
      newRoomWin.showCenter();
      setTimeout("$('roomname').focus();", 125);
   },

   /**
    * Display a window to allow the user to enter another
    * buddy's username and a group name to have the user added
    * to the user's buddylist.
    *
    * @author Joshua Gross
    **/
   newBuddy: function() {
      var newBuddyWin;
      if($('newBuddy')) {
         Windows.getWindow('newBuddy').toFront();
         return;
      }
      
      newBuddyWin = new Window({id: 'newBuddy', className: "dialog", width: 240, height: 160, resizable: false, title: Languages.get('newBuddy'), draggable: true, closable: true, maximizable: false, minimizable: false, detachable: false, minWidth: 240, minHeight: 120, showEffectOptions: {duration: 0}, hideEffectOptions: {duration: 0}});

      newBuddyWin.setConstraint(true, {left: 0, right: 0, top: 0, bottom: 0});

      newBuddyWin.getContent().innerHTML = '<div class="dialog_info" style="padding:3px;">' + Languages.get('newBuddyPlease') + '</div> \
                                            <span id="newbuddy_error_msg" class="errorMsg">&nbsp;</span> \
                                            <div id="newbuddy_box" style="padding-left:22px;width:100%;"> \
                                            <div style="display:block;float:left;margin-right:24px;padding-top:4px;">' + Languages.get('username') + ':</div><input type="text" style="width:110px;" id="newBuddyUsername" name="newBuddyUsername" onkeypress="handleInput(event, function() { Buddylist.addNewBuddy($(\'newBuddyUsername\').value, $(\'newBuddyGroup\').value); })" /><br /> \
                                            <div style="display:block;float:left;margin-right:5px;padding-top:4px;">' + Languages.get('addtogroup') + ':</div><input type="text" style="width:110px;" id="newBuddyGroup" name="newBuddyGroup" value="Friends" onfocus="this.select();" onkeypress="handleInput(event, function() { Buddylist.addNewBuddy($(\'newBuddyUsername\').value, $(\'newBuddyGroup\').value); })" /> \
                                            </div> \
                                            <div id="newbuddy_buttons">' +
                                            ButtonCtl.create(Languages.get('add'), 'Buddylist.addNewBuddy($(\'newBuddyUsername\').value, $(\'newBuddyGroup\').value);') +
                                            ButtonCtl.create(Languages.get('cancel'), 'Windows.close(\'newBuddy\');') +
                                            '</div>';

      $('newbuddy_buttons').setStyle({position: 'absolute', top: '150px', left: '25px'});

      newBuddyWin.setDestroyOnClose();
      newBuddyWin.showCenter();
      setTimeout("$('newBuddyUsername').focus();", 125);
   },

   /**
    * Display a window to confirm the removal of a buddy.
    *
    * @author Joshua Gross
    * @update Benjamin Hutchins
    **/
   removeBuddy: function(username) {
      var delBuddyWin;

      if (typeof username == 'undefined')
         var username = curSelected;

      if(username == '' || username.length == 0)
         return;

      if($('delBuddy')) {
         Windows.getWindow('delBuddy').toFront();
         return;
      }

      delBuddyWin = new Window({id: 'delBuddy', className: "dialog", width: 240, height: 70, resizable: false, title: Languages.get('removeBuddy'), draggable: true, closable: true, maximizable: false, minimizable: false, detachable: false, minWidth: 240, minHeight:70, showEffectOptions: {duration: 0}, hideEffectOptions: {duration: 0}});
      
      delBuddyWin.setConstraint(true, {left: 0, right: 0, top: 0, bottom: 0});
      
      delBuddyWin.getContent().innerHTML = '<div class="dialog_info" style="padding:3px;">' + Languages.get('removeBuddyAreYouSure').replace('%1', username) + '</div> \
                                            <div id="delbuddy_buttons">' +
                                            ButtonCtl.create(Languages.get('ok'), 'Buddylist.deleteBuddy(\'' + username + '\');Windows.close(\'delBuddy\');') +
                                            ButtonCtl.create(Languages.get('cancel'), 'Windows.close(\'delBuddy\');') +
                                            '</div>';
                                            
      $('delbuddy_buttons').setStyle({position: 'absolute', top: '60px', left: '25px'});
                                      
      delBuddyWin.setDestroyOnClose();
      delBuddyWin.showCenter();
   },

   /**
    * Display a window to confirm the blocking/unblocking
    * of a buddy.
    *
    * @author Joshua Gross
    **/
   blockBuddy: function(buddy) {
      var blockBuddyWin;

      if($('blockBuddy')) {
         Windows.getWindow('blockBuddy').toFront();
         return;
      }
      
      blockBuddyWin = new Window({id: 'blockBuddy', className: "dialog", width: 240, height: 70, resizable: false, title: Languages.get('blockBuddy'), draggable: true, closable: true, maximizable: false, minimizable: false, detachable: false, minWidth: 240, minHeight:70, showEffectOptions: {duration: 0}, hideEffectOptions: {duration: 0}});
      
      blockBuddyWin.setConstraint(true, {left: 0, right: 0, top: 0, bottom: 0});
      
      blockBuddyWin.getContent().innerHTML = '<div class="dialog_info" style="padding:3px;">' + (Buddylist.blocked.inArray(buddy) ? Languages.get('unblockBuddyAreYouSure').replace('%1', buddy) : Languages.get('blockBuddyAreYouSure').replace('%1', buddy)) + '</div> \
                                            <div id="blockbuddy_buttons">' +
                                            ButtonCtl.create(Languages.get('ok'), 'Buddylist.blockBuddy(\'' + buddy + '\');Windows.close(\'blockBuddy\');') +
                                            ButtonCtl.create(Languages.get('cancel'), 'Windows.close(\'blockBuddy\');') + 
                                            '</div>';
 
      $('blockbuddy_buttons').setStyle({position: 'absolute', top: '60px', left: '25px'});

      blockBuddyWin.setDestroyOnClose();
      blockBuddyWin.showCenter();
   },

   /**
    * Display a window to confirm the removal of an
    * entire buddy group.
    *
    * @author Joshua Gross
    **/
   removeGroup: function(group) {
      var delGroupWin;  
      if($('delGroup')) {
         Windows.getWindow('delGroup').toFront();
         return;
      }
      
      delGroupWin = new Window({id: 'delGroup', className: "dialog", width: 240, height: 70, resizable: false, title: Languages.get('removeGroup'), draggable: true, closable: true, maximizable: false, minimizable: false, detachable: false, minWidth: 240, minHeight:70, showEffectOptions: {duration: 0}, hideEffectOptions: {duration: 0}});
      
      delGroupWin.setConstraint(true, {left: 0, right: 0, top: 0, bottom: 0});
      
      delGroupWin.getContent().innerHTML = '<div class="dialog_info" style="padding:3px;">' + Languages.get('removeGroupAreYouSure').replace('%1', group) + '</div> \
                                            <div id="delgroup_buttons">' +
                                            ButtonCtl.create(Languages.get('ok'), 'Buddylist.deleteGroup(\'' + group + '\');Windows.close(\'delGroup\');') +
                                            ButtonCtl.create(Languages.get('cancel'), 'Windows.close(\'delGroup\');') +
                                            '</div>';
                                            
      $('delgroup_buttons').setStyle({position: 'absolute', top: '60px', left: '25px'});

      delGroupWin.setDestroyOnClose();
      delGroupWin.showCenter();
   },

   /**
    * Display a window to show the available settings
    * that the user can change.
    *
    * @author Benjamin Hutchins
    **/
   changeSettings: function() {
      var changeSettings;
      if($('changeSettings')) {
         Windows.getWindow('changeSettings').toFront();
         return;
      }
      
      changeSettings = new Window({id: 'changeSettings', className: "dialog", width: 300, height: 160, resizable: false, title: Languages.get('changeSettings'), draggable: true, closable: true, maximizable: false, minimizable: false, detachable: false, minWidth: 240, minHeight: 150, showEffectOptions: {duration: 0}, hideEffectOptions: {duration: 0}});
      
      changeSettings.setConstraint(true, {left: 0, right: 0, top: 0, bottom: 0});
      
      changeSettings.getContent().innerHTML = '<div class="dialog_info lang-changeSettingsInstructions langinsert-clear" style="padding:3px;">' + Languages.get('changeSettingsInstructions') + '</div> \
                                               <div id="changesettings_buttons">' +
                                               ButtonCtl.create(Languages.get('changeSettingsPassword'), 'Dialogs.changePass();if($(\'changeSettings\')){Windows.close(\'changeSettings\');}') +
                                               ButtonCtl.create(Languages.get('changeSettingsProfile'), 'Dialogs.changeProfile();if($(\'changeSettings\')){Windows.close(\'changeSettings\');}') +
                                               (useIcons ? ButtonCtl.create(Languages.get('changeSettingsBuddyicon'), 'Dialogs.changeIcon();if($(\'changeSettings\')){Windows.close(\'changeSettings\');}') : '') +
                                               ButtonCtl.create(Languages.get('cancel'), 'Windows.close(\'changeSettings\');') +
                                               '</div>';

      $('changesettings_buttons').setStyle({position: 'absolute', top: '60px', left: '85px'});

      changeSettings.setDestroyOnClose();
      changeSettings.showCenter();
   },

   /**
    * Display a window to allow the user to change
    * their buddy profile.
    *
    * @author Benjamin Hutchins
    **/
   changeProfile: function() {
      var changeProfileWin;
      if($('changeProfile')) {
         Windows.getWindow('changeProfile').toFront();
         return;
      }

      changeProfileWin = new Window({id: 'changeProfile', className: "dialog", width: 300, height: 250, resizable: false, title: Languages.get('changeProfile'), draggable: true, closable: true, maximizable: false, minimizable: false, detachable: false, minWidth: 240, minHeight: 240, showEffectOptions: {duration: 0}, hideEffectOptions: {duration: 0}});
      changeProfileWin.setConstraint(true, {left: 0, right: 0, top: 0, bottom: 0});
      changeProfileWin.getContent().innerHTML = '<div class="dialog_info lang-changeProfileInstructions langinsert-clear" style="padding:3px;">' + Languages.get('changeProfileInstructions') + '</div> \
                                            <span id="changeprofile_error_msg" class="errorMsg">&nbsp;</span> \
                                            <textarea style="width:97%;height:150px;" id="changeprofile_textarea"></textarea> \
                                            <div id="changeprofile_buttons">' +
                                            ButtonCtl.create(Languages.get('change'), 'System.changeProfile();') +
                                            ButtonCtl.create(Languages.get('cancel'), 'Windows.close(\'changeProfile\');') +
                                            '</div>';

      $('changeprofile_buttons').setStyle({position: 'absolute', top: '245px', left: '55px'});

      var xhConn = new XHConn();
      xhConn.connect(pingTo, "POST", "call=getprofile&user="+user,
         function(xh) {
            $('changeprofile_textarea').value = xh.responseText;
         }
      );

      changeProfileWin.setDestroyOnClose();
      changeProfileWin.showCenter();
   },

   /**
    * Display a window to allow the user to upload
    * a new buddy icon.
    *
    * @author Benjamin Hutchins
    **/
   changeIcon: function () {
      if(!useIcons) return;

      var changeIconWin;
      if($('changeIcon')) {
         Windows.getWindow('changeIcon').toFront();
         return;
      }
      
      changeIconWin = new Window({id: 'changeIcon', className: "dialog", width: 300, height: 160, resizable: false, title: Languages.get('changeBuddyicon'), draggable: true, closable: true, maximizable: false, minimizable: false, detachable: false, minWidth: 240, minHeight: 120, showEffectOptions: {duration: 0}, hideEffectOptions: {duration: 0}});
      
      changeIconWin.setConstraint(true, {left: 0, right: 0, top: 0, bottom: 0});
      
      changeIconWin.getContent().innerHTML = '<div class="dialog_info lang-changeBuddyiconInstructions langinsert-clear" style="padding:3px;">' + Languages.get('changeBuddyiconInstructions') + '</div> \
                                            <span id="changeicon_error_msg" class="errorMsg">&nbsp;</span> \
                                            <form target="changeicon_iframe" id="changeicon_form" enctype="multipart/form-data" method="post" action="' + pingTo + '"> \
                                            <input type="hidden" name="call" value="changeicon" style="display:none;" /> \
                                            <input id="changeicon_input_file" type="file" name="icon" /> \
                                            <div id="changeicon_buttons">' +
                                            ButtonCtl.createSubmit(Languages.get('change')) +
                                            ButtonCtl.create(Languages.get('cancel'), 'Windows.close(\'changeIcon\');') +
                                            '</form>' +
                                            '<iframe src="about:blank" onload="System.changeIcon()" style="display:none" id="changeicon_iframe" name="changeicon_iframe"></iframe>' + 
                                            '</div>';

      $('changeicon_buttons').setStyle({position: 'absolute', top: '150px', left: '55px'});

      changeIconWin.setDestroyOnClose();
      changeIconWin.showCenter();
   },

   /**
    * Display a window to allow the user to change
    * their password.
    *
    * @author Joshua Gross
    **/
   changePass: function() {
      var changePassWin;
      if($('changePass')) {
         Windows.getWindow('changePass').toFront();
         return;
      }
      
      changePassWin = new Window({id: 'changePass', className: "dialog", width: 300, height: 160, resizable: false, title: Languages.get('changePassword'), draggable: true, closable: true, maximizable: false, minimizable: false, detachable: false, minWidth: 240, minHeight: 120, showEffectOptions: {duration: 0}, hideEffectOptions: {duration: 0}});
      
      changePassWin.setConstraint(true, {left: 0, right: 0, top: 0, bottom: 0});
      
      changePassWin.getContent().innerHTML = '<div class="dialog_info lang-changePasswordInstructions langinsert-clear" style="padding:3px;">' + Languages.get('changePasswordInstructions') + '</div> \
                                            <span id="changepass_error_msg" class="errorMsg">&nbsp;</span> \
                                            <div id="changepass_box" style="padding-left:12px;width:100%;"> \
                                            <div style="display:block;float:left;margin-right:5px;padding-top:4px;" class="lang-currentPassword langinsert-replace">' + Languages.get('currentPassword') + ':</div><input type="password" style="width:110px;" id="currentpw" name="currentpw" onkeypress="handleInput(event, function() { System.changePass(); })" /><br /> \
                                            <div style="display:block;float:left;margin-right:20px;padding-top:4px;" class="lang-currentPassword langinsert-replace">' + Languages.get('newPassword') + ':</div><input type="password" style="width:110px;" id="newpw" name="newpw" onkeypress="handleInput(event, function() { changePass(); })" /> \
                                            <div style="display:block;float:left;margin-right:4px;padding-top:4px;" class="lang-currentPassword langinsert-replace">' + Languages.get('confirmPassword') + ':</div><input type="password" style="width:110px;" id="confirmpw" name="confirmpw" onkeypress="handleInput(event, function() { System.changePass(); })" /> \
                                            </div> \
                                            <div id="changepass_buttons">' +
                                            ButtonCtl.create(Languages.get('change'), 'System.changePass();') +
                                            ButtonCtl.create(Languages.get('cancel'), 'Windows.close(\'changePass\');') +
                                            '</div>';

      $('changepass_buttons').setStyle({position: 'absolute', top: '150px', left: '55px'});

      changePassWin.setDestroyOnClose();
      changePassWin.showCenter();
      setTimeout("$('currentpw').focus();", 125);
   }
};
