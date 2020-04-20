<?php

function spinWheel($user)
{
	global $db;
	srand(time());
	$random = rand(1,38);
	//37 = 0
	//38 = 00
	$winnum = $random;
	if($random == 37)
		$winnum = 0;
	if($random == 38)//37 will show up as double zero
		$winnum = 37;
	$wincolor = winColor($winnum);
	$wincolumn = winColumn($winnum);
	$winrow = winRow($winnum);
	$winevenodd = winEvenOdd($winnum);
	$winrange = winRange($winnum);
	$db->query("UPDATE roulette SET winnum=$winnum, wincolor=$wincolor, wincolumn=$wincolumn, winrow=$winrow, winEvenOdd=$winevenodd, winRange=$winrange WHERE userid=$user");
}

function cashIn($user)
{
	global $db;
	$wincash = 0;
	$didjawi=$db->query("SELECT * FROM roulette WHERE userid=$user");
	$didjawin = $db->fetch_row($didjawi);
	if($didjawin['betNum']!=-1)
	{
		if($didjawin['betNum']==$didjawin['winnum'])
			$wincash = $didjawin['betAmount'] * 36;
	}
	else if($didjawin['betColumnNum']!=-1)
	{
		if($didjawin['betColumnNum']==$didjawin['wincolumn'])
			$wincash = $didjawin['betAmount'] * 3;

	}
	else if($didjawin['betRowNum']!=-1)
	{
		if($didjawin['betRowNum']==$didjawin['winrow'])
			$wincash = $didjawin['betAmount'] * 3;
	}
	else if($didjawin['betRangeNum']!=-1)
	{
		if($didjawin['betRangeNum']==$didjawin['winRange'])
			$wincash = $didjawin['betAmount'] * 2;
	}
	else if($didjawin['betEvenOddNum']!=-1)
	{
		if($didjawin['betEvenOddNum']==$didjawin['winEvenOdd'])
			$wincash = $didjawin['betAmount'] * 2;
	}
	else if($didjawin['betColorNum']!=-1)
	{
		if($didjawin['betColorNum']==$didjawin['wincolor'])
		{
			$wincash = $didjawin['betAmount'] * 2;
		}
	}
	return $wincash;
}

function winColor($winnum)
{
	if($winnum == 1 || $winnum == 3 || $winnum == 5 || $winnum == 7 || $winnum == 9 || $winnum == 12 || $winnum == 14 || $winnum == 16 || $winnum == 18 || $winnum == 19 || $winnum == 21 || $winnum == 23 || $winnum == 25 || $winnum == 27 || $winnum == 30 || $winnum == 32 || $winnum == 34 || $winnum == 36)
	{
		return 1;   //red
	}
	else if($winnum == 2 || $winnum == 4 || $winnum == 6 || $winnum == 8 || $winnum == 10 || $winnum == 11 || $winnum == 13 || $winnum == 15 || $winnum == 17 || $winnum == 20 || $winnum == 22 || $winnum == 24 || $winnum == 26 || $winnum == 28 || $winnum == 29 || $winnum == 31 || $winnum == 33 || $winnum == 35)
	{
		return 2;	//black
	}
	else if($winnum == 0 || $winnum == 37)
	{
		//-1 is 00 on board
		return 3;	//green
	}
}
function winEvenOdd($winnum)
{
	if($winnum==0 || $winnum==37)
		return 3;
	else if($winnum%2==0)
		return 1;
	else
		return 2;
}
function winRange($winnum)
{
	if($winnum==0 || $winnum==37)
		return 3;
	else if($winnum>=1 && $winnum <=18)
		return 1;
	else
		return 2;
}


function winColumn($winnum)
{
	if($winnum == 0 || $winnum == 37)
	{
		return 0;//0 or 00, lost
	}
	else if((($winnum+2)%3)==0)
	{
		print"poo-{$winnum}-1";
		return 1;//left
	}
	else if((($winnum+1)%3)==0)
	{
		print"poo-{$winnum}-2";
		return 2;//middle
	}
	else if(($winnum%3)==0)
	{
		print"poo-{$winnum}-3";
		return 3;//right
	}
}

