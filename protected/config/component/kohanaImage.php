<?php
/**
 * components customer
 */
//	kohana image package (change image format)
$props['components']['image']['class']='CImageComponent';
// GD or ImageMagick
$props['components']['image']['driver']='GD';
// ImageMagick setup path
$props['components']['image']['params']=array(
		'directory'=>'');


/**
 * preload default will call CApplicationComponent.init()
 */
