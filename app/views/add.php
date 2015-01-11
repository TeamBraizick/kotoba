<html>

<header>
    <title>Adding Page</title>
</header>

<body>
<form action="insert" method="post">
    What language is the sentence in? <br/>
    <select name="target_lang">
		<?php foreach(Languages::getLangs() as $abbr => $full_lang){
			echo(
				'<option value="'.$abbr.'">'.
				$full_lang.
				'</option>'
			);
		} ?>
    </select>
    <br/>
    What is the sentence? <br/>
    <textarea name="sentence" maxlength="5000"></textarea>
    <br/><br/>
	What language is the translation in? <br/>
    <select name="source_lang">
		<?php foreach(Languages::getLangs() as $abbr => $full_lang){
			echo(
				'<option value="'.$abbr.'">'.
				$full_lang.
				'</option>'
			);
		} ?>
    </select>
	<br/>
    What is the translation? <br/>
    <textarea name="translation" maxlength="5000"></textarea>
    <br/>
    <input type="submit" value="ADD!">
</form>
</body>

</html>