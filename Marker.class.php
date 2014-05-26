<?php
/******************************************************************
 * 
 * Projectname:   PHP Marker Replacement Class 
 * Version:       1.0
 * Author:        Radovan Janjic <rade@it-radionica.com>
 * Last modified: 13 12 2013
 * Copyright (C): 2013 IT-radionica.com, All Rights Reserved
 * 
 * GNU General Public License (Version 2, June 1991)
 *
 * This program is free software; you can redistribute
 * it and/or modify it under the terms of the GNU
 * General Public License as published by the Free
 * Software Foundation; either version 2 of the License,
 * or (at your option) any later version.
 *
 * This program is distributed in the hope that it will
 * be useful, but WITHOUT ANY WARRANTY; without even the
 * implied warranty of MERCHANTABILITY or FITNESS FOR A
 * PARTICULAR PURPOSE. See the GNU General Public License
 * for more details.
 * 
 ******************************************************************/

class Marker {
	
	/** Marker left-delimiter
	 * @var string
	 */
	public static $leftDelimiter = '<!--';
	
	/** Marker right-delimiter
	 * @var string
	 */
	public static $rightDelimiter = '-->';
	
	/** Marker regex
	 * @var string
	 */
	private static $REXEG = '/%l[\s]*%m[\s]*%r([\s\S]*?)%l[\s]*\/[\s]*%m[\s]*%r|%l[\s]*%m[\s]*\/[\s]*%r/i';
	
	/** Replace marker
	 * @param	string	$content	- content
	 * @param	mixed	$marker		- marker name
	 * @param	mixed	$replace	- replace marker with content
	 * @param	integer	$limit		- maximum possible replacements (-1 - no limit)
	 * @param	integer	$count		- this variable will be filled with the number of replacements
	 * @return	string	- new content
	 */
	static function replace($content, $marker, $replace, $limit = -1, &$count) {
		$marker = (array) $marker;
		$replace = (array) $replace;
		$regex = array();
		foreach ($marker as $m) {
			$regex[] = str_replace(
				array('%l', '%r', '%m'),
				array(
					preg_quote(Marker::$leftDelimiter),
					preg_quote(Marker::$rightDelimiter),
					preg_quote($m)
				),
				Marker::$REXEG
			);
		}
		return preg_replace($regex, $replace, $content, $limit, $count);
	}
	
	/** Cleanup markers
	 * @param	string	$content	- content
	 * @param	string	$replace	- replace markers with content
	 * @return	string	- new content
	 */
	static function cleanup($content, $replace = NULL) {
		$regex = str_replace(
			array('%l', '%r', '%m'),
			array(
				preg_quote(Marker::$leftDelimiter),
				preg_quote(Marker::$rightDelimiter),
				'([a-z_-]*?)'
			),
			Marker::$REXEG
		);
		return preg_replace($regex, $replace, $content);
	}
}