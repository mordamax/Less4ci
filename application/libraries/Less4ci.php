<?php

/**
 * [Less](http://lesscss.org/) The dynamic stylesheet language.
 * LESS extends CSS with dynamic behavior such as variables, mixins,
 * operations and functions. LESS runs on both the client-side (Chrome, Safari, Firefox)
 * and server-side, with Node.js and Rhino.
 *
 * @see        http://lesscss.org/
 * @version    0.1.0
 * @author     mordamax@gmail.com
 * @copyright  (c) 2013 Maksym Hlukhovtsov
 * @license    http://ellislab.com/codeigniter/user-guide/license.html
 */

class Less4ci {

	public static function compile($file = FALSE)
	{
		$ci =& get_instance();
		$ci->config->load('less4ci');
		$doc_root = realpath(APPPATH . '../');
		if ( ! $file)
		{
			throw new Exception('Specify the file to compile');
		}

		$input = $ci->config->item('less_dir').DIRECTORY_SEPARATOR.$file.'.less';
		$output = $ci->config->item('css_dir').DIRECTORY_SEPARATOR.$file.'.css';

		if ( ! file_exists( $doc_root .DIRECTORY_SEPARATOR. $input ) )
		{
			throw new Exception('The file could not be found: '. $doc_root .DIRECTORY_SEPARATOR. $input);
		}

		if ( ! class_exists('lessc', FALSE))
		{
			require dirname(__FILE__) . '/Less4ci/lib/lessphp/lessc.inc.php';
		}

		$environment = strtolower( ENVIRONMENT ) == 'development';

		if ( ! $ci->config->item('only_development') OR 
				($ci->config->item('only_development') AND 
					( $environment OR ! file_exists($doc_root .DIRECTORY_SEPARATOR. $output) )
				)
		) {
			lessc::ccompile($input, $output);
		}

		return str_replace('\\', '/', $output);
	}   

}

?>