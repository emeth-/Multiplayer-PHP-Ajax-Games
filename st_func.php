<?php
//$_POST['chattxt']="$t";
//$db->query("INSERT INTO st_chat (st_room, timestamp, txt) VALUES({$ir["st_room"]}, unix_timestamp(), '{$_POST['chattxt']}')");

 function draw_board($roomid, $userid, $turn)
{
	global $db,$ir;

	$drawb = $db->query("SELECT * FROM st_game WHERE st_room=$roomid");

	if(!$db->num_rows($drawb)){die();}//game not yet created

	$draw = $db->fetch_row($drawb);
	$red = $draw['red'];
	if($red == $draw['p1']){$blue = $draw['p2'];}
	else{$blue = $draw['p1'];}


//board set up, red on bottom
	if($userid == $red && $draw['mode'] == 0)
	{
		for($i=1; $i <=8; $i++)
		{
			for($j=1; $j <=8; $j++)
			{
				$t = "b".$i.$j;
				$t1 = "{$i}{$j}";
				$t2 = $draw["a".$i.$j];
				if($t2 >0){$t3 = $t2;}
				else{$t3 = "blank";}
				$$t = "<form method='post' name='m{$t1}'><input type=hidden name='setup' value=$t1><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' height = '50' width='50' src=\"images/st/a{$t3}.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('st_play.php', 'm{$t1}');return false;\" /></form>";
			}
		}

	    //pieces left to place
		$p1 = "<form method='post' name='p1'><input type=hidden name='setup' value=1><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' height = '50' width='50' src=\"images/st/a1.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('st_play.php', 'p1');return false;\" /></form>";
		$p2 = "<form method='post' name='p2'><input type=hidden name='setup' value=2><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' height = '50' width='50' src=\"images/st/a2.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('st_play.php', 'p2');return false;\" /></form>";
		$p3 = "<form method='post' name='p3'><input type=hidden name='setup' value=3><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' height = '50' width='50' src=\"images/st/a3.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('st_play.php', 'p3');return false;\" /></form>";
		$p4 = "<form method='post' name='p4'><input type=hidden name='setup' value=4><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' height = '50' width='50' src=\"images/st/a4.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('st_play.php', 'p4');return false;\" /></form>";
		$p5 = "<form method='post' name='p5'><input type=hidden name='setup' value=5><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' height = '50' width='50' src=\"images/st/a5.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('st_play.php', 'p5');return false;\" /></form>";
		$p6 = "<form method='post' name='p6'><input type=hidden name='setup' value=6><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' height = '50' width='50' src=\"images/st/a6.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('st_play.php', 'p6');return false;\" /></form>";
		$p7 = "<form method='post' name='p7'><input type=hidden name='setup' value=7><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' height = '50' width='50' src=\"images/st/a7.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('st_play.php', 'p7');return false;\" /></form>";
		$p8 = "<form method='post' name='p8'><input type=hidden name='setup' value=8><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' height = '50' width='50' src=\"images/st/a8.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('st_play.php', 'p8');return false;\" /></form>";
		$p9 = "<form method='post' name='p9'><input type=hidden name='setup' value=9><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' height = '50' width='50' src=\"images/st/a9.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('st_play.php', 'p9');return false;\" /></form>";
		$p10 = "<form method='post' name='p10'><input type=hidden name='setup' value=10><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' height = '50' width='50' src=\"images/st/a10.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('st_play.php', 'p10');return false;\" /></form>";
		       
	     //number of pieces left
		$p1count = "x".$draw['pa1'];
		$p2count = "x".$draw['pa2'];
		$p3count = "x".$draw['pa3'];
		$p4count = "x".$draw['pa4'];
		$p5count = "x".$draw['pa5'];
		$p6count = "x".$draw['pa6'];
		$p7count = "x".$draw['pa7'];
		$p8count = "x".$draw['pa8'];
		$p9count = "x".$draw['pa9'];
		$p10count = "x".$draw['pa10'];

		$temp = $draw['posa'];
		$temp2 = "p".$temp;
		$$temp2 = "<form method='post' name='p{$temp}'><input type=hidden name='setup' value=$temp><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' height = '50' width='50' src=\"images/st/s{$temp}.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('st_play.php', 'p{$temp}');return false;\" /></form>";
			
		$bdistxt = " disabled='disabled'";
        if($draw['pa1'] == 0 && $draw['pa2'] == 0 && $draw['pa3'] == 0 && $draw['pa4'] == 0 && $draw['pa5'] == 0 && $draw['pa6'] == 0 && $draw['pa7'] == 0 && $draw['pa8'] == 0 && $draw['pa9'] == 0 && $draw['pa10'] == 0)
        {
			$bdistxt="";
		}


		if($userid == $draw['red'] && $draw['p1ready'] == 1)
		{
			$bdistxt = " disabled='disabled'";		
		}
		else if($userid != $draw['red'] && $draw['p2ready'] == 1)
		{
			$bdistxt = " disabled='disabled'";
		}

		$txt = "<center><form method='post' name='begin'><input type=hidden name='begin' value=1><input type=hidden name='id' value='{$roomid}'><input type='submit' border=0 name='movebutton' id='movebutton' value='Begin' onclick=\"postFormAjax('st_play.php', 'begin');return false;\" $bdistxt /></form></center><br />";
		$txt.="<center><table BORDER='0' cellspacing = '3' cellpadding='0' table bgcolor='#FFFFFF'>";
		$txt.="<tr><td style=\"font-size:0;\">$p1</td><td style=\"font-size:12;\">$p1count </td><td style=\"font-size:0;\">$p2</td><td style=\"font-size:12;\">$p2count </td><td style=\"font-size:0;\">$p3</td><td style=\"font-size:12;\">$p3count </td><td style=\"font-size:0;\">$p4</td><td style=\"font-size:12;\">$p4count </td><td style=\"font-size:0;\">$p5</td><td style=\"font-size:12;\">$p5count </td></tr>";
		$txt.="<tr><td style=\"font-size:0;\">$p6</td><td style=\"font-size:12;\">$p6count </td><td style=\"font-size:0;\">$p7</td><td style=\"font-size:12;\">$p7count </td><td style=\"font-size:0;\">$p8</td><td style=\"font-size:12;\">$p8count </td><td style=\"font-size:0;\">$p9</td><td style=\"font-size:12;\">$p9count </td><td style=\"font-size:0;\">$p10</td><td style=\"font-size:12;\">$p10count </td></tr>";
		$txt.="</table></center><br />";


		//board
		$txt.="<center><table BORDER='0' cellspacing = '0' cellpadding='0' height = '400' width='400' style=\"background: url('images/st/board.jpg') no-repeat;\">";
		$txt.="<tr><td>$b11</td><td>$b12</td><td>$b13</td><td>$b14</td><td>$b15</td><td>$b16</td><td>$b17</td><td>$b18</td></tr>";
		$txt.="<tr><td>$b21</td><td>$b22</td><td>$b23</td><td>$b24</td><td>$b25</td><td>$b26</td><td>$b27</td><td>$b28</td></tr>";
		$txt.="<tr><td>$b31</td><td>$b32</td><td>$b33</td><td>$b34</td><td>$b35</td><td>$b36</td><td>$b37</td><td>$b38</td></tr>";
		$txt.="<tr><td>$b41</td><td>$b42</td><td>$b43</td><td>$b44</td><td>$b45</td><td>$b46</td><td>$b47</td><td>$b48</td></tr>";
		$txt.="<tr><td>$b51</td><td>$b52</td><td>$b53</td><td>$b54</td><td>$b55</td><td>$b56</td><td>$b57</td><td>$b58</td></tr>";
		$txt.="<tr><td>$b61</td><td>$b62</td><td>$b63</td><td>$b64</td><td>$b65</td><td>$b66</td><td>$b67</td><td>$b68</td></tr>";
		$txt.="<tr><td>$b71</td><td>$b72</td><td>$b73</td><td>$b74</td><td>$b75</td><td>$b76</td><td>$b77</td><td>$b78</td></tr>";
		$txt.="<tr><td>$b81</td><td>$b82</td><td>$b83</td><td>$b84</td><td>$b85</td><td>$b86</td><td>$b87</td><td>$b88</td></tr>";
		$txt.="</table></center><br ><br />*Note - Scouts (7) can move more than one space in a turn, as far as squares are open in a straight line. Only Miners (6) can defuse bombs. The Spy can only kill the General, and only when the Spy attacks first. Capture your opponent's flag to win.";
	}
	//board set up, blue on bottom
	if($userid == $blue && $draw['mode'] == 0)
	{
		for($i=1; $i <=8; $i++)
		{
			for($j=1; $j <=8; $j++)
			{
				$t = "b".$i.$j;
				$t1 = "{$i}{$j}";
				$t2 = $draw["b".$i.$j];
				if($t2 >0){$t3 = $t2;}
				else{$t3 = "blank";}
				$$t = "<form method='post' name='m{$t1}'><input type=hidden name='setup' value=$t1><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' height = '50' width='50' src=\"images/st/b{$t3}.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('st_play.php', 'm{$t1}');return false;\" /></form>";
			}
		}

       //pieces left to place
         $p1 = "<form method='post' name='p1'><input type=hidden name='setup' value=1><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' height = '50' width='50' src=\"images/st/b1.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('st_play.php', 'p1');return false;\" /></form>";
         $p2 = "<form method='post' name='p2'><input type=hidden name='setup' value=2><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' height = '50' width='50' src=\"images/st/b2.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('st_play.php', 'p2');return false;\" /></form>";
         $p3 = "<form method='post' name='p3'><input type=hidden name='setup' value=3><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' height = '50' width='50' src=\"images/st/b3.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('st_play.php', 'p3');return false;\" /></form>";
         $p4 = "<form method='post' name='p4'><input type=hidden name='setup' value=4><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' height = '50' width='50' src=\"images/st/b4.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('st_play.php', 'p4');return false;\" /></form>";
         $p5 = "<form method='post' name='p5'><input type=hidden name='setup' value=5><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' height = '50' width='50' src=\"images/st/b5.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('st_play.php', 'p5');return false;\" /></form>";
         $p6 = "<form method='post' name='p6'><input type=hidden name='setup' value=6><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' height = '50' width='50' src=\"images/st/b6.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('st_play.php', 'p6');return false;\" /></form>";
         $p7 = "<form method='post' name='p7'><input type=hidden name='setup' value=7><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' height = '50' width='50' src=\"images/st/b7.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('st_play.php', 'p7');return false;\" /></form>";
         $p8 = "<form method='post' name='p8'><input type=hidden name='setup' value=8><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' height = '50' width='50' src=\"images/st/b8.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('st_play.php', 'p8');return false;\" /></form>";
         $p9 = "<form method='post' name='p9'><input type=hidden name='setup' value=9><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' height = '50' width='50' src=\"images/st/b9.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('st_play.php', 'p9');return false;\" /></form>";
         $p10 = "<form method='post' name='p10'><input type=hidden name='setup' value=10><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' height = '50' width='50' src=\"images/st/b10.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('st_play.php', 'p10');return false;\" /></form>";
       //number of pieces left
        $p1count = "x".$draw['pb1'];
        $p2count = "x".$draw['pb2'];
        $p3count = "x".$draw['pb3'];
        $p4count = "x".$draw['pb4'];
        $p5count = "x".$draw['pb5'];
        $p6count = "x".$draw['pb6'];
        $p7count = "x".$draw['pb7'];
        $p8count = "x".$draw['pb8'];
        $p9count = "x".$draw['pb9'];
        $p10count = "x".$draw['pb10'];
               
        $temp = $draw['posb'];
        $temp2 = "p".$temp;
       	$$temp2 = "<form method='post' name='p{$temp}'><input type=hidden name='setup' value=$temp><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' height = '50' width='50' src=\"images/st/s{$temp}.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('st_play.php', 'p{$temp}');return false;\" /></form>";       
               

		$bdistxt2 = " disabled='disabled'";
        if($draw['pb1'] == 0 && $draw['pb2'] == 0 && $draw['pb3'] == 0 && $draw['pb4'] == 0 && $draw['pb5'] == 0 && $draw['pb6'] == 0 && $draw['pb7'] == 0 && $draw['pb8'] == 0 && $draw['pb9'] == 0 && $draw['pb10'] == 0)
        {
			$bdistxt2="";
		}

		if($userid == $draw['red'] && $draw['p1ready'] == 1)
		{
			$bdistxt2 = " disabled='disabled'";		
		}
		else if($userid != $draw['red'] && $draw['p2ready'] == 1)
		{
			$bdistxt2 = " disabled='disabled'";
		}

		$txt = "<center><form method='post' name='begin'><input type=hidden name='begin' value=1><input type=hidden name='id' value='{$roomid}'><input type='submit' border=0 name='movebutton' id='movebutton' value='Begin' onclick=\"postFormAjax('st_play.php', 'begin');return false;\" $bdistxt2 /></form></center><br />";
		$txt.="<center><table BORDER='0' cellspacing = '3' cellpadding='0' table bgcolor='#FFFFFF'>";
		$txt.="<tr><td style=\"font-size:0;\">$p1</td><td style=\"font-size:12;\">$p1count </td><td style=\"font-size:0;\">$p2</td><td style=\"font-size:12;\">$p2count </td><td style=\"font-size:0;\">$p3</td><td style=\"font-size:12;\">$p3count </td><td style=\"font-size:0;\">$p4</td><td style=\"font-size:12;\">$p4count </td><td style=\"font-size:0;\">$p5</td><td style=\"font-size:12;\">$p5count </td></tr>";
		$txt.="<tr><td style=\"font-size:0;\">$p6</td><td style=\"font-size:12;\">$p6count </td><td style=\"font-size:0;\">$p7</td><td style=\"font-size:12;\">$p7count </td><td style=\"font-size:0;\">$p8</td><td style=\"font-size:12;\">$p8count </td><td style=\"font-size:0;\">$p9</td><td style=\"font-size:12;\">$p9count </td><td style=\"font-size:0;\">$p10</td><td style=\"font-size:12;\">$p10count </td></tr>";
		$txt.="</table></center><br />";
  
		$txt.="<center><table BORDER='0' cellspacing = '0' cellpadding='0' height = '400' width='400' style=\"background: url('images/st/board.jpg') no-repeat;\">";
		$txt.="<tr><td>$b88</td><td>$b87</td><td>$b86</td><td>$b85</td><td>$b84</td><td>$b83</td><td>$b82</td><td>$b81</td></tr>";
		$txt.="<tr><td>$b78</td><td>$b77</td><td>$b76</td><td>$b75</td><td>$b74</td><td>$b73</td><td>$b72</td><td>$b71</td></tr>";
		$txt.="<tr><td>$b68</td><td>$b67</td><td>$b66</td><td>$b65</td><td>$b64</td><td>$b63</td><td>$b62</td><td>$b61</td></tr>";
		$txt.="<tr><td>$b58</td><td>$b57</td><td>$b56</td><td>$b55</td><td>$b54</td><td>$b53</td><td>$b52</td><td>$b51</td></tr>";
		$txt.="<tr><td>$b48</td><td>$b47</td><td>$b46</td><td>$b45</td><td>$b44</td><td>$b43</td><td>$b42</td><td>$b41</td></tr>";
		$txt.="<tr><td>$b38</td><td>$b37</td><td>$b36</td><td>$b35</td><td>$b34</td><td>$b33</td><td>$b32</td><td>$b31</td></tr>";
		$txt.="<tr><td>$b28</td><td>$b27</td><td>$b26</td><td>$b25</td><td>$b24</td><td>$b23</td><td>$b22</td><td>$b21</td></tr>";
		$txt.="<tr><td>$b18</td><td>$b17</td><td>$b16</td><td>$b15</td><td>$b14</td><td>$b13</td><td>$b12</td><td>$b11</td></tr>";
		$txt.="</table></center><br ><br />*Note - Scouts (7) can move more than one space in a turn, as far as squares are open in a straight line. Only Miners (6) can defuse bombs. The Spy can only kill the General, and only when the Spy attacks first. Capture your opponent's flag to win.";
	}
//game play red on bottom
	if($userid == $red && $draw['mode'] == 1)
	{
		for($i=1; $i <=8; $i++)
		{
			for($j=1; $j <=8; $j++)
			{
				$t = "b".$i.$j;
				$t1 = "{$i}{$j}";
				$t2 = $draw["a".$i.$j];
				if($t2 != 0){$t3 = abs($t2);}
				else{$t3 = "blank";}
				$$t = "<form method='post' name='m{$t1}'><input type=hidden name='move' value=$t1><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' height = '50' width='50' src=\"images/st/a{$t3}.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('st_play.php', 'm{$t1}');return false;\" /></form>";
			}
		}
		for($i=1; $i <=8; $i++)
		{
			for($j=1; $j <=8; $j++)
			{
				$t = "b".$i.$j;
				$t1 = "{$i}{$j}";
				$t2 = $draw["b".$i.$j];
				if($t2 <0){$t3 = abs($t2);}
				else if($t2 > 0){$t3 = "blue";}
				else{$t3 = "blank";}
				if($draw["a".$i.$j] == 0)
				{
					$$t = "<form method='post' name='m{$t1}'><input type=hidden name='move' value=$t1><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' height = '50' width='50' src=\"images/st/b{$t3}.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('st_play.php', 'm{$t1}');return false;\" /></form>";
				}
			}
		}
        $temp = $draw['pselected'];
       	$t = "b".$temp;
        $temp2 = $draw["a".$temp];
        $temp3 = $draw["b".$temp];
		
        if($temp2 > 0)
        {
        	$$t = "<form method='post' name='m{$temp}'><input type=hidden name='move' value=$temp><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' height = '50' width='50' src=\"images/st/s{$temp2}.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('st_play.php', 'm{$temp}');return false;\" /></form>";
        }
        if($temp2 < 0)
        {
			$temp4 = abs($temp2);
        	$$t = "<form method='post' name='m{$temp}'><input type=hidden name='move' value=$temp><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' height = '50' width='50' src=\"images/st/s{$temp4}.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('st_play.php', 'm{$temp}');return false;\" /></form>";
        } 
	
		$temp = $draw['lastmove'];
       	$t = "b".$temp;
        $temp2 = $draw["a".$temp];
        $temp3 = $draw["b".$temp];

		if($temp2 >0)
		{
			$$t = "<form method='post' name='m{$temp}'><input type=hidden name='move' value=$temp><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' height = '50' width='50' src=\"images/st/a{$temp2}lm.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('st_play.php', 'm{$temp}');return false;\" /></form>";
		}
		else if($temp2 < 0)
		{
			$temp4 = abs($temp2);
			$$t = "<form method='post' name='m{$temp}'><input type=hidden name='move' value=$temp><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' height = '50' width='50' src=\"images/st/a{$temp4}lm.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('st_play.php', 'm{$temp}');return false;\" /></form>";
		}
		else if($temp3 <0)
		{
			$temp4 = abs($temp3);
			$$t = "<form method='post' name='m{$temp}'><input type=hidden name='move' value=$temp><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' height = '50' width='50' src=\"images/st/b{$temp4}lm.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('st_play.php', 'm{$temp}');return false;\" /></form>";		
		}
		else if($temp3 >0)
		{
			$$t = "<form method='post' name='m{$temp}'><input type=hidden name='move' value=$temp><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' height = '50' width='50' src=\"images/st/bbluelm.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('st_play.php', 'm{$temp}');return false;\" /></form>";
		}
         //pieces captured
            $p1 = "<img src='images/st/b1.png'>";
            $p2 = "<img src='images/st/b2.png'>";
            $p3 = "<img src='images/st/b3.png'>";
            $p4 = "<img src='images/st/b4.png'>";
            $p5 = "<img src='images/st/b5.png'>";
            $p6 = "<img src='images/st/b6.png'>";
            $p7 = "<img src='images/st/b7.png'>";
            $p8 = "<img src='images/st/b8.png'>";
            $p9 = "<img src='images/st/b9.png'>";
            $p10 = "<img src='images/st/b10.png'>";
	    
          //number of pieces captured -- CHANGED TO NUMBER OF PIECES LEFT
            $p1count = "x".(1-$draw['pa1']);
            $p2count = "x".(1-$draw['pa2']);
            $p3count = "x".(2-$draw['pa3']);
            $p4count = "x".(3-$draw['pa4']);
            $p5count = "x".(3-$draw['pa5']);
            $p6count = "x".(3-$draw['pa6']);
            $p7count = "x".(5-$draw['pa7']);
            $p8count = "x".(1-$draw['pa8']);
            $p9count = "x".(4-$draw['pa9']);
            $p10count = "x".(1-$draw['pa10']);
                
       	$battle = "<b>".$draw['battletxt']."</b>";
		$movelist = $draw['listofmoves'];
	
     //gameplay text
       	$txt ="<center><table BORDER='0' cellspacing = '0' cellpadding='0' table bgcolor='#FFFFFF'>";
       	$txt.="<tr><td>$battle</td></tr>";
       	$txt.="</table></center>";

     //board
		$txt .="<center><table BORDER='0' cellspacing = '0' cellpadding='0' height = '400' width='400' style=\"background: url('images/st/board.jpg') no-repeat;\">";
		$txt.="<tr><td>$b11</td><td>$b12</td><td>$b13</td><td>$b14</td><td>$b15</td><td>$b16</td><td>$b17</td><td>$b18</td></tr>";
		$txt.="<tr><td>$b21</td><td>$b22</td><td>$b23</td><td>$b24</td><td>$b25</td><td>$b26</td><td>$b27</td><td>$b28</td></tr>";
		$txt.="<tr><td>$b31</td><td>$b32</td><td>$b33</td><td>$b34</td><td>$b35</td><td>$b36</td><td>$b37</td><td>$b38</td></tr>";
		$txt.="<tr><td>$b41</td><td>$b42</td><td>$b43</td><td>$b44</td><td>$b45</td><td>$b46</td><td>$b47</td><td>$b48</td></tr>";
		$txt.="<tr><td>$b51</td><td>$b52</td><td>$b53</td><td>$b54</td><td>$b55</td><td>$b56</td><td>$b57</td><td>$b58</td></tr>";
		$txt.="<tr><td>$b61</td><td>$b62</td><td>$b63</td><td>$b64</td><td>$b65</td><td>$b66</td><td>$b67</td><td>$b68</td></tr>";
		$txt.="<tr><td>$b71</td><td>$b72</td><td>$b73</td><td>$b74</td><td>$b75</td><td>$b76</td><td>$b77</td><td>$b78</td></tr>";
		$txt.="<tr><td>$b81</td><td>$b82</td><td>$b83</td><td>$b84</td><td>$b85</td><td>$b86</td><td>$b87</td><td>$b88</td></tr>";
		$txt.="</table></center>";
     //pieces captured
		
		$movelist = reverse_movelist($movelist);

		$txt.= "<br /><br />";
		$txt.="<center><table border='1' cellpadding = '5' cellspacing = '0' table bordercolor='#FF0000'><tr>";
		$txt.="<td><table BORDER='0' cellspacing = '3' cellpadding='0'>";
		$txt.="<tr><td colspan=10 align='center'><b>Opponent's Pieces on Board</b></td></tr>";
		$txt.="<tr><td style=\"font-size:0;\">$p1</td><td style=\"font-size:12;\">$p1count </td><td style=\"font-size:0;\">$p2</td><td style=\"font-size:12;\">$p2count </td><td style=\"font-size:0;\">$p3</td><td style=\"font-size:12;\">$p3count </td><td style=\"font-size:0;\">$p4</td><td style=\"font-size:12;\">$p4count </td><td style=\"font-size:0;\">$p5</td><td style=\"font-size:12;\">$p5count </td></tr>";
		$txt.="<tr><td style=\"font-size:0;\">$p6</td><td style=\"font-size:12;\">$p6count </td><td style=\"font-size:0;\">$p7</td><td style=\"font-size:12;\">$p7count </td><td style=\"font-size:0;\">$p8</td><td style=\"font-size:12;\">$p8count </td><td style=\"font-size:0;\">$p9</td><td style=\"font-size:12;\">$p9count </td><td style=\"font-size:0;\">$p10</td><td style=\"font-size:12;\">$p10count </td></tr>";
		$txt.="</table></td>";
		/*
		$txt.="<td><table border = '1' cellpadding ='5' cellspacing = '0' height = '100' style=\"width:200px;\"  bgcolor='#FFFFFF'>";
		$txt.="<tr><td><div style=\"overflow:auto; height:100px; width:200px\"> $movelist </div></td>";
		$txt.="</tr></table></td>";
		*/
		$txt.="</tr></table></center><br ><br />*Note - Scouts (7) can move more than one space in a turn, as far as squares are open in a straight line. Only Miners (6) can defuse bombs. The Spy can only kill the General, and only when the Spy attacks first. Capture your opponent's flag to win.";

	}
//game play blue on bottom
	if($userid == $blue && $draw['mode'] == 1)
	{
		for($i=1; $i <=8; $i++)
		{
			for($j=1; $j <=8; $j++)
			{
				$t = "b".$i.$j;
				$t1 = "{$i}{$j}";
				$t2 = $draw["b".$i.$j];
				if($t2 != 0){$t3 = abs($t2);}
				else{$t3 = "blank";}
				$$t = "<form method='post' name='m{$t1}'><input type=hidden name='move' value=$t1><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' height = '50' width='50' src=\"images/st/b{$t3}.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('st_play.php', 'm{$t1}');return false;\" /></form>";
			}
		}
		for($i=1; $i <=8; $i++)
		{
			for($j=1; $j <=8; $j++)
			{
				$t = "b".$i.$j;
				$t1 = "{$i}{$j}";
				$t2 = $draw["a".$i.$j];
				if($t2 <0){$t3 = abs($t2);}
				else if($t2 > 0){$t3 = "red";}
				else{$t3 = "blank";}
				if($draw["b".$i.$j] == 0)
				{
					$$t = "<form method='post' name='m{$t1}'><input type=hidden name='move' value=$t1><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' height = '50' width='50' src=\"images/st/a{$t3}.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('st_play.php', 'm{$t1}');return false;\" /></form>";
				}
			}
		}
        $temp = $draw['pselected'];
        $t = "b".$temp;
        $temp2 = $draw["a".$temp];
        $temp3 = $draw["b".$temp];
		
        if($temp3 > 0)
        {
           	$$t = "<form method='post' name='m{$temp}'><input type=hidden name='move' value=$temp><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' height = '50' width='50' src=\"images/st/s{$temp3}.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('st_play.php', 'm{$temp}');return false;\" /></form>";
        }
        else if($temp3 < 0)
		{
			$temp4 = abs($temp3);
          	$$t = "<form method='post' name='m{$temp}'><input type=hidden name='move' value=$temp><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' height = '50' width='50' src=\"images/st/s{$temp4}.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('st_play.php', 'm{$temp}');return false;\" /></form>";
        }
		
		$temp = $draw['lastmove'];
       	$t = "b".$temp;
        $temp2 = $draw["a".$temp];
        $temp3 = $draw["b".$temp];

		if($temp2 >0)
		{
			$$t = "<form method='post' name='m{$temp}'><input type=hidden name='move' value=$temp><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' height = '50' width='50' src=\"images/st/aredlm.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('st_play.php', 'm{$temp}');return false;\" /></form>";		
		}
		else if($temp2 <0)
		{
			$temp4 = abs($temp2);
			$$t = "<form method='post' name='m{$temp}'><input type=hidden name='move' value=$temp><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' height = '50' width='50' src=\"images/st/a{$temp4}lm.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('st_play.php', 'm{$temp}');return false;\" /></form>";		
		}	
		else if($temp3 >0)
		{
			$$t = "<form method='post' name='m{$temp}'><input type=hidden name='move' value=$temp><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' height = '50' width='50' src=\"images/st/b{$temp3}lm.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('st_play.php', 'm{$temp}');return false;\" /></form>";
		}
		else if($temp3 <0)
		{
			$temp4 = abs($temp3);
			$$t = "<form method='post' name='m{$temp}'><input type=hidden name='move' value=$temp><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' height = '50' width='50' src=\"images/st/b{$temp4}lm.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('st_play.php', 'm{$temp}');return false;\" /></form>";
		}
          //pieces captured
	  
		$movelist = reverse_movelist($movelist);
		
            $p1 = "<img src='images/st/a1.png'>";
            $p2 = "<img src='images/st/a2.png'>";
            $p3 = "<img src='images/st/a3.png'>";
            $p4 = "<img src='images/st/a4.png'>";
            $p5 = "<img src='images/st/a5.png'>";
            $p6 = "<img src='images/st/a6.png'>";
            $p7 = "<img src='images/st/a7.png'>";
            $p8 = "<img src='images/st/a8.png'>";
            $p9 = "<img src='images/st/a9.png'>";
            $p10 = "<img src='images/st/a10.png'>";
          //number of pieces captured -- CHANGED TO NUMBER OF PIECES LEFT
            $p1count = "x".(1-$draw['pb1']);
            $p2count = "x".(1-$draw['pb2']);
            $p3count = "x".(2-$draw['pb3']);
            $p4count = "x".(3-$draw['pb4']);
            $p5count = "x".(3-$draw['pb5']);
            $p6count = "x".(3-$draw['pb6']);
            $p7count = "x".(5-$draw['pb7']);
            $p8count = "x".(1-$draw['pb8']);
            $p9count = "x".(4-$draw['pb9']);
            $p10count = "x".(1-$draw['pb10']);
		//battle text
	       $battle = "<b>".$draw['battletxt']."</b>";
	       $movelist = $draw['listofmoves'];
         //gameplay text
            $txt ="<center><table BORDER='0' cellspacing = '0' cellpadding='0' table bgcolor='#FFFFFF'>";
            $txt.="<tr><td>$battle</td></tr>";
            $txt.="</table></center>";
         //board
            $txt.="<center><table BORDER='0' cellspacing = '0' cellpadding='0' height = '400' width='400' style=\"background: url('images/st/board.jpg') no-repeat;\">";
            $txt.="<tr><td>$b88</td><td>$b87</td><td>$b86</td><td>$b85</td><td>$b84</td><td>$b83</td><td>$b82</td><td>$b81</td></tr>";
		$txt.="<tr><td>$b78</td><td>$b77</td><td>$b76</td><td>$b75</td><td>$b74</td><td>$b73</td><td>$b72</td><td>$b71</td></tr>";
		$txt.="<tr><td>$b68</td><td>$b67</td><td>$b66</td><td>$b65</td><td>$b64</td><td>$b63</td><td>$b62</td><td>$b61</td></tr>";
		$txt.="<tr><td>$b58</td><td>$b57</td><td>$b56</td><td>$b55</td><td>$b54</td><td>$b53</td><td>$b52</td><td>$b51</td></tr>";
		$txt.="<tr><td>$b48</td><td>$b47</td><td>$b46</td><td>$b45</td><td>$b44</td><td>$b43</td><td>$b42</td><td>$b41</td></tr>";
		$txt.="<tr><td>$b38</td><td>$b37</td><td>$b36</td><td>$b35</td><td>$b34</td><td>$b33</td><td>$b32</td><td>$b31</td></tr>";
		$txt.="<tr><td>$b28</td><td>$b27</td><td>$b26</td><td>$b25</td><td>$b24</td><td>$b23</td><td>$b22</td><td>$b21</td></tr>";
		$txt.="<tr><td>$b18</td><td>$b17</td><td>$b16</td><td>$b15</td><td>$b14</td><td>$b13</td><td>$b12</td><td>$b11</td></tr>";
		$txt.="</table></center>";
    //captured pieces
    
		$txt.= "<br /><br />";
		$txt.="<center><table border='1' cellpadding = '5' cellspacing = '0' table bordercolor='#FF0000'><tr>";
		$txt.="<td><table BORDER='0' cellspacing = '3' cellpadding='0'>";
		$txt.="<tr><td colspan=10 align='center'><b>Opponent's Pieces on Board</b></td></tr>";
		$txt.="<tr><td style=\"font-size:0;\">$p1</td><td style=\"font-size:12;\">$p1count </td><td style=\"font-size:0;\">$p2</td><td style=\"font-size:12;\">$p2count </td><td style=\"font-size:0;\">$p3</td><td style=\"font-size:12;\">$p3count </td><td style=\"font-size:0;\">$p4</td><td style=\"font-size:12;\">$p4count </td><td style=\"font-size:0;\">$p5</td><td style=\"font-size:12;\">$p5count </td></tr>";
		$txt.="<tr><td style=\"font-size:0;\">$p6</td><td style=\"font-size:12;\">$p6count </td><td style=\"font-size:0;\">$p7</td><td style=\"font-size:12;\">$p7count </td><td style=\"font-size:0;\">$p8</td><td style=\"font-size:12;\">$p8count </td><td style=\"font-size:0;\">$p9</td><td style=\"font-size:12;\">$p9count </td><td style=\"font-size:0;\">$p10</td><td style=\"font-size:12;\">$p10count </td></tr>";
		$txt.="</table></td>";
		/*
		$txt.="<td><table border = '1' cellpadding ='5' cellspacing = '0' height = '100' style=\"width:200px;\"  bgcolor='#FFFFFF'>";
		$txt.="<tr><td><div style=\"overflow:auto; height:100px; width:200px\"> $movelist </div></td>";
		$txt.="</tr></table></td>";
		*/
		$txt.="</tr></table></center><br ><br />*Note - Scouts (7) can move more than one space in a turn, as far as squares are open in a straight line. Only Miners (6) can defuse bombs. The Spy can only kill the General, and only when the Spy attacks first. Capture your opponent's flag to win.";

	}
	print $txt;
	
}// end of draw function

