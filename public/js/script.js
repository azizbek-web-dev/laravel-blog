// DOM Elements
const hamburger = document.querySelector('.hamburger');
const navMenu = document.querySelector('.nav-menu');
const searchInput = document.querySelector('.search-input');
const searchBtn = document.querySelector('.search-btn');
const themeToggle = document.querySelector('.theme-toggle');
const body = document.body;
const postCards = document.querySelectorAll('.post-card');
const viewAllBtn = document.querySelector('.view-all-btn');
const subscribeBtn = document.querySelector('.subscribe-btn');
const newsletterInput = document.querySelector('.newsletter-input');

// Mobile navigation actions elements
const mobileSearchInput = document.querySelector('.mobile-nav .search-input');
const mobileSearchBtn = document.querySelector('.mobile-nav .search-btn');
const mobileThemeToggle = document.querySelector('.mobile-nav .theme-toggle');

// Theme toggle elements
const desktopThemeToggle = document.getElementById('desktop-theme-toggle');
const mobileThemeToggleBtn = document.getElementById('mobile-theme-toggle');
const mobileNavThemeToggle = document.getElementById('mobile-nav-theme-toggle');

// Mobile Menu Toggle
if (hamburger && navMenu) {
    hamburger.addEventListener('click', () => {
        hamburger.classList.toggle('active');
        
        // Toggle mobile navigation instead of nav-menu
        const mobileNav = document.querySelector('.mobile-nav');
        if (mobileNav) {
            mobileNav.classList.toggle('active');
            
            // Prevent body scroll when mobile nav is open
            if (mobileNav.classList.contains('active')) {
                body.style.overflow = 'hidden';
                // Add backdrop for mobile menu
                addMobileBackdrop();
            } else {
                body.style.overflow = '';
                removeMobileBackdrop();
            }
        }
    });
}

// Add mobile backdrop
function addMobileBackdrop() {
    const backdrop = document.querySelector('.mobile-backdrop');
    if (backdrop) return; // Don't create multiple backdrops
    
    const newBackdrop = document.createElement('div');
    newBackdrop.className = 'mobile-backdrop';
    newBackdrop.style.cssText = `
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        z-index: 1000;
        opacity: 0;
        transition: opacity 0.3s ease;
    `;
    
    newBackdrop.addEventListener('click', () => {
        closeMobileMenu();
    });
    
    document.body.appendChild(newBackdrop);
    
    // Fade in backdrop
    setTimeout(() => {
        newBackdrop.style.opacity = '1';
    }, 10);
}

// Remove mobile backdrop
function removeMobileBackdrop() {
    const backdrop = document.querySelector('.mobile-backdrop');
    if (backdrop) {
        backdrop.style.opacity = '0';
        setTimeout(() => {
            if (backdrop.parentNode) {
                backdrop.remove();
            }
        }, 300);
    }
}

// Close mobile menu function
function closeMobileMenu() {
    if (hamburger) {
        hamburger.classList.remove('active');
        body.style.overflow = '';
        removeMobileBackdrop();
        
        // Close mobile navigation
        const mobileNav = document.querySelector('.mobile-nav');
        if (mobileNav) {
            mobileNav.classList.remove('active');
        }
    }
}

// Close mobile menu when clicking outside
document.addEventListener('click', (e) => {
    const mobileNav = document.querySelector('.mobile-nav');
    if (hamburger && mobileNav && !hamburger.contains(e.target) && !mobileNav.contains(e.target)) {
        closeMobileMenu();
    }
});

// Mobile Navigation Actions Event Listeners
if (mobileSearchInput && mobileSearchBtn) {
    // Mobile search functionality
    mobileSearchBtn.addEventListener('click', () => {
        const query = mobileSearchInput.value.trim();
        if (query) {
            performSearch(query);
        }
    });
    
    mobileSearchInput.addEventListener('keypress', (e) => {
        if (e.key === 'Enter') {
            const query = mobileSearchInput.value.trim();
            if (query) {
                performSearch(query);
            }
        }
    });
}

