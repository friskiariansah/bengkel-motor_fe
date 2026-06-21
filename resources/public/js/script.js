// script.js - Responsive Logic & Theme Management for Project Servis Motor

document.addEventListener('DOMContentLoaded', () => {
    
    // --- 1. Theme Management (Dark / Light Mode) ---
    const themeToggleBtn = document.getElementById('theme-toggle');
    
    // Check local storage for theme, or default to light
    const currentTheme = localStorage.getItem('theme') || 'light';
    document.documentElement.setAttribute('data-theme', currentTheme);
    
    if (themeToggleBtn) {
        themeToggleBtn.addEventListener('click', () => {
            let activeTheme = document.documentElement.getAttribute('data-theme');
            let newTheme = 'light';
            
            if (activeTheme === 'light') {
                newTheme = 'dark';
            }
            
            document.documentElement.setAttribute('data-theme', newTheme);
            localStorage.setItem('theme', newTheme);
        });
    }

    // --- 2. Navbar Scrolling Effects ---
    const navbar = document.getElementById('navbar');
    
    const checkScroll = () => {
        if (window.scrollY > 20) {
            navbar.classList.add('scrolled');
        } else {
            navbar.classList.remove('scrolled');
        }
    };
    
    window.addEventListener('scroll', checkScroll);
    checkScroll(); // Run initially

    // --- 3. Mobile Navigation Menu Toggle ---
    const menuBtn = document.getElementById('menu-btn');
    const navMenu = document.getElementById('nav-menu');
    
    if (menuBtn && navMenu) {
        menuBtn.addEventListener('click', () => {
            // Toggle active visual state
            if (navMenu.style.display === 'flex') {
                navMenu.style.display = 'none';
            } else {
                navMenu.style.display = 'flex';
                navMenu.style.flexDirection = 'column';
                navMenu.style.position = 'absolute';
                navMenu.style.top = '80px';
                navMenu.style.left = '0';
                navMenu.style.width = '100%';
                navMenu.style.backgroundColor = 'var(--bg-secondary)';
                navMenu.style.padding = '20px';
                navMenu.style.borderBottom = '1px solid var(--border-color)';
                navMenu.style.gap = '16px';
                navMenu.style.zIndex = '99';
            }
        });
    }

    // --- 4. Active Link Highlighting based on Page URL (Handled in Blade, disabled in JS) ---
    /*
    const currentPath = window.location.pathname.split('/').pop() || 'index.php';
    const navLinks = document.querySelectorAll('.nav-link');
    
    navLinks.forEach(link => {
        const linkPath = link.getAttribute('href').split('#')[0];
        
        // Remove active class first
        link.classList.remove('active');
        
        // Match exact or contains path
        if (currentPath === linkPath || (currentPath === '' && linkPath === 'index.php')) {
            link.classList.add('active');
        }
    });
    */

    // --- 5. Interactive Scrolling Spy for Landing Page Anchors ---
    const sections = document.querySelectorAll('section[id], header[id]');
    
    const scrollSpy = () => {
        const path = window.location.pathname;
        const isHome = path.endsWith('/') || path.endsWith('index.php') || path.endsWith('public');
        if (!isHome) return;
        
        const scrollY = window.pageYOffset;
        
        sections.forEach(current => {
            const sectionHeight = current.offsetHeight;
            const sectionTop = current.offsetTop - 100;
            const sectionId = current.getAttribute('id');
            
            if (scrollY > sectionTop && scrollY <= sectionTop + sectionHeight) {
                document.querySelector('.nav-menu a[href*=' + sectionId + ']')?.classList.add('active');
                // Remove active from others
                document.querySelectorAll('.nav-menu a:not([href*=' + sectionId + '])').forEach(el => {
                    if (el.getAttribute('href').includes('#')) {
                        el.classList.remove('active');
                    }
                });
            }
        });
    };
    
    window.addEventListener('scroll', scrollSpy);
    
    // --- 6. Quick Copy Booking Code Helper ---
    const successCodeBox = document.querySelector('.success-code-box');
    if (successCodeBox) {
        successCodeBox.style.cursor = 'pointer';
        successCodeBox.title = 'Klik untuk menyalin kode booking';
        
        successCodeBox.addEventListener('click', () => {
            const codeText = successCodeBox.innerText.trim();
            navigator.clipboard.writeText(codeText).then(() => {
                const originalText = successCodeBox.innerText;
                successCodeBox.innerText = 'Tersalin!';
                successCodeBox.style.borderColor = '#4ade80';
                successCodeBox.style.color = '#4ade80';
                
                setTimeout(() => {
                    successCodeBox.innerText = originalText;
                    successCodeBox.style.borderColor = 'var(--accent)';
                    successCodeBox.style.color = 'var(--accent)';
                }, 1500);
            });
        });
    }
});
