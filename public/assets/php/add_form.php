<form action="insert" method="post">
	What language is the sentence in? <br/>
	<select name="target_lang">
		<?php
		foreach (Languages::getLangs() as $abbr => $full_lang) {
			echo(
			'<option value="' . $abbr . '">' .
			$full_lang .
			'</option>'
			);
		}
		?>
	</select>
	<br/>
	What is the sentence? <br/>
	<textarea name="sentence" maxlength="5000"></textarea>
	<br/>
	What words are in this sentence? <br/>
	<input type='text' class='tag_box' id='org_tags' name='org_tags'>

	<br/><br/><br/>
	What language is the translation in? <br/>
	<select name="source_lang">
		<?php
		foreach (Languages::getLangs() as $abbr => $full_lang) {
			echo(
			'<option value="' . $abbr . '">' .
			$full_lang .
			'</option>'
			);
		}
		?>
	</select>
	<br/>
	What is the translation? <br/>
	<textarea name="translation" maxlength="5000"></textarea>
	<br/>
	What words are in this sentence? <br/>
	<input type='text' class='tag_box' id='trs_tags' name='trs_tags'>

	<br/><br/><br/>
	<input type="submit" value="ADD!">
</form>