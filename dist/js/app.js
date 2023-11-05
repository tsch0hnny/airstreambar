const menuClassesHide = ['opacity-0', 'h-0', 'hidden'];
const menuClassesShow = ['opacity-1', 'h-[calc(100dvh-5rem)]'];
// const menuItemClasses = ['duration-500', 'delay-']
const menuItems = document.querySelectorAll('.menu-items > *');

const menu = document.querySelector('#menu-container');
const hamburgerMenu = document.querySelector('.hamburger-menu');

// Retrieve the state from localStorage or default to false
let menuOpenState = localStorage.getItem('menuOpenState') === 'true';

// Toggle the value of menuOpenState and dispatch an event
function toggleMenuOpenState() {
    menuOpenState = !menuOpenState;
    // Save the new state to localStorage
    localStorage.setItem('menuOpenState', menuOpenState);
    document.dispatchEvent(new CustomEvent('menuOpenStateChanged', { detail: menuOpenState }));
}

// Event listener for DOMContentLoaded
document.addEventListener('DOMContentLoaded', (event) => {
    if (menuOpenState) {
        menu.classList.add('open');
        hamburgerMenu.classList.add('open');
        menuItems.forEach((item, index) => {
            item.classList.remove('opacity-0');
        });
        menu.classList.remove(...menuClassesHide);
        menu.classList.add(...menuClassesShow);
    } else {
        menuItems.forEach((item, index) => {
            item.classList.add('opacity-0');
        });
    }
    // Remove the no-transition class to re-enable transitions after initial load
    setTimeout(() => {
        hamburgerMenu.classList.remove('no-transition');
        menu.classList.remove('no-transition');
    }, 400);

    console.log(`The menu is ${menuOpenState ? 'open' : 'closed'}.`);
});

function resetMenuItemsAnimation() {
    menuItems.forEach((item) => {
        item.classList.add('opacity-0')
        // item.style.transition = 'none';
    });
}

// Event listener for changes on menuOpenState
document.addEventListener('menuOpenStateChanged', (event) => {
    if (event.detail) {
        menu.classList.add(...menuClassesShow);
        menu.classList.remove(...menuClassesHide);
        hamburgerMenu.classList.add('open');
        animateMenuItems();
        console.log('The menu is now open.');
    } else {
        menu.classList.remove(...menuClassesShow);
        menu.classList.add(...menuClassesHide);
        hamburgerMenu.classList.remove('open');
        resetMenuItemsAnimation();
        console.log('The menu is now closed.');
    }
});

function animateMenuItems() {
    const menuItems = document.querySelectorAll('.menu-items > *');
    menuItems.forEach((item, index) => {
        // Clear any existing animations
        item.style.animation = '';
        // Set a timeout to stagger the animations
        setTimeout(() => {
            item.classList.add('fade-in');
            // You may want to adjust the time to control the stagger delay
            item.style.animationDelay = `${index * 100}ms`;
        }, 0); // Set to 0 if you want the animation to start immediately
        // item.classList.remove('opacity-0')
    });
}
// Menu click event listener
hamburgerMenu.addEventListener('click', function() {
    toggleMenuOpenState(); // This will toggle the state of the menu
});

//close the menu

function closeMenu() {
    if (menuOpenState) {
        // Start the closing animation
        hamburgerMenu.classList.remove('no-transition');
            hamburgerMenu.classList.remove('open');
            menu.classList.remove(...menuClassesShow);
            menu.classList.add(...menuClassesHide);
            toggleMenuOpenState();
    }
}







// THE ROUTER

document.addEventListener('DOMContentLoaded', () => {
    const mainContent = document.querySelector('.main-content');
  
    const navigate = (url, pushState = true) => {
      // Normalize the URL to include a leading slash for comparison
      let normalizedUrl = url.startsWith('/') ? url : '/' + url;
      // Add .php extension for fetching content
      let fetchUrl = normalizedUrl.endsWith('.php') ? normalizedUrl : `${normalizedUrl}.php`;
  
      // Avoid fetching if the current URL is the same as the requested URL
      if (window.location.pathname === normalizedUrl) return;
  
      fetch(fetchUrl, { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
        .then(response => response.text())
        .then(html => {
          mainContent.innerHTML = html;
          if (pushState) {
            // Use normalizedUrl without .php for the browser's address bar
            history.pushState({ content: html, url: normalizedUrl }, '', normalizedUrl);
          }
        })
        .catch(error => console.error('Error fetching content:', error));
    };
  
    // Initial pushState call
    history.replaceState({
      content: mainContent.innerHTML,
      url: window.location.pathname
    }, '', window.location.pathname);
  
    menuItems.forEach((menuItem) => {
      menuItem.addEventListener('click', function(e) {
        e.preventDefault();
        navigate(this.getAttribute('href'));
        setTimeout(() => {
            closeMenu();
        }, 250);
      });
    });
  
    window.addEventListener('popstate', (event) => {
      if (event.state && event.state.content) {
        mainContent.innerHTML = event.state.content;
        // Optional: Update any active styles on the navigation
      } else {
        // Load the default page content if no state is found
        navigate(window.location.pathname, false);
      }
    });
  });