if (mobileThemeToggle) {
    // Mobile theme toggle functionality
    mobileThemeToggle.addEventListener('click', () => {
        toggleTheme();
        // Close mobile menu after theme toggle
        closeMobileMenu();
    });
}

// Close mobile menu when clicking on nav links and update active state
const navLinks = document.querySelectorAll('.nav-link, .mobile-nav-link');
if (navLinks.length > 0) {
    navLinks.forEach(link => {
        link.addEventListener('click', (e) => {
            closeMobileMenu();
            
            // Update active state immediately for better UX
            updateNavigationActiveState(link);
        });
    });
}

// Close mobile menu on escape key
document.addEventListener('keydown', (e) => {
    const mobileNav = document.querySelector('.mobile-nav');
    if (e.key === 'Escape' && mobileNav && mobileNav.classList.contains('active')) {
        closeMobileMenu();
    }
});

// Handle window resize
window.addEventListener('resize', () => {
    if (window.innerWidth > 768 && navMenu && navMenu.classList.contains('active')) {
        closeMobileMenu();
    }
});

// Search Functionality
if (searchBtn && searchInput) {
    searchBtn.addEventListener('click', () => {
        const query = searchInput.value.trim();
        if (query) {
            performSearch(query);
        } else {
            showSearchNotification('Please enter a search term', 'error');
        }
    });

    searchInput.addEventListener('keypress', (e) => {
        if (e.key === 'Enter') {
            const query = searchInput.value.trim();
            if (query) {
                performSearch(query);
            } else {
                showSearchNotification('Please enter a search term', 'error');
            }
        }
    });

    // Enhanced search with debouncing
    let searchTimeout;
    searchInput.addEventListener('input', (e) => {
        clearTimeout(searchTimeout);
        const query = e.target.value.trim();
        
        if (query.length >= 2) {
            searchTimeout = setTimeout(() => {
                performSearch(query);
            }, 500);
        } else if (query.length === 0) {
            clearSearchResults();
        }
    });
}

function performSearch(query) {
    // Clear previous results
    clearSearchResults();
    
    // Search in post titles, categories, and content
    const searchResults = [];
    const searchableElements = document.querySelectorAll('.post-title, .post-category, .post-meta');
    
    searchableElements.forEach(element => {
        const text = element.textContent.toLowerCase();
        if (text.includes(query.toLowerCase())) {
            searchResults.push(element);
        }
    });
    
    if (searchResults.length > 0) {
        // Highlight search results
        highlightSearchResults(query, searchResults);
        showSearchNotification(`Found ${searchResults.length} result(s) for: "${query}"`);
        
        // Scroll to first result if not visible
        if (searchResults[0]) {
            searchResults[0].scrollIntoView({ 
                behavior: 'smooth', 
                block: 'center' 
            });
        }
    } else {
        showSearchNotification(`No results found for: "${query}"`, 'error');
    }
}

function highlightSearchResults(query, elements) {
    elements.forEach(element => {
        const originalText = element.textContent;
        const regex = new RegExp(`(${query})`, 'gi');
        const highlightedText = originalText.replace(regex, '<span class="search-highlight">$1</span>');
        
        if (element.innerHTML !== highlightedText) {
            element.innerHTML = highlightedText;
        }
    });
}

function clearSearchResults() {
    const highlights = document.querySelectorAll('.search-highlight');
    highlights.forEach(highlight => {
        const parent = highlight.parentNode;
        parent.replaceChild(document.createTextNode(highlight.textContent), highlight);
        parent.normalize();
    });
}

function showSearchNotification(message, type = 'success') {
    // Remove existing notifications
    const existingNotification = document.querySelector('.search-notification');
    if (existingNotification) {
        existingNotification.remove();
    }
    
    // Create new notification
    const notification = document.createElement('div');
    notification.className = `search-notification ${type}`;
    notification.textContent = message;
    
    document.body.appendChild(notification);
    
    // Show notification
    setTimeout(() => {
        notification.classList.add('show');
    }, 100);
    
    // Hide notification after 3 seconds
    setTimeout(() => {
        notification.classList.remove('show');
        setTimeout(() => {
            if (notification.parentNode) {
                notification.remove();
            }
        }, 300);
    }, 3000);
}

