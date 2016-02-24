
A simple config file based asset manager. Simply create a config file for your assets as follows:

/application/config/site_assets.php
/application/config/app_assets.php

Add your assets to the styles and scripts arrays respectively.

```php

/* site_assets.php */

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
You're ready to rock. In your constructor or MY_Controllers constructor initialize and load the library. Note that the 2nd param for load->library() is an array.
This basically allows you to load multiple asset config files.

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
		$this->load->library("ignitedassets",['site_assets']);
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
		$this->load->library("ignitedassets",['site_assets']);

		$this->ignitedassets->_add_styles(['/css/morestyles.css','/css/yetmorestyles.css']);
		$this->ignitedassets->_add_scripts(['/js/morejs.js','/js/yetmorejs.js']);

		$this->ignitedassets->_initialize_style_scripts();
	}

```

In your header/footer views you simply echo $styles & $scripts. you can also echo $scripts in the head section of your HTML.

```php

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="<?php echo base_url('assets/bootstrap/ico/favicon.ico'); ?>">
    <title><?php echo $this->lang->line('system_system_name'); ?></title>

    <?php echo $styles ?>

    <!-- HTML5 shim and Respond.js IE8 support of HTML5
      elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

<?php echo $scripts ?>

</body>
</html>

```