#** README Tamanduá - CMS **#

###** Requirements **###
 * PHP 5.3+
 * PHP Composer
    - $ curl -s https://getcomposer.org/installer | php

###** Framework **###
[Symfony2](http://symfony.com/]) - version 2.2.0

###** External Bundles **###
 * [FOSUserBundle](https://github.com/FriendsOfSymfony/FOSUserBundle)
 * [KNPMenuBundle](https://github.com/KnpLabs/KnpMenuBundle)
 * [StFalconTinyMCEBundle](https://github.com/stfalcon/TinymceBundle)

###** Internal Bundles **###
 1. Acme (symfony2 default demo bundle)
 2. CMS
    - StoreBundle: Bundle of all the database models and Back-end Admin controllers.
    - AdminBundle: Bundle of Front-end CMS Admin controllers.
    - SiteBundle: Dummy bundle of a joint of views and controllers, to make the front-end WebSite.

###** Production bundle structure **###
 1. StoreBundle
    - Databases and Controllers of the back-end admin, this should be in a different server, to avoid copies and hacking.
 2. AdminBundle
    - Controllers of the front-end admin, this one **NEED** to be on the same server of the application.
 3. SiteBundle
    - Can have more than one site bundle, and they don't need to have the name "SiteBundle", this one can be hosted in any server.

###** The Idea **###
An powered CMS with the core no-hosted on the client, with a administrator area that you can administer how many sites as you want.
