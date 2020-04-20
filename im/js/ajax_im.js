///////////////////////////////////
//         ajax im 3.41          //
//    AJAX Instant Messenger     //
//   Copyright (c) 2006-2008     //
//    http://www.ajaxim.com/     //
//   Do not remove this notice   //
///////////////////////////////////

// See config.js for configuration options //

/**
 * Global variables used through the script
 **/
var user='';
var pass='';
var curSelected='';
var loggedIn=false;
var titlebarBlinker=false;
var defaultTitle = document.title=(siteName.length>0?siteName:document.title);
var blinkerTimer;
var pingTimer;
var newWin, newWinRcvd;
var windowButtons;
var smilies = [];
var soundManager;


/**
 * Before the window is 'unloaded', confirm the user wants to leave
 *
 * @author Joshua Gross
 **/
window.onbeforeunload = function(event) {
   event = event || window.event;
   if(event && loggedIn) {
      var text = Languages.get('onunload');
      event.returnValue = text;
      window.onbeforeunload = function() { };
      return text;
   }
}


/**
 * After all content and images for the web page is loaded,
 * run some functions
 *
 * @author Joshua Gross
 **/
window.onload = function() {
   Windows.addObserver({ onResize: IM.handleResize });
   Windows.addObserver({ onClose: IM.handleClose });
   Windows.addObserver({ onMaximize: IM.handleResize });
   Windows.addObserver({ onMinimize: IM.handleMinimize });
   
   // initialize the sound manager
   soundManager = new SoundManager();
   soundManager.onload = function() {
      soundManager.createSound({id: 'msg_in', url: './sounds/msg_in.mp3', autoLoad: true});
      soundManager.createSound({id: 'msg_out', url: './sounds/msg_out.mp3', autoLoad: true});
      soundManager.play('msg_out');
   };
   soundManager.beginDelayedInit();

   // attach event
   //  before window is unloaded, remove sound manager
   Element.observe(window, 'beforeunload', soundManager.destruct);
   
   // center modal
   setTimeout(function() { recenterModal(null); }, 1000);
   
   // on window resize, recenter modal
   Event.observe(window, 'resize', recenterModal);

   // on window unload, logout the user
   Event.observe(window, 'unload', function() { if(loggedIn) System.logout(); });

   // clear all inputs
   clearInputs();

   // replace status images with theme-based images
   $('statusList').getElementsBySelector('img').each(function(el) {
      el.src = el.src.replace(/images/g, 'themes/' + theme);
   });

   // initialize Context Menus
   Context.loaded();
   
   // hook mousedown for status list
   var dOMD = (document.onmousedown ? document.onmousedown : new Function());
   document.onmousedown = window.onmousedown = function(e) {
      showHide(e);
      dOMD(e);
   }

   // if the user wants to disable register, hide the button
   if (!allowNewUsers) {
      $$('.registerObject').each(function(el) {
         el.remove();
      });
      // then fix the buttons for login
      $('login_dialog_links').setStyle({width:'190px'});
   }

   // show login
   Dialogs.login();
};


/**
 * After all content for the web page is loaded,
 * load some more stuff.
 *
 * @author Joshua Gross
 **/
Event.onReady(function() {
   var getEmoteHTML = new XHConn();
   getEmoteHTML.connect('themes/' + theme +'/emoticons/emoticons.html', 'GET', '', function(xh) {
      document.body.innerHTML += xh.responseText;

      var getEmoteJS = new XHConn();
      getEmoteJS.connect('themes/' + theme +'/emoticons/emoticons.js', 'GET', '', function(xh) {
         window.smilies = xh.responseText.parseJSON();
      });
   });
   
   // load language file
   var s = document.createElement('script');
   s.src = 'languages/' + languageOptions[0][0] + '/lang.js?' + (new Date()).getTime();
   s.type = 'text/javascript';
   document.getElementsByTagName('head').item(0).appendChild(s);

   // if lingo is enabled
   if (useLingo) {
      // load the lingo file
      var l = document.createElement('script');
      l.src = 'languages/' + languageOptions[0][0] + '/lingo.js?' + (new Date()).getTime();
      l.type = 'text/javascript';
      document.getElementsByTagName('head').item(0).appendChild(l);
   }
   
   // if there is more than one language installed on the server, show them as options
   if(languageOptions.length > 1) {
      for(var i=0; i<languageOptions.length; i++)
         $('languageList').innerHTML += '<a href="#" onclick="Languages.load(\'' + languageOptions[i][0] + '\');return false;">' + languageOptions[i][1] + '</a> | ';

      $('languageList').innerHTML = $('languageList').innerHTML.substring(0, $('languageList').innerHTML.length - 3);
   }
});


