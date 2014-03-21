<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Easy_gzip_alternatives Class
 *
 * @package			ExpressionEngine
 * @category		Plugin
 * @author			Aaron Gustafson
 * @copyright		Copyright (c) Easy! Designs, LLC
 * @link			http://www.easy-designs.net/
 */

$plugin_info = array(
	'pi_name'			=> 'Easy GZip Alternatives',
	'pi_version'		=> '1.0',
	'pi_author'			=> 'Aaron Gustafson',
	'pi_author_url'		=> 'http://easy-designs.net/',
	'pi_description'	=> 'Chooses between two alternates based on GZip support',
	'pi_usage'			=> Easy_gzip_alternatives::usage()
);

class Easy_gzip_alternatives {

	var $cache;
	var $return_data = '';
	
	/**
	 * Easy_gzip_alternatives constructor
	 * triggers the processing
	 * 
	 * @param str $normal - the normal string
	 * @param str $gzip - the gzip string
	 */
	function __construct( $normal='', $gzip='' )
	{
		# make sure we have our own segment
		if ( ! isset( ee()->session->cache[__CLASS__] ) ) ee()->session->cache[__CLASS__] = array();
		
		$this->cache =& ee()->session->cache[__CLASS__];

		$has_gzip = NULL;
		
		if ( isset( $this->cache['has_gzip'] ) )
		{
			$has_gzip = $this->cache['has_gzip'];
		}
		else
		{
			$headers = getallheaders();
			$has_gzip = ( strpos( $headers['Accept-Encoding'], 'gzip' ) !== FALSE );
			$this->cache['has_gzip'] = $has_gzip;
		}
		
		$normal = ee()->TMPL->fetch_param( 'normal', $normal );
		$gzip = ee()->TMPL->fetch_param( 'gzip', $gzip );
		
		$this->return_data = $has_gzip ? $gzip : $normal;
		
		# just exit
		return $this->return_data;
		
	} # end Easy_gzip_alternatives constructor
	
	/**
	 * Easy_gzip_alternatives::usage()
	 * Describes how the plugin is used
	 */
	function usage()
	{
		ob_start(); ?>
This plugin allows you to supply alternate paths for gzip enabled and non-gzip capable devices.

Here&#8217;s an example:

	<link rel="stylesheet" href="main.{exp:easy_gzip_alternatives normal='css' gzip='gz.css'}"/>

With gzip support, you’d get

	<link rel="stylesheet" href="main.gz.css"/>

Without gzip support, you’d get

	<link rel="stylesheet" href="main.css"/>
<?php
		$buffer = ob_get_contents();
		ob_end_clean();
		return $buffer;
	} # end Easy_gzip_alternatives::usage()
	
} # end Easy_gzip_alternatives

/* End of file pi.easy_gzip_alternatives.php */ 
/* Location: ./system/expressionengine/third_party/easy_gzip_alternatives/pi.easy_gzip_alternatives.php */