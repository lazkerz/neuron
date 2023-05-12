// Tabs
var tabButtons = document.querySelectorAll(".wrapp-tabs .buttonTabs button");
var tabContent = document.querySelectorAll(".wrapp-tabs .tabContent");

function showContent(contentIndex) {
	tabButtons.forEach(function (node) {
		node.style.backgroundColor = "";
		node.style.color = "";
	});
	tabButtons[contentIndex].style.backgroundColor = '#87bffd';
	tabButtons[contentIndex].style.color = "white";

	tabContent.forEach(function (node) {
		node.style.display = "none";
	});

	tabContent[contentIndex].style.display = "block";
}

showContent(0);
