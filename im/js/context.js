///////////////////////////////////
//         ajax im 3.41          //
//    AJAX Instant Messenger     //
//   Copyright (c) 2006-2008     //
//    http://www.ajaxim.com/     //
//   Do not remove this notice   //
///////////////////////////////////


/**
 * Handle all right-click menus for buddy list
 *
 * @author Benjamin Hutchins
 **/
var Context = {
   currentUser: null,   // current user that the menu is being shown for
   lastClicked: null,   // last user that was right-clicked

   /**
    * On window load, apply new observes
    *
    * @author Benjamin Hutchins
    **/
   loaded: function() {
      if (typeof document.oncontextmenu != 'undefined') {
         document.oncontextmenu = Context.oncontextmenu;
      } else {
         window.oncontextmenu = Context.oncontextmenu;
      }

      document.onmousedown = window.onmousedown = Context.onmousedown;
   },

   /**
    * onClick of 'Get Info', open the users' profile.
    *
    * @author Benjamin Hutchins
    **/
   profile: function() {
      $('divContext').style.display = 'none';
      if(typeof(Profile.windows[Context.currentUser]) == 'undefined') {
         Profile.create(Context.currentUser, Context.currentUser);
      } else {
         if(!Profile.windows[Context.currentUser].isVisible()) {
            Profile.windows[Context.currentUser].show();
            Profile.windows[Context.currentUser].toFront();
         } else {
            Profile.windows[Context.currentUser].toFront();
         }
      }
   },

   /**
    * onClick of 'IM', open the conversation window with the user.
    *
    * @author Benjamin Hutchins
    **/
   createIM: function() {
      $('divContext').style.display = 'none';
      if(typeof(IM.windows[Context.currentUser]) == 'undefined') {
         IM.create(Context.currentUser, Context.currentUser);
      } else {
         if(IM.windows[Context.currentUser].detached) {
            if(IM.windows[Context.currentUser].popup.closed) {
               IM.windows[Context.currentUser] = IM.windows[Context.currentUser].old;
               IM.windows[Context.currentUser].show();
            } else {
               IM.windows[Context.currentUser].popup.focus();
            }
         } else if(!IM.windows[Context.currentUser].isVisible()) {
            IM.windows[Context.currentUser].show();
            IM.windows[Context.currentUser].toFront();
            setTimeout("scrollToBottom('" + IM.windows[Context.currentUser].getId() + "_rcvd')", 125);
            setTimeout("$('" + IM.windows[Context.currentUser].getId() + "_sendBox').focus();", 250);
         } else {
            IM.windows[Context.currentUser].toFront();
            setTimeout("$('" + IM.windows[Context.currentUser].getId() + "_sendBox').focus();", 250);
         }
      }
   },

   /**
    * onClick of 'Block' or 'Unblock', toggle the user's blocked status.
    *
    * @author Benjamin Hutchins
    **/
   blockBuddy: function() {
      $('divContext').style.display = 'none';
      Dialogs.blockBuddy(Context.currentUser);
   },

   /**
    * onClick of 'Remove', remove the user from the friend's list.
    *
    * @author Benjamin Hutchins
    **/
   removeBuddy: function() {
      $('divContext').style.display = 'none';
      Dialogs.removeBuddy(Context.currentUser);
   },

   /**
    * Global onContextMenu handler
    *
    * @author Benjamin Hutchins
    **/
   oncontextmenu: function (event) {
      if (loggedIn && Context.lastClicked != null) {
         event = event || window.event;

         Context.currentUser = Context.lastClicked;
         var scrollTop = document.body.scrollTop ? document.body.scrollTop : document.documentElement.scrollTop;
         var scrollLeft = document.body.scrollLeft ? document.body.scrollLeft : document.documentElement.scrollLeft;

         $('divContext').style.display = 'none';
         var group = Buddylist.listObjects[Context.currentUser].group;
         $('contextBlock').innerHTML = (typeof Buddylist.list[group] != 'undefined' && Buddylist.list[group][Context.currentUser].blocked == true ? Languages.get('contextUnblock') : Languages.get('contextBlock'));
         Element.setStyle($('divContext'), {
            left: (event.clientX + scrollLeft - 5) + 'px',
            top: (event.clientY + scrollTop - 5) + 'px',
            zIndex: Windows.maxZIndex + 20,
            display: 'block'
         });

         Context.lastClicked = null;
         return false;
      } else if ($('divContext')) {
         $('divContext').style.display = 'none';
      }
   },

   /**
    * Global onMouseDown handler, hide right-click menu,
    * as long as it wasn't a right click.
    *
    * @author Benjamin Hutchins
    **/
   onmousedown: function (event) {
      if (loggedIn) {
         event = event || window.event;
         if (event.button != 2 && event.button != 3) {
            setTimeout("$('divContext').style.display='none';", 100);
         }
      }
   }
};
