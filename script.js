/* layer of login */

const state = {
  currentUser: null,
  cart: [],
  wishlist: [],
};

function openAuthModal() {
  document.getElementById("authModal").classList.add("active");
  switchTab("login");
}

function closeModal(id) {
  document.getElementById(id).classList.remove("active");
}

function switchTab(tab) {
  document.getElementById("loginTab").classList.remove("active");
  document.getElementById("signupTab").classList.remove("active");
  document.querySelectorAll(".tab-btn").forEach(btn => btn.classList.remove("active"));

  if (tab === "login") {
    document.getElementById("loginTab").classList.add("active");
    document.querySelectorAll(".tab-btn")[0].classList.add("active");
  } else {
    document.getElementById("signupTab").classList.add("active");
    document.querySelectorAll(".tab-btn")[1].classList.add("active");
  }
}
/*cursor*/

const cursor = document.querySelector('.custom-cursor');
    const cursorTrail = document.querySelector('.cursor-trail');
    
    let mouseX = 0;
    let mouseY = 0;
    let trailX = 0;
    let trailY = 0;
    
    // Use transform for better performance
    function updateCursor() {
      cursor.style.transform = `translate(${mouseX}px, ${mouseY}px) translate(-50%, -50%)`;
    }
    
    function updateTrail() {
      trailX += (mouseX - trailX) * 0.15;
      trailY += (mouseY - trailY) * 0.15;
      cursorTrail.style.transform = `translate(${trailX}px, ${trailY}px) translate(-50%, -50%)`;
    }

    // Throttled mouse move for better performance
    let ticking = false;
    
    document.addEventListener('mousemove', (e) => {
      mouseX = e.clientX;
      mouseY = e.clientY;
      
      if (!ticking) {
        requestAnimationFrame(() => {
          updateCursor();
          ticking = false;
        });
        ticking = true;
      }
    });

    // Smooth trail animation loop
    function animate() {
      updateTrail();
      requestAnimationFrame(animate);
    }
    animate();

    // Optimized hover effects - use event delegation
    document.addEventListener('mouseover', (e) => {
      if (e.target.matches('button, a, .dropdown-btn, .auth-btn, .hero-cta, .cart-btn, [onclick]')) {
        cursor.classList.add('hover');
      }
    });
    
    document.addEventListener('mouseout', (e) => {
      if (e.target.matches('button, a, .dropdown-btn, .auth-btn, .hero-cta, .cart-btn, [onclick]')) {
        cursor.classList.remove('hover');
      }
    });

    // Click effects
    document.addEventListener('mousedown', () => cursor.classList.add('click'));
    document.addEventListener('mouseup', () => cursor.classList.remove('click'));

    // Visibility handling
    document.addEventListener('mouseleave', () => {
      cursor.style.opacity = '0';
      cursorTrail.style.opacity = '0';
    });

    document.addEventListener('mouseenter', () => {
      cursor.style.opacity = '1';
      cursorTrail.style.opacity = '1';
    });

// Mobile menu toggle functionality
function toggleMobileMenu() {
    const navMenu = document.querySelector('.nav-menu');
    const toggle = document.querySelector('.mobile-menu-toggle');
    
    navMenu.classList.toggle('active');
    
    // Animate hamburger menu
    const spans = toggle.querySelectorAll('span');
    if (navMenu.classList.contains('active')) {
        spans[0].style.transform = 'rotate(45deg) translate(5px, 5px)';
        spans[1].style.opacity = '0';
        spans[2].style.transform = 'rotate(-45deg) translate(7px, -6px)';
    } else {
        spans[0].style.transform = 'none';
        spans[1].style.opacity = '1';
        spans[2].style.transform = 'none';
    }
}

// Close mobile menu when clicking outside
document.addEventListener('click', function(event) {
    const navMenu = document.querySelector('.nav-menu');
    const toggle = document.querySelector('.mobile-menu-toggle');
    
    if (!navMenu.contains(event.target) && !toggle.contains(event.target)) {
        navMenu.classList.remove('active');
        const spans = toggle.querySelectorAll('span');
        spans[0].style.transform = 'none';
        spans[1].style.opacity = '1';
        spans[2].style.transform = 'none';
    }
});

// Close mobile menu when window is resized to desktop
window.addEventListener('resize', function() {
    if (window.innerWidth > 768) {
        const navMenu = document.querySelector('.nav-menu');
        const toggle = document.querySelector('.mobile-menu-toggle');
        navMenu.classList.remove('active');
        
        const spans = toggle.querySelectorAll('span');
        spans[0].style.transform = 'none';
        spans[1].style.opacity = '1';
        spans[2].style.transform = 'none';
    }
})
