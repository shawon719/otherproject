// Handle mobile menu toggle
const hamburger = document.getElementById('hamburger');
const mobileMenu = document.getElementById('mobileMenu');

hamburger.addEventListener('click', () => {
    mobileMenu.classList.toggle('hidden');
});

// Handle desktop dropdown hover
const dropdownButtons = document.querySelectorAll('.group');
dropdownButtons.forEach(dropdown => {
    dropdown.addEventListener('mouseover', () => {
        const dropdownContent = dropdown.querySelector('.dropdown-content');
        dropdownContent.classList.remove('hidden');
    });

    dropdown.addEventListener('mouseleave', () => {
        const dropdownContent = dropdown.querySelector('.dropdown-content');
        dropdownContent.classList.add('hidden');
    });
});

// Handle mobile dropdown click
const mobileDropdownButtons = document.querySelectorAll('#mobileMenu .relative > #button');
mobileDropdownButtons.forEach(button => {
    button.addEventListener('click', () => {
        const dropdownContent = button.nextElementSibling;
        dropdownContent.classList.toggle('hidden');
    });
});


// handle theme toggle 
const handleToggleBtn = () => {
    const darkModeEnabeld = document.body.classList.toggle('dark');

    // set theme in local storage 
    localStorage.setItem('theme', darkModeEnabeld ? 'dark' : 'light');
}


window.addEventListener('DOMContentLoaded', () => {
    // Check if the theme is saved in localStorage
    const savedTheme = localStorage.getItem('theme');

    // Apply the saved theme if it exists
    if (savedTheme === 'dark') {
        document.body.classList.add('dark');
    } else {
        document.body.classList.remove('dark');
    }
});


// success toast 
// Automatically hide the success message after 2 seconds
setTimeout(function () {
    const successMessage = document.getElementById('successMessage');
    if (successMessage) {
        successMessage.classList.remove('toast-visible');
        successMessage.classList.add('toast-hidden');
    }
}, 2000);
