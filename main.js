// categories button dynamic popover list 
document.addEventListener('DOMContentLoaded', function () {
    const categoryButton = document.getElementById('categoryButton');
    const popover = document.getElementById('popover');

    popover.style.display = 'none'
  
    // Show the popover directly below the button
    categoryButton.addEventListener('click', function () {
      const buttonRect = categoryButton.getBoundingClientRect();
      popover.style.top = `${buttonRect.bottom}px`;
      popover.style.left = `${buttonRect.left}px`;
      popover.style.display = popover.style.display === 'block' ? 'none' : 'block';
    });
  
    // Hide popover if clicked outside
    document.addEventListener('click', function (event) {
      if (!popover.contains(event.target) && !categoryButton.contains(event.target)) {
        popover.style.display = 'none';
      }
    });
  });
  