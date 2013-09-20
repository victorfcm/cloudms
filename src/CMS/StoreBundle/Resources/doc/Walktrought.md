#** Walktrought **#

###** Requirements Install **###
 * PHP 5.3+
    - $ sudo apt-get install php5 (Ubuntu)
    - $ yum install php5 (CentOS)
 * PHP Composer
    - $ curl -s https://getcomposer.org/installer | php (Ubuntu and CentOS)

###** Project Instalation **###
 * First step, the cloning.
    - Project: $ git clone git@bitbucket.org:victorfcm/cms.git (that will create the folder "cms" inside the current folder)
    - Wiki: $ git clone git@bitbucket.org:victorfcm/cms.git/wiki (that will create the folder "wiki" inside the current folder)

 * Secound step, the configuration.
    - Database: alter the file "app/config/parameters.yml" and change the fields, database_host, database_user, database_password to match with your database information.
 
 * Third step, the run!
    - Once configurated your database, run the comand:  $ php composer.phar install, that will generate some code to you.

 * Fourth step, run doctrine, run!
    - $ app/console doctrine:schema:create (that will create your database)
    - $ app/console doctrine:schema:update --force (that will update your database schema)

 * Fifity step, almost done!
    - $ chmod -R 777 app/cache app/logs (set the permissions)
 
 * Last step!!
    - Create a vhost in your machine, if you don't know how to do, [Google it!](http://google.com/), set the document root, to the "web/" directory and your DirectoryIndex, set "app.php" or "app_dev.php", obviously, only set "app_dev.php" if you are in dev enviroment.

###** Creating a new site (deprecated, it will be refresh soon) **###
 * First step, bundling.
    - $ app/console generate:bundle (the bundle name must be, CMS/ anything you want).
 
 * Secound step, the parenting.
    - When you create a new site bundle, you need to create the controllers, that would extend the "CMSSiteBundle" controllers.
    - Exemple:
        - CMSYourBundle/Post must extend CMSSiteBundle/Post. You do not need to create a controller for each page, the pages are post types.

 * Third step, templating!!
    - Inside "CMS/YourBundle/Resources/views" will have the foldes matching with your controllers, as exemple, if you want to do one special template for one post type, you can create a file inside the folder "PostType/show.POSTTYPE-SLUG.html.twig".
    - To create the base template, you should create a "base_YOURSITENAME.html.twig" inside the folder "app/Resources/views/", and extend inside each TWIG FILE you want to, [Learn more about TWIG](http://twig.sensiolabs.org/).
