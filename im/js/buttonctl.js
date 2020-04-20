///////////////////////////////////
//         ajax im 3.41          //
//    AJAX Instant Messenger     //
//   Copyright (c) 2006-2008     //
//    http://www.ajaxim.com/     //
//   Do not remove this notice   //
///////////////////////////////////


/**
 * Button control class
 */
var ButtonCtl = {
   /**
    * Create a button/link wrapper
    *
    * @arguments
    *   text - innerHTML for link
    *   action - onClick action
    *   id - element ID to apply (if none is supplied, none is set)
    *
    * @author Joshua Gross
    **/
   create: function(text, action, id) {
      return '<a href="#" ' + (id!=null ? 'id="' + id + '" ' : '') + 'class="stdButton" onclick="' + action + 'return false;" onmouseover="ButtonCtl.hover(this);" onmousedown="ButtonCtl.down(this);" onmouseup="ButtonCtl.normal(this);" onmouseout="ButtonCtl.normal(this);">' + text + '</a>';
   },

   /**
    * Create a submit input button wrapper
    *
    * @arguments
    *   text - value for input
    *   id - element ID to apply (if none is supplied, none is set)
    *
    * @authro Benjamin Hutchins
    **/
   createSubmit: function(text, id) {
      return '<input type="submit" ' + (id!=null ? 'id="' + id + '" ' : '') + 'class="stdButton" onmouseover="ButtonCtl.hover(this);" onmousedown="ButtonCtl.down(this);" onmouseup="ButtonCtl.normal(this);" onmouseout="ButtonCtl.normal(this);" value="' + text + '"" />';
   },

   /**
    * Effect to apply to 'el' (element) on mouseover
    *
    * @arguments 
    *   el - element to affect
    *
    * @author Joshua Gross
    **/
   hover: function(el) {
      el.className = 'stdButton btnHover';
   },

   /**
    * Effect to apply to 'el' (element) on mousedown
    *
    * @arguments 
    *   el - element to affect
    *
    * @author Joshua Gross
    **/
   down: function(el) {
      el.className = 'stdButton btnDown';
   },

   /**
    * Restore 'el' (element) to normal on mouseout
    *
    * @arguments 
    *   el - element to affect
    *
    * @author Joshua Gross
    **/
   normal: function(el) {
      el.className = 'stdButton';
   }
};
