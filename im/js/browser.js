///////////////////////////////////
//         ajax im 3.41          //
//    AJAX Instant Messenger     //
//   Copyright (c) 2006-2008     //
//    http://www.ajaxim.com/     //
//   Do not remove this notice   //
///////////////////////////////////


/**
 * Class to handle browser requests
 **/
var Browser = {
   /**
    * Get the width of the client browser
    *
    * @author Joshua Gross
    * @return Document Width
    **/
   width: function() {
      if (self.innerWidth) {
         return self.innerWidth;
      } else if (document.documentElement && document.documentElement.clientWidth) {
         return document.documentElement.clientWidth;
      } else if (document.body) {
         return document.body.clientWidth;
      }
      return 630;
   },

   /**
    * Get the height of the client browser
    *
    * @author Joshua Gross
    * @return Document Height
    **/
   height: function() {
      if (self.innerWidth) {
         return self.innerHeight;
      } else if (document.documentElement && document.documentElement.clientWidth) {
         return document.documentElement.clientHeight;
      } else if (document.body) {
         return document.body.clientHeight;
      }
      return 470;
   }
};
