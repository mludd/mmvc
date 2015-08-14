# The Simple PHP MVC Framework (sipMVC)

## What is this?

sipMVC is a simple PHP-based MVC framework.


## Structure


/config:
    Contains all configuration files. The configuration is stored in XML
    files. Currently if you want to use a configuration file other than
    the default ones you need to edit models/config.inc.php to make it
    read the file(s). A fix for this is forthcoming.
/controllers
    - This is where controllers go, they should inherit from the base
      Controller class.
/models
    - For all model classes
/smarty/templates
    - Put your Smarty templates in this directory
/Smarty
    - Included Smarty installation


### URL and controller anatomy

A normal URL to a view in sipMVC looks something like this:
http://example.com/controller/action/arguments

Each action is defined as a function in your controller, the
default action if one is not specified is the 'index' action, the method
for this action is 'indexAction()'.

If you want to add other actions to your controllers you just name the
methods accordingly. That is, the name of your method should be the name
of your action followed by 'Action'.


### Models

Models in sipMVC are fairly barebones, while there is an abstract parent
'Model' class it currently contains nothing of value, at all.

The models that come with sipMVC are very few:

Config:
    Handles configuration files, reading from XML files and such things.
ControllerFactory:
    Used by the dispatcher to load controllers.
ResourceManager:
    Used for database connections and config objects by default but can be
    extended to handle other things.


## Building your own sites

sipMVC is of course meant to be used to quickly deploy your own sites.

The first thing you'll want to do is probably to replace the default templates
with your own pages.
