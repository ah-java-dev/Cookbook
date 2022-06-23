let currentTitle = "";

function search(title) {
	if (currentTitle === title.value) {
		return;
	}
	
	if (/^\s+/g.test(title.value)) {
		title.value = title.value.replace(/^\s+/g, '');
		title.placeholder = 'Something, not space...';
		
		return;
	} else {
		title.placeholder = 'Type something...';
	}

	currentTitle = title;
	sendRequest(title.value)
}

function sendRequest(title) {
	const xHttp = new XMLHttpRequest();
	xHttp.onload = function() {
		document.getElementById("recipes").innerHTML = this.responseText;
	}

	let data = new FormData();
	data.append('title', title);

	xHttp.open("POST", "https://www.siliconos.ga:8081/assets/php/getRecipes.php");
	xHttp.send(data);
}

sendRequest("");
