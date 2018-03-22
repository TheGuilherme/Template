<?php

/**
 * Template system
 *
 * Distributed under GNU/LGPL 3 License
 *
 * @author Guilherme Alves theguilherme.com@gmail.com
 * @version 1.0 Alpha
 */
class Template
{
	/**
	 * 
	 * @var string
	 */
	public $_file;

	/**
	 * 
	 * @var array
	 */
	public $_vars = array();

	/**
	 * Constructor get the file.
	 * 
	 * @param string $file
	 */
	public function __construct($file)
	{
		$this->_file = $file . '.php';
	}

	/**
	 * Assign array on the file.
	 * 
	 * @param  string $key
	 * @param  string $value
	 * @return array
	 */
	public function assign($key, $value)
	{
		$this->_vars[$key] = $value;
	}

	/**
	 * Registers variables and prints in visual.
	 * 
	 * @return mixed|boolean
	 */
	public function display()
	{
		if (!file_exists($this->_file))
		{
			die('<strong>Error:</strong> this <strong>' . $this->_file . '</strong> file do not exists!');
		}

		$content = file_get_contents($this->_file);

		foreach ($this->_vars as $key => $value)
		{
			$content = preg_replace('/\{#' . $key . '\#}/', $value, $content);
		}

		$content = preg_replace('/\<\!\-\- if (.*) \-\-\>/', '<?php if ($1) : ?>', $content);
		$content = preg_replace('/\<\!\-\- else \-\-\>/', '<?php else : ?>', $content);
		$content = preg_replace('/\<\!\-\- endif \-\-\>/', '<?php endif; ?>', $content);

		@eval(' ?>' . $content . '<?php ');
	}
}