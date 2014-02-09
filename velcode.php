<?php
header("content-type:image/png");
$num="1234";
$numimage=imagecreate(60,18);   //创建画布
imagecolorallocate($numimage,240,240,240);
for($i=0;$i<strlen($num);$i++){
	$x=mt_rand(1,8)+$imagewidth*$i/4;
	$y=mt_rand(1,$imageheight/4);
	$color=imagecolorallocate($numimage,rand(200,250),rand(200,255));//定义图像颜色
	imagestring($numimage,5,$x,$y,$num[$i],$color);
}
for($i=0;$i<200;$i++){
	$randcolor=imagecolorallocate($numimage,rand(200,255),rand(200,255),rand(200,255));
	imagesetpixe($numimage,rand()%70,rand()%20,$randcolor);
}
imagepng($numimage);
imagedestroy($numimage);
?>