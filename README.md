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
7. [Make an .env file](#make-an-env-file)
8. [Migrate the database](#migrate-the-database)
9. [Seed the database](#seed-the-database)

### Clone the repo 
1. Click the green button within the repo named "Code" as shown in the image below 
![](https://i.imgur.com/U5rkTWZ.png)
2. Copy the URL of the repository
3. Open your git bash terminal 
4. Change the current directory to the location that you want the cloned directory to go to
5. Into your termianl, type the following: ``git clone`` [INSERT THE LINK YOU COPIED]


### Install PHP dependencies 
1. Open your webserver terminal 
2. Copy the following commands and ensure that you press enter after each command:
    * ``php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"``
    * ``php -r "if (hash_file('sha384', 'composer-setup.php') === '55ce33d7678c5a611085589f1f3ddf8b3c52d662cd01d4ba75c0ee0459970c2200a51f492d557530c71c15d8dba01eae') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"``
    * ``php composer-setup.php``
    * ``php -r "unlink('composer-setup.php');"``
    * ``php composer.phar``

### Install node dependencies 
1. If you do not have node installed, please go the following link: https://nodejs.org/dist/v16.11.0/ and install the ZIP version 
    1. Once installed, unzip the contents while ensuring the file is named ``node``
    2. Open your webserver terminal and type the following: ``set PATH=D:\node;%PATH%`` - Replace "D:" with the drive letter your node is located in
2. Open your git bash terminal, change the current directory to the root of the project (htdocs/assignment01) and enter the following command:
``../../../node/npm install -D tailwindcss postcss autoprefixer``
3. Enter this command after: ``npx tailwind init -p``


### Build front end assets
1. From the root of the project within git-bash terminal, enter the following command to build the assets: ``npm run dev``


### Make an .env file


### Migrate the database


### Seed the database 

## Known Issues

* First product within the products and cart page may bug out and result in the user unable to interact with the buttons. Possible workaround:
    * Add 