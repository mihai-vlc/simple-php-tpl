Simple PHP Template System
======================
Just a simple php template system i made for fun.  

## How to use
file.php
```php
$tpl = new Tpl("tpl/");
$tpl->grab("test.tpl");

$tpl->assign("var", "aSas{\$test}");
$tpl->assign("test", "hello");
$tpl->display();
```
tpl/test.tpl
```html
<!-- simple var -->
<b>This is a {$var}</b> and this is {$test}
<br/>
```
Output:
```html
<!-- simple var -->
<b>This is a aSas{$test}</b> and this is hello
<br/>
```

## Loops
php file
```php
$tpl = new Tpl("tpl/");
$tpl->grab("test.tpl");

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
```

tpl file
```html
<!-- how about some loops -->
<ul>
	{each $vector}
		<li>{$}</li>
	{/each}
</ul>
<!-- but i want to show only certain values -->
{$vector.0} and {$vector.2}

<!-- maybe multidimensional arrays ?-->
<ul>
	{each $mdArr}
		<li>{$group} - {$user.name} {$user.age}</li>
	{/each}
</ul>

$tpl->display();

```

Contributions
-----------------
If you find a bug or have suggestions open an issue [here](https://github.com/ionutvmi/simple-php-tpl/issues)

Donate 
-----------------
If you like my code you can support me by making a [donation](https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=T9HU2KAF54EBE&lc=RO&currency_code=USD&bn=PP%2dDonationsBF%3abtn_donateCC_LG%2egif%3aNonHosted)

