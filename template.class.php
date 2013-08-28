<?php 
/**
* August 2013
* @author Mihai Ionut Vilcu (ionutvmi@gmail.com)
*/
class Tpl {

	public $beginTag    = '{';
	public $endTag      = '}';
	public $buffer      = null;
	public $path 		= 'tpl/'; // the path to the tpl files

	function __construct($path) {
		$this->path = $path;
	}

	/**
	 * Grab the content of the files and run the hooks
	 *
	 * @param string The file name.
	 * @return boolean Always true.
	*/  
	public function grab($file){
		
		$this->buffer = file_get_contents($this->path.$file);
		return true;
	}
	
	/**
	 * Replace the vars from teplate with the specific value
	 *
	 * @param string $var The var name.
	 * @param string $value The var value.
	 * @param string $local if true it will use $local as buffer
	*/    
	public function assign( $var, $value, &$local = false ) {

		if(preg_match('/(?={each \$'.$var.'})({each \$\w+}((?:[^{]|{(?!\/?each)|(?1))*){\/each})/is', $this->buffer, $match))
			$this->assign_loop($match, $var, $value);

		if(is_array($value) || is_object($value))  // if it's an array we parse it as one
			$this->assign_array($var, (array)$value, $local);
		else {
			if($local)
				$local = str_replace($this->beginTag . '$' . $var  . $this->endTag , $this->parseVal($value), $local);
			else
				$this->buffer = str_replace($this->beginTag . '$' . $var  . $this->endTag , $this->parseVal($value), $this->buffer);
		}
	}
	
	/**
	 * It will replaced the vars inside the template with the values of the array.
	 * @param  string $var   the var name
	 * @param  array $value The array containing the values
	 * @param  string $prev it will hold the key names for multidimensional arrays
	 * @param string $local if true it will use $local as buffer
	 */
	public function assign_array($var, $value, $prev = '', &$local = false) {

		foreach ($value as $k => $v) {
			if(is_array($v) || is_object($v))
				$this->assign_array($var, (array)$v, $prev.".".$k, $local);
			else
				if($local) {

					$this->assign(substr($prev.".".$k,1), $v, $local);
				}
				else	
					$this->assign($var.$prev.".".$k, $v, $local);
		}

	}
	public function assign_loop($match, $var, $value, &$local = false) {

		$pos = $local ? 3 : 2;
		$result = $res =""; // will store the html result

		foreach ($value as $v) {
			$loc = $match[$pos];

			if(is_array($v) || is_object($v))
				$this->assign_array($var, (array)$v, '', $loc);
			else
				$loc = str_replace('{$}', $v, $loc);

			if(preg_match('/(?={each \$([^}]+)})({each \$\w+}((?:[^{]|{(?!\/?each)|(?1))*){\/each})/is', $loc, $match2)) {
				$loc2 = $match2[2];
				$this->assign_loop($match2, $match2[1], $v[$match2[1]], $loc2);
				$loc = preg_replace('/(?={each \$'.$match2[1].'})({each \$\w+}((?:[^{]|{(?!\/?each)|(?1))*){\/each})/is', $this->parseVal($loc2), $loc);
			}

			$result .= $loc;
		}
		


		if($local) // we place it in $local rather then the buffer
			$local = preg_replace('/(?={each \$'.$var.'})({each \$\w+}((?:[^{]|{(?!\/?each)|(?1))*){\/each})/is', $this->parseVal($result), $local);
		else
			// we add the result back to the buffer
			$this->buffer = preg_replace('/(?={each \$'.$var.'})({each \$\w+}((?:[^{]|{(?!\/?each)|(?1))*){\/each})/is', $this->parseVal($result), $this->buffer);
	}

	// display the final result
	public function display() {
		echo $this->unParse($this->buffer);
	}
	/**
	 * It will escape the some strings used in the teplate so we don't have problems with the replaced values
	 * @param  string $value The string to be escaped
	 * @return string        The escaped string
	 */
	public function parseVal($value){
		return str_replace('$', '\$', $value);
	}

	/**
	 * It will convert the string back to normal once all the variables in the template have been replaced.
	 * @param  string $value The string to be reversed back to normal/
	 * @return string        The unescaped string
	 */
	public function unParse($value) {
		return str_replace('\$', '$', $value);
	}

} 
