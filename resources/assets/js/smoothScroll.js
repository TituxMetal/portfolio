/** Scrolls the page to the target with a smooth effect 
 */
const scrollIt = function (destination, duration = 200, easing = 'easeInOutCubic', callback) {
  
  const easings = {
    easeInOutCubic(t) {
      return t < 0.5 ? 4 * t * t * t : (t - 1) * (2 * t - 2) * (2 * t - 2) + 1;
    }
  }
  
  const start = window.pageYOffset
  
  const startTime = 'now' in window.performance ?
    performance.now() :
      new Date().getTime()
  
  const documentHeight = Math.max(
    document.body.scrollHeight,
    document.body.offsetHeight,
    document.documentElement.clientHeight,
    document.documentElement.scrollHeight,
    document.documentElement.offsetHeight
  )

  const windowHeight = window.innerHeight ||
    document.documentElement.clientHeight ||
    document.getElementsByTagName('body')[0].clientHeight
  
  const destinationOffset = typeof destination === 'number' ?
    destination :
      destination.offsetTop
  
  const destinationOffsetToScroll = Math.round(
    documentHeight - destinationOffset < windowHeight ?
      documentHeight - windowHeight :
        destinationOffset
  )
  
  if ('requestAnimationFrame' in window === false) {
    
    window.scroll(0, destinationOffsetToScroll)
    if (callback) {
      
      callback()
    }
    
    return true
  }
  
  function scroll() {
    
    const now = 'now' in window.performance ? performance.now() : new Date().getTime()
    
    const time = Math.min(1, ((now - startTime) / duration))
    
    const timeFunction = easings[easing](time)
    
    window.scroll(0, Math.ceil((timeFunction * (destinationOffsetToScroll - start)) + start))
    
    if (window.pageYOffset === destinationOffsetToScroll) {
      
      if (callback) {
        
        callback()
      }
      
      return true
    }
    
    requestAnimationFrame(scroll)
  }
  
  scroll()
}

/** List of target elements
 */
const targets = []

/** Populate the list of target with section id's elements
 */
Array.from(document.getElementsByTagName('section')).map(function (item) {
  
  if (item.hasAttribute('id')) {
    
    targets.push(item)
  }
})

/**
 * 
 * List of navigation menu items, with a click event that calls the
 * scroll function
 */
const menuLinks = [...document.querySelectorAll('.navigation__menu--items li a')]
  .map (function(item, i) {
    
    item.addEventListener('click', function (e) {
      
      scrollIt(targets[i], 500)
    })
  })


/** Back to top button element
 */
const backToTopButton = document.createElement('div')
backToTopButton.classList.add('backToTop')
backToTopButton.innerText = 'TOP'
backToTopButton.addEventListener('click', function (e) {
  
  scrollIt(0, 500)
})

/** Add the back to top button element in the DOM
 */
document.body.insertBefore(backToTopButton, document.querySelector('footer.footer'))

/**
 * 
 * Display the back to top button, by adding and removing a class, depending
 * to the position of the scroll
 */
const backToTop = function () {
  
  window.addEventListener('scroll', function (e) {
    
    const button = document.querySelector('div.backToTop')
    
    let hasClass = button.classList.contains('sticky')
    
    if (window.scrollY >= (window.innerHeight)) {
      
      if (!hasClass) {
        
        button.classList.add('sticky')
      }
    } else {
      
      if (hasClass) {
        
        button.classList.remove('sticky')
      }
    }
  })
}()