/**
 * Clear the value of input elements
 *
 * @author Joshua Gross
 **/
function clearInputs() {
   var formInputs = document.getElementsByTagName('input');
   for (var i=0; i<formInputs.length; i++)
      if(formInputs[i].type == 'text' || formInputs[i].type == 'password') formInputs[i].value = '';
}


/**
 * Centers the login/register/forgot password modal
 *
 * @arguments
 *   event - passed by browser
 *
 * @author Joshua Gross
 **/
function recenterModal(event) {
   var windowScroll = WindowUtilities.getWindowScroll();    
   var pageSize = WindowUtilities.getPageSize();    

   var top = (pageSize.windowHeight - $('modal').getHeight())/2;
   top += windowScroll.top;

   var left = (pageSize.windowWidth - $('modal').getWidth())/2;
   left += windowScroll.left;

   $('modal').setStyle({top: top + 'px', left: left + 'px', display: 'block'});
}


/**
 * This function is ran everytime the mouse is clicked
 *
 * @arguments
 *   event - passed by browser
 *
 * @author Joshua Gross
 * @update Benjamin Hutchins
 **/
function showHide(event) {
   var target;
   event = event || window.event;
   if (document.all) {
      target = event.srcElement;
   } else {
      target = event.target;
   }
  if (!target) {return;}
  if (loggedIn &&
      target.id != 'statusList' &&
      target.id != 'fontsList' &&
      target.id != 'statusSettings' &&
      target.id != 'curStatus' &&
      target.parentNode.id != 'statusList' &&
      target.parentNode.id != 'fontsList' &&
      target.id != 'customMessage' &&
      target.parentNode.id != 'customMessage' &&
      target.id != 'emoticonList' &&
      target.className != 'emotIcon' &&
      target.id != 'fontSizeList' &&
      target.parentNode.id != 'fontSizeList' &&
      target.id != 'fontColorList' &&
      target.className != 'colorItem' &&
      target.className != 'tTable'
   ) // to put it simply, if you did not click on a list
   {
      Element.setStyle($('statusList'), {'display': 'none'});
      Element.setStyle($('emoticonList'), {'display': 'none'});
      Element.setStyle($('fontsList'), {'display': 'none'});
      Element.setStyle($('fontSizeList'), {'display': 'none'});
      Element.setStyle($('fontColorList'), {'display': 'none'});
      return;
   }
}


/**
 * Will check for the press of the 'Return'/'Enter' key,
 * if found, func() is ran. If it is not, then func2, if supplied,
 * and if it is a function, is ran.
 *
 * @arguments
 *   event - supplied by browser
 *   func - (function) run if Enter is pressed
 *   func2 - (function) run if Enter is not pressed
 *
 * @author Benjamin Hutchins
 **/
function handleInput(event, func, func2) {
   event = event || event.window;
   var asc = document.all ? event.keyCode : event.which;
   
   if(asc == 13) {
      func();
      return false;
   }

   if (typeof func2 == 'function')
      func2();

   return true;
}


/**
 * Will run through passed variable 'text' and fix
 * it's regExpression faults.
 *
 * @author Joshua Gross
 * @return fromatted 'text'
 **/
function regExpEscape(text) {
  if (!arguments.callee.sRE) {
    var specials = [
      '/', '.', '*', '+', '?', '|',
      '(', ')', '[', ']', '{', '}', '\\'
    ];
    arguments.callee.sRE = new RegExp(
      '(\\' + specials.join('|\\') + ')', 'g'
    );
  }
  return text.replace(arguments.callee.sRE, '\\$1');
}


/**
 * Wrapper to scroll down within an element
 *
 * @arguments
 *   id - element to scroll down within
 *
 * @author Joshua Gross
 **/
function scrollToBottom(id) {
   $(id).scrollTop = $(id).scrollHeight - $(id).clientHeight;
}


/**
 * Strip out whitespace on then sides of 'text'
 *
 * @author Joshua Gross
 * @return trimmed 'text'
 **/
function trim(text) {
   if(text == null) return null;
   return text.replace(/^[ \t]+|[ \t]+$/g, "");
}


/**
 * Toggle audio on and off
 *
 * @author Joshua Gross
 **/