function winRow($winnum)
{
	if($winnum == 0 || $winnum == 37)
	{
		return 0;//0 or 00, lost
	}
	else if($winnum >= 1 && $winnum <= 12)
	{
		return 1;//top
	}
	else if($winnum >= 13 && $winnum <= 24)
	{
		return 2;//middle
	}
	else if($winnum >= 25 && $winnum <= 36)
	{
		return 3;//bottom
	}
}
function betToText($user)
{
	global $db;
	$wincash = 0;
	$didjawi=$db->query("SELECT * FROM roulette WHERE userid=$user");
	$didjawin = $db->fetch_row($didjawi);
	if($didjawin['betNum']!=-1)
	{
		if($didjawin['betNum']==37)
			$didjawin['betNum']='00';
		if($didjawin['winnum']==37)
			$didjawin['winnum']='00';
		return "You bet $".number_format($didjawin['betAmount'])." on the number {$didjawin['betNum']}. The winning number was {$didjawin['winnum']}.";
	}
	else if($didjawin['betColumnNum']!=-1)
	{
		if($didjawin['betColumnNum']==1)
			$bcol='1st Column';
		else if($didjawin['betColumnNum']==2)
			$bcol='2nd Column';
		else if($didjawin['betColumnNum']==3)
			$bcol='3rd Column';
		else
			$bcol='00 or 0';

		if($didjawin['wincolumn']==1)
			$wcol='1st Column';
		else if($didjawin['wincolumn']==2)
			$wcol='2nd Column';
		else if($didjawin['wincolumn']==3)
			$wcol='3rd Column';
		else
			$wcol='00 or 0';

		return "You bet $".number_format($didjawin['betAmount'])." on the $bcol. The winning column was the $wcol.";
	}
	else if($didjawin['betRowNum']!=-1)
	{
		if($didjawin['betRowNum']==1)
			$bcol='1st Row';
		else if($didjawin['betRowNum']==2)
			$bcol='2nd Row';
		else if($didjawin['betRowNum']==3)
			$bcol='3rd Row';
		else
			$bcol='00 or 0';

		if($didjawin['winrow']==1)
			$wcol='1st Row';
		else if($didjawin['winrow']==2)
			$wcol='2nd Row';
		else if($didjawin['winrow']==3)
			$wcol='3rd Row';
		else
			$wcol='00 or 0';

		return "You bet $".number_format($didjawin['betAmount'])." on the $bcol. The winning row was the $wcol.";
	}
	else if($didjawin['betRangeNum']!=-1)
	{
		if($didjawin['betRangeNum']==1)
			$bcol='1-18';
		else if($didjawin['betRangeNum']==2)
			$bcol='19-36';

		if($didjawin['winRange']==1)
			$wcol='1-18';
		else if($didjawin['winRange']==2)
			$wcol='19-36';
		else
			$wcol='0 or 00';

		return "You bet $".number_format($didjawin['betAmount'])." on the range $bcol. The winning range was $wcol.";
	}
	else if($didjawin['betEvenOddNum']!=-1)
	{
		if($didjawin['betEvenOddNum']==1)
			$bcol='Even';
		else if($didjawin['betEvenOddNum']==2)
			$bcol='Odd';

		if($didjawin['winEvenOdd']==1)
			$wcol='Even';
		else if($didjawin['winEvenOdd']==2)
			$wcol='Odd';
		else
			$wcol='0 or 00';

		return "You bet $".number_format($didjawin['betAmount'])." on an $bcol number. The winning number was an $wcol number.";
	}
	else if($didjawin['betColorNum']!=-1)
	{
		if($didjawin['betColorNum']==1)
			$bcolor='Red';
		else if($didjawin['betColorNum']==2)
			$bcolor='Black';

		if($didjawin['wincolor']==1)
			$wcolor='Red';
		else if($didjawin['wincolor']==2)
			$wcolor='Black';
		else
			$wcolor='Green';

		return "You bet $".number_format($didjawin['betAmount'])." on the color $bcolor. The winning color was $wcolor.";
	}
	return $wincash;
}
function numbersDropDown($selectednum)//parameter is a string
{
	$ret="<select name='beton' type='dropdown'>";
	$ret.="\n<option value='37'";
	if ($selectednum == "37") { $ret.=" selected='selected'";} 
	$ret.=">00</option>";
	for($i = 0; $i<37; $i++)
	{
		$ret.="\n<option value='$i'";
		if ($selectednum == "$i") { $ret.=" selected='selected'";} 
		$ret.=">$i</option>";
	}
	$ret.="\n</select>";
	return $ret;
}
?>