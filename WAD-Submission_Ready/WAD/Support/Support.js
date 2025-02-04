// Author Maciej Makar
const contactForm = document.getElementById('contactForm');
const formResponse = document.getElementById('formResponse');

contactForm.addEventListener('submit', function(event) {
  event.preventDefault(); // Prevents the default form submission behavior
  formResponse.style.display = 'block'; // Displays the response message
  contactForm.reset();

  // Scroll to the bottom of the page
  window.scrollTo({
    top: document.body.scrollHeight,
    behavior: 'smooth'
  });

  setTimeout(function() {
    formResponse.style.transition = 'opacity 1s';
    formResponse.style.opacity = 0; // Make the message fade out
  }, 2000);


  setTimeout(function() {
    window.scrollBy({
      top: -70, // Scroll up by 30px
      behavior: 'smooth'
    });
  }, 2400); // Wait for the fade-out to complete before scrolling up
}, 2000);
