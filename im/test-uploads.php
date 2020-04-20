<?php
///////////////////////////////////
//         ajax im 3.41          //
//    AJAX Instant Messenger     //
//   Copyright (c) 2006-2008     //
//    http://www.ajaxim.com/     //
//   Do not remove this notice   //
///////////////////////////////////

/*
 * Stupid tab-space fix
 *
 * @author Benjamin Hutchins
 * @return $str with spaces appended to make the length of $len
 */
function space_fix ($str, $len) {
   for ($i = strlen($str); $i<$len; $i++) {
      $str .= " ";
   }
   return $str;
}

?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
   <head>
      <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
      <title>ajax im - test upload max size</title>
      <style type="text/css" media="screen">body{background:#101010}a{color:#fff}h1{font:160px Arial,Verdana,Tahoma,sans-serif;color:#fff;margin:0 auto 40px;padding:0;text-align:center;width:80%}h2{font:28px tahoma,verdana,arial,sans-serif;font-weight:bold;color:#84e03a;margin:0;padding:0 0 10px 0}div{border:2px solid #1d1d1d;padding:10px;font:12px Verdana,Tahoma,Arial,sans-serif;width:400px;margin:10px auto;color:#fff}pre,code{display:block;margin:5px;padding:0px;line-height:normal;color:#84e03a;width:100%;}</style>
   </head>
   
   <body>
      <h1>ajax im</h1>
      <div>
         <h2>uploads not working?</h2>
         <p>If your uploads aren't working, try looking at the below reasons?</p>
      <?php
            require('config.php');
            if (!isset($maxBuddyIconSize)) {
               print "You have an outdated config.php, please rename config-sample.php to config.php and modify the database information.";
            } else if ($maxBuddyIconSize == 0) {
               print "Currently <b>\$maxBuddyIconSize</b> is set to 0 (zero), please set it to a higher value.";
            } else if (trim(substr(sprintf('%o', fileperms('buddyicons/')), -4)) != 777) {
               print "The directory <b>buddyicons/</b> is not writeable, please CHMOD it to 0777.";
            } else if (ini_get('file_uploads') == 0) {
               if (file_exists('php.ini')) {
                  print "File uploads are not supported on your server.";
               } else {
                  @ini_set('file_uploads', 'On');
                  if (ini_get('file_uploads') == 0) {
                     print "PHP cannot use <b>ini_set</b> to allow file uploads. Try creating a file called <b>php.ini</b> in the parent directory with the following contents:<br/><br/><pre><code>file_uploads = On\nupload_max_filesize = {$maxBuddyIconSize}M\npost_max_size = {$maxBuddyIconSize}M</code></pre>";
                  } else {
                     $continue = true;
                  }
               }
            } else {
               $continue = true;
            }

            if (isset($continue)) {
               $upload_max_filesize = substr(ini_get('upload_max_filesize'), 0, -1);
               $post_max_size = substr(ini_get('post_max_size'), 0, -1);

               if ($upload_max_filesize == 0 || $post_max_size == 0) {
                  print "Your max upload size is 0 (zero), please increase it.";
               } else {
                  if ($upload_max_filesize >= ini_get('post_max_size')) {
                     $max = 'upload_max_filesize';
                  } else {
                     $max = 'post_max_size';
                  }

                  print "Things look good on your server, your max upload size is: <pre><code>" . ini_get('post_max_size') . "</code></pre><br/>If this value to too low, say, below 2MBs, then most images will be to large to be uploaded. Please keep that in mind.";
                  print "<br/><br/>Other misc. information:<pre><code>+-------------------------------+---------------------|                          
| PHP Configuration Variable    | Suggested value     |
+-------------------------------+---------------------|
| max_execution_time = " . space_fix(ini_get('max_execution_time'), 8) . " | >= 30               |
| max_input_time = " . space_fix(ini_get('max_input_time'), 12) . " | ~ 60                |
+-------------------------------+---------------------|
</code></pre>";
               }
            }
      ?>
     </div>
   </body>
</html>