function make_move($move, $userid, $roomid)
{
	global $db,$ir;
	$game=$db->query("SELECT * FROM st_room WHERE id=$roomid", $c) or die("1");
	$ga=$db->fetch_row($game);

	$game2=$db->query("SELECT * FROM st_game WHERE st_room=$roomid", $c) or die("1");
	$gijoe=$db->fetch_row($game2);
        
	$turn = $ga['turn'];

    $red  = $gijoe['red']; 
	if($gijoe['p1'] == $red){$blue = $gijoe['p2'];}
    else{$blue = $gijoe['p1'];}        
	$pselect = $gijoe['pselected'];
    
	$uname = $db->fetch_row($db->query("SELECT username FROM users WHERE userid=$userid"));
	$attackersusername = $uname['username'];
	if($userid == $red){$uname = $db->fetch_row($db->query("SELECT username FROM users WHERE userid=$blue"));}
	else{$uname = $db->fetch_row($db->query("SELECT username FROM users WHERE userid=$red"));}
    $defendersusername = $uname['username'];

	if($turn==$userid)
	{
            if($userid == $red){$loc = "a";$antiloc= "b";}
            else{$loc = "b";$antiloc= "a";}
            
            if($pselect == $move){$db->query("UPDATE st_game SET pselected = 0 WHERE st_room=$roomid");die();} //deselect their piece
            if($gijoe[$loc.$move] != 0){$db->query("UPDATE st_game SET pselected = $move WHERE st_room=$roomid");die();}
        //basic moves
	    //pselect working and deselect working basic moves so normal pieces can move.
                
            $piecetomove = $gijoe[$loc.$pselect];
            //out of bounds
            if($move == 56 || $move == 46 || $move == 53 || $move == 43){die();}
            if($move < 11 || $move > 88 || $move == 19 || $move == 29 || $move == 39 || $move == 49 || $move == 59 || $move == 69 || $move == 79){die();}

            //movement of linear pieces
            if((abs($piecetomove) >0 && abs($piecetomove) < 7) || abs($piecetomove) == 8)
            {
                if($gijoe[$antiloc.$move] != 0)
                {
					
                    //if the oppent has a piece there ATTACK
                    if(valid_move($pselect, $move) ==  1)
                        {   
                            $piece1 = $gijoe[$loc.$pselect]; //attacker
                            $piece2 = $gijoe[$antiloc.$move]; //defender
						
                            if(attack_piece(abs($piece1),abs($piece2)) == 2) // if attacker wins
                            {
                                $startingspot = $loc.$pselect; //start spot
                                $finishingspot = $loc.$move; //finishing spot
                                $revealedpiece = "-".abs($gijoe[$startingspot]); // reveal the piece 
                                $opponentsspot = $antiloc.$move; // losers spot
                                $Attackname = number_to_name(abs($piece1)); // name of attackers piece
                                $Defendname = number_to_name(abs($piece2)); // name of defenders piece
                                $text = $attackersusername ."\'s " . $Attackname . " (".abs($piece1).") killed " . $defendersusername . "\'s " . $Defendname." (".abs($piece2).")";
                                $piecelost = "p".$loc.abs($piece2); //piece captured
                               	$newmovelist = move_list($pselect,$move,$gijoe['listofmoves'],$gijoe['posa'],$attackersusername,$defendersusername);
				$db->query("UPDATE st_game SET listofmoves = '$newmovelist', $piecelost = $piecelost +1,$startingspot = 0, $finishingspot = $revealedpiece, $opponentsspot = 0, lastmove = $move, battletxt = '$text' WHERE st_room=$roomid");         
				toggle_turn($roomid);
                            }
                            else if(attack_piece(abs($piece1), abs($piece2)) == 1) // if tie ... need to look up what happens if tie
                            {
                                $startingspot = $loc.$pselect;
                                $finishingspot = $antiloc.$move;
                                $piecesname = number_to_name(abs($piece1));  // name of the two pieces
                                $text = "Both " .$piecesname."\'s (".abs($piece1).") were killed";
                                $piecelost = "p".$loc.abs($piece2); // piece captured
                                $piecelost2 = "p".$antiloc.abs($piece1); //piece lost
                                $newmovelist = move_list($pselect,$move,$gijoe['listofmoves'],$gijoe['posa'],$attackersusername,$defendersusername);
                                $db->query("UPDATE st_game SET listofmoves = '$newmovelist', $piecelost = $piecelost +1,$piecelost2 = $piecelost2 +1,$startingspot = 0, $finishingspot = 0, lastmove = $move, battletxt = '$text' WHERE st_room=$roomid");
                                toggle_turn($roomid);
                            }
                            else if(attack_piece(abs($piece1),abs($piece2)) == 3) //captured flag award win
                            {
                                $winningpiece = number_to_name(abs($piece1));  // name of the two pieces
                                
				$text = $attackersusername ."\'s " . $winnpiece . " (".abs($piece1).") captured the flag";
                                
				$newmovelist = move_list($pselect,$move,$gijoe['listofmoves'],$gijoe['posa'],$attackersusername,$defendersusername);
                                $db->query("UPDATE st_game SET listofmoves = '$newmovelist', battletxt = '$text' WHERE st_room=$roomid");
                                award_win($roomid, $userid);
                            }
                            else // attacker loses
                            {
                                $Attackname = number_to_name(abs($piece1)); // name of attackers piece
                                $Defendname = number_to_name(abs($piece2)); // name of defenders piece
                          
				$text = $attackersusername ."\'s " . $Attackname . " (".abs($piece1).") lost to " . $defendersusername . "\'s " . $Defendname." (".abs($piece2).")";
                                
                                $startingspot = $loc.$pselect;
                                $finishingspot = $antiloc.$move;
                                $revealedpiece = "-".abs($gijoe[$finishingspot]);
			    
                                $piecelost = "p".$antiloc.abs($piece1);
                            	$newmovelist = move_list($pselect,$move,$gijoe['listofmoves'],$gijoe['posa'],$attackersusername,$defendersusername);

								$db->query("UPDATE st_game SET listofmoves = '$newmovelist', $piecelost = $piecelost +1,$startingspot = 0, $finishingspot = $revealedpiece, lastmove = $move, battletxt = '$text' WHERE st_room=$roomid");
                                toggle_turn($roomid);
                            }
                        }
                }
                else
                {
					
                    if($gijoe[$loc.$move] == 0)
                    {
						
                        if(valid_move($pselect, $move) ==  1)
                        {
                            $startingspot = $loc.$pselect;
                            $finishingspot = $loc.$move;
                            $piecetomove = $gijoe[$startingspot];
                            $newmovelist = move_list($pselect,$move,$gijoe['listofmoves'],$gijoe['posa'],$attackersusername,$defendersusername);
                            $db->query("UPDATE st_game SET listofmoves = '$newmovelist', $startingspot = 0, $finishingspot = $piecetomove, pselected = 0, lastmove = $move, battletxt = '' WHERE st_room=$roomid");
                            toggle_turn($roomid);
                        }
                    }
                }
            }
            //movement of scout
           if(abs($piecetomove) == 7)
            {
		
                if($gijoe[$antiloc.$move] != 0)
                {
                    //if the oppent has a piece there ATTACK
                    	$scoutresults = array();
                        $scoutresults = valid_scout($pselect, $move);
						$differenceofspots = $scoutresults['distance'];
                        $direction = $scoutresults['direction'];
                        if($differenceofspots >  0)
                        {
                            $openspots = 1;
                            for($i = 1; $i < $differenceofspots; $i++)
                            {
                                if($direction == 4) //right
                                {
					$checklake = $pselect+$i;
					if($checklake == 56 || $checklake == 46 || $checklake == 53 || $checklake == 43){$openspots =0;}
	 
					$temp1 = $loc.($pselect + $i);
					$temp2 = $antiloc.($pselect + $i);
					$openplayer = $gijoe[$temp1];
					$openopponent = $gijoe[$temp2];
					if($openplayer != 0 || $openopponent != 0)
					{$openspots = 0;}
                                }
                                if($direction == 3) //left
                                {
					$checklake = $pselect-$i;
					if($checklake == 56 || $checklake == 46 || $checklake == 53 || $checklake == 43){$openspots =0;}
					$temp1 = $loc.($pselect - $i);
					$temp2 = $antiloc.($pselect - $i);
					$openplayer = $gijoe[$temp1];
					$openopponent = $gijoe[$temp2];
					if($openplayer != 0 || $openopponent != 0)
					{$openspots = 0;}
                                }
                                if($direction == 2)//down
                                {
					$movevalue = $i."0";
					$checklake = $pselect-$movevalue;
					if($checklake == 56 || $checklake == 46 || $checklake == 53 || $checklake == 43){$openspots =0;}
					$temp1 = $loc.($pselect - $movevalue);
					$temp2 = $antiloc.($pselect - $movevalue);
					$openplayer = $gijoe[$temp1];
					$openopponent = $gijoe[$temp2];
					if($openplayer != 0 || $openopponent != 0)
					{$openspots = 0;}
                                }
                                if($direction == 1) //up
                                {
					$movevalue = $i."0";
					$checklake = $pselect+$movevalue;
					if($checklake == 56 || $checklake == 46 || $checklake == 53 || $checklake == 43){$openspots =0;}
					$temp1 = $loc.($pselect + $movevalue);
					$temp2 = $antiloc.($pselect + $movevalue);
					$openplayer = $gijoe[$temp1];
					$openopponent = $gijoe[$temp2];
					if($openplayer != 0 || $openopponent != 0)
					{$openspots = 0;}
                                }
                            }
                            if($openspots == 1) //valid move to spot then attack location
                            {
                           	$piece1 = $gijoe[$loc.$pselect]; //attacker
                            	$piece2 = $gijoe[$antiloc.$move]; //defender
						
                            	if(attack_piece(abs($piece1),abs($piece2)) == 2) // if attacker wins
                            	{
					$startingspot = $loc.$pselect; //start spot
	                                $finishingspot = $loc.$move; //finishing spot
	                                $revealedpiece = "-".abs($gijoe[$startingspot]); // reveal the piece 
	                                $opponentsspot = $antiloc.$move; // losers spot
	                                $Attackname = number_to_name(abs($piece1)); // name of attackers piece
	                                $Defendname = number_to_name(abs($piece2)); // name of defenders piece
	                                
					$text = $attackersusername ."\'s " . $Attackname . " (".abs($piece1).") killed " . $defendersusername . "\'s " . $Defendname." (".abs($piece2).")";
                                
					$piecelost = "p".$loc.abs($piece2); //piece captured
	                               	$newmovelist = move_list($pselect,$move,$gijoe['listofmoves'],$gijoe['posa'],$attackersusername,$defendersusername);
					$db->query("UPDATE st_game SET listofmoves = '$newmovelist', $piecelost = $piecelost +1,$startingspot = 0, $finishingspot = $revealedpiece, $opponentsspot = 0, lastmove = $move, battletxt = '$text' WHERE st_room=$roomid");
	                                toggle_turn($roomid);
								
				}
				else if(attack_piece(abs($piece1), abs($piece2)) == 1) // if tie ... need to look up what happens if tie
                            	{
					$startingspot = $loc.$pselect;
	                                $finishingspot = $antiloc.$move;
	                                $piecesname = number_to_name(abs($piece1));  // name of the two pieces
	                                $text = "Both " .$piecesname."\'s (".abs($piece1).") were killed";
	                                $piecelost = "p".$loc.abs($piece2); // piece captured
	                                $piecelost2 = "p".$antiloc.abs($piece1); //piece lost
	                                $newmovelist = move_list($pselect,$move,$gijoe['listofmoves'],$gijoe['posa'],$attackersusername,$defendersusername);
	                                $db->query("UPDATE st_game SET listofmoves = '$newmovelist', $piecelost = $piecelost +1,$piecelost2 = $piecelost2 +1,$startingspot = 0, $finishingspot = 0, lastmove = $move, battletxt = '$text' WHERE st_room=$roomid");
	                                toggle_turn($roomid);
				}
				else if(attack_piece(abs($piece1),abs($piece2)) == 3) //captured flag award win
                            	{
					$winningpiece = number_to_name(abs($piece1));  // name of the two pieces
                                	$text = $attackersusername ."\'s " . $Attackname . "captured the flag";
                                
					$newmovelist = move_list($pselect,$move,$gijoe['listofmoves'],$gijoe['posa'],$attackersusername,$defendersusername);
                                	$db->query("UPDATE st_game SET listofmoves = '$newmovelist', battletxt = '$text' WHERE st_room=$roomid");
                                	award_win($roomid, $userid);
				}
				else
				{
					$Attackname = number_to_name(abs($piece1)); // name of attackers piece
	                                $Defendname = number_to_name(abs($piece2)); // name of defenders piece
	                                
					$text = $attackersusername ."\'s " . $Attackname . " (".abs($piece1).") lost to " . $defendersusername . "\'s " . $Defendname." (".abs($piece2).")";
                                
	                                $startingspot = $loc.$pselect;
	                                $finishingspot = $antiloc.$move;
	                                $revealedpiece = "-".abs($gijoe[$finishingspot]);
				    
	                                $piecelost = "p".$antiloc.abs($piece1);
	                            	$newmovelist = move_list($pselect,$move,$gijoe['listofmoves'],$gijoe['posa'],$attackersusername,$defendersusername);
	                                $db->query("UPDATE st_game SET listofmoves = '$newmovelist', $piecelost = $piecelost +1,$startingspot = 0, $finishingspot = $revealedpiece, lastmove = $move, battletxt = '$text' WHERE st_room=$roomid");
	                                toggle_turn($roomid);	
				}
                            }
                        }                 
                }
                else
                {
                    if($gijoe[$loc.$move] == 0)
                    {
                      	$scoutresults = array();
                        $scoutresults = valid_scout($pselect, $move);
			$differenceofspots = $scoutresults['distance'];
                        $direction = $scoutresults['direction'];
                        if($differenceofspots >  0)
                        {
                            $openspots = 1;
                            for($i = 1; $i < $differenceofspots; $i++)
                            {
                                if($direction == 4) //right
                                {
					$checklake = $pselect+$i;
					if($checklake == 56 || $checklake == 46 || $checklake == 53 || $checklake == 43){$openspots =0;}
					$temp1 = $loc.($pselect + $i);
					$temp2 = $antiloc.($pselect + $i);
					$openplayer = $gijoe[$temp1];
					$openopponent = $gijoe[$temp2];
					if($openplayer != 0 || $openopponent != 0)
					{$openspots = 0;}
                                }
                                if($direction == 3) //left
                                {
					$checklake = $pselect-$i;
					if($checklake == 56 || $checklake == 46 || $checklake == 53 || $checklake == 43){$openspots =0;}
	
					$temp1 = $loc.($pselect - $i);
					$temp2 = $antiloc.($pselect - $i);
					$openplayer = $gijoe[$temp1];
					$openopponent = $gijoe[$temp2];
					if($openplayer != 0 || $openopponent != 0)
					{$openspots = 0;}
                                }
                                if($direction == 2)//down
                                {
					$movevalue = $i."0";

					$checklake = $pselect-$movevalue;
					if($checklake == 56 || $checklake == 46 || $checklake == 53 || $checklake == 43){$openspots =0;}
	
					$temp1 = $loc.($pselect - $movevalue);
					$temp2 = $antiloc.($pselect - $movevalue);
					$openplayer = $gijoe[$temp1];
					$openopponent = $gijoe[$temp2];
					if($openplayer != 0 || $openopponent != 0)
					{$openspots = 0;}
                                }
                                if($direction == 1) //up
                                {
					$movevalue = $i."0";
					$checklake = $pselect-$movevalue;
					if($checklake == 56 || $checklake == 46 || $checklake == 53 || $checklake == 43){$openspots =0;}
					$temp1 = $loc.($pselect + $movevalue);
					$temp2 = $antiloc.($pselect + $movevalue);
					$openplayer = $gijoe[$temp1];
					$openopponent = $gijoe[$temp2];
					if($openplayer != 0 || $openopponent != 0)
					{$openspots = 0;}
                                }
                            }
                            if($openspots == 1)
                            {
				$startingspot = $loc.$pselect;
				$finishingspot = $loc.$move;
				$piecetomove = $gijoe[$startingspot];
				$text = "";
				$newmovelist = move_list($pselect,$move,$gijoe['listofmoves'],$gijoe['posa'],$attackersusername,$defendersusername);
				$db->query("UPDATE st_game SET listofmoves = '$newmovelist', $startingspot = 0, $finishingspot = $piecetomove, pselected = 0, lastmove = $move, battletxt = '$text' WHERE st_room=$roomid");
				toggle_turn($roomid);
                            }
                        }
                    }
                }
	    }
	}
}
function valid_move($pselect, $move)
{
	if($pselect+10 == $move|| $pselect+1 == $move || $pselect-1 == $move || $pselect-10 == $move)
	{
	    return 1;        
	}
	return 0;
}
function valid_scout($start,$finish)
{
    $rowstart = substr($start,0,1);
    $rowfinish = substr($finish,0,1);
    
    $colstart = substr($start,1,1);
    $colfinish = substr($finish,1,1);
    
    $difference = array();
    $difference['distance'] = 0;
    $difference['direction'] = 0;

    if($rowstart == $rowfinish)
    {
        $difference['distance'] = abs($colfinish - $colstart);
        if($colfinish > $colstart)
        {$difference['direction'] = 4;} //4 right
        else{$difference['direction'] = 3;} //3 left
    }
    if($colstart == $colfinish)
    {
        $difference['distance']= abs($rowfinish - $rowstart);
        if($rowfinish > $rowstart)
        {$difference['direction'] = 1;} 	//1 up
        else{$difference['direction'] = 2;} //2 down
    }
    return $difference;
}
function create_game($roomid)
{
	global $db,$ir, $firstmovemarkfield;
	$alreadymade = $db->num_rows($db->query("SELECT st_room FROM st_game WHERE st_room = $roomid"));
	if(!$alreadymade)
	{
		$roominfo = $db->fetch_row($db->query("SELECT * FROM st_room WHERE id=$roomid"));
		$turn = rand(1,2);
		$turnuid = p_to_uid($turn, $roomid);
		$db->query("UPDATE st_room SET turn=-1,play_time=0 WHERE id=$roomid");
		$db->query("INSERT INTO st_game (st_room, {$firstmovemarkfield}, p1, p2) VALUES ($roomid, $turnuid, {$roominfo['p1']}, {$roominfo['p2']})");
	}
}

