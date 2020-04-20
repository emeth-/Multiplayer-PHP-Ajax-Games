///////////////////////////////////
//         ajax im 3.41          //
//    AJAX Instant Messenger     //
//   Copyright (c) 2006-2008     //
//    http://www.ajaxim.com/     //
//   Do not remove this notice   //
///////////////////////////////////


/**
 * Handles user status changes
 **/
var Status = {
   state: 0,                  // current status
   awayMessage: '',           // away message
   wasSetAutoAway: false,     // did you get set as away because you were being antisocial?
   lastIM: null,              // timestamp of the last IM you sent

   /**
    * Change your status
    *
    * @arguments
    *   status - status [0=online, 1=away, 99=friends only, 49=invisible]
    *   away_msg - away message to use
    *
    * @author Joshua Gross
    **/
   set: function(status, away_msg) {
      lastIM = new Date().getTime();
      if(status == 1) { // away
         this.state = 1;
         this.awayMessage = away_msg;
         $('curStatus').innerHTML = this.awayMessage.substring(0, 30) + (this.awayMessage.length > 30 ? '...' : '');
      } else { // back
         this.state = status; // 0 for avail, 99 for "friends only", 49 for "invisible"
         this.awayMessage = '';
         $('curStatus').innerHTML = away_msg;
      }
      
      $('statusList').hide();
   },

   /**
    * Display entry box to allow the user to enter
    * a custom away message.
    *
    * @author Joshua Gross
    **/
   customAway: function() {
      $('curStatus').hide();
      $('customStatus').show().focus();
   },

   /**
    * Handle keyboard entires on customStatus.
    *
    * @arguments
    *   event - sent by browser
    *
    * @author Joshua Gross
    **/
   processCustomAway: function(event) {
      event = event || event.window;
      var asc = document.all ? event.keyCode : event.which;

      if(asc == 13) {
         awayMessage = $('customStatus').value;
         $('curStatus').innerHTML = awayMessage.substring(0, 30) + (awayMessage.length > 30 ? '...' : '');
         $('curStatus').show();
         $('customStatus').hide();

         Status.set(1, awayMessage);
      }
      return asc != 13;
   },

   /**
    * Display/Hide the status drop down list
    *
    * @author Joshua Gross
    **/
   toggleStatusList: function() {
      var sL = $('statusList');
      if(sL.style.display == 'block') {
         sL.hide();
         if(sL.style.zIndex > Windows.maxZIndex) Windows.maxZIndex = sL.style.zIndex;
      } else {
         Element.setStyle(sL, {left: parseInt(Buddylist.buddyListWin.getLocation()['left']) + $('statusSettings').offsetLeft + $('blTopToolbar').offsetLeft + 'px', top: parseInt(Buddylist.buddyListWin.getLocation()['top']) + $('statusSettings').offsetTop + $('blTopToolbar').offsetTop + $('statusSettings').offsetHeight + 'px', zIndex:  Windows.maxZIndex + 20, display: 'block'});
      }
   }
};
