# Table Of Contents

* [About Project](#about-project)
* [Getting Started](#getting-started)
* [Known Issues](#known-issues)


# About Project

This project is based on a basic shopping website which has been created with the use of HTML, Laravel and CRUD operations. The website contains the following functions:

* Login/Signup System
* Homepage
* Products View Page (Allows the user to add the product to cart as well as edit the description of the product which will make changes within the database)
* Cart View Page (Allows the user to delete the product from cart as well as view the product)


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

### 1. Clone the repo 
1. Click the green button within the repo named "Code" as shown in the image below
![](https://i.imgur.com/U5rkTWZ.png)
2. Copy the URL of the repository
3. Open your git bash terminal 
4. Change the current directory to the location that you want the cloned directory to go to
5. Into your termianl, type the following: ``git clone`` [INSERT THE LINK YOU COPIED]


### 2. Install PHP dependencies 
1. Open your webserver terminal 
2. Copy the following commands and ensure that you press enter after each command:
    * ``php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"``
    * ``php -r "if (hash_file('sha384', 'composer-setup.php') === '55ce33d7678c5a611085589f1f3ddf8b3c52d662cd01d4ba75c0ee0459970c2200a51f492d557530c71c15d8dba01eae') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"``
    * ``php composer-setup.php``
    * ``php -r "unlink('composer-setup.php');"``
    * ``php composer.phar``


### 3. Install node dependencies 
1. If you do not have node installed, please go the following link: https://nodejs.org/dist/v16.11.0/ and install the ZIP version 
    1. Once installed, unzip the contents while ensuring the file is named ``node``
    2. Open your webserver terminal and type the following: ``set PATH=D:\node;%PATH%`` - Replace "D:" with the drive letter your node is located in
2. Open your git bash terminal, change the current directory to the root of the project (htdocs/assignment01) and enter the following command:
``../../../node/npm install -D tailwindcss postcss autoprefixer``
3. Enter this command after: ``npx tailwind init -p``


### 4. Build front end assets
1. From the root of the project within git-bash terminal, enter the following command to build the assets: ``npm run dev``
    * If an error pops up where npm does not exist, please open your webserver terminal and type the following: ``set PATH=D:\node;%PATH%`` - Replace "D:" with the drive letter your node is located in
2. Ensure the git-bash terminal remains open will you view the website 


### Edit .env.example file
1. Open the project within your chosen code editor
2. Locate a file named `.env.example` which should be at the bottom of your file explorer section 
3. Change the following section as shown below to match your database details:

![](https://i.imgur.com/glSiD30.png)


### 5. Migrate the database
1. Please ensure your MySQL module is running
2. Open git-bash terminal, change the root to the project and enter the following command: ``php artisan migrate`` - You should see a list of tables being displayed
3. Keep the terminal open and [seed the database](#seed-the-database)

### 6. Seed the database 
1. You should already have completed the [migrate database](#migrate-the-database) section and therefore should still have the terminal open - If you do not, please refer back to the steps
2. Enter the following command: ``php artisan db:seed``
3. This is the last section and you should now be able to view the website along with the correct front end assets by visiting: http://localhost/ while ensuring both apache and mysql module's are running 

## Known Issues

This section will cover any issues/bugs you may occur within the project that have not been resolved due to time constraints. 

* First product within the products and cart page may bug out and result in the user unable to interact with the buttons. Possible workaround:
    * Add a product to cart other than the product at the top which will result in the site refreshing and letting you interact with the buttons for the top product.
* Show button within the cart page shows as blue text