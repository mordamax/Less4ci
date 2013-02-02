<?php

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
			throw new Exception('The file could not be found: '.$_SERVER['DOCUMENT_ROOT'].'/'.$input);
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