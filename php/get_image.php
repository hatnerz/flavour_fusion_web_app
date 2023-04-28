<?php

function output_img($hosts, $hits, $total)
{
	$img = imagecreatefrompng('../media/bg.png');
	$color = ImageColorAllocate ($img, 255, 255, 255);
	Imagestring($img, 7, 10, 10, 'hosts: '.$hosts, $color);
	Imagestring($img, 7, 10, 25, 'hits:  '.$hits, $color);
	Imagestring($img, 7, 10, 40, 'total: '.$total, $color);
	header ("Content-type: image/png");
	ImagePng ($img);
}
