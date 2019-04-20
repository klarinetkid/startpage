var timeElement = document.getElementById("time");

function updateTime() {
	var time = new Date();
	var hours = time.getHours();
	timeElement.innerText = 
		(hours > 12 ? hours-12 : hours) + ":" + time.getMinutes().toString().padStart(2, '0');
}

updateTime();
setInterval(updateTime, 30*1000);


var links = document.getElementsByClassName("link");

// attach click listeners
for(var i = 0;i < links.length;i++) {
	links[i].onclick = nav;
}

function nav(e) {
	var href = e.target.getAttribute("href");
	window.parent.location = href;
}


// focus links when name typed
var search = "";

var matches = document.getElementsByClassName("match");

document.onkeydown = function(e) {

    // if enter pressed, click selected link
    if(e.key == "Enter" && matches.length == 1) matches[0].click();

    // filter out all except characters and backspace
    if(e.key.length > 1 && e.key != "Backspace") return;

    // add key to search
    search = e.key == "Backspace" ? "" : search + e.key;

    // search through link elements
    for(var i = 0;i < links.length;i++) {
        // compare search to link text
		var match = links[i].innerText.toLowerCase().startsWith(search.toLowerCase());

        if(match && search.length > 0) {
            links[i].classList.add("match");
            continue;
        }
        links[i].classList.remove("match");
    }
	if(matches.length == 0) search = "";
}

