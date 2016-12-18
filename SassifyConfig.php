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
            'sass_path'   => wire('config')->paths->templates . 'sass/',
            'sass_entry'   => 'main.scss',
      		'sass_formatter' => 'Leafo\ScssPhp\Formatter\Nested',
    	];
  	}


	public function getInputfields() {

		// Initiate CP input fields
    	$inputfields = parent::getInputfields();

        // Compile Sass Button Area
        $f              = $this->modules->get('InputfieldMarkup');
        $f->columnWidth = 25;
        $f->label       = __('Compile Sass');
        $f->description = __('Compile all your sass.');

        // The actual button
        $f_button           = $this->modules->get('InputfieldButton');
        $f_button->name     = 'compile_sass';
        $f_button->value    = __('Compile SASS');
        $f_button->href     = 'edit?name='.wire('input')->get('name').'&sass=compile';

        $f->add($f_button);
        $inputfields->add($f);



    	// CSS Folder location
	    $f = $this->modules->get('InputfieldText');
	    $f->attr('name', 'css_path');
	    $f->label = 'CSS Folder Path';
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

        // SASS Folder location
        $f = $this->modules->get('InputfieldText');
        $f->columnWidth = 50;
        $f->attr('name', 'sass_path');
        $f->label = 'SCSS Folder Path';
        $f->required = true;
        $inputfields->add($f);

        // SASS Entry location
        $f = $this->modules->get('InputfieldText');
        $f->columnWidth = 50;
        $f->attr('name', 'sass_entry');
        $f->label = 'SCSS Entry Filename';
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