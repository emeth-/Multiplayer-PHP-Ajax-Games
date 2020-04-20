///////////////////////////////////
//         ajax im 3.41          //
//    AJAX Instant Messenger     //
//   Copyright (c) 2006-2008     //
//    http://www.ajaxim.com/     //
//   Do not remove this notice   //
///////////////////////////////////

/**
 * Object to hold all Admin Windows as variables
 *
 * @author Joshua Gross
 **/
var AdminWindows = {
   /**
    * Display window to allow admin to search for users
    *
    * @author Joshua Gross
    **/
   userSearch: function() {
      var userSearchWin;
      if($('admin-userSearch')) {
         Windows.getWindow('admin-userSearch').toFront();
         return;
      }

      userSearchWin = new Window({id: 'admin-userSearch', className: "dialog", width: 250, height: 110, resizable: true,
                                  title: Languages.get('admin-admin') + ' - ' + Languages.get('admin-userSearch'), draggable: true, closable: true, maximizable: false, minimizable: true, detachable: false,
                                  minWidth: 250, minHeight: 110, showEffectOptions: {duration: 0}, hideEffectOptions: {duration: 0}});

      userSearchWin.setConstraint(true, {left: 0, right: 0, top: 0, bottom: 0});
      
      userSearchWin.getContent().innerHTML = '<div class="dialog_info" style="padding:3px;">' + Languages.get('admin-chooseByAndSearch') + '</div> \
                                              <div id="admin-userSearchBox"> \
                                              <div style="display:block;float:left;margin-right:24px;padding:4px 0 0 5px;">' + Languages.get('admin-searchType') + ':</div> \
                                              <select id="admin-searchType" name="adminSearchType" style="font-family:Tahoma,Verdana,Arial,sans-serif;"> \
                                              <option selected="selected" value="username">' + Languages.get('username') + '</option> \
                                              <option value="email">' + Languages.get('email') + '</option> \
                                              </select><br /> \
                                              <div style="display:block;float:left;margin-right:46px;padding:4px 0 0 5px;">' + Languages.get('search') + ':</div> \
                                              <input type="text" id="admin-search" name="adminSearch" style="width:110px;" onkeypress="handleInput(event, function() { Admin.findUser($(\'admin-searchType\').value, $(\'admin-search\').value); })" /> \
                                              <div id="admin-searchButtons">' +
                                              ButtonCtl.create(Languages.get('search'), 'Admin.findUser($(\'admin-searchType\').value, $(\'admin-search\').value);') +
                                              ButtonCtl.create(Languages.get('cancel'), 'Windows.close(\'admin-userSearch\');') +
                                              '</div>';

      $('admin-searchButtons').setStyle({position: 'absolute',
                                         top:      '105px',
                                         left:     '32px'});

      userSearchWin.setDestroyOnClose();
      userSearchWin.showCenter();
   },

   /**
    * On admin window resize, fix elements within window
    *
    * @arguments
    *   win - window to be resized
    *
    * @author Joshua Gross
    **/
   handleResize: function(win) {
      switch(win.getId().replace(/admin-/, '')) {
         case 'userSearch':
            if($('admin-userSearchResults')) {
               $('admin-userSearchResults').setStyle({'width': win.getSize()['width'] + 'px'});
               $('admin-userSearchResults').parentNode.setStyle({'width': win.getSize()['width'] + 'px'});
               $('admin-userExecFunctions').setStyle({'left': ((win.getSize()['width'] - $('admin-userExecFunctions').getWidth()) / 2) + 'px'});
            }

            $('admin-searchButtons').setStyle({'left': ((win.getSize()['width'] - $('admin-searchButtons').getWidth()) / 2) + 'px'});
         break;
      }
   }
}


/**
 * Handle all Admin requests
 *
 * @author Joshua Gross
 **/
