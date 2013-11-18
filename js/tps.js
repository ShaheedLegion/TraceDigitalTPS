/*
This function performs an Ajax request.
*/
function sendchanges(request, callback)
{
	var xmlhttp = 0;
	var _request_text;

	if (window.XMLHttpRequest)// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp = new XMLHttpRequest();
	else// code for IE6, IE5
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");

	xmlhttp.onreadystatechange = function()
	{
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
			callback(xmlhttp.responseText, xmlhttp.getAllResponseHeaders());
	}

	_request_text = request;
	xmlhttp.open("GET", _request_text, true);	//test if this should be GET or POST
	xmlhttp.send();
}

/*
	This function fetches the fields of a project based on the current type selection of the project.
*/
function fetchFields()
{
	var _node = document.getElementById("project_type");
	if (_node)
	{
		//get the selected option and perform the ajax request... with the specified callback
		var selectedOption = _node.options[_node.selectedIndex].value;
		var request = "tps_addproject.php?project_type=" + selectedOption;
		//this tells us the value of the selection in the dropdown.
		sendchanges(request, displayFields);
	}
}

//need to finalize a way for the backend to report an error.
function displayFields(_response, _headers)
{
	var _node = document.getElementById("formfields");
	if (_node)
	{
		_node.innerHTML = _response;
	}
}

function shownode(_id)
{
	var _node = document.getElementById(_id);
	if (_node)
	{
		_node.style.display = 'block';
	}
}

function hidenode(_id)
{
	alert("Hiding node");
	var _node = document.getElementById(_id);
	if (_node)
	{
		_node.style.display = 'none';
		alert("Node hidden");
	}
}

function run()
{
	alert("Hello World!");
}