function toggleAudio() {
   if(audioNotify == true) {
      audioNotify = false;
      $('toggleaudio').src = 'themes/'+theme+'/window/audio_off.png';
   } else {
      audioNotify = true;
      $('toggleaudio').src = 'themes/'+theme+'/window/audio_on.png';
   }
}


/**
 * Make a window title and the web page "blink"
 *
 * @arguments
 *   name - username to retrieve IM Window
 *   message - message to show 'nlinking'
 *   alter - which step of blinking are we in
 *   chatroom - is this a chatroom
 *
 * @author Joshua Gross
 **/
function titlebarBlink(name, message, alter, chatroom) {
   if(titlebarBlinker == false) {
      document.title = defaultTitle;
      return;
   }
   
   if(chatroom == 0 && IM.windows[name].detached) {
      IM.windows[name].popup.titlebarBlink(name, message, alter);
      return;
   }
   
   if(alter == 0) {
      document.title = name + '!';
      blinkerTimer = setTimeout("titlebarBlink('"+name+"', '"+message+"', 1, "+chatroom+")", 1000);
   } else if(alter == 1) {
      document.title = '"' + message.substring(0, 10) + (message.length > 10 ? '...' : '') + '"';
      blinkerTimer = setTimeout("titlebarBlink('"+name+"', '"+message+"', 2, "+chatroom+")", 1000);
   } else if(alter == 2) {
      document.title = defaultTitle;
      blinkerTimer = setTimeout("titlebarBlink('"+name+"', '"+message+"', 0, "+chatroom+")", 1000);
   }
}


/**
 * Toggle the variable 'titlebarBlinker' to true/false
 *
 * @author Joshua Gross
 * @update Benjamin Hutchins
 **/
function blinkerOn(onoff) {
   titlebarBlinker = (onoff == true ? true : false);
}


/**
 * Button effects for browsers without ":" support
 *
 * @arguments
 *   el - element to affect
 *
 * @author Joshua Gross
 **/
function buttonHover(el) {
   var newsrc = el.src;
   newsrc = newsrc.replace(/_hover/, '');
   el.src = newsrc.replace(/\.png/, '_hover.png');
}
function buttonDown(el) {
   el.src = el.src.replace(/_hover\.png/, '_down.png');
}
function buttonNormal(el) {
   el.src = el.src.replace(/\_hover.png/, '.png').replace(/\_down.png/, '.png');
}


/**
 * Check to see is an email is valid
 *
 * @arguments
 *   email - email to check
 *
 * @author Joshua Gross
 * @updated Benjamin Hutchins
 * @return true if email is valid, false otherwise
 **/
function checkEmailAddr(email) {
   var filter  = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
   return filter.test(email);
}


/**
 * Generates a random string
 *
 * @arguments
 *   length - length of string to be created
 *
 * @author Joshua Gross
 * @return random string
 **/
function randomString(length) {
   var chars = "abcdefghijklmnopqrstuvwxyz1234567890";
   var pass = "";
   var charLength = chars.length;

   for(x=0;x<length;x++) {
      i = Math.floor(Math.random() * charLength);
      pass += chars.charAt(i);
   }

   return pass;
}


/**
 * in_array for javascript
 *
 * @arguments
 *   arr - array to be searched
 *   value - item to search for
 *
 * @author Joshua Gross
 * @return true if 'value' is found in 'arr', false if it is not.
 **/
function inArray(arr, value) {
   var i;
   for (var group in arr) {
     // Matches identical (===), not just similar (==).
      for(i=0; i<arr[group].length; i++) {
         if(arr[group][i] === value)
            return true;
      }
   }
   return false;
};
Array.prototype.inArray = function(search_term) { // Adds inArray to all arrays
   var i = this.length;
   if (i > 0) {
      do {
         if (this[i] === search_term) {
            return true;
         }
      } while (i--);
   }
   return false;
}


/**
 * Checks to see if a string is alphanumeric (only letters and numbers)
 *
 * @author Joshua Gross
 * @return true if string is alphanumeric, false otherwise
 **/
String.prototype.isAlphaNumeric = function() {return /^[A-Za-z0-9_\d]+$/.test (this)};


/**
 * Load the theme stylesheet
 **/
var loadCSS = document.createElement("link");
loadCSS.setAttribute("rel", "stylesheet")
loadCSS.setAttribute("type", "text/css")
loadCSS.setAttribute("href", 'themes/' + theme + '/style.css')
if (typeof loadCSS != "undefined")
   document.getElementsByTagName("head")[0].appendChild(loadCSS);
