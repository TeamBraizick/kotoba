function display(sentence, box){
	document.getElementById(box).value = tags(splitter(document.getElementById(sentence)));
}

function splitter(sentence){
	var words = sentecne.split(/ |,|\.|\?|&|\||\/|!|\+|-|\(|\)|"|'|:/g);
	if(words.length <= 1) return;
	return words;
}

function tags (words){ 
	words.toString();
}