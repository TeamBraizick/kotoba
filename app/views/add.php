<html>

<header>
    <title>Adding Page</title>
</header>

<body>
<form action="insert" method="post">
    What language is the sentence in? <br/>
    <select name="lang">
        <option value="en">English</option>
        <option value="jp">Japanese</option>
    </select>
    <br/>
    What is the sentence? <br/>
    <textarea name="sentence" maxlength="5000"></textarea>
    <br/>
    What is the translation? <br/>
    <textarea name="translation" maxlength="5000"></textarea>
    <br/>
    <input type="submit" value="ADD!">
</form>
</body>

</html>