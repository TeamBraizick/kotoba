<html>

<header>
    <title>Main Page</title>
</header>

<body>

	<ul>
		<li><a href="add">Add</a></li>
		<li><a href="search">Search</a></li>
	</ul>

	<?php
		/*
			Change TargetLanugage/KnownLanguage
			to another phrase that makes more sense.
		*/
	?>
	<form method="post" action="search/results">
		
		<select name='target'>
			<option value="none">Target Language</option>
			<option value="none">---------------</option>
			<?php foreach ($languages as $abbr => $full_lang){
				echo(
					'<option value="'.$abbr.'">'.
					$full_lang.
					'</option>'
				);
			} ?>
		</select>
		
		<select name='known'>
			<option value="none">Known Language</option>
			<option value="none">---------------</option>
			<?php foreach ($languages as $abbr => $full_lang){
				echo(
					'<option value="'.$abbr.'">'.
					$full_lang.
					'</option>'
				);
			} ?>
		</select>
		
		<input type="text" name="query">
		<input type="submit" value="Search">
	</form>

</body>

</html>