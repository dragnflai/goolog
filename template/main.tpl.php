<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns = "http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv = "content-type" content = "text/html;charset = UTF-8"/>
<meta name = "description" content = "<?php echo $data['meta'];?>"/>
<title><?php echo $data['meta'];?> - <?php echo $data['head'];?></title>
<link rel = "stylesheet" type = "text/css" href = "theme/<?php echo $data['theme'];?>.css"/>
<link rel = "alternate" type = "application/atom+xml" href = "feed.php?post" title = "<?php echo $lang['post'];?>"/>
<link rel = "alternate" type = "application/atom+xml" href = "feed.php?comment" title = "<?php echo $lang['comment'];?>"/>
</head>
<body>
<div id = "container">
<div id = "header"><h2><?php echo $data['head'];?></h2></div>
<div id = "menu"><ul>
<li><a href = "index.php?post"><?php echo $lang['post'];?></a></li>
<li><a href = "index.php?comment"><?php echo $lang['comment'];?></a></li>
<li><a href = "index.php?more"><?php echo $lang['more'];?></a></li>
<?php echo isset($_SESSION['admin'])?
'<li><a href = "config.php">' .$lang['config']. '</a></li>
<li><a href = "auth.php?logout">' .$lang['logout']. '</a></li>' : 
'<li><a href = "auth.php?login">' .$lang['login']. '</a></li>';?>
</ul></div>
<div id = "main">
<?php echo $data['body'];?>
</div>
<div id = "footer"><ul>
<li><?php echo $lang['powered_by'];?> <a href = "http://github.com/goolog/">Goolog</a></li>
<li><a href = "feed.php?post"><?php echo $lang['feed'];?></a></li>
</ul></div>
</div>
</body>
</html>
