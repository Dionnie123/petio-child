CUSTOM WORDPRESS THEME DEVELOPMENT:

1. HOW TO IMPORT FILES

Parent Theme:
require_once(get_template_directory() . '/folder/foo.php');

Child Theme:
require_once(get_stylesheet_directory() . '/folder/foo.php');

2. OVERRIDING TEMPLATES OR FUNCTIONS

- Common misconceptions is that you can just override a template or function of parent theme by simply
  replecating file and the file structure on the child theme, It will not work everytime.

Quick Workaround

1. Search the the function on parent theme, wrap the code like this e.g

if( !function_exists('foo') )
{ function foo() {} }

We tell the parent theme to not execute its foo function if it's already added which will definitely happen because we will
register our custom foo function via child theme.

2. On Child theme, go to functions.php
   function foo()
   {
   ?>
   <h1>HELLO WORLD</h1>
   <?php
   }