// Theme Toggle - Consolidated and Fixed
let isDarkTheme = false;

// Initialize theme toggle functionality
function initializeThemeToggle() {
    console.log('Initializing theme toggle...');
    
    // Get all theme toggle buttons
    const themeToggles = [desktopThemeToggle, mobileThemeToggleBtn, mobileNavThemeToggle].filter(Boolean);
    
    console.log('Found theme toggle buttons:', themeToggles.length);
    console.log('Desktop theme toggle:', desktopThemeToggle);
    console.log('Mobile theme toggle:', mobileThemeToggleBtn);
    console.log('Mobile nav theme toggle:', mobileNavThemeToggle);
    
    // Add event listeners to all theme toggle buttons
    themeToggles.forEach((toggle, index) => {
        if (toggle) {
            console.log(`Adding event listener to theme toggle ${index + 1}:`, toggle.id);
            toggle.addEventListener('click', (e) => {
                e.preventDefault();
                e.stopPropagation();
                console.log(`Theme toggle ${index + 1} clicked!`);
                toggleTheme();
            });
        }
    });
    
    // If no theme toggles found, try to find them by class
    if (themeToggles.length === 0) {
        console.log('No theme toggles found by ID, trying by class...');
        const fallbackToggles = document.querySelectorAll('.theme-toggle');
        console.log('Found fallback theme toggles:', fallbackToggles.length);
        
        fallbackToggles.forEach((toggle, index) => {
            console.log(`Adding fallback event listener to theme toggle ${index + 1}`);
            toggle.addEventListener('click', (e) => {
                e.preventDefault();
                e.stopPropagation();
                console.log(`Fallback theme toggle ${index + 1} clicked!`);
                toggleTheme();
            });
        });
    }
    
    // Load saved theme
    loadSavedTheme();
    
    // Add a global click handler to debug theme toggle clicks
    document.addEventListener('click', (e) => {
        if (e.target.closest('.theme-toggle')) {
            console.log('Theme toggle clicked via event delegation');
        }
    });
}

// Toggle theme function
function toggleTheme() {
    console.log('Toggling theme...');
    isDarkTheme = !isDarkTheme;
    
    if (isDarkTheme) {
        console.log('Switching to dark theme');
        body.classList.add('dark-theme');
        updateAllThemeIcons('moon');
        localStorage.setItem('theme', 'dark');
    } else {
        console.log('Switching to light theme');
        body.classList.remove('dark-theme');
        updateAllThemeIcons('sun');
        localStorage.setItem('theme', 'light');
    }
    
    updateCurrentThemeDisplay();
    console.log('Theme toggled successfully. isDarkTheme:', isDarkTheme);
}

// Update all theme icons
function updateAllThemeIcons(iconType) {
    console.log(`Updating all theme icons to: ${iconType}`);
    const themeToggles = [desktopThemeToggle, mobileThemeToggleBtn, mobileNavThemeToggle].filter(Boolean);
    themeToggles.forEach((toggle, index) => {
        if (toggle) {
            const icon = toggle.querySelector('i');
            if (icon) {
                icon.className = `fas fa-${iconType}`;
                console.log(`Updated icon ${index + 1} to: fas fa-${iconType}`);
            }
            toggle.setAttribute('data-theme', isDarkTheme ? 'dark' : 'light');
        }
    });
}

// Load saved theme
function loadSavedTheme() {
    const savedTheme = localStorage.getItem('theme');
    console.log('Loading saved theme:', savedTheme);
    
    if (savedTheme === 'dark') {
        isDarkTheme = true;
        body.classList.add('dark-theme');
        updateAllThemeIcons('moon');
        updateCurrentThemeDisplay();
        console.log('Loaded dark theme');
    } else {
        isDarkTheme = false;
        body.classList.remove('dark-theme');
        updateAllThemeIcons('sun');
        updateCurrentThemeDisplay();
        console.log('Loaded light theme');
    }
}

// Update current theme display
function updateCurrentThemeDisplay() {
    const themeDisplay = document.getElementById('current-theme');
    if (themeDisplay) {
        themeDisplay.textContent = isDarkTheme ? 'Dark' : 'Light';
    }
}

