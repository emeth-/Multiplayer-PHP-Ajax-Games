	<center><h2>Contact Us</h2>
<?php
if($_GET['success']==true)
{
echo <<<EOF
<strong style="color:green;">Success! Your message has been sent.</strong>
EOF;
}
else if($_GET['error']==true)
{
echo <<<EOF
<strong style="color:red;">There was an error. Please try again later.</strong>
EOF;
}
else
{
?>

		<form action="inc/contact.php" method="post" id="cForm">
			<fieldset>
				<b>Your Name:</b>
				<input class="text" type="text" size="25" name="posName" id="posName" /><br />
				<b>Your Email:</b>
				<input class="text" type="text" size="25" name="posEmail" id="posEmail" /><br />
				<b>Regarding:</b>
				<input class="text" type="text" size="25" name="posRegard" id="posRegard" /><br />
				<b>Message:</b><br />
				<textarea cols="50" rows="5" name="posText" id="posText"></textarea><br />
				<label>
					<input class="submit" type="submit" name="sendContactEmail" id="sendContactEmail" value=" Send Email " />
				</label>
			</fieldset>
		</form>
<?php
}
?>