var Admin = {
   // current selected user from the user-search-results list
   selectedUser: null,

   /**
    * Finds and displays users searched for by the admin
    *
    * @author Joshua Gross
    * @update Benjamin Hutchins
    *    - User's email be displayed.
    **/
   findUser: function(searchType, search) {
      var xhConn = new XHConn();
      
      xhConn.connect(adminPingTo, "POST", "call=search&by="+searchType+"&for="+search, function(xh) {
         if(xh.responseText == 'access_denied') return Admin.noAccess();
         
         if($('admin-userSearchResults'))
            $('admin-userSearchResults').parentNode.parentNode.removeChild($('admin-userSearchResults').parentNode);
         
         var results = xh.responseText.parseJSON();
         var resultsTable = '<table id="admin-userSearchResults" style="text-align:center;" class="listNotSelected">';
         resultsTable += '<thead><tr style="cursor:pointer;"><th>' + Languages.get('username') + '</th><th>' + Languages.get('email') + '</th><th>' + Languages.get('admin-lastKnownIP') + '</th><th>' + Languages.get('admin-lastActive') + '</th><th>' + Languages.get('admin-status') + '</th><th>' + Languages.get('admin-banned') + '</th><th>' + Languages.get('admin-admin') + '</th></tr></thead><tbody>';

         for(var i=0; i<results.length; i++) {
            var lastActiveObj = new Date(results[i].lastActive*1000);
            var lastActive = lastActiveObj.getMonth() + '/' + lastActiveObj.getDate() + '/' + lastActiveObj.getFullYear() + ' @ ' + lastActiveObj.getHours() + ':' + lastActiveObj.getMinutes();
            
            resultsTable += '<tr style="cursor:pointer;" onmouseover="Admin.findUserListHover(this);" onmouseout="Admin.findUserListDefault(this);" onclick="Admin.findUserListSelect(this);">' +
                            '<td>' + results[i].username + '</td><td>' + results[i].email + '</td><td>' + results[i].lastKnownIP + '</td>' +
                            '<td>' + lastActive + '</td>' + '<td>' + results[i].currentStatus + '</td><td>' + results[i].banned + '</td>' +
                            '<td>' + results[i].admin + '</td></tr>';
         }
         resultsTable += '</tbody></table>';
         
         var userSearch = Windows.getWindow('admin-userSearch')
         userSearch.setSize(500, 232);
         userSearch.options.minWidth = 500;
         userSearch.options.minHeight = 232;
         userSearch.showCenter(false);
         userSearch.getContent().innerHTML += resultsTable;
         
         if(!$('admin-userExecFunctions')) {
            userSearch.getContent().innerHTML += '<div id="admin-userExecFunctions">' +
                                                 ButtonCtl.create(Languages.get('admin-kick'), 'Admin.kickUser(Admin.selectedUser.getElementsByTagName(\'td\')[0].innerHTML);') +
                                                 ButtonCtl.create(Languages.get('admin-ban'), 'Admin.banUser(Admin.selectedUser.getElementsByTagName(\'td\')[0].innerHTML);', 'admin-banButton') +
                                                 ButtonCtl.create(Languages.get('admin-makeAdmin'), 'Admin.toggleAdmin(Admin.selectedUser.getElementsByTagName(\'td\')[0].innerHTML);', 'admin-makeAdminButton') +
                                                 '</div>';
            
            $('admin-userExecFunctions').setStyle({position: 'absolute',
                                                   top:      '195px',
                                                   left:     '83px'});
         }
         
         $('admin-searchButtons').innerHTML = ButtonCtl.create(Languages.get('searchAgain'), 'Admin.findUser($(\'admin-searchType\').value, $(\'admin-search\').value);') +
                                              ButtonCtl.create(Languages.get('cancel'), 'Windows.close(\'admin-userSearch\');');
                                              

         $('admin-searchButtons').setStyle({position: 'absolute',
                                            top:      '225px',
                                            left:     '130px'});
 
         var t = new ScrollableTable($('admin-userSearchResults'), 100, 500);
             t = new SortableTable($('admin-userSearchResults'));

         $('admin-searchType').value = searchType;
         $('admin-search').value = search;
      });
   },
   
   /**
    * Sends request to server to ban user
    *
    * @arguments
    *   user - user to be banned
    *
    * @author Joshua Gross
    **/
   banUser: function(user) {
      var xhConn = new XHConn();
      
      xhConn.connect(adminPingTo, "POST", "call=ban&user="+user, function(xh) {
         if(xh.responseText == 'access_denied') return Admin.noAccess();
         
         Admin.selectedUser.getElementsByTagName('td')[4].innerHTML = xh.responseText;
         $('admin-banButton').innerHTML = (xh.responseText=='true'?Languages.get('admin-unban'):Languages.get('admin-ban'));
      });
   },
   
   /**
    * Sends request to server to kick a user offline
    *
    * @arguments
    *   user - user to be kicked
    *
    * @author Joshua Gross
    **/
   kickUser: function(user) {
      var xhConn = new XHConn();
      
      xhConn.connect(adminPingTo, "POST", "call=kick&user="+user, function(xh) {
         if(xh.responseText == 'access_denied') return Admin.noAccess();
         
         Admin.selectedUser.getElementsByTagName('td')[3].innerHTML = '0';
      });
   },

   /**
    * Toggles a user's admin rights
    *
    * @arguments
    *   user - user to be toggled
    *
    * @author Joshua Gross
    **/
   toggleAdmin: function(user) {
      var xhConn = new XHConn();
      
      xhConn.connect(adminPingTo, "POST", "call=admin&user="+user, function(xh) {
         if(xh.responseText == 'access_denied') return Admin.noAccess();
         
         Admin.selectedUser.getElementsByTagName('td')[5].innerHTML = xh.responseText;
         $('admin-makeAdminButton').innerHTML = (xh.responseText=='true'?Languages.get('admin-removeAdmin'):Languages.get('admin-makeAdmin'));
      });
   },

   /**
    * Add hover effect to an element
    *
    * @arguments
    *   el - element to have effect added
    *
    * @author Joshua Gross
    **/
   findUserListHover: function(el) {
      Element.addClassName(el, 'listHover').removeClassName('listSelected').removeClassName('listNotSelected');
   },

   /**
    * Remove hover effect added by Admin.findUserListHover
    *
    * @arguments
    *   el - element to have effect removed
    *
    * @author Joshua Gross
    **/
   findUserListDefault: function(el) {
      if(el != Admin.selectedUser) Element.addClassName(el, 'listNotSelected').removeClassName('listSelected').removeClassName('listHover');
      else Element.addClassName(el, 'listSelected').removeClassName('listNotSelected').removeClassName('listHover');
   },

   /**
    * Change Admin.selectedUser to the user clicked by the admin
    *
    * @arguments
    *   el - list element to turn into selected
    *
    * @author Joshua Gross
    **/
   findUserListSelect: function(el) {
      if(Admin.selectedUser) Element.addClassName(Admin.selectedUser, 'listNotSelected').removeClassName('listSelected').removeClassName('listHover');
      Element.addClassName(el, 'listSelected').removeClassName('listNotSelected').removeClassName('listHover');
      Admin.selectedUser = el;
      
      if(el.getElementsByTagName('td')[4].innerHTML == 'true')
         $('admin-banButton').innerHTML = Languages.get('admin-unban');
      else
         $('admin-banButton').innerHTML = Languages.get('admin-ban');
         
      if(el.getElementsByTagName('td')[5].innerHTML == 'true')
         $('admin-makeAdminButton').innerHTML = Languages.get('admin-removeAdmin');
      else
         $('admin-makeAdminButton').innerHTML = Languages.get('admin-makeAdmin');
   }
};