// Test theme toggle function
function testThemeToggle() {
    console.log('Test theme toggle called');
    toggleTheme();
    updateCurrentThemeDisplay();
}

// Post Card Interactions
if (postCards.length > 0) {
    postCards.forEach(card => {
        card.addEventListener('click', () => {
            // Add click effect
            card.style.transform = 'scale(0.98)';
            setTimeout(() => {
                card.style.transform = '';
            }, 150);
            
            // You can add navigation logic here
            console.log('Post clicked:', card.querySelector('.post-title')?.textContent);
        });
        
        // Add hover effects
        card.addEventListener('mouseenter', () => {
            card.style.transform = 'translateY(-5px)';
        });
        
        card.addEventListener('mouseleave', () => {
            card.style.transform = '';
        });
    });
}

// View All Posts Button
if (viewAllBtn) {
    viewAllBtn.addEventListener('click', () => {
        // Add click effect
        viewAllBtn.style.transform = 'scale(0.95)';
        setTimeout(() => {
            viewAllBtn.style.transform = '';
        }, 150);
        
        // You can add navigation logic here
        console.log('View All Posts clicked');
        showNotification('Loading all posts...', 'info');
    });
}

// Newsletter Subscription
if (subscribeBtn && newsletterInput) {
    subscribeBtn.addEventListener('click', () => {
        const email = newsletterInput.value.trim();
        
        if (!email) {
            showNotification('Please enter your email address', 'error');
            return;
        }
        
        if (!isValidEmail(email)) {
            showNotification('Please enter a valid email address', 'error');
            return;
        }
        
        // Simulate subscription
        subscribeBtn.textContent = 'Subscribing...';
        subscribeBtn.disabled = true;
        
        setTimeout(() => {
            showNotification('Successfully subscribed to newsletter!', 'success');
            newsletterInput.value = '';
            subscribeBtn.textContent = 'Subscribe';
            subscribeBtn.disabled = false;
        }, 1500);
    });

    newsletterInput.addEventListener('keypress', (e) => {
        if (e.key === 'Enter') {
            subscribeBtn.click();
        }
    });
}

function isValidEmail(email) {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
}

// Notification System
function showNotification(message, type = 'info') {
    const notification = document.createElement('div');
    notification.className = `notification notification-${type}`;
    notification.textContent = message;
    
    const colors = {
        info: '#007bff',
        success: '#28a745',
        error: '#dc3545',
        warning: '#ffc107'
    };
    
    notification.style.cssText = `
        position: fixed;
        top: 100px;
        right: 20px;
        background: ${colors[type]};
        color: white;
        padding: 12px 20px;
        border-radius: 5px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        z-index: 10000;
        animation: slideInRight 0.3s ease;
        max-width: 300px;
        word-wrap: break-word;
    `;
    
    document.body.appendChild(notification);
    
    // Auto remove after 4 seconds
    setTimeout(() => {
        notification.style.animation = 'slideOutRight 0.3s ease';
        setTimeout(() => notification.remove(), 300);
    }, 4000);
}

// Smooth Scrolling for Navigation Links
const anchorLinks = document.querySelectorAll('a[href^="#"]');
if (anchorLinks.length > 0) {
    anchorLinks.forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });
}

// Intersection Observer for Animations
const observerOptions = {
    threshold: 0.1,
    rootMargin: '0px 0px -50px 0px'
};

const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.classList.add('animate-in');
        }
    });
}, observerOptions);

// Observe elements for animation
const animatedElements = document.querySelectorAll('.post-card, .featured-post, .footer-column');
if (animatedElements.length > 0) {
    animatedElements.forEach(el => {
        observer.observe(el);
    });
}

// Lazy Loading for Images
function lazyLoadImages() {
    const images = document.querySelectorAll('img[data-src]');
    
    if (images.length > 0) {
        const imageObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    img.src = img.dataset.src;
                    img.classList.remove('lazy');
                    imageObserver.unobserve(img);
                }
            });
        });
        
        images.forEach(img => imageObserver.observe(img));
    }
}

