///////////////////////////////////
//         ajax im 3.41          //
//    AJAX Instant Messenger     //
//   Copyright (c) 2006-2008     //
//    http://www.ajaxim.com/     //
//   Do not remove this notice   //
///////////////////////////////////

// Configuration //

// Title //
var siteName           = 'MrWQ';      // Name of your site (appears as the page title).
                                         // If '', then the title will be used from the index file.

// Registration //
var allowNewUsers      = true;           // Enable/Disable open registration

// Languages //
// Format: [
//          ['folderName', 'properName'],
//          ['language2Folder', 'Language 2 Proper Name'],
//          ...
//         ]
// Note: The first language will be used as the default language.
var languageOptions    = [
                            ['english', 'English']
                         ];

// Theme Settings //
var theme              = 'dark';         // ajax im theme
var alertWidth         = 400;            // alert window width

// Notification // 
var useBlinker         = true;           // Show new message in titlebar when window isn't active.
var blinkSpeed         = 1000;           // How fast to change between the titles when "blinking" (in milliseconds).
var pulsateTitles      = true;           // Pulsate (blink) IM window titles on new IM when they are not the active window.
var audioNotify        = true;           // By default, play sounds upon getting an IM?

// Server //
var pingFrequency      = 2500;           // How often to ping the server (in milliseconds). Best range between 2500 and 3500 ms.
var pingTo             = 'ajax_im.php';  // The file that is the "server".
var adminPingTo        = 'admin.php';    // The "server" script for admin functions.
var blockedBuddyStatus = false;           // Show blocked buddies' status. 

// Windows //
var imWidth            = 310;            // Default IM window width
var imHeight           = 335;            // Default IM window height
var imDetachable       = true;           // Enable/Disable ability to detach IM windows from the application
var buddyListLoc       = 1;              // Default buddylist location: 0=left, 1=right (of window)

// Timeouts //
var idleTime           = 15;             // How long until a user goes idle from now sending any messages (in minutes).
                                         // If 0, feature not used.

// Lingo Text-Replacement //
var useLingo           = true;           // Automated text replacement for messaging. Will replace typos and shorthand,
                                         // as defined in the current language's lingo.js file, with the proper replacement
                                         // text.
var lingoPunction      = [               // Punction the can be placed at the end of a word/setence.
                            [" ", " "],  // Format: [RegularExpression, Real]
			    ["\\.\\.", ".."],
			    ["\\.\\.\\.", "..."],
			    ["\\.\\.\\.\\.", "...."],
			    ["\\.\\.\\.\\.\\.", "....."],
                            ["\\.", "."],
                            [",", ","],
                            [";", ";"],
                            ["\\!", "!"],
                            ["\\?", "?"]
                         ];

// Buddy Icons //
var useIcons           = true;           // Enable/Disable use of buddy icons
var pathToIcons        = './buddyicons/';// Path to buddy icons, include trailing slash.
var showInList         = false;          // Enable/Disable showing of buddy icons in the buddy list
var vanishingIcons     = true;           // Enable/Disable the hiding of the buddy icons in a chat
var vanishingSpeed     = 10000;          // Show the buddy icon for X amount until it is hidden (in milliseconds).
var defaultIcon        = '';             // Location of image to use when no buddy icon is availible
                                         // If blank, no default icon is used


// Messaging History //
var imHistory          = true;           // Retain conversations with buddies throughout the session?
                                         // How it works: If an IM window is closed an imHistory is true,
                                         //               next time that IM window is opened (during the same session!),
                                         //               the old chat text will be there

// Chatrooms //
var predefRooms        = [];             // Define preset rooms that will always exist when a user views the "Join Room" list.
                                         // Format: ['room1', 'room2', ...]

// Timestamp Format //
// This is the timestamp format used to note when an IM was received.
/* M = month, Jan - Dec
 * m = month, 01 - 12, with prepended 0 (01, 02, ...)
 * u = month, 1 - 12, without prepended 0 (1, 2, ...)
 * d = day, 01 - 31, with prepended 0 (01, 02, ...)
 * x = day, 1 - 31, without prepended 0 (1, 2, ...)
 * Y = year, 4 digits (eg: 2008)
 * y = year, 2 digits (eg: 08)
 * H = hours, 24-hour format with prepended 0 (01, 02, ...)
 * h = hours, 12-hour format without prepended 0 (1, 2, ...)
 * Q = hours, 24-hour format without prepended 0 (1, 2, ...)
 * q = hours, 12-hour format with prepended 0 (01, 02, ...)
 * i = minutes
 * s = seconds
 * a = am/pm
 * A = AM/PM
 */
var timestamp          = '[h:i:s a]';
