<h3>Ecommerce</h3>
<hr>
<p>This is the dynamic e-commerce website where customer can visit page, search products, register, purchase products.</p>
<p><b>Features Include</b></p>
<ol>
    <li>Add to cart</li>
    <li>Wishlist</li>
    <li>Discount Product<li>
    <li>Apply Coupon</li>
    <li>Realtime Cart reflector</li>
    <li>Apply coupon based upon User, Category & Product in cart</li>
    <li>Cart item updation</li>
    <li>Move to wishlist</li>
    <li>List user saved address</li>
    <li>Search API</li>
    <li>API Integration</li>
</ol>

<h3>what languages are used?</h3>
<p>I have used html, css, bootstrap, js, jquery, ajax, php and mysql This is purely based on procedural php.</p>

<h3>Level</h3>
<p>It is intermediate level of projects based on frontend as well as backend where i have used procedural php</p>

<p><b>Project File Structure</b></p>
<p>All request from frontend to backend goes via AJAX concept written in js/custome.js file each request include unique button name that helps to identify which parts of backend code need to be compile.</p>

CUSTOME.JS file include all js DOM code
Action.php(located at root folder) - Backend calculation and validation written in action.php
Newaction.php(located at root folder) - To checkout process perform smoothly backend code written separately.
-----Multiple thirdparty api call made within newaction.php
CSS -> css/main.css

To check website Routes check .htaccess file

New product page based on REST API
Backend code for rest api : api.php(located at root folder)
JS fecth await use to call api endpoints for new product page



<hr>


<p><b>Installation Steps</b></p>
<ul>
    <li>git clone https://github.com/sandeepparekh/globalpharma.git</li>
    <li>Move project to htdocs</li>
    <li>Create database ``global``</li>
    <li>Import sql file to database</li>
    <ol>To enable error display just add below line to htaccess file
        <ul>
        <li>php_flag display_startup_errors on</li>
        <li>php_flag display_errors on</li>
        </ul>
    </ol>
</ul>