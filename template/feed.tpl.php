<feed xmlns = "http://www.w3.org/2005/Atom">
<id><?php echo $data['url'];?>feed.php</id>
<title><?php echo $data['subtitle'];?> - <?php echo $data['title'];?></title>
<updated><?php echo strftime('%Y-%m-%dT%H:%M:%S%z');?></updated>
<link href = "<?php echo $data['url'];?>feed.php" rel = "self"/>
<author><name><?php echo $lang['powered_by'];?> Goolog</name></author>
<?php echo $data['content'];?>
</feed>
