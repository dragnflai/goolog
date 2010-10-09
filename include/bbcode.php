<?php

function bbcode($text)
{
	//the pattern to be matched
	$pattern[] = '#\[b\](.*?)\[/b\]#i';
	$pattern[] = '#\[i\](.*?)\[/i\]#i';
	$pattern[] = '#\[u\](.*?)\[/u\]#i';
	$pattern[] = '#\[s\](.*?)\[/s\]#i';
	$pattern[] = '#\[img\](.*?)\[/img\]#i';
	$pattern[] = '#\[url\](.*?)\[/url\]#i';
	$pattern[] = '#\[youtube\]http://www.youtube.com/watch\?v=(.*?)\[/youtube\]#i';
	//the replacement
	$replace[] = '<b>$1</b>';
	$replace[] = '<i>$1</i>';
	$replace[] = '<u>$1</u>';
	$replace[] = '<del>$1</del>';
	$replace[] = '<img src = "$1"/>';
	$replace[] = '<a href ="$1">$1</a>';
	$replace[] = '<iframe width="480" height="390" src="http://www.youtube.com/embed/$1" frameborder="0"></iframe>';
	//the variable for the replace
	return preg_replace($pattern, $replace, $text);
}
?>
