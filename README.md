# Ecommerce Shopping Website
# Table Of Contents

* [About Project](#about-project)
* [Getting Started](#getting-started)
* [How To Use](#how-to-use)
* [Known Issues](#known-issues)
* [Test Cases](#test-cases)
* [Development Analysis](#develop-analysis)
* [References](#references)


# About Project

This project is based on a basic shopping website which has been created with the use of HTML, Laravel and CRUD operations. The website contains the following functions:

* **Login/Signup System**
    - [Laravel fortify](https://laravel.com/docs/9.x/fortify) used to implement the feature due to its proven capabilites and ease of use. 
        - User can login 
        - User can sign up 
* **Two Factor Authentication**
    - [Laravel fortify](https://laravel.com/docs/9.x/fortify) has also been used for this.
        - User can disable/enable 2FA
        - Upon enabling 2FA, user will be presented with 2FA code to login or they can enter a recovery code
        - User can sign with a recovery code from 2FA
* **Products View Page**
    - Allows user to view all the products within the database
    - Allows user to add a product to cart along with a quantity selected 
* **Cart Page** 
    - User can view all the products they have added to cart
    - Can view more information on a product as well as remove it from the cart
    - Checkout through this page if cart is not empty 
* **Checkout System**
    * [Stripe API](https://stripe.com/docs/api) has been used as it contains detailed documentation of each feature and their API has an extensive amount of features which allows the project to easily be expanded upon with extra features such as subscriptions, tax rates and shipping rates. 
        - Allows user to complete an order
        - Upon successful order, user can review a product 
* **Coupon System**
    - Allows user to add a coupon to their cart
    - Fixed Coupon such as £3 OFF
    - Percentage Coupon such as 15% OFF
* **Reviews**
    - User can review a product if they have ordered it
    - User can view all reviews of a product from other users
    - User can edit a review they have published 
* **Birthday Shceduler** 
     - [Laravel scheduler](https://laravel.com/docs/9.x/scheduling) has been used to achieve this feature.
        - Sends a happy birthday email to a user that has their birthday today along with a £3 OFF coupon

## Getting Started 

This section wil cover how to setup the project and get it running within your system. 

1. [Clone the repo](#clone-the-repo)
2. Configure the webserver to point at the public directory within the project
3. Create a database within MySQL
4. [Install PHP dependencies](#install-php-dependencies) 
5. [Install node dependencies](#install-node-dependencies)
6. [Build front end assets](#build-front-end-assets)
7. [Edit .env.example file](#edit-envexample-file)
8. [Migrate the database](#migrate-the-database)
9. [Seed the database](#seed-the-database)
10. [Setup a mail host](#setup-a-mail-host)
11. [Setup stripe API](#setup-stripe-api)

### Clone the repo 
1. Click the green button within the repo named "Code" as shown in the image below
![](https://i.imgur.com/U5rkTWZ.png)
2. Copy the URL of the repository
3. Open your git bash terminal 
4. Change the current directory to the location that you want the cloned directory to go to
5. Into your termianl, type the following: ``git clone`` [INSERT THE LINK YOU COPIED]


### Install PHP dependencies 
1. Open your git bash terminal, change the current directory to the root of the project (htdocs/assignment02)
and enter the following commands: `php composer. phar install`


### Install node dependencies 
1. If you do not have node installed, please go the following link: https://nodejs.org/dist/v16.11.0/ and install the ZIP version 
    1. Once installed, unzip the contents while ensuring the file is named ``node``
    2. Open your webserver terminal and type the following: ``set PATH=D:\node;%PATH%`` - Replace "D:" with the drive letter your node is located in
2. Open your git bash terminal, change the current directory to the root of the project (htdocs/assignment02) and enter the following command:
``../../../node/npm install -D tailwindcss postcss autoprefixer``
3. Enter this command after: ``npx tailwind init -p``


### Build front end assets
1. From the root of the project within git-bash terminal, enter the following command to build the assets: ``npm run dev``
    * If an error pops up where npm does not exist, please open your webserver terminal and type the following: ``set PATH=D:\node;%PATH%`` - Replace "D:" with the drive letter your node is located in
2. Ensure the git-bash terminal remains open will you view the website 


### Edit .env.example file
1. Open the project within your chosen code editor
2. Locate a file named `.env.example` which should be at the bottom of your file explorer section 
3. Change the following section as shown below to match with your database details:

![](https://i.imgur.com/glSiD30.png)


### Migrate the database
1. Please ensure your MySQL module is running
2. Open git-bash terminal, change the root to the project and enter the following command: ``php artisan migrate`` - You should see a list of tables being displayed
3. Keep the terminal open and [seed the database](#seed-the-database)

### Seed the database 
1. You should already have completed the [migrate database](#migrate-the-database) section and therefore should still have the terminal open - If you do not, please refer back to the steps
2. Enter the following command: ``php artisan db:seed``
3. You should now be able to view the website along with the correct front end assets by visiting: http://localhost/ while ensuring both apache and mysql module's are running 

### Setup a mail host
You can use your own mail host that you use and include the required info within the .env file. However, for those that do not have a mail host, I suggest using MailTrap.io: 
1. Go to: https://mailtrap.io/
2. Sign up if you do not have an account already created 
3. Go to: https://mailtrap.io/inboxes
4. You may need to create an inbox by clicking a blue button named "Add inbox" - Give your inbox a name
5. Click on the inbox that you just created and under the "SMTP Settings", change the "Integrations" section to "Laravel 7+" as shown below:
![](https://i.imgur.com/DWyHcUs.png)
6. Copy all these details and paste them into a file named `.env.example` in the following section: 
![](https://i.imgur.com/AzrS1PI.png)

### Setup stripe API
This part is optional and not required. A stripe API key has already been included within the .env.example. However, if you would like, you add your own API key. 

1. You must first create a stripe account: https://dashboard.stripe.com/register
2. [Locate API key](https://support.stripe.com/questions/locate-api-keys-in-the-dashboard?locale=en-GB#:~:text=Locate%20API%20keys%20in%20the%20Dashboard%20%3A%20Stripe%3A%20Help%20%26%20Support&text=Users%20with%20Administrator%20permissions%20can,and%20clicking%20on%20API%20Keys.)

## How To Use
This section will explain how to most features that been implemented into the website. 
1. [Forgot Password](#forgot-password)
2. [Coupon System](#coupon-system)
3. [Checkout System](#checkout-system)
4. [Two Factor Authenticator](#two-factor-authenticator)
5. [Product Review](#Product-Review)
6. [Birthday Scheduler](#Birthday-Scheduler)

### 1. Forgot Password
During the login page, there is a clickable text that can be clicked named `Forgot Password?` as shown below:
![](https://i.imgur.com/veKzZlm.png)

If you click this text, you will directed to another page where you will have to input an email address of a user that has been registered. 
For testing purposes, you can enter `admin@email.com` as the email. Upon clicking submit, a text message should be displayed informing you that a password reset link has been sent to your email. 

You can confirm that an email was received by visiting your mail host which should present you with an email as the one below:
![](https://i.imgur.com/z0x0OzM.png)
To reset your password, simply click the `Reset Password` button displayed within the email or alternatively, click the link just below the button in case you are having troubles.
Upon clicking the reset password button, you should be presented with a form with your `email` already predefined along with a password and password confirmation field.

If you enter a password which does not match with the password confirmation, you will be presented with an error message the passwords do not match. Alternatively, if you enter
a password which is less than 8 characters, you will also be displayed with an error. 

Upon entering a password which meets all requirements, you will be presented with the login form after clicking the submit button. From here, you are now able to login in with your new details!

### 2. Coupon System
Within the cart page, the user is able to apply two different types of coupons:

- Fixed Coupon: Takes off a value such as £5 off the cart total (By default 5OFF is created upon seeding)
- Percent Coupon: Takes off a percentage value such as 15% off the cart total (By default 15PERCTOFF is created upon seeding)

These coupons can be applied to the cart as long as you have added a product to the cart (Meaning if your cart is empty, you will not be able to apply a coupon). Upon applying a valid coupon which exists in the database,
your cart price will be reduced based on the coupon as well as the coupon name being displayed (example below). On the other hand, if you input an invalid coupon, you will receive an error message that is displayed. 

_Coupon Applied:_
![](https://i.imgur.com/MJxqAsa.png)
_Without Coupon Applied:_
![](https://i.imgur.com/5B24azq.png)

### 3. Checkout System
The checkout system has been created with the use of stripe therefore the checkout process will be based on stripe's API. By default, the checkout button is not displayed within the cart page due to the cart being empty.

There are three different types of order statuses:
- Unpaid: This means the user closed the tab/clicked back in their browser during the checkout screen
- Cancelled: User clicked the back button next to the "TEST MODE"
- Paid: Order was successful

**Instructions**
1. Add a product to cart
2. The checkout button will be displayed in the cart page 
3. By pressing checkout, you will be presented with the stripe checkout page which looks like this:
![](https://i.imgur.com/YfkOONW.png)
4. There are two potential circumstances that can occur:
 - User creates a successful order: To do this, enter enter `4242 4242 4242 4242` as the card number and a valid expiry date. The email, name, country, postal code and CVC can be random.
 - The user decides to click the back button next to the text 'TEST MODE'
5. Depending on what the user does will depend on the email they receive. If the user performs a successful order, then they will receive an order confirmation via email. On the other hand,
if the user decides to cancel the order, they will receieve an order cancellation email as shown below:
![](https://i.imgur.com/S6Zye8P.png)
![](https://i.imgur.com/p9GGgBr.png)
6. If a user applies a coupon, it will also display during the stripe checkout
![](https://i.imgur.com/WtxKxaO.png) 
![](https://i.imgur.com/ZdcCBfu.png) 

### 4. Two Factor Authenticator
By default, all users have two factor authentication disabled. In order to enable two factor authentication, you have to manually do this:

**Instructions**
1. Login into the website
2. Go to account section by clicking 'Account' top right 
3. You will be presented with your account details. From here, you can select "Security" 
![](https://i.imgur.com/6ylOhFu.pngg)
4. You may be presented to input your password which is a security check that has been put in place
5. Upon entering your password, you will be presented with a button to enable two factor authentication. After clicking the button, your QR code along with your recovery codes will be presented. This information will
always be displayed here unless you choose to disable two factor authentication. 
![](https://i.imgur.com/e0pLcuL.png)
6. You can now sign out and attempt to sign back in to which you will be presented to enter your two factor authenticator. 

### 4.1 Two Factor Authenticator Recovery Code
In the case that a user may no longer have access to their authenticator applicator, they can log into their account using the recovery codes that 
was presented to them in the account->security page. The recovery code option will be presented to the user when they have entered their login details and are on the page where
they have to enter their two factor code as shown:
![](https://i.imgur.com/x9BvsBT.png)

### 5. Product Review
A user will only be able to review a product for an order they have purchased successfully. For any orders that are cancelled or unpaid, the user will not be able to review the product within the order. 

**Instructions**
1. To review a product, go to the account page and click the "Orders" button. From here, you will see a list of all your orders that are paid, cancelled and unpaid. 
2. Click on an order that has the status of paid and you will see a list of products you purchased within the order. 
3. From here, you can click on "Review Product" next to the product name 
4. You will then be presented with the option to select a rating and enter a comment for the product (Both of these fields need are required to leave a review therefore if any of them are blank, you will receive an error message)
![](https://i.imgur.com/GaucuBn.png)

5. Upon clicking the "Leave Review" button, you will be displayed with a message informing you that your review has been left
6. To view your review, go to the products page and locate the product you left a review on. Click on "Reviews" button and you will be displayed with all the ratings of that product including your's and other users. 
7. If you would like to edit your product, you can do so by clicking the "Edit your review" button as shown below:
![](https://i.imgur.com/u1cPKP7.png)

### 6. Birthday Scheduler
The birthday scheduler essentially checks if any users within the database have their birthday today. If they do, it will send a birthday mail to the users email along with a unique coupon
code that has been generated that gives £3 OFF their total cart price. 

Upon seeding the database, a user (with the email: admin@email.com) is automatically created as their birthday being today. This allows you to test if this feature is working correctly:

**Instructions**
1. Open the project's code 
2. Go to App\Console\Kernel\Handler.php and change this line `$schedule->command('email:birthday')->daily();` to `$schedule->command('email:birthday')->everyMintute();` By changing this, we are telling the scheduler to run every minute instead of every day at midnight just for testing purposes
3. Open your git bash terminal, change directory to the project root and enter the following command `php artisan schedule:work`
4. Within a minute, there should be an output within the git bash terminal and email sent to the mail host as shown below. 
5. After you have tested the scheduler, you may revert back the code to how it was originally to ensure the scheduler runs every day rather than every minute.
![](https://i.imgur.com/zWSpecm.png)
![](https://i.imgur.com/z9uRBZP.png)


## Test Cases 
To ensure the application has been setup correctly and everything is working as intended, you may run test cases that have been implemented into the code to ensure there are no errors/issues during the setup process. 
There are multiple test cases that have been implemented. You may run the following command ```php artisan test``` to run all test cases or you may run the tests separately:

- To run tests for the *cart page*, enter the `php artisan test --filter CartPageTest`
- To run tests for the *coupon system*, enter the `php artisan test --filter CouponTest`
- To run tests for the *login page*, enter the `php artisan test --filter LoginPageTest`
- To run tests for the *signup page*, enter the `php artisan test --filter SignupPageTest`
- To run tests for the *product page*, enter the `php artisan test --filter ProductPageTest`
- To run tests for the *reset password system*, enter the `php artisan test --filter ResetPasswordTest`
- To run tests for the *reset password system*, enter the `php artisan test --filter ReviewTest`


**All tests should return as passed.** If any tests do fail, please refer to the [getting started](#getting-started) section to ensure you have installed the project correctly. 

## Development Analysis
During development, one of the features that needed to be implemented into the project was two-factor authentication as well as allowing the user to reset their password in case they forgot it. With various research, Laravel fortify was discovered which contained detailed documentation of the features/how to implement them into a project.

With the use of Laravel fortify, all the methods and controllers are included with the package. For example, logging in, registering and two-factor authentication are routes that are already pre-defined and therefore, you don’t need to define them in your routes.php. This is very helpful and useful as its time-efficient, something that is vital during project development. 

Without the use of Laravel fortify, creating controllers and methods for all these features would be extremely time-consuming and will result in way more testing that will need to be performed to ensure everything is working as intended. It is also likely that, during development, more errors will arise that will need to be resolved than simply using Laravel fortify which is something that has been used by thousands of people and is extensively tested to ensure all the features that it can do, works as intended. 

Furthermore, Laravel fortify requires tokens to be passed during reset password and enabling two factor authentication. This means that throughout the whole process, it is validating that the user matches with the user that is requesting the methods which greatly enhances the security of the project to ensure anyone on the outside can not manipulate the code and reset someone’s password or enable 2FA for someone which they didn’t request for. 

Lastly, it was appropriate to choose Laravel fortify for these features as there were multiple YouTube videos that covered how to use Laravel fortify and setup features such as 2FA and reset password. There were also posts that people published of Laravel fortify displaying a certain error message and how to resolve them which during the development, helped a lot. 
 


## References
- Zura [The Codeholic] (2022, October 10) *Stripe Complete Checkout Process in Laravel*\
    Youtube: https://www.youtube.com/watch?v=J13Xe939Bh8

- [Penguin Digital] (2022, October 16) *2FA two-factor authentication - Create your own Laravel 8 login system using Laravel Fortify - EP7*\
    Youtube: https://www.youtube.com/watch?v=5-P5gBM6hDM

- Andre Madarang [Andre Madarang] (2018, January 15) *Laravel E-Commerce - Coupons & Discounts - Part 6*\
    Youtube: https://www.youtube.com/watch?v=N9U4FYLBEiQ

- Muhammad Irshad [Online Tutorials] (2018, January 15) *Pure CSS Star Rating Widget - How To Create a Simple Star Rating with Html and CSS - No Javascipt*\
    Youtube: https://www.youtube.com/watch?v=Ep78KjstQuw

- Laravel *The PHP Framework For Web Artisans*\
    https://laravel.com/docs/9.x/

- Laravel *Laravel Fortify*\
    https://laravel.com/docs/9.x/fortify#fortify

- Stripe *Accept a payment*\
    https://stripe.com/docs/payments/accept-a-payment