// Navigation menu
const menuOverlay = document.querySelector('.navigation__overlay')
const menuElts = [...document.querySelectorAll('.navigation__menu--items li')]
const hamburgerIcon = document.querySelector('.navigation__hamburger--icon')

// On mobile devices, open the menu by adding an opened class
const openMenu = function () {
	hamburgerIcon.addEventListener('click', function (e) {
		menuElts.forEach(function (elt) {
			elt.addEventListener('click', function (e) {
				menuOverlay.classList.remove('visible')
				hamburgerIcon.classList.remove('opened')
			})
		})
		
		menuOverlay.classList.toggle('visible')
		hamburgerIcon.classList.toggle('opened')
	})
}

openMenu()

// On large devices, when the page scrolls we add a class to sticking the menu on the top of the page
const stickyMenu = function () {
	window.addEventListener('scroll', function (e) {
		const menu = document.querySelector('.navigation__menu--items')
		if (window.scrollY >= (window.innerHeight - menu.clientHeight)) {
			menu.parentElement.parentElement.classList.add('sticky')
		} else {
			menu.parentElement.parentElement.classList.remove('sticky')
		}
	})
}

stickyMenu()

// Contact form
const form = [...document.querySelector('.contact__form').elements]

form.forEach(function (i) {
	let input = i.parentElement
	i.addEventListener('focus', function (e) {
		input.classList.add('is-focused')
		input.classList.add('has-label')
	})
	i.addEventListener('blur', function (e) {
		if (e.target.value === '') {
			input.classList.remove('has-label')
		}
		input.classList.remove('is-focused')
	})
	if (i.value != '') {
		i.parentElement.classList.add('has-label')
	}
	if (i.type === 'textarea') {
		i.parentElement.classList.add('contact__form--textarea')
	}
})