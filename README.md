# learn-online-php
Web application built using PHP that manages a database of students and courses and renders the content on HTML. Users can see the lists of all courses/users present on the database; there are also detail views of courses and users. Furthermore, it is possible for the users to enroll or drop courses and this data will be updated on the database.

There is a login on the index page so the users have to provide their username and password to log in.

The project makes use of the Mode-View-Controller (MVC) architecture.

* Project structure
  * index.php: This is the start point of our web application and the person who uses this app is supposed to start here. It will redirect the user to a different webpage depending on different things (e.g. which component and view is specified or if the database of our app needs to be created). 
  * configuration.php: This file defines important constants for the correct running of our app, such as the database name, host, username and password. Without it no webpage of our app would work properly.
  * installation.php: This page is where the user is redirected after launching the application (index.php) for the first time. It is possible too that the user runs installation.php directly without going to index.php. However, after the installation of the database is done the access to this file won’t be permitted.
  * /admin directory: It stores the files that any administrative user can modify while accessing our application (page title and subtitle). We can find these files in the subfolder ‘settings’. 
  * /components directory: This folder contains every component used by the app. I’ve created 3 components: user, course and default. The first two work this way: both have one list view showing the users or the courses of the database, and they have a detail view in which we can see more information about one specific user/course. The default component corresponds to the ‘homepage’ of our web app. It also displays a login form to make it possible for the users to be identified by the system.
  * /content directory: This folder stores a ‘css’ subfolder containing one .css file used by my app, and a ‘database’ subfolder which contains (in form of .txt files) the names of the host, username, password and database name that our web application will use.  The latter folder is crucial for the correct running of our app, because we will be accessing our database in almost every page and we need those names to do it (configuration.php makes use of this folder).
  * /installation directory: This folder contains the necessary .php files for the installation.php file to be able to run. These .php files contain different layout and database functions to make that webpage work properly.   
