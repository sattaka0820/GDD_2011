var elements = new Array(1024);
for (i=0;i<1024;i++) {
	elements[i] = document.getElementById('card' + i);
}

var myevent = document.createEvent('MouseEvents');
myevent.initEvent('click', false, true);

for (var i in elements) {
	var element = elements[i];
	if (element) {
		element.dispatchEvent(myevent);
		var color = element.style.backgroundColor.match(/^rgb\(\s*(\d+),\s*(\d+),\s*(\d+)\)$/);
		element.innerHTML = color[1] + '<br>' + color[2] + '<br>' + color[3];
	}
}

for (var i in elements) {
	element_i = elements[i];
	if (element_i) {
		i_c = element_i.innerHTML;

		for (var j in elements) {
			element_j = elements[j];
			if (element_j) {
				j_c = element_j.innerHTML;
				if (i_c == j_c) {
					element_i.dispatchEvent(myevent);
					element_j.dispatchEvent(myevent);
				}
			}
		}

	}
}
