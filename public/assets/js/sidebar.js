let sidebar = document.querySelector("aside");
let toggle = document.querySelector(".toggleIcon");
let search = document.querySelector(".aside__search");
let modeSwitch = document.querySelector(".toggle-switch");
let image1 = document.querySelector(".image-text .image");
let image2 = document.querySelector(".image-text .icon");
let body = document.body;
let arrow = document.querySelectorAll(".dropdownIcon");
let dropdown = document.querySelectorAll(".dropdown");
let dropdownLists = document.querySelectorAll(".dropdownList");

modeSwitch.addEventListener("click", () => {
	body.classList.toggle("dark");
});

toggle.addEventListener("click", () => {
	sidebar.classList.toggle("close");
	image1.classList.toggle("d-none");
	image2.classList.toggle("d-none");

	if (sidebar.classList.contains("close")) {
		sidebar.classList.remove("overflow-y-auto");
		for (let i = 0; i < dropdownLists.length; i++) {
			let link = dropdownLists[i].querySelector("a");
			link.classList.remove("active");
			dropdownLists[i].addEventListener("click", () => {
				dropdownLists[i].classList.toggle("showMenu");
				link.classList.toggle("active");
			});
			if (link.classList.contains("active")) {
				console.log(link);
				dropdownLists[i].classList.add("showMenu");
			}
		}
	} else {
		sidebar.classList.add("overflow-y-auto");
		DropdownArrow(arrow);
	}
});
DropdownArrow(arrow);
for (let i = 0; i < dropdownLists.length; i++) {
	let link = dropdownLists[i].querySelector("a");
	if (link.classList.contains("active")) {
		console.log(link);
		dropdownLists[i].classList.add("showMenu");
	}
}
