<?php

$counter = 0;
if(!defined('UNKNOWN_BEHAVIOR'))
{
	define('UNKNOWN_BEHAVIOR', 'CON-'.$counter);
	$counter++;
}

if(!defined('ERR_SQL'))
{
	define('ERR_SQL', 'CON-'.$counter);
	$counter++;
}

if(!defined('ERR_NO_FIELDS'))
{
	define('ERR_NO_FIELDS', 'CON-'.$counter);
	$counter++;
}

if(!defined('ERR_BATCH_SPOILED'))
{
	define('ERR_BATCH_SPOILED', 'hferughwu9o');
	$counter++;
}

if(!defined('ERR_BATCH_NOT_FOUND'))
{
	define('ERR_BATCH_NOT_FOUND', 'CON-'.$counter);
	$counter++;
}

if(!defined('ERR_INVALID_QUANTITY'))
{
	define('ERR_INVALID_QUANTITY', 'CON-'.$counter);
	$counter++;
}

if(!defined('ERR_BARCODE_NOT_FOUND'))
{
	define('ERR_BARCODE_NOT_FOUND', 'CON-'.$counter);
	$counter++;
}

if(!defined('ERR_SUPPLIER_ID_NOT_FOUND'))
{
	define('ERR_SUPPLIER_ID_NOT_FOUND', 'CON-'.$counter);
	$counter++;
}

if(!defined('ERR_SUPPLIER_NOT_FOUND'))
{
	define('ERR_SUPPLIER_NOT_FOUND', 'CON-'.$counter);
	$counter++;
}

if(!defined('ERR_PRODUCT_NOT_FOUND'))
{
	define('ERR_PRODUCT_NOT_FOUND', 'CON-'.$counter);
	$counter++;
}

if(!defined('WAR_LOW_QUANTITY'))
{
	define('WAR_LOW_QUANTITY', 'CON-'.$counter);
	$counter++;
}

if(!defined('WAR_NEAR_LOW_QUANTITY'))
{
	define('WAR_NEAR_LOW_QUANTITY', 'CON-'.$counter);
	$counter++;
}

if(!defined('WAR_NEAR_SPOIL_DATE'))
{
	define('WAR_NEAR_SPOIL_DATE', 'CON-'.$counter);
	$counter++;
}
