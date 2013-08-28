<?php

/**
 * @author Mihai Ionut Vilcu (ionutvmi@gmail.com)
 */

include 'template.class.php';

$tpl = new Tpl("tpl/");
$tpl->grab("test.tpl");

$tpl->assign("var", "aSas{\$test}");
$tpl->assign("test", "hello");

$arr =[	'name' => "Test",
		"text" => ['one' => ['name' => '1a1', 'age' => 26],'two' => '2a2'],
];

$tpl->assign("arr", $arr);

$vector = ['a', 'b', 'c'];

$tpl->assign("vector", $vector);

$mdArr = [
	[ 	
		'group' => 'Guest',
		'user' => ['name'=> 'ion', 'age'=>20]
	],
	[ 	
		'group' => 'Admin',
		'user' => ['name'=> 'mihai', 'age'=>20]
	],
];

$tpl->assign("mdArr", $mdArr);

$nestedArr = [
	[
		'group' => 'Guests',
		'users' => [ 
			[
				'name' => 'vasile',
				'age' => 20
			],			
			[
				'name' => 'andrei',
				'age' => 19
			],
			[
				'name' => 'cristi',
				'age' => 19
			],
		]
	],
	[
		'group' => 'Admins',
		'users' => [ 
			[
				'name' => 'ionut',
				'age' => 20
			],			
			[
				'name' => 'mihai',
				'age' => 19
			],
		]
	]
];

$tpl->assign("nestedArr", $nestedArr);




$site_users = [
	[
		'group' => 'Guests',
		'users' => [ 'a', 'b', 'c']
	],
	[
		'group' => 'Admins',
		'users' => [ 'd', 'e', 'f']
	],
];

$tpl->assign("site_users", $site_users);

$tpl->display();