// Initialize when DOM is loaded
document.addEventListener('DOMContentLoaded', () => {
    initializeThemeToggle(); // Initialize theme toggle first
    lazyLoadImages();
    
    // Add loading animation
    document.body.classList.add('loaded');
    
    // Initialize tooltips for better UX
    initializeTooltips();
    
    // Initialize navigation active state
    initializeNavigationActiveState();
    
    // Debug: Log current navigation state
    console.log('Navigation initialized. Current path:', window.location.pathname);
});

// Navigation Active State Management
function initializeNavigationActiveState() {
    const currentPath = window.location.pathname;
    const navLinks = document.querySelectorAll('.nav-link');
    
    // Remove all active classes first
    navLinks.forEach(link => {
        link.classList.remove('active');
    });
    
    // Determine which navigation item should be active based on current path
    let activeLink = null;
    
    // More robust route matching
    if (currentPath === '/' || currentPath === '/home') {
        // Home page
        activeLink = document.querySelector('a[href*="home"]');
    } else if (currentPath === '/blog' || currentPath.startsWith('/blog/')) {
        // Blog page or blog-related pages
        activeLink = document.querySelector('a[href*="blog"]');
    } else if (currentPath === '/post' || currentPath.startsWith('/post/')) {
        // Single post page or post-related pages
        activeLink = document.querySelector('a[href*="single-post"]');
    } else if (currentPath === '/authors' || currentPath.startsWith('/authors/')) {
        // Authors page or author-related pages
        activeLink = document.querySelector('a[href*="authors"]');
    } else if (currentPath === '/contact' || currentPath.startsWith('/contact/')) {
        // Contact page or contact-related pages
        activeLink = document.querySelector('a[href*="contact"]');
    } else if (currentPath === '/about' || currentPath.startsWith('/about/')) {
        // About page or about-related pages
        activeLink = document.querySelector('a[href*="about"]');
    } else if (currentPath === '/terms' || currentPath.startsWith('/terms/')) {
        // Terms page or terms-related pages
        activeLink = document.querySelector('a[href*="terms"]');
    } else if (currentPath === '/privacy' || currentPath.startsWith('/privacy/')) {
        // Privacy page or privacy-related pages
        activeLink = document.querySelector('a[href*="privacy"]');
    } else if (currentPath === '/cookie-policy' || currentPath.startsWith('/cookie-policy/')) {
        // Cookie policy page or related pages
        activeLink = document.querySelector('a[href*="cookie-policy"]');
    }
    
    // Add active class to the current page's navigation link
    if (activeLink) {
        activeLink.classList.add('active');
    }
    
    // Fallback: if no exact match, try to find the best match
    if (!activeLink) {
        const bestMatch = findBestNavigationMatch(currentPath);
        if (bestMatch) {
            bestMatch.classList.add('active');
        }
    }
}

// Helper function to find the best navigation match for a given path
function findBestNavigationMatch(path) {
    const navLinks = document.querySelectorAll('.nav-link');
    let bestMatch = null;
    let bestScore = 0;
    
    navLinks.forEach(link => {
        const href = link.getAttribute('href');
        if (href) {
            // Extract route name from href
            const routeName = href.split('/').pop() || href.split('/').slice(-2).join('/');
            const pathSegments = path.split('/').filter(segment => segment.length > 0);
            
            // Calculate similarity score
            let score = 0;
            pathSegments.forEach(segment => {
                if (href.includes(segment) || routeName.includes(segment)) {
                    score += 1;
                }
            });
            
            if (score > bestScore) {
                bestScore = score;
                bestMatch = link;
            }
        }
    });
    
    return bestMatch;
}

// Function to update navigation active state when clicking on links
function updateNavigationActiveState(clickedLink) {
    // Remove active class from all navigation links
    const navLinks = document.querySelectorAll('.nav-link');
    navLinks.forEach(link => {
        link.classList.remove('active');
    });
    
    // Add active class to the clicked link
    if (clickedLink) {
        clickedLink.classList.add('active');
    }
}

// Handle browser back/forward buttons
window.addEventListener('popstate', () => {
    // Re-initialize navigation active state when browser history changes
    setTimeout(() => {
        initializeNavigationActiveState();
    }, 100);
});