/**
*
* Scrollable HTML table
* http://www.webtoolkit.info/
*
**/
function ScrollableTable (tableEl, tableHeight, tableWidth) {

    this.initIEengine = function () {

        this.containerEl.style.overflowY = 'auto';
        if (this.tableEl.parentElement.clientHeight - this.tableEl.offsetHeight < 0) {
            this.tableEl.style.width = this.newWidth - this.scrollWidth +'px';
        } else {
            this.containerEl.style.overflowY = 'hidden';
            this.tableEl.style.width = this.newWidth +'px';
        }

        if (this.thead) {
            var trs = this.thead.getElementsByTagName('tr');
            for (x=0; x<trs.length; x++) {
                trs[x].style.position ='relative';
                trs[x].style.setExpression("top", "this.parentElement.parentElement.parentElement.scrollTop + 'px'");
            }
        }

        if (this.tfoot) {
            var trs = this.tfoot.getElementsByTagName('tr');
            for (x=0; x<trs.length; x++) {
                trs[x].style.position ='relative';
                trs[x].style.setExpression("bottom", "(this.parentElement.parentElement.offsetHeight - this.parentElement.parentElement.parentElement.clientHeight - this.parentElement.parentElement.parentElement.scrollTop) + 'px'");
            }
        }

        eval("window.attachEvent('onresize', function () { document.getElementById('" + this.tableEl.id + "').style.visibility = 'hidden'; document.getElementById('" + this.tableEl.id + "').style.visibility = 'visible'; } )");
    };


    this.initFFengine = function () {
        this.containerEl.style.overflow = 'hidden';
        this.tableEl.style.width = this.newWidth + 'px';

        var headHeight = (this.thead) ? this.thead.clientHeight : 0;
        var footHeight = (this.tfoot) ? this.tfoot.clientHeight : 0;
        var bodyHeight = this.tbody.clientHeight;
        var trs = this.tbody.getElementsByTagName('tr');
        if (bodyHeight >= (this.newHeight - (headHeight + footHeight))) {
            this.tbody.style.overflow = '-moz-scrollbars-vertical';
            for (x=0; x<trs.length; x++) {
                var tds = trs[x].getElementsByTagName('td');
                tds[tds.length-1].style.paddingRight += this.scrollWidth + 'px';
            }
        } else {
            this.tbody.style.overflow = '-moz-scrollbars-none';
        }

        var cellSpacing = (this.tableEl.offsetHeight - (this.tbody.clientHeight + headHeight + footHeight)) / 4;
        this.tbody.style.height = (this.newHeight - (headHeight + cellSpacing * 2) - (footHeight + cellSpacing * 2)) + 'px';

    };

    this.tableEl = tableEl;
    this.scrollWidth = 16;

    this.originalHeight = this.tableEl.clientHeight;
    this.originalWidth = this.tableEl.clientWidth;

    this.newHeight = parseInt(tableHeight);
    this.newWidth = tableWidth ? parseInt(tableWidth) : this.originalWidth;

    this.tableEl.style.height = 'auto';
    this.tableEl.removeAttribute('height');

    this.containerEl = this.tableEl.parentNode.insertBefore(document.createElement('div'), this.tableEl);
    this.containerEl.appendChild(this.tableEl);
    this.containerEl.style.height = this.newHeight + 'px';
    this.containerEl.style.width = this.newWidth + 'px';


    var thead = this.tableEl.getElementsByTagName('thead');
    this.thead = (thead[0]) ? thead[0] : null;

    var tfoot = this.tableEl.getElementsByTagName('tfoot');
    this.tfoot = (tfoot[0]) ? tfoot[0] : null;

    var tbody = this.tableEl.getElementsByTagName('tbody');
    this.tbody = (tbody[0]) ? tbody[0] : null;

    if (!this.tbody) return;

    if (document.all && document.getElementById && !window.opera) this.initIEengine();
    if (!document.all && document.getElementById && !window.opera) this.initFFengine();
}

