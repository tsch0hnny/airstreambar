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
  
    document.querySelectorAll('.menu-item').forEach(item => {
      item.addEventListener('click', function(e) {
        e.preventDefault();
        
        navigate(this.getAttribute('href'));
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