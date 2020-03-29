window.onload = indexController;

function indexController() {
	let selectedItem = initMenuList();
	let menuBody;

	selectedItem.addEventListener('change', function() {
		let selectedValue = selectedItem.options[selectedItem.selectedIndex];
		console.log(selectedValue);
		menuBody = getMenuBody(selectedValue);
	})
}

function getMenuBody(selectedValue) {
	let result = document.getElementById('menuBody');
	if (selectedValue.value === '-1') {
		alert("Chose menu");
		return result;
	}
	let data = new FormData();
	data.append('getMenuHead', '1');
	data.append('value', selectedValue.value);
	data.append('title', selectedValue.text);
	let xhr = new XMLHttpRequest();
	xhr.open('POST', 'JS/request', true);
	xhr.onload = function () {
		let json = JSON.parse(this.response);
		if (json.head) {
			result.innerHTML = json.head;
		}
	};
	xhr.send(data);
	return result;
}

function initMenuList() {
	let selectMenu = document.getElementById('select');
	let data = new FormData();
	data.append('getListOfMenus', '1');
	let xhr = new XMLHttpRequest();
	xhr.open('POST', 'JS/request', true);
	xhr.onload = function () {
		let json = JSON.parse(this.response);
		if (json.menus) {
			selectMenu.innerHTML = "<option selected value='-1'>Chose menu</option>" + json.menus;
		}
		else {
			console.log(json.menus);
			selectMenu.innerHTML = "<option>Press 'Create menu'</option>"
		}
	};
	xhr.send(data);
	return selectMenu;
}