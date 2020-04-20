///////////////////////////////////
//         ajax im 3.41          //
//    AJAX Instant Messenger     //
//   Copyright (c) 2006-2008     //
//    http://www.ajaxim.com/     //
//   Do not remove this notice   //
///////////////////////////////////


/**
 * Class to handle buddylist events
 *
 * @author Joshua Gross
 **/
var Buddylist = {  
   buddyListWin: null,  // buddy list window

   /**
    * Process the creation of the buddy list window
    *
    * @author Joshua Gross
    **/
   create: function() {
      Event.observe(window, 'resize', Buddylist.fixBuddyList);
      
      if(!$('bl')) {
         this.buddyListWin = new Window({id: 'bl', className: "dialog", width: 210, height: (Browser.height() - 60), zIndex: 100, resizable: true,  title: Languages.get('buddyList'), draggable: true, closable: false, maximizable: false, detachable: false, minWidth: 205, minHeight: 150, showEffectOptions: {duration: 0}, hideEffectOptions: {duration: 0}});
         this.buddyListWin.setConstraint(true, {left: 0, right: 0, top: 0, bottom: 0});
      }
      
      this.buddyListWin.getContent().innerHTML = '<div id="blTopToolbar"><span class="toolbarButton">' +
                                                  '<img id="addbuddy" src="themes/'+theme+'/window/addbuddy.png" class="toolbarButton" onclick="Dialogs.newBuddy();" alt="' + Languages.get('addBuddyButton') + '" title="' + Languages.get('addBuddyButton') + '" onmouseover="buttonHover(this);" onmouseout="buttonNormal(this);" onmousedown="buttonDown(this);" onmouseup="buttonNormal(this);" /></span>' +
                                                  '<span class="toolbarButton toolbarSpacer"><img id="removebuddy" src="themes/'+theme+'/window/removebuddy.png" class="toolbarButton" onclick="Dialogs.removeBuddy();" alt="' + Languages.get('removeBuddyButton') + '" title="' + Languages.get('removeBuddyButton') + '" onmouseover="buttonHover(this);" onmouseout="buttonNormal(this);" onmousedown="buttonDown(this);" onmouseup="buttonNormal(this);" /></span>' +
                                                  '<span class="toolbarButton"><img id="imanyone" src="themes/'+theme+'/window/imanyone.png" class="toolbarButton" onclick="Dialogs.newIM();" alt="' + Languages.get('IMAnyoneButton') + '" title="' + Languages.get('IMAnyoneButton') + '" onmouseover="buttonHover(this);" onmouseout="buttonNormal(this);" onmousedown="buttonDown(this);" onmouseup="buttonNormal(this);" /></span>' +
                                                  '<span class="toolbarButton toolbarSpacer"><img id="joinroom" src="themes/'+theme+'/window/joinroom.png" class="toolbarButton" onclick="Dialogs.newRoom();" alt="' + Languages.get('joinChatroomButton') + '" title="' + Languages.get('joinChatroomButton') + '" onmouseover="buttonHover(this);" onmouseout="buttonNormal(this);" onmousedown="buttonDown(this);" onmouseup="buttonNormal(this);"/></span>' +
                                                  '<span class="toolbarButton"><img id="changepassword" src="themes/'+theme+'/window/changepassword.png" class="toolbarButton" onclick="Dialogs.changeSettings();" alt="' + Languages.get('changeSettingsButton') + '" title="' + Languages.get('changeSettingsButton') + '" onmouseover="buttonHover(this);" onmouseout="buttonNormal(this);" onmousedown="buttonDown(this);" onmouseup="buttonNormal(this);" /></span>' +
                                                  '<span class="toolbarButton"><img id="toggleaudio" src="themes/'+theme+'/window/audio_'+(audioNotify ? 'on' : 'off')+'.png" onclick="toggleAudio();" alt="' + Languages.get('toggleSoundButton') + '" title="' + Languages.get('toggleSoundButton') + '" /></span>' +
                                                  (typeof(Status) != 'undefined' ? '<div id="statusSettings"><input type="text" id="customStatus" onkeypress="Status.processCustomAway(event);" style="display:none" onblur="if($(\'customStatus\').style.display != \'none\') { $(\'customStatus\').style.display = \'none\'; $(\'curStatus\').style.display = \'block\'; }" /><a href="#" id="curStatus" onclick="Status.toggleStatusList();return false;">' + Languages.get('available') + '</a></div>' : '') +
                                                  '</div><div id="blContainer"><ul id="buddylist" class="sortable box"><li style="display:none"></li></ul></div><div id="blBottomToolbar"><a href="#" style="-moz-outline-style: none;" onclick="System.logout();return false;"><img src="themes/'+theme+'/window/signoff.png" style="border:0;" alt="' + Languages.get('signOff') + '" onmouseover="buttonHover(this);" onmouseout="buttonNormal(this);" onmousedown="buttonDown(this);" onmouseup="buttonNormal(this);" /></a></div>';
      Event.observe(this.buddyListWin.getContent(), 'contextmenu', function() { return false; });
      
      $('bl_minimize').setStyle({left: (this.buddyListWin.getSize()['width'] - 21) + 'px'});
      
      this.sizeBuddyList();
      
      this.buddyListWin.showCenter(false, (((Browser.height()-40) / 2) - (this.buddyListWin.getSize()['height'] / 2)), (buddyListLoc == 0 ? 10 : (Browser.width() - this.buddyListWin.getSize()['width'] - 10)));
      this.buddyListWin.toFront();
      
      this.list = {};
      this.listObjects = {};
      this.blocked = {};
   },
   
   /**
    * Destroy the buddy list window
    *
    * @author Joshua Gross
    **/
   destroy: function() {
      this.buddyListWin.destroy();
   },
   
   /**
    * Reposition buddylist
    *
    * @author Joshua Gross
    **/
   fixBuddyList: function() {
      if(Buddylist.buddyListWin.isVisible()) {
         Buddylist.buddyListWin.setSize(210, (Browser.height() - 60));
         Buddylist.buddyListWin.setLocation((((Browser.height()-40) / 2) - (Buddylist.buddyListWin.getSize()['height'] / 2)), (buddyListLoc == 0 ? 10 : (Browser.width() - Buddylist.buddyListWin.getSize()['width'] - 10)));
         Buddylist.sizeBuddyList();
      }
   },

   /**
    * Resize buddylist
    *
    * @author Joshua Gross
    **/
   sizeBuddyList: function() {
      $('blContainer').setStyle({width:  (this.buddyListWin.getSize()['width'] - 8) + 'px',
                                 height: (this.buddyListWin.getSize()['height'] - 95) + 'px'});
                                 
      $('blBottomToolbar').setStyle({width:  (this.buddyListWin.getSize()['width'] - 8) + 'px',
                                     top:    (this.buddyListWin.getSize()['height'] - 7) + 'px'});

      $('bl_minimize').setStyle({left: (this.buddyListWin.getSize()['width'] - 21) + 'px'});                                     
   },

   /**
    * Add new buddy to the list
    *
    * @arguments
    *   username - user's username
    *   groupname - group the user is in
    *
    * @author Joshua Gross
    **/
   addNewBuddy: function(username, groupname) {
      username = username.toLowerCase();
      if(!inArray(Buddylist.list, username) && (!Buddylist.listObjects[username] || !$(Buddylist.listObjects[username].obj))) {      
         var xhConn = new XHConn();
         
         xhConn.connect(pingTo, "POST", "call=isuser&username="+username, function(xh) {
            if(xh.responseText == 'not_exists') {
               $('newbuddy_error_msg').innerHTML = Languages.get('noSuchUser');
            } else {
               if(!$(groupname.replace(/\s/, '_') + '_group')) {
                  Buddylist.addGroup(groupname);
                  Buddylist.list[groupname] = [];
               }
               
               Buddylist.addBuddy(username, 'Offline', 'none');
               
               if(parseInt(xh.responseText) == 0) {
                  Buddylist.moveBuddy(username, 'Offline');
                  $(Buddylist.listObjects[username].img).src = 'themes/' + theme + '/offline.png';
               } else if(parseInt(xh.responseText) == 2) {
                  Buddylist.moveBuddy(username, groupname);
                  $(Buddylist.listObjects[username].img).src = 'themes/' + theme + '/away.png';            
               } else {
                  Buddylist.moveBuddy(username, groupname);
                  $(Buddylist.listObjects[username].img).src = 'themes/' + theme + '/online.png';
               }
               
               Buddylist.list[groupname][username] = {'username': username, 'blocked': false, 'status': parseInt(xh.responseText)};
         
               var xhConn = new XHConn();
               xhConn.connect(pingTo, "POST", "call=addbuddy&username="+username+'&group='+groupname, null);
               
               Windows.close('newBuddy');
            }
         });
      } else {
         $('newbuddy_error_msg').innerHTML = Languages.get('alreadyOnBuddylist');
      }
   },

   /**
    * Add buddy to the list
    *
    * @arguments
    *   username - username of the buddy we're adding
    *   groupname - the group the buddy is in
    *   buddyicon - the buddy's buddyiocn
    *
    * @author Joshua Gross
    * update Benjamin Hutchins
    **/
   addBuddy: function(username, groupname, buddyicon) {  
      if(!$(groupname.replace(/\s/, '_') + '_group')) this.addGroup(groupname);
      var groupList = $(groupname.replace(/\s/, '_') + '_group');
      var iconsrc = (buddyicon=='none'?defaultIcon:pathToIcons+username+'.'+buddyicon);
   
      var randId = Math.floor(Math.random()*1000000000);
      while($(randId + '_blItem'))
         randId = Math.floor(Math.random()*1000000000);
   
      groupList.innerHTML += '<li id="'+randId+'_blItem" class="buddy'+(useIcons && showInList ? " buddyicon" : "")+'" onmousedown="Buddylist.clickBuddy(event, \''+username+'\');return false;" onselectstart="return false;" onmouseover="Buddylist.selectBuddy(this, \''+username+'\', true);" onmouseout="Buddylist.selectBuddy(this, \''+username+'\', false);" ondblclick="Buddylist.onBuddyDblClick();">' + (useIcons&&showInList?(defaultIcon==""&&buddyicon=='none'?'':'<img class="blIcon" src="'+iconsrc+'" alt="" id="'+randId+'_blIcon" />'):'') + '&nbsp;&nbsp;&nbsp;&nbsp;<img src="themes/' + theme + '/online.png" alt="" id="'+randId+'_blImg" />&nbsp;'+username+'</li>';
      
      Buddylist.listObjects[username] = {};
      Buddylist.listObjects[username].obj  = randId + '_blItem';
      Buddylist.listObjects[username].img  = randId + '_blImg';
      Buddylist.listObjects[username].icon = buddyicon;
      Buddylist.listObjects[username].group = groupname;
      
      $(Buddylist.listObjects[username].obj).setStyle({listStyleType: 'none'});
   },

   /**
    * Move a buddy from one group to another
    *
    * @arguments
    *   username - username of the buddy we're moving
    *   groupname - new group name
    *
    * @author Joshua Gross
    **/
   moveBuddy: function(username, groupname) {
      if(groupname == null) return;
      if($(Buddylist.listObjects[username].obj).parentNode == $(groupname.replace(/\s/, '_') + '_group')) return;
      if(!$(groupname.replace(/\s/, '_') + '_group')) this.addGroup(groupname);
      
      var group = $(groupname.replace(/\s/, '_') + '_group')

      group.insertBefore($(Buddylist.listObjects[username].obj), null);
   },

   /**
    * Add a new group the buddylist window
    *
    * @arguments
    *   groupname - group to add
    *
    * @author Joshua Gross
    **/
   addGroup: function(groupname) {
      var bList = $('buddylist');
      bList.innerHTML = (groupname=='Offline' ? bList.innerHTML : '') + '<li id="' + groupname.replace(/\s/, '_') + '_groupTop" class="groupTop" onmousedown="return false;" onselectstart="return false;" onclick="Buddylist.toggleGroup(\'' + groupname + '\');"><img id="' + groupname.replace(/\s/, '_') + '_groupArrow" src="themes/' + theme + '/window/arrow.png" />&nbsp;&nbsp;' + groupname + 
                        (groupname!='Offline' ? ' <a href="#" class="delLink" onclick="Dialogs.removeGroup(\'' + groupname + '\');return false;"><img src="themes/' + theme + '/window/smallx.png" style="border:0;" onmouseover="buttonHover(this);" onmouseout="buttonNormal(this);" /></a>' : '') + '</li>' + "\n" + '<ul id="' + groupname.replace(/\s/, '_') + '_group" class="group"></ul>' + (groupname!='Offline' ? bList.innerHTML : '');
   },
   
   /**
    * Remove buddy from the buddylist permanently
    *
    * @arguments
    *   username - buddy we're removin
    *
    * @author Joshua Gross
    **/
   deleteBuddy: function(username) {
      if(username.indexOf('_group') != -1) {
         this.deleteGroup(username.substring(0, username.length - 6));
         return;
      }
   
      var usernam = username;
   
      var ingroup = null;
      for (var group in this.list) {
         if(typeof(this.list[group][username]) !== 'undefined' && this.list[group][username].username == username) {
            ingroup = group;
            break;
         }
      }
   
      var buddyToRmv = $(Buddylist.listObjects[username].obj);

      if(typeof(buddyToRmv) !== 'undefined') {
         buddyToRmv.parentNode.removeChild(buddyToRmv);
         if(this.list[ingroup]) {
            this.list[ingroup][username] = null;

            var xhConn = new XHConn();
            xhConn.connect(pingTo, "POST", "call=removebuddy&username="+username, null);

         }
         Dialog.closeInfo();
      }
   },
   
   /**
    * Process the blocking of a buddy
    *
    * @arguments
    *   username - the buddy to be blocked
    *
    * @author Joshua Gross
    * @update Benjamin Hutchins
    **/
   blockBuddy: function(username) {     
      var isBlocked = this.blocked.inArray(username);
      if(isBlocked) {
         for(var i=0; i<this.blocked.length; i++) {
            if(this.blocked[i] == username) this.blocked.splice(i, 1);
            break;
         }
      } else {
         this.blocked[this.blocked.length] = username;
      }

      var xhConn = new XHConn();      
      xhConn.connect(pingTo, "POST", "call=blockbuddy&username="+username+(isBlocked ? '&status=' + (Status.state + 1) : ''), null);

      for (var group in this.list) {
         if(typeof(this.list[group][username]) !== 'undefined' && this.list[group][username].username == username) {
            this.list[group][username].blocked = (isBlocked ? false : true);
            $(Buddylist.listObjects[username].img).src = (!isBlocked ? 'themes/' + theme + '/blocked.png' : (Buddylist.list[group][username].status == 1 ? 'themes/' + theme + '/online.png' : (Buddylist.list[group][username].status >= 2 ? 'themes/' + theme + '/away.png' : 'themes/' + theme + '/offline.png')));
            if(!blockedBuddyStatus && isBlocked) {
               Buddylist.moveBuddy(username, Languages.get('offline'));
            }
            break;
         }
      }
   },

   /**
    * Remove a group from the buddylist permanently
    *
    * @arguments
    *   groupname - group to be removes
    *
    * @author Joshua Gross
    **/
   deleteGroup: function(groupname) {
      var groupNoSpaces = groupname.replace(/\s/, '_');
      var groupToRmv = $(groupNoSpaces+"_group");
      var groupTop   = $(groupNoSpaces+"_groupTop");
         
      if(typeof(groupToRmv) !== 'undefined') {
         groupToRmv.parentNode.removeChild(groupToRmv);
         groupTop.parentNode.removeChild(groupTop);
         
         for(var i=0;i<this.list[groupname].length;i++) {
            var buddyItem = $(Buddylist.listObjects[this.list[groupname][i].username].obj);
            if(typeof(buddyItem) !== 'undefined') buddyItem.parentNode.removeChild(buddyItem);
         }
         
         delete this.list[groupname];
         
         var xhConn = new XHConn();
         xhConn.connect(pingTo, "POST", "call=removegroup&group="+groupname, null);
         
         Dialog.closeInfo();
      } else {
         $('deletebuddy_error_msg').innerHTML = Languages.get('noSuchGroup');
         $('deletebuddy_error_msg').show();
         Dialog.win.updateHeight();
      }
   },

   /**
    * Toggle whether a group is collapsed or not.
    *
    * @arguments
    *   groupname - group to toggle
    *
    * @author Joshua Gross
    **/
   toggleGroup: function(groupname) {
      var groupList = $(groupname.replace(/\s/, '_') + '_group');
      var groupArrow = $(groupname.replace(/\s/, '_') + '_groupArrow');
      
      if(groupList.style.display != 'none') {
         groupList.hide();
         groupArrow.src = 'themes/' + theme + '/window/arrow_up.png';
      } else {
         groupList.show();
         groupArrow.src = 'themes/' + theme + '/window/arrow.png';
      }
   },

   /**
    * Proccess mouseover ad mouseout for list items
    *
    * @arguments
    *   sel - list element
    *   username - user being messed with
    *   selected - is the mouse over or out
    **/
   selectBuddy: function(sel, username, selected) {
      if(selected === false) {
         if(curSelected != username) {
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
    * Handle mouse clicks on a buddy in the buddylist
    *
    * @arguments
    *   event - passed by the browser
    *   username - the user that was clicked
    *
    * @author Joshua Gross
    * @update Benjamin Hutchins
    **/
   clickBuddy: function(event, username) {
      event = event || window.event;

      if (event.button == 2) {
         Context.lastClicked = username;
      } else {
         Context.lastClicked = null;

         if(curSelected.length > 0) {
            try {
               var el = $(Buddylist.listObjects[curSelected].obj);
               Element.addClassName(el, 'listNotSelected');
               Element.removeClassName(el, 'listSelected');
               Element.removeClassName(el, 'listHover');
            } catch(e) { }
         }

         curSelected = username;

         var oel = $(Buddylist.listObjects[curSelected].obj);
         Element.addClassName(oel, 'listSelected');
         Element.removeClassName(oel, 'listNotSelected');
         Element.removeClassName(oel, 'listHover');
      }
      return false;
   },

   /**
    * Process double clicks, open the IM window
    *
    * @author Joshua Gross
    **/
   onBuddyDblClick: function() {
      if(curSelected.length > 0) {
         if(typeof(IM.windows[curSelected]) == 'undefined') {
            IM.create(curSelected, curSelected);
         } else {
            if(IM.windows[curSelected].detached) {
               if(IM.windows[curSelected].popup.closed) {
                  IM.windows[curSelected] = IM.windows[curSelected].old;
                  IM.windows[curSelected].show();
               } else {
                  IM.windows[curSelected].popup.focus();
               }
            } else if(!IM.windows[curSelected].isVisible()) {
               IM.windows[curSelected].show();
               IM.windows[curSelected].toFront();
               setTimeout("scrollToBottom('" + IM.windows[curSelected].getId() + "_rcvd')", 125);
               setTimeout("$('" + IM.windows[curSelected].getId() + "_sendBox').focus();", 250);
            } else {
               IM.windows[curSelected].toFront();
               setTimeout("$('" + IM.windows[curSelected].getId() + "_sendBox').focus();", 250);
            }
         }
      }
   }
};