// Handle navigation state changes for SPA-like behavior
function handleNavigationStateChange() {
    // Update navigation active state
    initializeNavigationActiveState();
    
    // Log navigation change for debugging
    console.log('Navigation state updated:', window.location.pathname);
}

// Listen for route changes (useful for SPA frameworks)
if (typeof window.history.pushState === 'function') {
    const originalPushState = window.history.pushState;
    window.history.pushState = function(...args) {
        originalPushState.apply(this, args);
        setTimeout(handleNavigationStateChange, 100);
    };
}

// Tooltip System
function initializeTooltips() {
    const tooltipElements = document.querySelectorAll('[data-tooltip]');
    
    if (tooltipElements.length > 0) {
        tooltipElements.forEach(element => {
            element.addEventListener('mouseenter', showTooltip);
            element.addEventListener('mouseleave', hideTooltip);
        });
    }
}

function showTooltip(e) {
    const tooltipText = e.target.dataset.tooltip;
    const tooltip = document.createElement('div');
    tooltip.className = 'tooltip';
    tooltip.textContent = tooltipText;
    
    tooltip.style.cssText = `
        position: absolute;
        background: #333;
        color: white;
        padding: 8px 12px;
        border-radius: 4px;
        font-size: 12px;
        z-index: 10000;
        pointer-events: none;
        white-space: nowrap;
        box-shadow: 0 2px 8px rgba(0,0,0,0.2);
    `;
    
    document.body.appendChild(tooltip);
    
    const rect = e.target.getBoundingClientRect();
    tooltip.style.left = rect.left + (rect.width / 2) - (tooltip.offsetWidth / 2) + 'px';
    tooltip.style.top = rect.top - tooltip.offsetHeight - 8 + 'px';
    
    e.target.tooltip = tooltip;
}

function hideTooltip(e) {
    if (e.target.tooltip) {
        e.target.tooltip.remove();
        e.target.tooltip = null;
    }
}

// Performance Optimization: Debounce function
function debounce(func, wait) {
    let timeout;
    return function executedFunction(...args) {
        const later = () => {
            clearTimeout(timeout);
            func(...args);
        };
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
    };
}

// Optimize scroll events
const optimizedScrollHandler = debounce(() => {
    // Add scroll-based animations or effects here
    const scrolled = window.pageYOffset;
    const header = document.querySelector('.header');
    
    if (header && scrolled > 100) {
        header.classList.add('scrolled');
    } else if (header) {
        header.classList.remove('scrolled');
    }
}, 10);

window.addEventListener('scroll', optimizedScrollHandler);

// Add CSS animations
const style = document.createElement('style');
style.textContent = `
    @keyframes slideInRight {
        from { transform: translateX(100%); opacity: 0; }
        to { transform: translateX(0); opacity: 1; }
    }
    
    @keyframes slideOutRight {
        from { transform: translateX(0); opacity: 1; }
        to { transform: translateX(100%); opacity: 0; }
    }
    
    .search-highlight {
        background: #ffeb3b;
        padding: 2px 4px;
        border-radius: 3px;
        font-weight: bold;
    }
    
    .animate-in {
        animation: fadeInUp 0.6s ease forwards;
    }
    
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(30px); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    .header.scrolled {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
    }
    
    .dark-theme {
        background: #1a1a1a;
        color: #ffffff;
    }
    
    .dark-theme .header {
        background: #2d2d2d;
        box-shadow: 0 2px 10px rgba(0,0,0,0.3);
    }
    
    .dark-theme .post-card {
        background: #2d2d2d;
        color: #ffffff;
    }
    
    .dark-theme .footer {
        background: #1a1a1a;
    }
    
    .lazy {
        opacity: 0;
        transition: opacity 0.3s;
    }
    
    .lazy.loaded {
        opacity: 1;
    }
    
    .tooltip {
        animation: fadeIn 0.2s ease;
    }
    
    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }
`;

document.head.appendChild(style);

