<!-- Header -->
<header class="header">
        <nav class="navbar">
            <div class="nav-container">
                <div class="nav-logo">
                    <div class="logo-icon">D</div>
                    <span class="logo-text">
                        <span class="logo-dev">Dev</span>
                        <span class="logo-med">Med</span>
                        <span class="logo-uz">.uz</span>
                    </span>
                </div>

                <ul class="nav-menu">
                    <li class="nav-item">
                        <a href="{{ route('home') }}" class="nav-link active">Home</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('blog') }}" class="nav-link">Blog</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('about') }}" class="nav-link">About</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('authors') }}" class="nav-link">Authors</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('contact') }}" class="nav-link">Contact</a>
                    </li>
                </ul>

                <!-- Desktop Search and Theme Toggle -->
                <div class="nav-actions">
                    <div class="search-container">
                        <input type="text" placeholder="Search articles..." class="search-input" aria-label="Search articles">
                        <button class="search-btn" aria-label="Search">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                    <button class="theme-toggle" id="desktop-theme-toggle" aria-label="Toggle theme" data-theme="light">
                        <i class="fas fa-sun"></i>
                    </button>
                </div>

                <!-- Mobile Search and Theme Toggle -->
                <div class="mobile-actions">
                    <div class="search-container">
                        <input type="text" placeholder="Search articles..." class="search-input" aria-label="Search articles">
                        <button class="search-btn" aria-label="Search">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                    <button class="theme-toggle" id="mobile-theme-toggle" aria-label="Toggle theme" data-theme="light">
                        <i class="fas fa-sun"></i>
                    </button>
                </div>

                <!-- Mobile Navigation Menu -->
                <div class="mobile-nav">
                    <!-- Mobile Search and Theme Toggle -->
                    <div class="mobile-nav-actions">
                        <div class="search-container">
                            <input type="text" placeholder="Search articles..." class="search-input" aria-label="Search articles">
                            <button class="search-btn" aria-label="Search">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                        <button class="theme-toggle" id="mobile-nav-theme-toggle" aria-label="Toggle theme" data-theme="light">
                            <i class="fas fa-sun"></i>
                        </button>
                    </div>
                    
                    <ul class="mobile-nav-menu">
                        <li class="mobile-nav-item">
                            <a href="{{ route('home') }}" class="mobile-nav-link active">Home</a>
                        </li>
                        <li class="mobile-nav-item">
                            <a href="{{ route('blog') }}" class="mobile-nav-link">Blog</a>
                        </li>
                        <li class="mobile-nav-item">
                            <a href="{{ route('about') }}" class="mobile-nav-link">About</a>
                        </li>
                        <li class="mobile-nav-item">
                            <a href="{{ route('authors') }}" class="mobile-nav-link">Authors</a>
                        </li>
                        <li class="mobile-nav-item">
                            <a href="{{ route('contact') }}" class="mobile-nav-link">Contact</a>
                        </li>
                    </ul>
                </div>

                <div class="hamburger">
                    <span class="bar"></span>
                    <span class="bar"></span>
                    <span class="bar"></span>
                </div>
            </div>
        </nav>
    </header>