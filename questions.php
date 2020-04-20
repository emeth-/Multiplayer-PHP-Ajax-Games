<?php
include "globals.php";
$_POST['quest']=htmlentities($_POST['quest'], ENT_QUOTES);
register_shutdown_function('incfoot');
function incfoot() 
{
global $db,$h;
$h->endpage();
}
function question_dropdown($type, $varnam)
{
	if($type==0){$typet="WHERE Qdone=1 AND Qredirect=0";}
	else if($type==1){$typet="WHERE Qredirect>0";}
	else {$type=="";}
	global $db;
	$ret="<select name='$varnam' type='dropdown'>";
	$q=$db->query("SELECT * FROM questions $typet ORDER BY Qid ASC");
	if($selected == -1) { $first=0; } else { $first=1; }
	while($r=$db->fetch_row($q))
	{
	$r['Qquest']=stripslashes($r['Qquest']);
	$ret.="\n<option value='{$r['Qid']}'";
	if ($selected == $r['Qid'] || $first == 0) { $ret.=" selected='selected'";$first=1; } 
	$ret.= ">{$r['Qquest']}</option>";
	}
	$ret.="\n</select>";
	return $ret;
}

function simquestion_dropdown($quest, $varnam)
{
	global $db;
	$counter=15;
	$qd=$db->query("SELECT * FROM questions WHERE Qquest LIKE ('%$quest%') AND Qdone=1 AND Qredirect=0 ORDER BY Qid ASC");
	$cnt=$db->num_rows($qd);
	$questa = explode(" ", $quest);
	$i=0;
	$big=0;
	while($questa[$i]!="")
	{	
		$slen=strlen($questa[$i]);
		if($slen>$big){$big2=$big;$bigt2=$bigt;$big=$slen;$bigt=$questa[$i];}
		else if($slen>$big2)
		{
			$big2=$slen;
			$bigt2=$questa[$i];
		}
		$i++;
	}
	$qd2=$db->query("SELECT * FROM questions WHERE Qquest LIKE ('%".$bigt."%') AND Qdone=1 AND Qredirect=0 ORDER BY Qid ASC");
	$cnt2=$db->num_rows($qd2);
	$qd3=$db->query("SELECT * FROM questions WHERE Qquest LIKE ('%".$bigt."%') AND Qdone=1 AND Qredirect=0 ORDER BY Qid ASC");
	$cnt3=$db->num_rows($qd3);
	if($cnt==0 && $cnt2==0)
	{
		$quest=stripslashes($quest);
		die("No answers to your question could be found. <br /><br />
		<form action='questions.php' method='post'>
		<input type='hidden' name='quest' value='$quest'>
		<input type='hidden' name='questsub' value='1'>
		<input type='submit' value='Click here to submit your question to a staff member' /></form>");
	}
	$ret="Your exact question could not be found in our database, <br />
		but perhaps one of these questions is similar?:<br />
		<form action='questions.php' method='post'>
		<select name='quest' type='dropdown'>";
	if($selected == -1) { $first=0; } else { $first=1; }
	if($cnt>0)
	{
		while($rc=$db->fetch_row($qd))
		{
		$rc['Qquest']=stripslashes($rc['Qquest']);
		$ret.="\n<option value='{$rc['Qquest']}'";
		if ($selected == $rc['Qquest'] || $first == 0) { $ret.=" selected='selected'";$first=1; } 
		$ret.= ">{$rc['Qquest']}</option>";
		}
	}
	if($cnt2>0 && $cnt==0)
	{
		while($rv=$db->fetch_row($qd2))
		{
			$rv['Qquest']=stripslashes($rv['Qquest']);
			if(!eregi("{$rv['Qquest']}", $ret))
			{
				$ret.="\n<option value='{$rv['Qquest']}'";
				if ($selected == $rv['Qquest'] || $first == 0) { $ret.=" selected='selected'";$first=1; } 
				$ret.= ">{$rv['Qquest']}</option>";
			}
		}
	}
	if($cnt3>0 && $cnt==0)
	{
		while($rv=$db->fetch_row($qd3))
		{
			$rv['Qquest']=stripslashes($rv['Qquest']);
			if(!eregi("{$rv['Qquest']}", $ret))
			{
				$ret.="\n<option value='{$rv['Qquest']}'";
				if ($selected == $rv['Qquest'] || $first == 0) { $ret.=" selected='selected'";$first=1; } 
				$ret.= ">{$rv['Qquest']}</option>";
			}
		}
	}
	
	$ret.="\n</select><input type='submit' value='Choose this question'></form>
		<br /><hr /><br />If not, click this button to submit your question to a staff member for answering.<br />
		<form action='questions.php' method='post'>
		<input type='hidden' name='quest' value='$quest'>
		<input type='hidden' name='questsub' value='1'>
		<input type='submit' value='Submit Question to staff member' /></form>";
	return $ret;
}



print"<div class='heading'>Got Questions?</div><hr width=98%><center>
<b>We have answers.</b><br /><br />";
die("This service is undergoing construction. If you have questions you want to be answered, please go to the forums. Thank you.");
$_POST['questsub']=abs((int)$_POST['questsub']);
if($_POST['questsub']==1 && $_POST['quest'])
{
	//submit question to staff

	$_POST['quest']=html_entity_decode($_POST['quest'], ENT_QUOTES);
	$db->query("INSERT INTO questions (Qquest,Quser) VALUES('{$_POST['quest']}',$userid)");
	die("<br />Question Asked.<br />You will be notified when a staff member answers it.");
}
if($ir['user_level']!=2)
{
	if(!$_POST['quest'])
	{
		die(" <font size=1>This section is for FAQ type questions, such as \"How does the Click Exchange work?\". <br>If you are looking for support help, send in a support email using the Contact Us form on the login page, <br>or send an in-site mail to Seanybob.</font><form action='questions.php' method='post'>
		<textarea rows=10 cols=50 name='quest'>Enter Your Question (or just keywords)</textarea><br />
		<input type='submit' value='Ask away!' /></form><br /><br /><br /><font size=1>*Note-If you wish to get 
		many results from your search, use less words. For more specific results, use more words.</font><br /><br />");
	}
	else if($_POST['quest'])
	{
		$_POST['quest']=mysql_real_escape_string($_POST['quest']);
		//check for exact question
		$qq=$db->query("SELECT * FROM questions WHERE Qquest='{$_POST['quest']}' AND (Qdone=1 OR Qredirect>0)");
		$any1=$db->num_rows($qq);
		if($any1>0)
		{
			$aq1=$db->fetch_row($qq);
			$question=$aq1['Qquest'];
			if($aq1['Qredirect']>0)
			{
				$qq=$db->query("SELECT * FROM questions WHERE Qid='{$aq1['Qredirect']}'");
				$aq1=$db->fetch_row($qq);
			}
			$aq1['Qquest']=stripslashes($aq1['Qquest']);
			$aq1['Qanswer']=stripslashes($aq1['Qanswer']);
			die("
			<b>Question</b>: $question<br />
			<b>Answer</b>: {$aq1['Qanswer']}<br />
			<br /><a href=questions.php>&gt;Back</a>
			");
		}

		//check for similar questions
		$que=$_POST['quest'];
		$simq=simquestion_dropdown("$que",$varname);
		die("
		$simq<br />
		<br /><a href=questions.php>&gt;Back</a>
		");
	}
}
else if($ir['user_level']==2)
{
	$_GET['act']=mysql_escape($_GET['act']);
	$_GET['id']=abs((int) $_GET['id']);
	if($_GET['act']=='answer')
	{
		$w=$db->query("SELECT * FROM questions WHERE Qid={$_GET['id']} LIMIT 1");
		$a=$db->fetch_row($w);
		print"<form action='questions.php?id={$a['Qid']}&act=answer2' method='post'><br />
		<b>Question:</b><br />
		{$a['Qquest']}<br />
		<b>Answer:</b><br />
		<textarea rows=10 cols=50 name='answer'>{$a['Qanswer']}</textarea><br />
		<input type='submit' value='Answer Question' /></form>";
	}
	else if($_GET['act']=='answer2')
	{
		$_POST['answer']=mysql_escape($_POST['answer']);
		$db->query("UPDATE questions SET Qanswer='{$_POST['answer']}',Qdone=1 where Qid={$_GET['id']}");
		$w=$db->query("SELECT * FROM questions WHERE Qid={$_GET['id']} LIMIT 1");
		$a=$db->fetch_row($w);
		$subj="In response to your question...";
		$msg="[b]Your question was:[/b]\n{$a['Qquest']}\n[b]Answer:\n[/b]{$a['Qanswer']}";
		$db->query("INSERT INTO mail VALUES ('',0,1,{$a['Quser']},unix_timestamp(),'$subj','$msg')");
		$db->query("UPDATE users SET new_mail=new_mail+1 WHERE userid={$a['Quser']}");
		print"Question Answered.<br /><br /><a href=questions.php>&gt;Back</a>";
	}
	if($_GET['act']=='answerd')
	{
		$w=$db->query("SELECT * FROM questions WHERE Qid={$_GET['id']} LIMIT 1");
		$a=$db->fetch_row($w);
		print"<form action='questions.php?id={$a['Qid']}&act=answerd2' method='post'><br />
		<b>Question:</b><br />
		{$a['Qquest']}<br />
		<b>Answer:</b><br />
		<textarea rows=10 cols=50 name='answer'>{$a['Qanswer']}</textarea><br />
		<input type='submit' value='Answer Question' /></form>";
	}
	else if($_GET['act']=='answerd2')
	{
		$_POST['answer']=mysql_escape($_POST['answer']);
		$w=$db->query("SELECT * FROM questions WHERE Qid={$_GET['id']} LIMIT 1");
		$a=$db->fetch_row($w);
		$subj="In response to your question...";
		$msg="[b]Your question was:[/b]\n{$a['Qquest']}\n[b]Answer:\n[/b]{$_POST['answer']}";
		$db->query("INSERT INTO mail VALUES ('',0,1,{$a['Quser']},unix_timestamp(),'$subj','$msg')");
		$db->query("UPDATE users SET new_mail=new_mail+1 WHERE userid={$a['Quser']}");
		$db->query("DELETE FROM questions WHERE Qid={$_GET['id']}");
		print"Question Answered.<br /><br /><a href=questions.php>&gt;Back</a>";
	}
	if($_GET['act']=='redirect')
	{
		$w=$db->query("SELECT * FROM questions WHERE Qid={$_GET['id']} LIMIT 1");
		$a=$db->fetch_row($w);
		$qdro=question_dropdown(0,'redirect');
		print"<form action='questions.php?id={$a['Qid']}&act=redirect2' method='post'><br />
		<b>Question # here:</b><br />
		<input type='text' name='redirect' value='{$a['Qredirect']}'><br />
		<input type='submit' value='Redirect Question' /></form>";
		if($a['Qredirect']>0)
		{		
			print"<br /><font size=1>*note-leave blank to reset</font>";
		}
		if($a['Qredirect']==0)
		{
			print" <br /><br /><b>Or select a question from this dropdown box!</b><br />
			<form action='questions.php?id={$a['Qid']}&act=redirect2' method='post'>
			$qdro
			<input type='submit' value='Redirect Question' />
			</form>";
		}
	}
	else if($_GET['act']=='redirect2')
	{
		$_POST['redirect']=abs((int)$_POST['redirect']);
		if($_POST['redirect']==0){$qstr="Qdone=0";}
		else{$qstr="Qdone=1";}
		$db->query("UPDATE questions SET Qredirect={$_POST['redirect']},$qstr where Qid={$_GET['id']}");
		//if redirect was simply reset, no need to send an email.
		if($_POST['redirect']>0)
		{
			$w=$db->query("SELECT * FROM questions WHERE Qid={$_POST['redirect']} LIMIT 1");
			$a=$db->fetch_row($w);
			$w2=$db->query("SELECT * FROM questions WHERE Qid={$_GET['id']} LIMIT 1");
			$a2=$db->fetch_row($w2);
			$subj="In response to your question...";
			$msg="[b]Your question was:[/b]\n{$a2['Qquest']}\n[b]Answer:\n[/b]{$a['Qanswer']}";
			$db->query("INSERT INTO mail VALUES ('',0,1,{$a2['Quser']},unix_timestamp(),'$subj','$msg')");
			$db->query("UPDATE users SET new_mail=new_mail+1 WHERE userid={$a2['Quser']}");
		}
		print"Question Redirected.<br /><br /><a href=questions.php>&gt;Back</a>";
	}
	if($_GET['act']=='redirectd')
	{
		$w=$db->query("SELECT * FROM questions WHERE Qid={$_GET['id']} LIMIT 1");
		$a=$db->fetch_row($w);
		$qdro=question_dropdown(0,'redirect');
		print"<form action='questions.php?id={$a['Qid']}&act=redirect2' method='post'><br />
		<b>Question # here:</b><br />
		<input type='text' name='redirect' value='{$a['Qredirect']}'><br />
		<input type='submit' value='Redirect Question' /></form>";
		if($a['Qredirect']>0)
		{		
			print"<br /><font size=1>*note-leave blank to reset</font>";
		}
		if($a['Qredirect']==0)
		{
			print" <br /><br /><b>Or select a question from this dropdown box!</b><br />
			<form action='questions.php?id={$a['Qid']}&act=redirect2' method='post'>
			$qdro
			<input type='submit' value='Redirect Question' />
			</form>";
		}
	}
	else if($_GET['act']=='redirectd2')
	{
		$_POST['redirect']=abs((int)$_POST['redirect']);
		if($_POST['redirect']==0){$qstr="Qdone=0";}
		else{$qstr="Qdone=1";}
		//if redirect was simply reset, no need to send an email.
		if($_POST['redirect']>0)
		{
			$w=$db->query("SELECT * FROM questions WHERE Qid={$_POST['redirect']} LIMIT 1");
			$a=$db->fetch_row($w);
			$w2=$db->query("SELECT * FROM questions WHERE Qid={$_GET['id']} LIMIT 1");
			$a2=$db->fetch_row($w2);
			$subj="In response to your question...";
			$msg="[b]Your question was:[/b]\n{$a2['Qquest']}\n[b]Answer:\n[/b]{$a['Qanswer']}";
			$db->query("INSERT INTO mail VALUES ('',0,1,{$a2['Quser']},unix_timestamp(),'$subj','$msg')");
			$db->query("UPDATE users SET new_mail=new_mail+1 WHERE userid={$a2['Quser']}");
		}
		$db->query("DELETE FROM questions where Qid={$_GET['id']}");
		print"Question Redirected.<br /><br /><a href=questions.php>&gt;Back</a>";
	}

	else if($_GET['act']=='edit')
	{
		$w=$db->query("SELECT * FROM questions WHERE Qid={$_GET['id']} LIMIT 1");
		$a=$db->fetch_row($w);
		$a['Qquest']=stripslashes($a['Qquest']);
		print"<form action='questions.php?id={$a['Qid']}&act=edit2' method='post'><br />
		<b>Question:</b><br />
		<textarea rows=10 cols=50 name='quest'>{$a['Qquest']}</textarea><br />
		<input type='submit' value='Edit Question' /></form>";
	}
	else if($_GET['act']=='edit2')
	{
		$_POST['quest']=mysql_escape($_POST['quest']);
		$db->query("UPDATE questions SET Qquest='{$_POST['quest']}' where Qid={$_GET['id']}");
		print"Question Editted.<br /><br /><a href=questions.php>&gt;Back</a>";
	}
	else if($_GET['act']=='editanswer')
	{
		$w=$db->query("SELECT * FROM questions WHERE Qid={$_GET['id']} LIMIT 1");
		$a=$db->fetch_row($w);
		$a['Qanswer']=stripslashes($a['Qanswer']);
		print"<form action='questions.php?id={$a['Qid']}&act=editanswer2' method='post'><br />
		<b>Answer:</b><br />
		<textarea rows=10 cols=50 name='answer'>{$a['Qanswer']}</textarea><br />
		<input type='submit' value='Edit Answer' /></form>";
	}
	else if($_GET['act']=='editanswer2')
	{
		$_POST['answer']=mysql_escape($_POST['answer']);
		$db->query("UPDATE questions SET Qanswer='{$_POST['answer']}' where Qid={$_GET['id']}");
		print"Answer Editted.<br /><br /><a href=questions.php>&gt;Back</a>";
	}
	else if($_GET['act']=='delete')
	{
		$w=$db->query("SELECT * FROM questions WHERE Qid={$_GET['id']} LIMIT 1");
		$a=$db->fetch_row($w);
		$a['Qquest']=stripslashes($a['Qquest']);
		print"<form action='' method='post'>
		<b>Are you sure you want to delete this question?</b><br />{$a['Qquest']}<br /><br />
		<a href=questions.php?id={$a['Qid']}&act=delete2>Yes</a> | <a href=questions.php>No</a>";
	}
	else if($_GET['act']=='delete2')
	{
		$db->query("DELETE FROM questions WHERE Qid={$_GET['id']}");
		print"Question Deleted.<br /><br /><a href=questions.php>&gt;Back</a>";
	}
	else
	{
		if($_GET['act']=='')
		{
			print"<a href=questions.php?t=wait>Waiting for answer</a> | <a href=questions.php?t=redir>Redirected</a> | <a href=questions.php?t=answer>Answered</a><br /><br />";
		}
		$_GET['t']=mysql_escape($_GET['t']);
		if($_GET['t']=="redir")
		{
			print"<b>Questions redirected...</b><br /><table border=1>
			<tr><th>#</th><th>Question</th><th>Redirect #</th><th>Redirect Question</th><th>ACTIONS</th></tr>";
			$w=$db->query("SELECT * FROM questions WHERE Qredirect>0 ORDER BY Qid ASC");
			while($a=$db->fetch_row($w))
			{
				$w2=$db->query("SELECT * FROM questions WHERE Qid={$a['Qredirect']} LIMIT 1");
				$a2=$db->fetch_row($w2);
				$a['Qquest']=stripslashes($a['Qquest']);
				print "<tr><td><center>{$a['Qid']}</center></td><td>{$a['Qquest']}</td><td><center>{$a2['Qid']}</center></td>
				<td>{$a2['Qquest']}</td><td>&gt;<a href=questions.php?id={$a['Qid']}&act=answer>Answer</a><br />&gt;<a href=questions.php?id={$a['Qid']}&act=redirect>Edit Redir</a><br />&gt;<a href=questions.php?id={$a['Qid']}&act=edit>Edit Q</a><br />&gt;<a href=questions.php?id={$a['Qid']}&act=delete>Delete</a><br /></td></tr>";
			}
		}		
		else if($_GET['t']=="answer")
		{
			print"<b>Questions waiting for an answer...</b><br /><table border=1>
			<tr><th>#</th><th>Question</th><th>Answer</th><th>From User</th><th>ACTIONS</th></tr>";
			$w=$db->query("SELECT * FROM questions WHERE Qanswer!='' ORDER BY Qid ASC");
			while($a=$db->fetch_row($w))
			{
				if(!$a['Qanswer']) { $a['Qanswer']="<center><i>none</i></center>"; }
				$a['Qquest']=stripslashes($a['Qquest']);
				$a['Qanswer']=stripslashes($a['Qanswer']);
				print "<tr><td><center>{$a['Qid']}</center></td><td>{$a['Qquest']}</td><td>{$a['Qanswer']}</td>
				<td><center>{$a['Quser']}</center></td>
				<td>&gt;<a href=questions.php?id={$a['Qid']}&act=editanswer>Edit A</a><br />&gt;<a href=questions.php?id={$a['Qid']}&act=edit>Edit Q</a><br />&gt;<a href=questions.php?id={$a['Qid']}&act=redirect>Redirect</a><br />&gt;<a href=questions.php?id={$a['Qid']}&act=delete>Delete</a><br /></td></tr>";
			}
		}
		else if($_GET['act']=='')
		{
			print"<b>Questions waiting for an answer...</b><br /><table border=1>
			<tr><th>#</th><th>Question</th><th>From User</th><th>ACTIONS</th></tr>";
			$w=$db->query("SELECT * FROM questions WHERE Qdone=0 ORDER BY Qid ASC");
			while($a=$db->fetch_row($w))
			{
				$a['Qquest']=stripslashes($a['Qquest']);
				print "<tr><td><center>{$a['Qid']}</center></td><td>{$a['Qquest']}</td><td><center>{$a['Quser']}</center></td>
				<td>&gt;<a href=questions.php?id={$a['Qid']}&act=answer>Answer</a><br />&gt;<a href=questions.php?id={$a['Qid']}&act=answerd>Answer Spec.</a><br />&gt;<a href=questions.php?id={$a['Qid']}&act=redirect>Redirect</a><br />&gt;<a href=questions.php?id={$a['Qid']}&act=redirectd>Redirect Spec.</a><br />&gt;<a href=questions.php?id={$a['Qid']}&act=edit>Edit Q</a><br />&gt;<a href=questions.php?id={$a['Qid']}&act=delete>Delete</a><br /></td></tr>";
			}
		}
		print"</table>";
	}
}
print"</center><br /><br />";

?>
