<?php
/**
 * Sassify module for ProcessWire CMS
 * by Rudy Affandi (2016)
 * https://github.com/lesaff
 * MIT License
 */

class SassifyConfig extends ModuleConfig {

    // Init global configuration variables.
    private static $sassFormatter;

	/**
	 * Gets the defaults.
	 *
	 * @return     array  The defaults.
	 */
	public function getDefaults() {
    	return [
      		'css_path'       => wire('config')->paths->templates . 'styles/',
      		'css_url'        => wire('config')->urls->templates . 'styles/',
      		'css_filename'   => 'styles',
      		'sass_formatter' => 'Leafo\ScssPhp\Formatter\Nested',
    	];
  	}


	public function getInputfields() {
    	
		// Initiate CP input fields
    	$inputfields = parent::getInputfields();

    	// SASS Folder location
	    $f = $this->modules->get('InputfieldText');
        $f->columnWidth = 50;
	    $f->attr('name', 'sass_folder');
	    $f->label = 'SASS/SCSS Folder Name';
        $f->description = 'Enter your SASS folder name in your templates folder';
        $f->notes = 'Sassify will grab all scss/sass files from this folder';
	    $f->required = true;
	    $inputfields->add($f);

        // CSS Folder location
        $f = $this->modules->get('InputfieldText');
        $f->columnWidth = 50;
        $f->attr('name', 'css_folder');
        $f->label = 'CSS Folder Name';
        $f->description = 'Enter your CSS folder name in your templates folder';
        $f->notes = 'Sassify will store your compiled CSS file here';
        $f->required = true;
        $inputfields->add($f);

    	// CSS URL location
	    $f = $this->modules->get('InputfieldText');
        $f->columnWidth = 50;
	    $f->attr('name', 'css_url');
	    $f->label = 'CSS Folder URL';
	    $f->required = true;
	    $inputfields->add($f);

    	// CSS file name
	    $f = $this->modules->get('InputfieldText');
        $f->columnWidth = 50;
	    $f->attr('name', 'css_filename');
	    $f->label = 'Compiled CSS Filename';
	    $f->required = true;
	    $inputfields->add($f);

    	// SASS Compiler number precision
	    $f = $this->modules->get('InputfieldSelect');
        $f->columnWidth = 50;
	    $f->attr('name', 'css_number_precision');
	    $f->label = 'Set how many digits of precision to use when outputting decimal numbers';
    	$f->options = [
        	'0', '1', '2', '3', '4', '5', '6', '7', '8', '9'
        ]; 
        $inputfields->add($f);

 		// SASS Compiler formatting 
 		$f = $this->modules->get('InputfieldSelect');
        $f->columnWidth = 50;
    	$f->attr('name', 'sass_formatter');
    	$f->label = 'Set the output formatting of Sass compiler';
    	$f->options = [
        	'Leafo\ScssPhp\Formatter\Expanded' => 'Expanded',
			'Leafo\ScssPhp\Formatter\Nested' => 'Nested',
			'Leafo\ScssPhp\Formatter\Compressed' => 'Compressed',
			'Leafo\ScssPhp\Formatter\Compact' => 'Compact',
			'Leafo\ScssPhp\Formatter\Crunched' => 'Crunched'
    	];
    	$inputfields->add($f);

    	// Add notes
        $f = wire('modules')->get('InputfieldMarkup');
        $f->columnWidth = 50;
        $f->label = __('Notes');
        $f->description = __('Brief notes on how to use Sassify module on your website.');
        $f->markupText = file_get_contents(wire('config')->paths->Sassify.'doc'.DIRECTORY_SEPARATOR.'notes.html');
        $inputfields->add($f);

    	return $inputfields;
    }

}
