/**
 * 
 * Make the navigation menu sticky when the page is scrolled,
 * by adding and removing classes
 */

const stickyMenu = function () {
  
	window.addEventListener('scroll', function (e) {
    
		const menu = document.querySelector('.navigation__menu--items')
    
    const menuWrapper = menu.parentElement.parentElement
    
    let hasClass = menuWrapper.classList.contains('sticky')
    
    if (window.scrollY >= (window.innerHeight - menu.clientHeight)) {
      
			if (!hasClass) {
        
        menuWrapper.classList.add('sticky')
      }

    } else {
      
      if (hasClass) {
        
        menuWrapper.classList.remove('sticky')
      }
    }
	})
}()
