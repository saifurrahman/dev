<?php

return array(

	'driver' => 'mailgun',

	'host' => 'smtp.mailgun.org',

	'port' => 587,

	'from' => array('address' => 'support@glomindz.com', 'name' => 'Crimatrix'),

	'encryption' => 'tls',

	'username' => 'postmaster@sandbox9d129c59f78a4105bcaebc329a4486dd.mailgun.org',

	'password' => '3a7a3f3432cbc2914135a61ea216eb66',

	'sendmail' => '/usr/sbin/sendmail -bs',

	'pretend' => false,

);
