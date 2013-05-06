#** README CloudMS **#

###** Requirements **###
 * PHP 5.3+
 * PHP Composer
    - $ curl -s https://getcomposer.org/installer | php

###** Framework **###
[Symfony2](http://symfony.com/) - version 2.2.0

###** Project Documentation **###
[Visit the Wiki](cms/wiki/Home)

###** External Bundles **###
 * [FOSUserBundle](https://github.com/FriendsOfSymfony/FOSUserBundle)
 * [KNPMenuBundle](https://github.com/KnpLabs/KnpMenuBundle)
 * [StFalconTinyMCEBundle](https://github.com/stfalcon/TinymceBundle)
 * [KNPPaginatorBundle](https://github.com/KnpLabs/KnpPaginatorBundle)
 * [DMSFilterBundle](http://knpbundles.com/rdohms/DMSFilterBundle)
 * [LexikFormFilterBundle](https://github.com/lexik/LexikFormFilterBundle)

###** Internal Bundles **###
 1. CMS
    - StoreBundle: Bundle of all the database models and Back-end Admin controllers.
    - AdminBundle: Bundle of Front-end CMS Admin controllers.

###** Production bundle structure **###
 1. StoreBundle
    - Databases and Controllers of the back-end admin, this should be in a different server, to avoid copies and hacking.
 2. AdminBundle
    - Controllers of the front-end admin, this one **NEED** to be on the same server of the application.

###** The Idea **###
An powered CMS with the core no-hosted on the client, with a administrator area that you can administer how many sites as you want.
