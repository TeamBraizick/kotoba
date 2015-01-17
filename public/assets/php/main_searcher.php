<form id="searcher" method="post" action="find">
	<!--
		Change TargetLanugage/KnownLanguage
		to another phrase that makes more sense.
	-->
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
	<span>&nbsp;&nbsp; ---> &nbsp;&nbsp;</span>
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
	
	<br/>
	<input id="box" type="text" name="query">
	<input type="submit" value="Search">
</form>
