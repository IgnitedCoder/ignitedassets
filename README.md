
A simple config file based asset manager. Simply create a config file for your assets as follows:

/application/config/site_assets.php

Add your assets to the styles and scripts arrays respectively.

```php

<?php defined('BASEPATH') OR exit('No direct script access allowed');

$config['styles'] =  array(
    'assets/site/css/bootstrap.min.css',
    'assets/site/css/mystylesheet.css',
);

$config['scripts'] =  array('https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js',
    'assets/bootstrap/js/bootstrap.min.js',
    'assets/bootstrap/js/docs.min.js',
);


```

You're ready to rock. In your constructor or MY_Controllers constructor initialize and load the library.

```php

    /**
	 * __construct()
	 *
	 * Constructor	PHP 5+	NOTE: Not needed if not setting values!
	 *
	 * @access	public
	 * @return	void
	 */
	public function __construct()
	{
		parent::__construct();
		$this->load->library("ignitedassets",'site_assets');
		$this->ignitedassets->_initialize_style_scripts();
	}

```

You can add additional scripts/styles as follows:

```php

    /**
	 * __construct()
	 *
	 * Constructor	PHP 5+	NOTE: Not needed if not setting values!
	 *
	 * @access	public
	 * @return	void
	 */
	public function __construct()
	{
		parent::__construct();
		$this->load->library("ignitedassets",'site_assets');

		$this->ignitedassets->_add_styles(['/css/morestyles.css','/css/yetmorestyles.css']);
		$this->ignitedassets->_add_scripts(['/js/morejs.js','/js/yetmorejs.js']);

		$this->ignitedassets->_initialize_style_scripts();
	}

```