<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>DripNest</title>
  <style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    /* Custom Scrollbar Styles */
    ::-webkit-scrollbar {
        width: 12px;
    }

    ::-webkit-scrollbar-track {
        background: rgba(20, 20, 20, 0.8);
        border-radius: 10px;
        margin: 5px;
    }

    ::-webkit-scrollbar-thumb {
        background: linear-gradient(135deg, #333 0%, #666 50%, #999 100%);
        border-radius: 10px;
        border: 2px solid rgba(20, 20, 20, 0.8);
        transition: all 0.3s ease;
    }

    ::-webkit-scrollbar-thumb:hover {
        background: linear-gradient(135deg, #555 0%, #888 50%, #bbb 100%);
        box-shadow: 0 0 10px rgba(255, 255, 255, 0.2);
        transform: scale(1.1);
    }

    * {
        cursor: none;
    }
    
    .custom-cursor {
        position: fixed;
        top: 0;
        left: 0;
        width: 20px;
        height: 20px;
        background: rgba(255, 255, 255, 0.8);
        border: 2px solid rgba(255, 255, 255, 0.4);
        border-radius: 50%;
        pointer-events: none;
        z-index: 9999;
        transition: all 0.1s ease;
        transform: translate(-50%, -50%);
        backdrop-filter: blur(2px);
    }

    .cursor-trail {
        position: fixed;
        top: 0;
        left: 0;
        width: 8px;
        height: 8px;
        background: rgba(255, 255, 255, 0.3);
        border-radius: 50%;
        pointer-events: none;
        z-index: 9998;
        transition: all 0.15s ease;
        transform: translate(-50%, -50%);
    }

    .custom-cursor.hover {
        width: 40px;
        height: 40px;
        background: rgba(255, 255, 255, 0.1);
        border: 2px solid rgba(255, 255, 255, 0.8);
        backdrop-filter: blur(4px);
    }

    .custom-cursor.click {
        width: 15px;
        height: 15px;
        background: rgba(255, 255, 255, 1);
        border: 3px solid rgba(255, 255, 255, 0.6);
    }

    button:hover, a:hover, .dropdown-btn:hover, .auth-btn:hover, .hero-cta:hover {
        transform: translateY(-2px);
    }

    body {
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
        background: #0a0a0a;
        color: #ffffff;
        overflow-x: hidden;
        cursor: pointer;
    }

    .header {
        position: fixed;
        top: 0;
        width: 100%;
        padding: 20px;
        display: flex;
        justify-content: space-between;  
        align-items: center;
        background: rgba(10, 10, 10, 0.9);
        backdrop-filter: blur(20px);
        z-index: 1000;
        transition: all 0.3s ease;
    }

    .logo {
        font-size: 28px;
        font-weight: 700;
        letter-spacing: 2px;
    }

    .nav-menu {
        display: flex;
        align-items: center;
        gap: 40px;
    }

    .dropdown {
        position: relative;
    }

    .dropdown-btn {
        background: none;
        border: none;
        color: white;
        font-size: 16px;
        cursor: pointer;
        padding: 10px 0;
        display: flex;
        align-items: center;
        gap: 8px;
        transition: all 0.3s ease;
    }

    .dropdown-btn:hover {
        color: #888;
    }

    .dropdown-content {
        position: absolute;
        top: 100%;
        left: 0;
        background: rgba(20, 20, 20, 0.95);
        backdrop-filter: blur(20px);
        min-width: 200px;
        padding: 20px 0;
        border-radius: 15px;
        opacity: 0;
        visibility: hidden;
        transform: translateY(-10px);
        transition: all 0.3s ease;
        border: 1px solid #333;
    }

    .dropdown:hover .dropdown-content {
        opacity: 1;
        visibility: visible;
        transform: translateY(0);
    }

    .dropdown-item {
        padding: 12px 25px;
        cursor: pointer;
        transition: all 0.3s ease;
        border-left: 3px solid transparent;
        position: relative;
    }

    .dropdown-item:hover {
        background: rgba(255, 255, 255, 0.1);
        border-left-color: #ffffff;
    }

    .has-submenu {
        position: relative;
    }

    .has-submenu > span {
        display: flex;
        align-items: center;
        justify-content: space-between;
        width: 100%;
    }

    .submenu {
        position: absolute;
        left: 100%;
        top: 0;
        background: rgba(20, 20, 20, 0.95);
        backdrop-filter: blur(20px);
        min-width: 180px;
        padding: 15px 0;
        border-radius: 15px;
        opacity: 0;
        visibility: hidden;
        transform: translateX(-10px);
        transition: all 0.3s ease;
        border: 1px solid #333;
        z-index: 1001;
    }

    .has-submenu:hover .submenu {
        opacity: 1;
        visibility: visible;
        transform: translateX(0);
    }

    .submenu .dropdown-item {
        padding: 10px 20px;
        font-size: 14px;
    }

    .submenu .dropdown-item:hover {
        background: rgba(255, 255, 255, 0.15);
    }

    .auth-section {
        display: flex;
        align-items: center;
        gap: 20px;
    }

    .auth-btn {
        background: linear-gradient(135deg, #1a1a1a, #2a2a2a);
        color: white;
        border: 1px solid #333;
        padding: 12px 24px;
        border-radius: 25px;
        cursor: pointer;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        font-size: 14px;
        font-weight: 500;
        position: relative;
        overflow: hidden;
    }

    .auth-btn::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.1), transparent);
        transition: left 0.6s ease;
    }

    .auth-btn:hover::before {
        left: 100%;
    }

    .auth-btn:hover {
        background: linear-gradient(135deg, #2a2a2a, #3a3a3a);
        transform: translateY(-3px) scale(1.02);
        box-shadow: 0 8px 25px rgba(255, 255, 255, 0.1);
        border-color: #555;
    }

    .cart-btn {
        position: relative;
        background: linear-gradient(135deg, #1a1a1a, #2a2a2a);
        border: 2px solid #333;
        color: white;
        padding: 12px 16px;
        border-radius: 12px;
        cursor: pointer;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        overflow: visible;
    }

    .cart-btn:hover {
        border-color: #fff;
        transform: translateY(-3px) scale(1.05);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
    }

    .cart-icon {
        width: 20px;
        height: 20px;
        transition: transform 0.3s ease;
    }

    .cart-count {
        position: absolute;
        top: -12px;
        right: -12px;
        background: linear-gradient(135deg, #ff6b6b, #ff5252);
        color: #fff;
        border-radius: 50%;
        width: 26px;
        height: 26px;
        font-size: 13px;
        display: none;
        align-items: center;
        justify-content: center;
        font-weight: 800;
        animation: pulse 2s infinite;
        border: 3px solid #0a0a0a;
        z-index: 1001;
        box-shadow: 0 4px 12px rgba(255, 107, 107, 0.6);
    }

    @keyframes pulse {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.1); }
    }

    .hero {
        height: 100vh;
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, #0a0a0a 0%, #1a1a1a 100%);
        overflow: hidden;
    }

    .hero-content {
        text-align: center;
        z-index: 10;
        max-width: 800px;
        padding: 0 20px;
    }

    .hero h1 {
        font-size: 4rem;
        font-weight: 800;
        margin-bottom: 20px;
        background: linear-gradient(135deg, #fff, #888);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .hero p {
        font-size: 1.5rem;
        margin-bottom: 40px;
        color: #888;
    }

    .hero-cta {
        background: linear-gradient(135deg, #fff, #ddd);
        color: #000;
        padding: 15px 40px;
        border: none;
        border-radius: 30px;
        font-size: 18px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .hero-cta:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 30px rgba(255, 255, 255, 0.2);
    }

    .products-section {
        padding: 100px 20px;
        max-width: 1400px;
        margin: 0 auto;
    }

    .section-title {
        text-align: center;
        font-size: 3rem;
        margin-bottom: 60px;
        background: linear-gradient(135deg, #fff, #888);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .filter-buttons {
        display: flex;
        justify-content: center;
        gap: 20px;
        margin-bottom: 50px;
        flex-wrap: wrap;
    }

    .filter-btn {
        background: linear-gradient(135deg, #1a1a1a, #2a2a2a);
        color: white;
        border: 1px solid #333;
        padding: 10px 20px;
        border-radius: 20px;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .filter-btn.active {
        background: linear-gradient(135deg, #fff, #ddd);
        color: #000;
    }

    .products-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 30px;
        margin-bottom: 50px;
    }

    .product-card {
        background: #1a1a1a;
        border-radius: 15px;
        overflow: hidden;
        transition: all 0.3s ease;
        border: 1px solid #333;
    }

    .product-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
    }

    .product-image {
        width: 100%;
        height: 250px;
        background: #2a2a2a;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 3rem;
        color: #666;
    }

    .product-info {
        padding: 20px;
    }

    .product-name {
        font-size: 1.2rem;
        font-weight: 600;
        margin-bottom: 10px;
    }

    .product-price {
        font-size: 1.5rem;
        color: #fff;
        margin-bottom: 15px;
        font-weight: 700;
    }

    .add-to-cart {
        width: 100%;
        background: linear-gradient(135deg, #fff, #ddd);
        color: #000;
        border: none;
        padding: 12px;
        border-radius: 8px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .add-to-cart:hover {
        transform: translateY(-2px);
    }

    .modal {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.8);
        backdrop-filter: blur(10px);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 2000;
        opacity: 0;
        visibility: hidden;
        transition: all 0.3s ease;
    }

    .modal.active {
        opacity: 1;
        visibility: visible;
    }

    .modal-content {
        background: #1a1a1a;
        border-radius: 20px;
        padding: 40px;
        max-width: 500px;
        width: 90%;
        max-height: 80vh;
        overflow-y: auto;
        position: relative;
        border: 1px solid #333;
    }

    .close-btn {
        position: absolute;
        top: 20px;
        right: 20px;
        background: none;
        border: none;
        color: #888;
        font-size: 24px;
        cursor: pointer;
        transition: color 0.3s ease;
    }

    .close-btn:hover {
        color: #fff;
    }

    .tab-buttons {
        display: flex;
        margin-bottom: 30px;
        border-bottom: 1px solid #333;
    }

    .tab-btn {
        flex: 1;
        padding: 15px;
        background: none;
        border: none;
        color: #888;
        cursor: pointer;
        transition: all 0.3s ease;
        border-bottom: 2px solid transparent;
    }

    .tab-btn.active {
        color: #fff;
        border-bottom-color: #fff;
    }

    .tab-content {
        display: none;
    }

    .tab-content.active {
        display: block;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        display: block;
        margin-bottom: 8px;
        color: #ccc;
    }

    .form-group input {
        width: 100%;
        padding: 12px;
        background: #2a2a2a;
        border: 1px solid #333;
        border-radius: 8px;
        color: white;
        font-size: 16px;
    }

    .form-group input:focus {
        outline: none;
        border-color: #555;
    }

    .form-submit {
        width: 100%;
        padding: 12px;
        background: linear-gradient(135deg, #fff, #ddd);
        color: #000;
        border: none;
        border-radius: 8px;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .form-submit:hover {
        transform: translateY(-2px);
    }

    .cart-item {
        display: flex;
        align-items: center;
        gap: 15px;
        padding: 15px 0;
        border-bottom: 1px solid #333;
    }

    .cart-item-image {
        width: 60px;
        height: 60px;
        background: #2a2a2a;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #666;
    }

    .cart-item-details {
        flex: 1;
    }

    .cart-item-name {
        font-weight: 600;
        margin-bottom: 5px;
    }

    .cart-item-price {
        color: #888;
    }

    .quantity-controls {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-top: 10px;
    }

    .qty-btn {
        background: #2a2a2a;
        border: 1px solid #333;
        color: white;
        width: 30px;
        height: 30px;
        border-radius: 5px;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .remove-item {
        background: #ff4444;
        color: white;
        border: none;
        padding: 5px 10px;
        border-radius: 5px;
        cursor: pointer;
        font-size: 12px;
    }

    .empty-state {
        text-align: center;
        padding: 40px 20px;
        color: #888;
    }

    .cart-total {
        text-align: right;
        font-size: 1.5rem;
        font-weight: 700;
        padding: 20px 0;
        border-top: 1px solid #333;
        margin-top: 20px;
    }

    .mobile-menu-toggle {
        display: none;
        background: none;
        border: none;
        color: white;
        font-size: 24px;
        cursor: pointer;
        padding: 8px;
        flex-direction: column;
        gap: 4px;
    }

    .mobile-menu-toggle span {
        width: 25px;
        height: 3px;
        background: white;
        border-radius: 2px;
        transition: all 0.3s ease;
    }

    .profile-content {
        text-align: center;
    }

    .profile-info {
        text-align: left;
        margin-top: 20px;
    }

    .profile-field {
        margin-bottom: 15px;
        padding: 10px;
        background: #2a2a2a;
        border-radius: 8px;
        border-left: 3px solid #555;
    }

    .profile-field strong {
        color: #fff;
        margin-right: 10px;
    }

    .profile-field span {
        color: #ccc;
    }

    /* Cart Modal */
    @media screen and (max-width: 768px) {
        .custom-cursor,
        .cursor-trail {
            display: none;
        }
        
        * {
            cursor: auto !important;
        }
        
        .header {
            padding: 12px 15px;
        }
        
        .logo {
            font-size: 22px;
        }
        
        .nav-menu {
            display: none;
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            background: rgba(10, 10, 10, 0.95);
            backdrop-filter: blur(20px);
            flex-direction: column;
            padding: 20px;
            border-top: 1px solid #333;
        }
        
        .nav-menu.active {
            display: flex;
        }
        
        .mobile-menu-toggle {
            display: flex;
        }
        
        .hero h1 {
            font-size: 2.5rem;
        }
        
        .hero p {
            font-size: 1.2rem;
        }
        
        .products-grid {
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
        }
        
        .modal-content {
            padding: 25px 20px;
            max-width: 95%;
        }
    }
  </style>
</head>
<body>
  <div class="custom-cursor"></div>
  <div class="cursor-trail"></div>
  
  <header class="header">
    <div class="logo">DripNest</div>

    <button class="mobile-menu-toggle" onclick="toggleMobileMenu()">
      <span></span>
      <span></span>
      <span></span>
    </button>

    <nav class="nav-menu">
      <div class="dropdown">
        <button class="dropdown-btn">Collections ▼</button>
        <div class="dropdown-content">
          <div class="dropdown-item has-submenu" data-category="tops">
            <span>Tops ▶</span>
            <div class="submenu">
              <div class="dropdown-item" data-subcategory="shirts" onclick="filterProducts('tops', 'shirts')">Shirts</div>
              <div class="dropdown-item" data-subcategory="t-shirts" onclick="filterProducts('tops', 't-shirts')">T-Shirts</div>
              <div class="dropdown-item" data-subcategory="hoodies" onclick="filterProducts('tops', 'hoodies')">Hoodies</div>
              <div class="dropdown-item" data-subcategory="jackets" onclick="filterProducts('tops', 'jackets')">Jackets</div>
            </div>
          </div>
          <div class="dropdown-item has-submenu" data-category="bottoms">
            <span>Bottoms ▶</span>
            <div class="submenu">
              <div class="dropdown-item" data-subcategory="jeans" onclick="filterProducts('bottoms', 'jeans')">Jeans</div>
              <div class="dropdown-item" data-subcategory="trousers" onclick="filterProducts('bottoms', 'trousers')">Trousers</div>
              <div class="dropdown-item" data-subcategory="shorts" onclick="filterProducts('bottoms', 'shorts')">Shorts</div>
              <div class="dropdown-item" data-subcategory="chinos" onclick="filterProducts('bottoms', 'chinos')">Chinos</div>
              <div class="dropdown-item" data-subcategory="joggers" onclick="filterProducts('bottoms', 'joggers')">Joggers</div>
              <div class="dropdown-item" data-subcategory="cargo" onclick="filterProducts('bottoms', 'cargo')">Cargo Pants</div>
            </div>
          </div>
          <div class="dropdown-item has-submenu" data-category="accessories">
            <span>Accessories ▶</span>
            <div class="submenu">
              <div class="dropdown-item" data-subcategory="watches" onclick="filterProducts('accessories', 'watches')">Watches</div>
              <div class="dropdown-item" data-subcategory="bags" onclick="filterProducts('accessories', 'bags')">Bags</div>
              <div class="dropdown-item" data-subcategory="belts" onclick="filterProducts('accessories', 'belts')">Belts</div>
              <div class="dropdown-item" data-subcategory="wallets" onclick="filterProducts('accessories', 'wallets')">Wallets</div>
              <div class="dropdown-item" data-subcategory="sunglasses" onclick="filterProducts('accessories', 'sunglasses')">Sunglasses</div>
              <div class="dropdown-item" data-subcategory="caps" onclick="filterProducts('accessories', 'caps')">Caps</div>
            </div>
          </div>
        </div>
      </div>
    </nav>

    <div class="auth-section">
      <div class="auth-buttons">
        <button class="auth-btn" onclick="openAuthModal()">Login</button>
      </div>
      <div class="user-menu" id="userMenu" style="display: none;">
        <div class="user-avatar" onclick="toggleUserMenu()">
          <span id="userInitial">U</span>
        </div>
        <div class="user-dropdown" id="userDropdown">
          <div class="dropdown-item" onclick="showProfile()">Profile</div>
          <div class="dropdown-item" onclick="showSettings()">Settings</div>
          <div class="dropdown-item" onclick="showOrders()">Orders</div>
          <div class="dropdown-item" onclick="showWishlist()">Wishlist</div>
          <div class="dropdown-item" onclick="logout()">Logout</div>
        </div>
      </div>
      <button class="cart-btn" onclick="openCart()">
        <svg class="cart-icon" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M3 3H5L5.4 5M7 13H17L21 5H5.4M7 13L5.4 5M7 13L4.7 15.3C4.3 15.7 4.6 16.5 5.1 16.5H17M17 13V17C17 18.1 16.1 19 15 19H9C7.9 19 7 18.1 7 17V13M9 21C9.6 21 10 20.6 10 20S9.6 19 9 19 8 19.4 8 20 8.4 21 9 21ZM20 21C20.6 21 21 20.6 21 20S20.6 19 20 19 19 19.4 19 20 19.4 21 20 21Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
        <span class="cart-count" id="cartCount">0</span>
      </button>
    </div>
  </header>

  <!-- Hero Section -->
  <section class="hero">
    <div class="hero-content">
      <h1>Welcome to DripNest</h1>
      <p>Discover the Latest Fashion Trends</p>
      <button class="hero-cta" onclick="scrollToProducts()">Shop Now</button>
    </div>
  </section>

  <!-- Products Section -->
  <section class="products-section" id="products">
    <h2 class="section-title">Our Collection</h2>
    
    <div class="filter-buttons">
      <button class="filter-btn active" onclick="filterProducts('all')">All</button>
      <button class="filter-btn" onclick="filterProducts('tops')">Tops</button>
      <button class="filter-btn" onclick="filterProducts('bottoms')">Bottoms</button>
      <button class="filter-btn" onclick="filterProducts('accessories')">Accessories</button>
    </div>

    <div class="products-grid" id="productsGrid">
      <!-- Products will be dynamically loaded here -->
    </div>
  </section>

  <!-- Auth Modal -->
  <div class="modal" id="authModal">
    <div class="modal-content">
      <button class="close-btn" onclick="closeModal('authModal')">&times;</button>
      <div class="tab-buttons">
        <button class="tab-btn active" onclick="switchTab('login')">Log in</button>
        <button class="tab-btn" onclick="switchTab('signup')">Sign Up</button>
      </div>

      <div class="tab-content active" id="loginTab">
        <h2>Welcome Back</h2>
        <form onsubmit="handleLogin(event)">
          <div class="form-group">
            <label>Email</label>
            <input type="email" id="loginEmail" required />
          </div>
          <div class="form-group">
            <label>Password</label>
            <input type="password" id="loginPassword" required />
          </div>
          <button type="submit" class="form-submit">Login</button>
        </form>
      </div>

      <div class="tab-content" id="signupTab">
        <h2>Create Account</h2>
        <form onsubmit="handleSignup(event)">
          <div class="form-group">
            <label>First Name</label>
            <input type="text" id="signupFirstName" required />
          </div>
          <div class="form-group">
            <label>Last Name</label>
            <input type="text" id="signupLastName" required />
          </div>
          <div class="form-group">
            <label>Email</label>
            <input type="email" id="signupEmail" required />
          </div>
          <div class="form-group">
            <label>Password</label>
            <input type="password" id="signupPassword" required />
          </div>
          <button type="submit" class="form-submit">Sign Up</button>
        </form>
      </div>
    </div>
  </div>

  <!-- Settings Modal -->
  <div class="modal" id="settingsModal">
    <div class="modal-content">
      <button class="close-btn" onclick="closeModal('settingsModal')">&times;</button>
      <h2>Settings</h2>
      <form onsubmit="handleSettingsUpdate(event)">
        <div class="form-group">
          <label>First Name</label>
          <input type="text" id="settingsFirstName" />
        </div>
        <div class="form-group">
          <label>Last Name</label>
          <input type="text" id="settingsLastName" />
        </div>
        <div class="form-group">
          <label>Email</label>
          <input type="email" id="settingsEmail" readonly />
        </div>
        <div class="form-group">
          <label>Phone Number</label>
          <input type="tel" id="settingsPhone" />
        </div>
        <div class="form-group">
          <label>Address</label>
          <textarea id="settingsAddress" rows="3" style="width: 100%; padding: 12px; background: #2a2a2a; border: 1px solid #333; border-radius: 8px; color: white; font-size: 16px; resize: vertical;"></textarea>
        </div>
        <button type="submit" class="form-submit">Update Settings</button>
      </form>
    </div>
  </div>

  <!-- Profile Modal -->
  <div class="modal" id="profileModal">
    <div class="modal-content">
      <button class="close-btn" onclick="closeModal('profileModal')">&times;</button>
      <h2>My Profile</h2>
      <div class="profile-content">
        <div class="profile-avatar">
          <div class="user-avatar" style="width: 80px; height: 80px; font-size: 32px; margin: 0 auto 20px;">
            <span id="profileInitial">U</span>
          </div>
        </div>
        <div class="profile-info">
          <div class="profile-field">
            <strong>Name:</strong> <span id="profileName">-</span>
          </div>
          <div class="profile-field">
            <strong>Email:</strong> <span id="profileEmail">-</span>
          </div>
          <div class="profile-field">
            <strong>Phone:</strong> <span id="profilePhone">-</span>
          </div>
          <div class="profile-field">
            <strong>Address:</strong> <span id="profileAddress">-</span>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="modal" id="cartModal">
    <div class="modal-content">
      <button class="close-btn" onclick="closeModal('cartModal')">&times;</button>
      <h2>Shopping Cart</h2>
      <div id="cartItems">
        <div class="empty-state">
          <h3>Your cart is empty</h3>
          <p>Add some items to get started!</p>
        </div>
      </div>
      <div class="cart-total" id="cartTotal" style="display: none;">
        Total: ₹0
      </div>
      <button class="form-submit" onclick="checkout()" id="checkoutBtn" style="display: none;">
        Checkout (COD)
      </button>
    </div>
  </div>

  <script>
    // State management
    const state = {
      currentUser: null,
      cart: [],
      wishlist: [],
      products: [
        // Tops
        { id: 1, name: "Premium Cotton Shirt", category: "tops", subcategory: "shirts", price: 1999, image: "👔" },
        { id: 2, name: "Classic White T-Shirt", category: "tops", subcategory: "t-shirts", price: 899, image: "👕" },
        { id: 3, name: "Oversized Hoodie", category: "tops", subcategory: "hoodies", price: 2499, image: "🧥" },
        { id: 4, name: "Leather Jacket", category: "tops", subcategory: "jackets", price: 4999, image: "🧥" },
        
        // Bottoms
        { id: 5, name: "Slim Fit Jeans", category: "bottoms", subcategory: "jeans", price: 2799, image: "👖" },
        { id: 6, name: "Formal Trousers", category: "bottoms", subcategory: "trousers", price: 2199, image: "👔" },
        { id: 7, name: "Summer Shorts", category: "bottoms", subcategory: "shorts", price: 1299, image: "🩳" },
        { id: 8, name: "Chino Pants", category: "bottoms", subcategory: "chinos", price: 1899, image: "👖" },
        { id: 9, name: "Comfortable Joggers", category: "bottoms", subcategory: "joggers", price: 1599, image: "👖" },
        { id: 10, name: "Cargo Pants", category: "bottoms", subcategory: "cargo", price: 2299, image: "👖" },
        
        // Accessories
        { id: 11, name: "Digital Watch", category: "accessories", subcategory: "watches", price: 3999, image: "⌚" },
        { id: 12, name: "Leather Backpack", category: "accessories", subcategory: "bags", price: 3299, image: "🎒" },
        { id: 13, name: "Genuine Leather Belt", category: "accessories", subcategory: "belts", price: 1499, image: "👑" },
        { id: 14, name: "Bifold Wallet", category: "accessories", subcategory: "wallets", price: 1199, image: "👝" },
        { id: 15, name: "Aviator Sunglasses", category: "accessories", subcategory: "sunglasses", price: 2199, image: "🕶️" },
        { id: 16, name: "Baseball Cap", category: "accessories", subcategory: "caps", price: 899, image: "🧢" }
      ]
    };

    // Initialize the app
    document.addEventListener('DOMContentLoaded', function() {
      loadProducts();
      updateCartCount();
      initializeCursor();
    });

    // Custom cursor functionality
    function initializeCursor() {
      const cursor = document.querySelector('.custom-cursor');
      const cursorTrail = document.querySelector('.cursor-trail');
      
      let mouseX = 0;
      let mouseY = 0;
      let trailX = 0;
      let trailY = 0;
      
      function updateCursor() {
        cursor.style.transform = `translate(${mouseX}px, ${mouseY}px) translate(-50%, -50%)`;
      }
      
      function updateTrail() {
        trailX += (mouseX - trailX) * 0.15;
        trailY += (mouseY - trailY) * 0.15;
        cursorTrail.style.transform = `translate(${trailX}px, ${trailY}px) translate(-50%, -50%)`;
      }

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

      function animate() {
        updateTrail();
        requestAnimationFrame(animate);
      }
      animate();

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

      document.addEventListener('mousedown', () => cursor.classList.add('click'));
      document.addEventListener('mouseup', () => cursor.classList.remove('click'));

      document.addEventListener('mouseleave', () => {
        cursor.style.opacity = '0';
        cursorTrail.style.opacity = '0';
      });

      document.addEventListener('mouseenter', () => {
        cursor.style.opacity = '1';
        cursorTrail.style.opacity = '1';
      });
    }

    // Mobile menu toggle
    function toggleMobileMenu() {
      const navMenu = document.querySelector('.nav-menu');
      const toggle = document.querySelector('.mobile-menu-toggle');
      
      navMenu.classList.toggle('active');
      
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

    // Authentication functions
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

    function handleLogin(event) {
      event.preventDefault();
      const email = document.getElementById('loginEmail').value;
      const password = document.getElementById('loginPassword').value;
      
      // Simple demo login - in real app, this would connect to your PHP backend
      if (email && password) {
        state.currentUser = { email: email };
        showNotification('Welcome back!', 'You have been successfully logged in', 'success');
        closeModal('authModal');
        updateAuthUI();
      }
    }

    function handleSignup(event) {
      event.preventDefault();
      const firstName = document.getElementById('signupFirstName').value;
      const lastName = document.getElementById('signupLastName').value;
      const email = document.getElementById('signupEmail').value;
      const password = document.getElementById('signupPassword').value;
      
      // Simple demo signup - in real app, this would connect to your PHP backend
      if (firstName && lastName && email && password) {
        state.currentUser = { email: email, firstName: firstName, lastName: lastName };
        showNotification('Account Created!', 'Welcome to DripNest! Your account has been created successfully', 'success');
        closeModal('authModal');
        updateAuthUI();
      }
    }

    function updateAuthUI() {
      const authButtons = document.querySelector('.auth-buttons');
      const userMenu = document.getElementById('userMenu');
      
      if (state.currentUser) {
        // Hide login button and show user menu
        authButtons.style.display = 'none';
        userMenu.style.display = 'block';
        
        // Update user initial
        const userInitial = document.getElementById('userInitial');
        const profileInitial = document.getElementById('profileInitial');
        const initial = state.currentUser.firstName ? state.currentUser.firstName.charAt(0).toUpperCase() : state.currentUser.email.charAt(0).toUpperCase();
        
        userInitial.textContent = initial;
        profileInitial.textContent = initial;
        
        // Update profile information
        updateProfileDisplay();
      } else {
        // Show login button and hide user menu
        authButtons.style.display = 'block';
        userMenu.style.display = 'none';
      }
    }

    function toggleUserMenu() {
      const userMenu = document.getElementById('userMenu');
      userMenu.classList.toggle('active');
    }

    // Close user dropdown when clicking outside
    document.addEventListener('click', function(event) {
      const userMenu = document.getElementById('userMenu');
      if (!userMenu.contains(event.target)) {
        userMenu.classList.remove('active');
      }
    });

    function showProfile() {
      document.getElementById('profileModal').classList.add('active');
      document.getElementById('userMenu').classList.remove('active');
      updateProfileDisplay();
    }

    function showSettings() {
      document.getElementById('settingsModal').classList.add('active');
      document.getElementById('userMenu').classList.remove('active');
      
      // Pre-fill settings form with current user data
      if (state.currentUser) {
        document.getElementById('settingsFirstName').value = state.currentUser.firstName || '';
        document.getElementById('settingsLastName').value = state.currentUser.lastName || '';
        document.getElementById('settingsEmail').value = state.currentUser.email || '';
        document.getElementById('settingsPhone').value = state.currentUser.phone || '';
        document.getElementById('settingsAddress').value = state.currentUser.address || '';
      }
    }

    function showOrders() {
      document.getElementById('userMenu').classList.remove('active');
      showNotification('Coming Soon', 'Orders feature will be available soon', 'info');
    }

    function showWishlist() {
      document.getElementById('userMenu').classList.remove('active');
      showNotification('Coming Soon', 'Wishlist feature will be available soon', 'info');
    }

    function handleSettingsUpdate(event) {
      event.preventDefault();
      
      if (!state.currentUser) return;
      
      const oldFirstName = state.currentUser.firstName;
      const oldPhone = state.currentUser.phone;
      const oldAddress = state.currentUser.address;
      
      // Update user data
      state.currentUser.firstName = document.getElementById('settingsFirstName').value;
      state.currentUser.lastName = document.getElementById('settingsLastName').value;
      state.currentUser.phone = document.getElementById('settingsPhone').value;
      state.currentUser.address = document.getElementById('settingsAddress').value;
      
      // Update UI
      updateAuthUI();
      updateProfileDisplay();
      
      // Show specific notification based on what was changed
      let changes = [];
      if (oldFirstName !== state.currentUser.firstName) changes.push('name');
      if (oldPhone !== state.currentUser.phone) changes.push('phone number');
      if (oldAddress !== state.currentUser.address) changes.push('address');
      
      let message = 'Your profile information has been updated successfully';
      if (changes.length > 0) {
        message = `Your ${changes.join(' and ')} has been updated successfully`;
      }
      
      showNotification('Settings Updated', message, 'success');
      closeModal('settingsModal');
    }

    function updateProfileDisplay() {
      if (!state.currentUser) return;
      
      const fullName = `${state.currentUser.firstName || ''} ${state.currentUser.lastName || ''}`.trim();
      
      document.getElementById('profileName').textContent = fullName || '-';
      document.getElementById('profileEmail').textContent = state.currentUser.email || '-';
      document.getElementById('profilePhone').textContent = state.currentUser.phone || '-';
      document.getElementById('profileAddress').textContent = state.currentUser.address || '-';
    }

    function logout() {
      state.currentUser = null;
      state.cart = [];
      updateAuthUI();
      updateCartCount();
      document.getElementById('userMenu').classList.remove('active');
      showNotification('Logged Out', 'You have been successfully logged out', 'info');
    }

    // Product functions
    function loadProducts(filter = 'all') {
      const grid = document.getElementById('productsGrid');
      let filteredProducts = state.products;
      
      if (filter !== 'all') {
        filteredProducts = state.products.filter(product => product.category === filter);
      }
      
      grid.innerHTML = filteredProducts.map(product => `
        <div class="product-card">
          <div class="product-image">${product.image}</div>
          <div class="product-info">
            <div class="product-name">${product.name}</div>
            <div class="product-price">₹${product.price}</div>
            <button class="add-to-cart" onclick="addToCart(${product.id})">
              Add to Cart
            </button>
          </div>
        </div>
      `).join('');
    }

    function filterProducts(category, subcategory = null) {
      // Update filter buttons
      document.querySelectorAll('.filter-btn').forEach(btn => btn.classList.remove('active'));
      event.target.classList.add('active');
      
      const grid = document.getElementById('productsGrid');
      let filteredProducts = state.products;
      
      if (category !== 'all') {
        filteredProducts = state.products.filter(product => {
          if (subcategory) {
            return product.category === category && product.subcategory === subcategory;
          }
          return product.category === category;
        });
      }
      
      grid.innerHTML = filteredProducts.map(product => `
        <div class="product-card">
          <div class="product-image">${product.image}</div>
          <div class="product-info">
            <div class="product-name">${product.name}</div>
            <div class="product-price">₹${product.price}</div>
            <button class="add-to-cart" onclick="addToCart(${product.id})">
              Add to Cart
            </button>
          </div>
        </div>
      `).join('');
    }

    function scrollToProducts() {
      document.getElementById('products').scrollIntoView({ 
        behavior: 'smooth' 
      });
    }

    // Cart functions
    function addToCart(productId) {
      const product = state.products.find(p => p.id === productId);
      if (!product) return;
      
      const existingItem = state.cart.find(item => item.id === productId);
      if (existingItem) {
        existingItem.quantity += 1;
      } else {
        state.cart.push({ ...product, quantity: 1 });
      }
      
      updateCartCount();
      showCartNotification(product.name);
    }

    function removeFromCart(productId) {
      state.cart = state.cart.filter(item => item.id !== productId);
      updateCartDisplay();
      updateCartCount();
    }

    function updateQuantity(productId, change) {
      const item = state.cart.find(item => item.id === productId);
      if (item) {
        item.quantity += change;
        if (item.quantity <= 0) {
          removeFromCart(productId);
        } else {
          updateCartDisplay();
          updateCartCount();
        }
      }
    }

    function updateCartCount() {
      const cartCount = document.getElementById('cartCount');
      const totalItems = state.cart.reduce((sum, item) => sum + item.quantity, 0);
      
      cartCount.textContent = totalItems;
      cartCount.style.display = totalItems > 0 ? 'flex' : 'none';
    }

    function openCart() {
      document.getElementById('cartModal').classList.add('active');
      updateCartDisplay();
    }

    function updateCartDisplay() {
      const cartItems = document.getElementById('cartItems');
      const cartTotal = document.getElementById('cartTotal');
      const checkoutBtn = document.getElementById('checkoutBtn');
      
      if (state.cart.length === 0) {
        cartItems.innerHTML = `
          <div class="empty-state">
            <h3>Your cart is empty</h3>
            <p>Add some items to get started!</p>
          </div>
        `;
        cartTotal.style.display = 'none';
        checkoutBtn.style.display = 'none';
      } else {
        const total = state.cart.reduce((sum, item) => sum + (item.price * item.quantity), 0);
        
        cartItems.innerHTML = state.cart.map(item => `
          <div class="cart-item">
            <div class="cart-item-image">${item.image}</div>
            <div class="cart-item-details">
              <div class="cart-item-name">${item.name}</div>
              <div class="cart-item-price">₹${item.price}</div>
              <div class="quantity-controls">
                <button class="qty-btn" onclick="updateQuantity(${item.id}, -1)">-</button>
                <span>${item.quantity}</span>
                <button class="qty-btn" onclick="updateQuantity(${item.id}, 1)">+</button>
                <button class="remove-item" onclick="removeFromCart(${item.id})">Remove</button>
              </div>
            </div>
          </div>
        `).join('');
        
        cartTotal.innerHTML = `Total: ₹${total}`;
        cartTotal.style.display = 'block';
        checkoutBtn.style.display = 'block';
      }
    }

    function showCartNotification(productName) {
      showNotification('Added to Cart', `${productName} has been added to your cart`, 'success');
    }

    function checkout() {
      if (state.cart.length === 0) {
        showNotification('Cart Empty', 'Please add some items to your cart before checkout', 'warning');
        return;
      }
      
      if (!state.currentUser) {
        showNotification('Login Required', 'Please login to continue with checkout', 'warning');
        closeModal('cartModal');
        openAuthModal();
        return;
      }
      
      const total = state.cart.reduce((sum, item) => sum + (item.price * item.quantity), 0);
      const orderSummary = state.cart.map(item => `${item.name} x${item.quantity}`).join(', ');
      
      if (confirm(`Order Summary:\n${orderSummary}\n\nTotal: ₹${total}\n\nConfirm Cash on Delivery order?`)) {
        showNotification('Order Placed!', 'Your order has been placed successfully. You will receive a confirmation email shortly', 'success');
        state.cart = [];
        updateCartCount();
        closeModal('cartModal');
      }
    }

    // Notification system
    function showNotification(title, message, type = 'info') {
      const notification = document.createElement('div');
      notification.className = `notification ${type}`;
      
      const iconText = {
        success: '✓',
        error: '✕',
        warning: '!',
        info: 'i'
      };
      
      notification.innerHTML = `
        <div class="notification-content">
          <div class="notification-icon">${iconText[type]}</div>
          <div class="notification-text">
            <div class="notification-title">${title}</div>
            <div class="notification-message">${message}</div>
          </div>
          <button class="notification-close" onclick="closeNotification(this)">×</button>
        </div>
      `;
      
      document.body.appendChild(notification);
      
      // Trigger animation
      setTimeout(() => {
        notification.classList.add('show');
      }, 100);
      
      // Auto remove after 5 seconds
      setTimeout(() => {
        closeNotification(notification.querySelector('.notification-close'));
      }, 5000);
    }

    function closeNotification(closeBtn) {
      const notification = closeBtn.closest('.notification');
      if (notification) {
        notification.classList.remove('show');
        setTimeout(() => {
          notification.remove();
        }, 400);
      }
    }

    // Add CSS animation for notifications
    const style = document.createElement('style');
    style.textContent = `
      @keyframes slideIn {
        from {
          transform: translateX(100%);
          opacity: 0;
        }
        to {
          transform: translateX(0);
          opacity: 1;
        }
      }
      
      @keyframes slideOut {
        from {
          transform: translateX(0);
          opacity: 1;
        }
        to {
          transform: translateX(100%);
          opacity: 0;
        }
      }
    `;
    document.head.appendChild(style);
  </script>
</body>
</html>