// FAQ Functionality for Contact Page
document.addEventListener('DOMContentLoaded', function() {
    console.log('DOM loaded, initializing FAQ functionality...');
    
    // Wait a bit for all elements to be ready
    setTimeout(() => {
        const faqItems = document.querySelectorAll('.faq-item');
        console.log('Found FAQ items:', faqItems.length);
        
        if (faqItems.length > 0) {
            faqItems.forEach((item, index) => {
                const question = item.querySelector('.faq-question');
                const answer = item.querySelector('.faq-answer');
                const icon = item.querySelector('.faq-question i');
                
                console.log(`FAQ item ${index + 1}:`, { question: !!question, answer: !!answer, icon: !!icon });
                
                if (question && answer && icon) {
                    // Initially hide all answers
                    answer.style.display = 'none';
                    
                    // Add click event to question
                    question.addEventListener('click', function(e) {
                        console.log('FAQ question clicked:', index + 1);
                        e.preventDefault();
                        e.stopPropagation();
                        
                        const isOpen = answer.style.display === 'block';
                        
                        // Close all other FAQ items
                        faqItems.forEach((otherItem, otherIndex) => {
                            if (otherIndex !== index) {
                                const otherAnswer = otherItem.querySelector('.faq-answer');
                                const otherIcon = otherItem.querySelector('.faq-question i');
                                if (otherAnswer && otherIcon) {
                                    otherAnswer.style.display = 'none';
                                    otherIcon.style.transform = 'rotate(0deg)';
                                    otherIcon.className = 'fas fa-chevron-down';
                                }
                            }
                        });
                        
                        // Toggle current item
                        if (isOpen) {
                            answer.style.display = 'none';
                            icon.style.transform = 'rotate(0deg)';
                            icon.className = 'fas fa-chevron-down';
                            console.log('FAQ closed:', index + 1);
                        } else {
                            answer.style.display = 'block';
                            icon.style.transform = 'rotate(180deg)';
                            icon.className = 'fas fa-chevron-up';
                            console.log('FAQ opened:', index + 1);
                        }
                    });
                    
                    // Add hover effect to question
                    question.style.cursor = 'pointer';
                    
                    // Also add click event to the icon itself
                    icon.addEventListener('click', function(e) {
                        e.preventDefault();
                        e.stopPropagation();
                        question.click(); // Trigger the question click event
                    });
                }
            });
            
            console.log('FAQ functionality initialized successfully');
        } else {
            console.log('No FAQ items found on this page');
        }
    }, 100);
});

// Contact Form Handling
document.addEventListener('DOMContentLoaded', function() {
    const contactForm = document.getElementById('contactForm');
    
    if (contactForm) {
        contactForm.addEventListener('submit', function(e) {
            // Get form data
            const formData = new FormData(contactForm);
            const firstName = formData.get('first_name');
            const lastName = formData.get('last_name');
            const email = formData.get('email');
            const subject = formData.get('subject');
            const message = formData.get('message');
            
            // Simple validation
            if (!firstName || !lastName || !email || !subject || !message) {
                showNotification('Please fill in all required fields.', 'error');
                e.preventDefault();
                return;
            }
            
            if (!isValidEmail(email)) {
                showNotification('Please enter a valid email address.', 'error');
                e.preventDefault();
                return;
            }
            
            // Form to'g'ri bo'lsa, Laravel'ga yubor
            const submitBtn = contactForm.querySelector('.submit-btn');
            const originalText = submitBtn.innerHTML;
            
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Sending...';
            submitBtn.disabled = true;
            
            // Form yuborilgandan keyin button'ni tikla
            setTimeout(() => {
                submitBtn.innerHTML = originalText;
                submitBtn.disabled = false;
            }, 1000);
        });
    }
});

// Email validation function
function isValidEmail(email) {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
}