function toggle_turn($roomid)
{
	global $db,$ir;
	$ui=$db->fetch_row($db->query("SELECT p1,p2,turn FROM st_room WHERE id = $roomid"));
	if($ui['turn']==$ui['p1'])
	{
		$db->query("UPDATE st_room SET notifyturn=0,play_time=unix_timestamp(),turn={$ui['p2']} WHERE id=$roomid");
	}
	else
	{
		$db->query("UPDATE st_room SET notifyturn=0,play_time=unix_timestamp(),turn={$ui['p1']} WHERE id=$roomid");
	}
	$db->query("UPDATE st_game SET pselected = 0, posa=posa+1 WHERE st_room=$roomid");
}

function player_ready($begin, $userid, $roomid)
{
    global $db,$ir;

    $readyb = $db->query("SELECT * FROM st_game WHERE st_room=$roomid");
    $ready = $db->fetch_row($readyb);
    $red = $ready['red'];
    if($red == $ready['p1']){$blue = $ready['p2'];}
    else{$blue = $ready['p1'];}
    
    if($userid == $red){
        if($ready['pa1'] == 0 && $ready['pa2'] == 0 && $ready['pa3'] == 0 && $ready['pa4'] == 0 && $ready['pa5'] == 0 && $ready['pa6'] == 0 && $ready['pa7'] == 0 && $ready['pa8'] == 0 && $ready['pa9'] == 0 && $ready['pa10'] == 0)
        {
            $db->query("UPDATE st_game SET p1ready=1 WHERE st_room=$roomid");

            if($ready['p2ready'] == 1)
            {
                $db->query("UPDATE st_game SET mode = 1, posa = 0 WHERE st_room=$roomid");
				$db->query("UPDATE st_room SET turn = $blue WHERE id=$roomid");
            }
        }
    }
    else{
         if($ready['pb1'] == 0 && $ready['pb2'] == 0 && $ready['pb3'] == 0 && $ready['pb4'] == 0 && $ready['pb5'] == 0 && $ready['pb6'] == 0 && $ready['pb7'] == 0 && $ready['pb8'] == 0 && $ready['pb9'] == 0 && $ready['pb10'] == 0)
        {
            $db->query("UPDATE st_game SET p2ready=1 WHERE st_room=$roomid");
            if($ready['p1ready'] == 1)
            {
                $db->query("UPDATE st_game SET mode=1, posa = 0 WHERE st_room=$roomid");
				$db->query("UPDATE st_room SET turn = $red WHERE id=$roomid");
            }
        }
    }
}
function place_piece($setup, $userid, $roomid)
{
    global $db,$ir;

    $setb = $db->query("SELECT * FROM st_game WHERE st_room=$roomid");
    $set = $db->fetch_row($setb);
    $red = $set['red'];
    if($red == $set['p1']){$blue = $set['p2'];}else{$blue = $set['p1'];}
    
	if($setup >0 && $setup <= 10)
    {
        if($userid == $red)
        {$db->query("UPDATE st_game SET posa =$setup WHERE st_room=$roomid");}
        else
        {$db->query("UPDATE st_game SET posb =$setup WHERE st_room=$roomid");}
    }
    if($userid == $red)
    {
		if($set['p1ready'] == 1){die();}
	//	if($set['p2ready'] == 1 && $set['p2']==$userid){die();}
        if($setup >= 61  && $setup <=88)
        {
            if($set["a".$setup] != 0)
            {
                $temp = $set["a".$setup];
                $temp2 = "pa".$temp;
				$temp3 = "a".$setup;
                $db->query("UPDATE st_game SET $temp3 = 0, $temp2 = $temp2 + 1 WHERE st_room=$roomid");
            }
            else{
                $temp = "a".$setup;
                $temp2 = $set['posa'];
                $temp3 = "pa".$temp2;
                if($set[$temp3] !=0 ){
                $db->query("UPDATE st_game SET $temp = $temp2, $temp3 = $temp3 -1 WHERE st_room=$roomid");
                }
            }
        }
    }
    else
    {
		if($set['p2ready'] == 1){die();}
		//if($set['p2ready'] == 1 && $set['p2']==$userid){die();}
        if($setup > 10  && $setup <= 38)
        {
		
            if($set["b".$setup] != 0)
            {
                $temp = $set["b".$setup];
                $temp2 = "pb".$temp;
				$temp3 = "b".$setup;
				$db->query("UPDATE st_game SET $temp3 = 0, $temp2 = $temp2 + 1 WHERE st_room=$roomid");
            }
            else{
                $temp = "b".$setup;
                $temp2 = $set['posb'];
                $temp3 = "pb".$temp2;
                if($set[$temp3] >0 )
				{
                    $db->query("UPDATE st_game SET $temp = $temp2, $temp3 = $temp3 -1 WHERE st_room=$roomid");
                }
            }
        }
    }
}
function attack_piece($attackpiece, $defendingpiece)
{
    if($defendingpiece == 9 && $attackpiece != 6)
    {return 0;}
    if($defendingpiece == 9 && $attackpiece == 6)
    {return 2;}
    if($defendingpiece == 10)
    {return 3;}
    if($attackpiece == $defendingpiece)
    {return 1;}
    if($attackpiece == 8 && $defendingpiece == 1)
    {return 2;}
    if($attackpiece > $defendingpiece)
    {return 0;}
    if($attackpiece < $defendingpiece)
    {return 2;}
}
function number_to_name($piecevalue)
{
    switch($piecevalue)
    {
        case 1:
            $name = "general";
            break;
        case 2:
            $name = "colonel";
            break;
        case 3:
            $name = "major";
            break;
        case 4:
            $name = "captain";
            break;
        case 5:
            $name = "lieutenant";
            break;
        case 6:
            $name = "engineer";
            break;
        case 7:
            $name = "scout";
            break;
        case 8:
            $name = "spy";
            break;
        case 9:
            $name = "bomb";
            break;
        case 10:
            $name = "flag";
            break;
    }
    return $name;
}
function move_list($start,$finish,$listofmoves,$numofturns,$first,$second)
{	
	$rowstartletter = num_to_letter(substr($start,0,1));
	$rowfinishletter = num_to_letter(substr($finish,0,1));
	$colstartnum = substr($start,1,1);
	$colfinishnum = substr($finish,1,1);
	if($numofturns%2 ==0)
	{
		if($start == 0 && $finish == 0)
		{
			$turn = ($numofturns / 2) + 1;
			$listofmoves .= "{$turn}. no move |";
		}
		else
		{
			$turn = ($numofturns / 2) + 1;
			if($turn ==1)
			{
				$player1 = substr($first,0,11);
				$player2 = substr($second,0,11);
				$listofmoves = "{$player1}";
				$length = strlen($player1);
				for($i = $length; $i <= 10; $i++)
				{
					$listofmoves .= "&nbsp;";
				}
				$listofmoves .= "| {$player2}<br />";
			}
			$listofmoves .= "{$turn}. {$rowstartletter}{$colstartnum} x {$rowfinishletter}{$colfinishnum} |";
		}
	}
	else
	{
		if($start == 0 && $finish == 0)
		{
			$listofmoves .= " no move<br/>";
		}
		else
		{
			//&nbsp;
			$listofmoves .= " {$rowstartletter}{$colstartnum} x {$rowfinishletter}{$colfinishnum}<br />";
		}
	}
	return $listofmoves;
}
function num_to_letter($num)
{
	switch($num)
	{
		case 1:
			$letter = "a";
			break;
		case 2:
			$letter = "b";
			break;
		case 3:
			$letter = "c";
			break;
		case 4:
			$letter = "d";
			break;
		case 5:
			$letter = "e";
			break;
		case 6:
			$letter = "f";
			break;
		case 7:
			$letter = "g";
			break;
		case 8:
			$letter = "h";
			break;
	}	
	return $letter;
}
function reverse_movelist($movelist)
{
	$movelistt = explode("<br />", $movelist);
	$beginml = $movelistt[0];
	unset($movelistt[0]);
	$mlarr = array_reverse($movelistt);
	$sizeml = count($mlarr);
	$i = 0;
	$finalmltxt = $beginml."<br />";
	while($i < $sizeml)
	{
		$finalmltxt .= $mlarr[$i]."<br />";
		$i++;
	}
	return $finalmltxt;
}
?>