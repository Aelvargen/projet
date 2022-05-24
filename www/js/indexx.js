// document.getElementById("signUp").disabled = false;`


const signInButton = document.getElementById('signIn');

const container = document.getElementById('container');



signInButton.addEventListener('click', () => {

	container.classList.remove("right-panel-active");

});


function findGetParameter(parameterName) {
	var result = null,
		tmp = [];
	location.search
		.substr(1)
		.split("&")
		.forEach(function(item) {
			tmp = item.split("=");
			if (tmp[0] === parameterName) result = decodeURIComponent(tmp[1]);
		});
	return result;
};

if (findGetParameter("view") == 1) {
	if (!(performance.navigation.type == performance.navigation.TYPE_RELOAD)) {
		container.classList.remove("right-panel-active");
		container.offsetWidth;
		container.classList.add("right-panel-active");
	} else {
		container.classList.add("right-panel-active");
	}
};