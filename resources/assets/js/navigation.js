/** Navigation menu
 */

/** Select the navigation overlay
 */
const menuOverlay = document.querySelector('.navigation__overlay')

/** Select the navigation menu items
 */
const menuElts = [...document.querySelectorAll('.navigation__menu--items li')]

/** Select the navigation hamburger icon
 */
const hamburgerIcon = document.querySelector('.navigation__hamburger--icon')

/**
 * 
 * Toggle the navigation menu when we click on the hamburger icon or on an
 * element from the navigation menu, by adding and removing classes
 */
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
}()
