<?php
include 'connect.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>DripNest</title>
  <link rel="stylesheet" href="style.css" />
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
    </nav>

    <div class="auth-section">
      <div class="auth-buttons">
        <button class="auth-btn" onclick="openAuthModal()">Login</button>
      </div>
      <div class="user-menu" id="userMenu">
        <div class="user-avatar" onclick="toggleUserMenu()">
          <span id="userInitial">U</span>
        </div>
        <div class="user-dropdown">
          <div class="dropdown-item" onclick="showProfile()">Profile</div>
          <div class="dropdown-item" onclick="showOrders()">Orders</div>
          <div class="dropdown-item" onclick="showWishlist()">Wishlist</div>
          <div class="dropdown-item" onclick="showSettings()">Settings</div>
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

  <div class="modal" id="authModal">
    <div class="modal-content">
      <button class="close-btn" onclick="closeModal('authModal')">&times;</button>
      <div class="tab-buttons">
        <button class="tab-btn active" onclick="switchTab('login')">Log in</button>
        <button class="tab-btn" onclick="switchTab('signup')">Sign Up</button>
      </div>

      <div class="tab-content active" id="loginTab">
        <h2>Welcome Back</h2>
        <form  method="post" action="register.php">
          <div class="form-group">
            <label>Email</label>
            <input type="email" id="email" name="email" required />
          </div>
          <div class="form-group">
            <label>Password</label>
            <input type="password" id="password" name="password" required />
          </div>
          <button type="submit" class="auth-btn" value="Sign In" name="SignIn" >Login</button>
        </form>
      </div>

      <div class="tab-content" id="signupTab">
        <h2> Create Account </h2>
        <form  method="post" action="register.php">
          <div class="form-group">
            <label>First Name</label>
            <input type="text" id="fName" name="fName" required />
          </div>
          <div class="form-group">
            <label>Last Name</label>
            <input type="text" id="lName" name="lName" required />
          </div>
          <div class="form-group">
            <label>Email</label>
            <input type="email" id="email" name="email" required />
          </div>
          <div class="form-group">
            <label>Password</label>
            <input type="password" id="password" name="password" required />
          </div>
          <button type="submit" class="auth-btn" value="Sign Up" name="SignUp">Sign Up</button>
        </form>
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

  <script src="script.js"></script>
</body>
</html>
