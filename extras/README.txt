
BEAUTYFLY AURA - STARTER FILES (Very Basic Step-by-Step)
-------------------------------------------------------

This ZIP contains view templates, simple controllers, routes, and CSS for a starter
BeautyFly Aura Laravel front-end with:
- Home, Products (search+filter), Product Details, Cart, Contact
- Session-based cart and reviews (no database required)
- Blade partials for header/footer

IMPORTANT: This is a starter bundle. You must have a working Laravel project created
on your machine (see steps below). Then copy these files into that project's folders.

VERY BASIC STEPS (for absolute beginners):

1) Install requirements on your computer (ask your instructor if unsure):
   - PHP (8.1+)
   - Composer (https://getcomposer.org/)
   - Git (optional)
   - A code editor (VS Code recommended)
   - (Optional) Node and npm if you want to compile assets

2) Create a fresh Laravel project (open terminal / command prompt):
   composer create-project laravel/laravel beautyfly-aura
   cd beautyfly-aura

3) Place files from this ZIP into the Laravel project:
   - routes_web.php  -> copy contents into routes/web.php (overwrite or merge)
   - Controllers (.php) -> put into app/Http/Controllers/ (new files)
       PageController.php
       ProductController.php
       CartController.php
   - Views (Blade templates) -> place into resources/views/
       create subfolders: layouts/, partials/, pages/
       copy files: layouts/layout.blade.php
                   partials/header.blade.php
                   partials/footer.blade.php
                   partials/product-card.blade.php
                   pages/home.blade.php
                   pages/products.blade.php
                   pages/product-details.blade.php
                   pages/cart.blade.php
                   pages/contact.blade.php
   - public/css/style.css -> copy into public/css/style.css
   - public/images/ -> create folder public/images and add your images (serum.jpg etc).
       You can use any small images and name them: serum.jpg, moisturizer.jpg, cleanser.jpg, spf.jpg
       If you don't add images, update blade image paths or create placeholder.jpg file.

4) Run the project:
   php artisan serve
   Open http://127.0.0.1:8000 in your browser.

5) Test features (very simple):
   - Go to /products   (use search box and filter dropdown)
   - Click View on a product to see details
   - Click Add to Cart -> then open Cart (top nav) to view items
   - In Cart you can change quantity and remove items
   - On product page add a review (it will be stored in session)

6) Git (optional):
   git init
   git add .
   git commit -m "Add beautyfly aura starter frontend"
   # create GitHub repo and push as described in class

If you want, I can:
- Produce a ZIP you can download now (this file)
- Or generate full Laravel project (not possible here) but you can copy these files into your project

If something is unclear, tell me which step you are on and I will explain the next step in EVEN MORE BASIC words.
