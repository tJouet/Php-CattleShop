

  

# Simple crud app

 This app was realised to pass a technical test. On the base of a family owned farm market, it allows its visitors to browse a list of animals for sale as well as filtering them. As a user you can login and edit your animals.

## Used technologies:


 - [PHP](https://www.php.net/) :  <img src="https://www.vectorlogo.zone/logos/php/php-icon.svg" alt="illustrator" width="40" height="40"/>
 - [Laravel](https://laravel.com/):  <img src="https://www.vectorlogo.zone/logos/laravel/laravel-icon.svg" alt="illustrator" width="40" height="40"/>

And to deploy a PHP development environment I used:

 - [Herd](https://herd.laravel.com): <img src="https://external-content.duckduckgo.com/iu/?u=https%3A%2F%2Fherd.laravel.com%2Fimages%2Fappicon.png&f=1&nofb=1&ipt=f3e0c903c077d2e36de4aae25170a64cd2c6b31dc52cb4042ff9dfda6989878d&ipo=images" alt="illustrator" width="40" height="40"/>
 
**You have to make sure Herd is installed on your computer to correctly launch the app.** 

I am **looking into alternative ways** to deploy this project. They sould be available soon.






# Getting started

## Install project

First of all you need to clone this repo in the file of your choosing and open it in your SDE. I personnaly use VSC.

Once this is done, you can start installing PHP and Nodejs dependencies with:

    composer install
and

    npm install

then build the app by running:

    npm run build
  
  Finally create your `.env` file by copy pasting the `.env.example` of the project.
  
  Do not run the `npm run dev` command just yet. We will come to it in a few steps.
  
## Starting the database

After installing the project we need to get the database running, starting by migrating the tables with:

    php artisan migrate
    
This should make a prompt appear, asking you if you want to create an SQLite database for your app. You must approve this operation, thus creating the project database.

To fill this database I used seeders that must be launched with the command:

    php artisan db:seed

This can take a bit of time as it generates pictures.

While the database is getting filled you can go ahead and

## Configure Herd

As stated before, I used [Herd](https://herd.laravel.com) to code this project. If you are unfamiliar with the app don't worrie, as I will show you a step by step process to lauch the app.

First of all download Herd. We are not getting very far in Herd's configuration without it.

As you open Herd you should see that his **NGINX** and **PHP** services are running. 
Under the ***Quick access*** tab, click on ***Open sites***

![enter image description here](https://i.imgur.com/Pq0Tou3.png)
 Once this menu opened, ***Add*** a site and ***Link*** your site to the file where you have cloned the project.
![efefefe](https://i.imgur.com/mFJWh6M.png)

Congrats! You just added your project! It is now almost ready to launch. 
 For the last step copy your site ***URL*** and copy it in your `.env` under the key `APP_URL=`
![enter image description here](https://i.imgur.com/6tkCwHF.png)

You should be good to go!

## Run the website

Once every step above is done go ahead and use the command:

    npm run dev
   
   **Your website is now running** on the URL you have pasted for Herd. Don't let it go to far!
   (Because it's running you know... Anyway...)

# Using the app

As a visitor your choices are pretty limited. You can only consult a list of pregenerated animals.
Those can be filtered thanks to the dropdown options you can see on top of the list.

To log in you have to use a dummy account I have created specially for the occasion. You the log in option in the header to redirect you to a sign in page.

Here are the email and password you should use. 

 - Email : jeanmichel64@mink.com
 - Password: minkIsGo@t.64

You can then access your dashboard where you will find the list of "your" animals. You can edit them or create a new one. Let your imagination run wild!

When finished, you can simply log out.
