# assisted.by WP

assisted by WP is our WordPress starter repository. The starting place for all our WordPress development.

## Information

WordPress core exists in the `cms` folder, 1 level up from the sites root. This means the `wp-config.php` file is in the root along with a custom content directory for themes, plugins and uploads. The `wp-config.php` file also takes care of different development environments using a `env-config.php` (example included). This file contains the database connection details for each of your development environments as well as some constants to check which dev environment you are currently in.

## Usage Instructions

1. Clone the repository in the root of your website (usually `public_html` or `htdocs` on an apache server).
2. Edit the name of the `env-config-sample.php` file to `env-config.php` and add the connection details to your database in that file as well as setting the development environment constant to true for whichever environment you are working in.
3. Visit the domains url and you should receive the normal WordPress installation steps after the database connection stage. Install WordPress normally from here.
4. Once logged into the WordPress admin, navigate to Settings and remove /cms from the setting labelled 'Site Address (URL)'
5. Thats it you should be good to go.

Remember that the `/content` folder now works as the usual `/wp-content` folder normally does storing your plugins and themes etc.