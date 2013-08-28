<!-- simple var -->
<b>This is a {$var}</b> and this is {$test}
<br/>

<!-- want arrays ? -->
<div> {$arr.name} </div>
<div> {$arr.text.one.name} </div>
<div> {$arr.text.one.age} </div>
<div> {$arr.text.two} </div>


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

<!-- access a certain value here also -->
{$mdArr.0.user.name}

<!-- show it again ? -->
<ul>
	{each $vector}
		<li>{$}</li>
	{/each}
</ul>

<!-- Want it nested ? -->
<ul>
	{each $nestedArr}
		<li>
			{$group}
			<ul>
				{each $users}
					<li>{$name} is {$age} years old</li>
				{/each}
			</ul>
		</li>
	{/each}
</ul>

<!-- multidimensional with a vector inside -->
<ul>
	{each $site_users}
		<li>
			{$group}
			<ul>
				{each $users}
					<li>{$}</li>
				{/each}
			</ul>
		</li>
	{/each}
</ul>

<!-- need something from inside ? -->
{$site_users.0.users.1}

<div style='text-align: center; padding: 5px; background-color: #ccc; border: 1px solid #375284'>
	August 2013 - 
	Mihai Ionut Vilcu (ionutvmi@gmail.com)
</div>
