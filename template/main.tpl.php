<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html;charset=UTF-8"/>
<meta name="description" content="<?php echo $data['meta'];?>"/>
<title><?php echo $data['meta'];?> - <?php echo $data['head'];?></title>
<link rel="stylesheet" type="text/css" href="theme/<?php echo $data['theme']?>.css"/>
<link rel="alternate" type="application/atom+xml" href="feed.php"/>
</head>
<body>
<h2><?php echo $data['head'];?></h2>
<h5><a href="index.php?post"><?php echo $lang['post'];?></a> | <a href="index.php?comment"><?php echo $lang['comment'];?></a> | <a href="index.php?more"><?php echo $lang['more'];?></a> | <?php echo isset($_SESSION['admin'])? '<a href="config.php">'.$lang['config'].'</a> | <a href="auth.php?logout">'.$lang['logout'].'</a>' : '<a href="auth.php?login">'.$lang['login'].'</a>';?></h5>
<?php echo $data['body'];?>
<h4><?php echo $lang['powered_by']?> <a href="http://github.com/goolog/">Goolog</a> | <a href="feed.php"><?php echo $lang['feed']?></a></h4>
</body>
</html>
