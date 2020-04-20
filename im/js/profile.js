///////////////////////////////////
//         ajax im 3.41          //
//    AJAX Instant Messenger     //
//   Copyright (c) 2006-2008     //
//    http://www.ajaxim.com/     //
//   Do not remove this notice   //
///////////////////////////////////


/**
 * Handle all requests that deal with a users' profile
 *
 * @author Benjamin Hutchins
 **/
var Profile = {
   windows: {},   // store all existent windows 

   /**
    * Create new window for a user's profile,
    * load the user profile and append it inside the window
    *
    * @arguments
    *   name - username of user we're getting the profile of
    *   title - title for window, default is the user's username
    *
    * @author Benjamin Hutchins
    **/
   create: function(name, title) {
      var winLeft = Math.round(Math.random()*(Browser.width()-360))+'px';
      var winTop  = Math.round(Math.random()*(Browser.height()-400))+'px';

      var winId = randomString(32) + '_profile';
   
      this.windows[name] = new Window({id: winId, className: "dialog", width: 320, height: 335, top: winTop, left: winLeft, resizable: true, title: title, draggable: true, detachable: false, minWidth: 320, minHeight: 150, showEffectOptions: {duration: 0}, hideEffectOptions: {duration: 0}});

      this.windows[name].setConstraint(true, {left: 0, right: 0, top: 0, bottom: 0});
      var xhConn = new XHConn();
      xhConn.connect(pingTo, "POST", "call=getprofile&user="+name,
         function(xh) {
            Profile.windows[name].getContent().innerHTML = '<div class="userProfile" id="'+name+'_userProfile">' +
                        (xh.responseText == "" ? Languages.get('hasNoProfile') : xh.responseText) + '</div>' +
                        '<div class="updateProfile">' +
                        ButtonCtl.create(Languages.get('update'), 'Profile.update(\''+name+'\');') +
                        '</div>';
         }.bind(name)
      );
      //this.windows[name].setDestroyOnClose();
      this.windows[name].show();
      this.windows[name].toFront();
      Windows.focusedWindow = this.windows[name];
   },

   /**
    * Force-update a user's profile
    *
    * @arguments
    *   name - user's username
    *
    * @author Benjamin Hutchins
    **/
   update: function(name) {
      if ($(name+'_userProfile')) {
         var xhConn = new XHConn();
         xhConn.connect(pingTo, "POST", "call=getprofile&user="+name,
            function(xh) {
               $(name+'_userProfile').innerHTML = (xh.responseText == "" ? Languages.get('hasNoProfile') : xh.responseText);
            }
         );
      }
   }
};
