<?php
/**
 * components customer
 */
//	language switcher
//	config public var flag name
$props['components']['LangSwitcherAC']['flagname']='lang';
//	enable LangSwitcherAC
$props['components']['LangSwitcherAC']['class']='LangSwitcherAC';

/**
 * preload default will call CApplicationComponent.init()
 */
$props['preload']['LangSwitcherAC']=true;
