/** Animate the contact form by adding and removing classes
 */
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
  
	if (i.value !== '') {
    
		i.parentElement.classList.add('has-label')
	}
  
	if (i.type === 'textarea') {
    
		i.parentElement.classList.add('contact__form--textarea')
	}
})
