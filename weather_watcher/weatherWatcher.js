//NAME: EUNICE JOY LLOBET
//ID: 1330233

//AJAX Request function
function ajaxRequest(url, method, data, callback) {

	let request = new XMLHttpRequest();
	request.open(method, url, true);

	if (method == "POST") {
		request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	}

	request.onreadystatechange = function() {
		//IF REQUEST IS READY TO BE PROCCESSED
		if (request.readyState === 4) {
			//IF REQUEST WAS SUCCESSFUL
			if (request.status === 200) {
				//GET RESPONSE AND CALLBACK
				let response = request.responseText;
				callback(response);
			}
			else {
				handleError(request.statusText); //
			}
		}
	}
	request.send(data);
}

function handleError(errorText) {
	alert("An error occurred: " + errorText);
}

function loginButton() {
	//GLOBAL ACCESS USERNAME
	window.username = document.getElementById("username").value;

	let password = document.getElementById("password").value;

	//IF INPUT IS EMPTY
	if(username.length == 0 || password.length == 0) {
		document.getElementById("page_statement").innerHTML = "<p>Please enter a username and password</p>";
	}
	else {
		//AJAX REQUEST TO PROCCESS LOGIN
		let url = "php/login.php";
		let data = "usernameValue=" + username + "&passwordValue=" + password;
		ajaxRequest(url, "POST", data, login);
	}
}

//CALLBACK METHOD
function login(response) {
	//IF WRONG USERNAME OR PASSWORD
	if (response == "No data") {
		let page_statement = document.getElementById("page_statement");
		page_statement.innerHTML = "<p> Invalid Username or Password <p>";
		page_statement.style.color = "red";

	} else {
		//IF DATA IS CORRECT
		let url = "php/displayWeather.php?id=" + response;
		//SEND AJAX REQUEST TO DISPLAY WEATHER
		ajaxRequest(url, "GET", "", displayWeather);
	}

}

//DISPLAY WEATHER INFORMATION
function displayWeather(response) {
	//REPLACE TITLE AND PAGE STATEMENT
	let title = document.getElementById("title");
	title.innerHTML = "<h1>Welcome, " + window.username + "</h1>"
	let page_statement = document.getElementById("page_statement");
	page_statement.innerHTML = "<p>Click on a town name to display more information.</p>";

	//CLEAR LOGIN SECTION
	document.getElementById("login_container").innerHTML = "";

	//DISPLAY WEATHER TABLE
	let table = document.getElementById("table");
	table.innerHTML = "<table><tr><th>Town</th><th>Current Temperature (in degrees)</th><th>Summary</th></tr>" + response + "</table>";
	
	//DISPLAY DROP DOWN MENU AND BUTTONS
	let form = document.getElementById("addOrRemove");
	form.style.display = "block";
	let logout = document.getElementById("logout");
	logout.style.display = "block";
}

//WHEN USER CLICKS A TOWN NAME
function showInfo(town) {
	//SEND AJAX REQUEST TO GET FULL DESCRIPTION OF TOWN CLICKED
	let url = "php/showFullDescription.php?town=";
	let data = "townName=" + town;
	ajaxRequest(url, "POST", data, showFullDescription);
}

//DISPLAY FULL DESCRIPTION
function showFullDescription(response) {
	document.getElementById("description_container").innerHTML = response;
}

//GET AVAILABLE LIST OF TOWNS FROM DATABASE TO DISPLAY IN DROP DOWN MENU
function townOptions() {
	let url="php/townOptions.php";
	ajaxRequest(url, "GET", "", displayOptions);
}

//DISPLAY LIST IN DROP DOWN MENU
function displayOptions(response) {
	var options = document.getElementById("townName");
	options.innerHTML = response;
}

//CHECK WHETHER USER CHOSE ADD OR REMOVE BUTTON
//SEND AJAX REQUEST TO FULFILL USER INTENTION
function getSelectedTown(id) {
	var selectedValue = document.getElementById("townName").value;

	//ACCESS GLOBAL VARIABLE
	var user = window.username;

	if(id == "addTown") {
		let url = "php/addTown.php";
		let data = "selectedTown=" + selectedValue + "&usernameValue=" + user;
		ajaxRequest(url, "POST", data, addOrRemove);
	}
	else if(id == "removeTown") {
		let url = "php/removeTown.php";
		let data = "selectedTown=" + selectedValue + "&usernameValue=" + user;
		ajaxRequest(url, "POST", data, addOrRemove);
	}
}

//REDIRECT REQUEST TO DISPLAY APPROPRIATE LIST OF TOWN ASSOCIATED WITH USER ID
function addOrRemove(response) {
	let url = "php/displayWeather.php?id=" + response;
	ajaxRequest(url, "GET", "", displayWeather);
}

//REFRESH PAGE TO GO BACK TO LOGIN PAGE
function logout() {
	location.reload();
}