// Notification system
function showNotification(message, type = 'info') {
    // Remove existing notifications
    const existingNotifications = document.querySelectorAll('.notification');
    existingNotifications.forEach(notification => notification.remove());
    
    const notification = document.createElement('div');
    notification.className = `notification notification-${type}`;
    notification.innerHTML = `
        <div class="notification-content">
            <i class="fas ${type === 'success' ? 'fa-check-circle' : type === 'error' ? 'fa-exclamation-circle' : 'fa-info-circle'}"></i>
            <span>${message}</span>
        </div>
        <button class="notification-close">
            <i class="fas fa-times"></i>
        </button>
    `;
    
    document.body.appendChild(notification);
    
    // Close button functionality
    const closeBtn = notification.querySelector('.notification-close');
    closeBtn.addEventListener('click', () => {
        notification.style.animation = 'slideOutRight 0.3s ease';
        setTimeout(() => notification.remove(), 300);
    });
    
    // Auto-remove after 5 seconds
    setTimeout(() => {
        if (notification.parentNode) {
            notification.style.animation = 'slideOutRight 0.3s ease';
            setTimeout(() => notification.remove(), 300);
        }
    }, 5000);
}

// Search Functionality
document.addEventListener('DOMContentLoaded', function() {
    const searchInputs = document.querySelectorAll('.search-input');
    const searchBtns = document.querySelectorAll('.search-btn');
    
    searchInputs.forEach((input, index) => {
        const searchBtn = searchBtns[index];
        
        // Search input focus
        input.addEventListener('focus', function() {
            this.parentElement.style.borderColor = '#007bff';
            this.parentElement.style.boxShadow = '0 0 0 3px rgba(0, 123, 255, 0.1)';
        });
        
        // Search input blur
        input.addEventListener('blur', function() {
            this.parentElement.style.borderColor = '#e9ecef';
            this.parentElement.style.boxShadow = 'none';
        });
        
        // Search button click
        if (searchBtn) {
            searchBtn.addEventListener('click', function() {
                performSearch(input.value);
            });
        }
        
        // Enter key press
        input.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                performSearch(this.value);
            }
        });
    });
});

// Perform search function
function performSearch(query) {
    if (!query.trim()) {
        showNotification('Please enter a search term.', 'error');
        return;
    }
    
    // Show search notification
    showNotification(`Searching for: "${query}"`, 'info');
    
    // Simulate search (you can replace this with actual search functionality)
    setTimeout(() => {
        // Redirect to blog page with search query
        const currentUrl = new URL(window.location);
        if (currentUrl.pathname === '/blog') {
            // If already on blog page, just show results
            showNotification(`Found 5 results for: "${query}"`, 'success');
        } else {
            // Redirect to blog page with search
            window.location.href = `/blog?search=${encodeURIComponent(query)}`;
        }
    }, 1000);
}

// Newsletter Subscription
document.addEventListener('DOMContentLoaded', function() {
    const newsletterForm = document.querySelector('.newsletter-form');
    const newsletterInput = document.querySelector('.newsletter-input');
    const subscribeBtn = document.querySelector('.subscribe-btn');
    
    if (newsletterForm && newsletterInput && subscribeBtn) {
        // Subscribe button click
        subscribeBtn.addEventListener('click', function(e) {
            e.preventDefault();
            subscribeToNewsletter();
        });
        
        // Enter key press
        newsletterInput.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                subscribeToNewsletter();
            }
        });
    }
});

// Newsletter subscription function
function subscribeToNewsletter() {
    const newsletterInput = document.querySelector('.newsletter-input');
    const email = newsletterInput.value.trim();
    
    if (!email) {
        showNotification('Please enter your email address.', 'error');
        return;
    }
    
    if (!isValidEmail(email)) {
        showNotification('Please enter a valid email address.', 'error');
        return;
    }
    
    // Show loading state
    const subscribeBtn = document.querySelector('.subscribe-btn');
    const originalText = subscribeBtn.innerHTML;
    subscribeBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Subscribing...';
    subscribeBtn.disabled = true;
    
    // Send AJAX request to backend
    fetch('/newsletter/subscribe', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({ email: email })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showNotification(data.message, 'success');
            newsletterInput.value = '';
        } else {
            showNotification(data.message, 'error');
        }
    })
    .catch(error => {
        showNotification('Something went wrong. Please try again.', 'error');
        console.error('Error:', error);
    })
    .finally(() => {
        subscribeBtn.innerHTML = originalText;
        subscribeBtn.disabled = false;
    });
}

// Theme toggle functionality is now handled by the consolidated code above