/**
*
* Sortable HTML table
* http://www.webtoolkit.info/
*
**/
function SortableTable (tableEl) {

    this.tbody = tableEl.getElementsByTagName('tbody');
    this.thead = tableEl.getElementsByTagName('thead');
    this.tfoot = tableEl.getElementsByTagName('tfoot');

    this.getInnerText = function (el) {
        if (typeof(el.textContent) != 'undefined') return el.textContent;
        if (typeof(el.innerText) != 'undefined') return el.innerText;
        if (typeof(el.innerHTML) == 'string') return el.innerHTML.replace(/<[^<>]+>/g,'');
    }

    this.getParent = function (el, pTagName) {
        if (el == null) return null;
        else if (el.nodeType == 1 && el.tagName.toLowerCase() == pTagName.toLowerCase())
            return el;
        else
            return this.getParent(el.parentNode, pTagName);
    }

    this.sort = function (cell) {

     var column = cell.cellIndex;
     var itm = this.getInnerText(this.tbody[0].rows[1].cells[column]);
        var sortfn = this.sortCaseInsensitive;

        if (itm.match(/\d\d[-]+\d\d[-]+\d\d\d\d/)) sortfn = this.sortDate; // date format mm-dd-yyyy
        if (itm.replace(/^\s+|\s+$/g,"").match(/^[\d\.]+$/)) sortfn = this.sortNumeric;

        this.sortColumnIndex = column;

     var newRows = new Array();
     for (j = 0; j < this.tbody[0].rows.length; j++) {
            newRows[j] = this.tbody[0].rows[j];
        }

        newRows.sort(sortfn);

        if (cell.getAttribute("sortdir") == 'down') {
            newRows.reverse();
            cell.setAttribute('sortdir','up');
        } else {
            cell.setAttribute('sortdir','down');
        }

        for (i=0;i<newRows.length;i++) {
            this.tbody[0].appendChild(newRows[i]);
        }

    }

    this.sortCaseInsensitive = function(a,b) {
        aa = thisObject.getInnerText(a.cells[thisObject.sortColumnIndex]).toLowerCase();
        bb = thisObject.getInnerText(b.cells[thisObject.sortColumnIndex]).toLowerCase();
        if (aa==bb) return 0;
        if (aa<bb) return -1;
        return 1;
    }

    this.sortDate = function(a,b) {
        aa = thisObject.getInnerText(a.cells[thisObject.sortColumnIndex]);
        bb = thisObject.getInnerText(b.cells[thisObject.sortColumnIndex]);
        date1 = aa.substr(6,4)+aa.substr(3,2)+aa.substr(0,2);
        date2 = bb.substr(6,4)+bb.substr(3,2)+bb.substr(0,2);
        if (date1==date2) return 0;
        if (date1<date2) return -1;
        return 1;
    }

    this.sortNumeric = function(a,b) {
        aa = parseFloat(thisObject.getInnerText(a.cells[thisObject.sortColumnIndex]));
        if (isNaN(aa)) aa = 0;
        bb = parseFloat(thisObject.getInnerText(b.cells[thisObject.sortColumnIndex]));
        if (isNaN(bb)) bb = 0;
        return aa-bb;
    }

    // define variables
    var thisObject = this;
    var sortSection = this.thead;

    // constructor actions
    if (!(this.tbody && this.tbody[0].rows && this.tbody[0].rows.length > 0)) return;

    if (sortSection && sortSection[0].rows && sortSection[0].rows.length > 0) {
        var sortRow = sortSection[0].rows[0];
    } else {
        return;
    }

    for (var i=0; i<sortRow.cells.length; i++) {
        sortRow.cells[i].sTable = this;
        sortRow.cells[i].onclick = function () {
            this.sTable.sort(this);
            return false;
        }
    }
}
