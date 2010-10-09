<feed xmlns = "http://www.w3.org/2005/Atom">
<id><?php echo $data['url'];?>feed.php</id>
<title><?php echo $data['meta'];?> - <?php echo $data['head'];?></title>
<updated><?php echo $data['head'];?></updated>
<link href = "<?php echo $data['url'];?>feed.php" rel = "self"/>
<author><name><?php echo $lang['powered_by'];?>' Goolog</name></author>
<?php echo $data['body'];?>
</feed>

