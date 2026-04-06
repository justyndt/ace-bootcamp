const navDrawer = {
	init() {
		this.closeNavOnClick();
	},

	closeNavOnClick() {
		const navLinks = document.querySelectorAll('#nav-drawer ul li > a');

		navLinks.forEach((link) => {
			link.addEventListener('click', () => {
				const drawerToggle = document.querySelector('#drawer-toggle');

				// Uncheck the drawer toggle to close the drawer
				if (drawerToggle.checked) {
					drawerToggle.checked = false;
				}
			});
		});
	},
};

export default navDrawer;
