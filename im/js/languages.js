///////////////////////////////////
//         ajax im 3.41          //
//    AJAX Instant Messenger     //
//   Copyright (c) 2006-2008     //
//    http://www.ajaxim.com/     //
//   Do not remove this notice   //
///////////////////////////////////


/**
 * Language class
 *
 * @author Joshua Gross
 * @update Benjamin Hutchins
 *    - Added to popup
 *    - Added lingo-replacement
 **/
var Languages = {
   current: '',                      // current language being used
   previous: '',                     // previous language used
   available: languageOptions,       // list of available languages
   loaded: [],                       // list of languages loaded
   dictionary: {},                   // dictionary of languages
   lingodict: {},                    // dictionary of lingo-replacements


   /**
    * Load a new language
    *
    * @arguments
    *   language - the language to be loaded
    *
    * @author Joshua Gross
    * @update Benjamin Hutchins
    *   - Loads lingo dictionary for language as well
    **/
   load: function(language) {
      for(var i=0; i<Languages.loaded.length; i++) {
         if(Languages.loaded[i][0] == language)
            return Languages.set(language);
      }
         
      var s = document.createElement('script');
      s.src = 'languages/' + language + '/lang.js?' + (new Date()).getTime();
      s.type = 'text/javascript';
      document.getElementsByTagName('head').item(0).appendChild(s);

      if (useLingo) {
         var l = document.createElement('script');
         l.src = 'languages/' + language + '/lingo.js?' + (new Date()).getTime();
         l.type = 'text/javascript';
         document.getElementsByTagName('head').item(0).appendChild(l);
      }
   },

   /**
    * Adds a language to Language.dictionary
    *
    * @arguments
    *   language - the name of the language
    *   dict - the language dictionary
    *
    * @author Joshua Gross
    **/
   onLoad: function(language, dict) {
      for(var i=0; i<Languages.available.length; i++) {
         if(Languages.available[i][0] == language) {
            Languages.loaded[Languages.loaded.length] = Languages.available[i];
            break;
         }
      }

      Languages.dictionary[language] = dict;
      Languages.set(language);
   },

   /**
    * Adds a lingo-dictionary to Language.lingodict
    *
    * @arguments
    *   language - the language of the dictionary
    *   dict - the dictionary itself
    *
    * @author Benjamin Hutchins
    **/
   onLingoLoad: function(language, dict) {
      Languages.lingodict[language] = dict;
   },
   
   /**
    * Goes through and changes any items with the class lang-TEXT,
    * where TEXT is the language dictionary key, to the actual text.
    *
    * @arguments
    *   language - the language to use
    *
    * @author Joshua Gross
    **/
   set: function(language) {
      Languages.previous = Languages.current;
      Languages.current = language;

      var langObjs = $$('[class*="lang-"]');

      langObjs.each(function(el) {
         var langItem = el.className.split(' ');
         var i;
         for(i=0; i<langItem.length; i++)
            if(langItem[i].indexOf('lang-') > -1) break;
         
         langItem = langItem[i].substring(5);

         var langText = Languages.get(langItem);
         var oldLangText = Languages.get(langItem, Languages.previous);

         var preprocessEl = $(document.createElement('div'));
         preprocessEl.setStyle({display: 'none'});
         preprocessEl.innerHTML = oldLangText + '';
         document.body.appendChild(preprocessEl);
         
         oldLangText = preprocessEl.innerHTML;

         if(el.className.indexOf('langinsert-post') > -1 && el.innerHTML.indexOf(oldLangText) == -1)
            el.innerHTML += Languages.get(langItem);
         else if(el.className.indexOf('langinsert-clear') > -1)
            el.innerHTML = Languages.get(langItem);
         else if(el.className.indexOf('langinsert-pre') > -1 && el.innerHTML.indexOf(oldLangText) == -1)
            el.innerHTML = Languages.get(langItem) + el.innerHTML;
         else {         
            if(el.innerHTML.length == 0) {
               el.innerHTML = langText;
               return;
            }

            if(langText.indexOf('%1') > -1) {
               langText = langText.split(/%1/);
               oldLangText = preprocessEl.innerHTML.split(/%1/);
               
               el.innerHTML = el.innerHTML.replace(oldLangText[0], langText[0]).replace(oldLangText[1], langText[1]);
            } else
               el.innerHTML = el.innerHTML.replace(oldLangText, langText);
         }
         
         document.body.removeChild(preprocessEl);
      });
   },
   
   /**
    * Get the text to show for a language
    **/
   get: function(text, language) {
      if(language != null && language.length == 0)
         return -1;
         
      return Languages.dictionary[language != null ? language : Languages.current][text];
   },

   /**
    * Removed lingo-text from a message 
    *
    * @arguments
    *   message - the message entered by the user
    *   last - last punction character
    *
    * @author Benjamin Hutchins
    * @return none-lingo message
    **/
   lingoReplace: function(message, last) {
      var exp = RegExp(last[0]+"$");
      var mostof = message.replace(exp,"");
      var word = trim(mostof.substring(mostof.lastIndexOf(" "), mostof.length)).replace(exp,"");
      mostof = mostof.substring(0, mostof.length-word.length);
      return mostof + Languages.lingo(word) + last[1];
   },

   /**
    * Runs a single word through the lingo-dictionary
    *
    * @arguments
    *   text - word to try and replace
    *
    * @author Benjamin Hutchins
    * @return none-lingo text if availible, else returns text
    **/
   lingo: function(text, language) {
      if(language != null && language.length == 0)
         return text;
      language = language != null ? language : Languages.current;
      if (typeof Languages.lingodict[language] != 'undefined') {
         if (typeof Languages.lingodict[language][text.toLowerCase()] != 'undefined') {
            return Languages.lingodict[language][text.toLowerCase()];
         }
      }
      return text;
   }
};
