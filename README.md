# ezolp

### Dev Setup
1. To use Vagrant first install vagrant and virtualbox.
2. From the root of the project directory type 'vagrant up'
3. Edit your hosts file and add the following entry: `192.168.56.101  gofundit.dev`
4. Access the application at http://gofundit.dev

### CLI Functions
* Seed Database: `php index.php Seeder demo_seed`
* NationBuilder Worker: `php index.php 'nation_builder/Nation_builder' worker`
* Contribution Report Worker: `php index.php 'contributionreport/Contributionreport' worker`
* Prospect Report Worker: `php index.php 'prospect/Prospect' worker`

### GFI Production Deployment Documentation (WIP)
1. Select a slug for the application, for example `demo`
2. Gain superuser permissions by running: `sudo su`
3. Create a new directory for the application slug you selected in step 1 within `/var/www/` on gfi-web-01.
4. Clone the project from github by running: `git clone git@github.com:iwatllc/ezolp.git .`
5. Login to PHPMyAdmin on gfi-db-01
6. Create a new user for the slug selected in step 1 using the format `gfi_<SLUG>` and restricting access to the ip `10.132.43.129`.  Example: If the slug was 'demo' the mysql username would be: `gfi_demo@10.132.43.129`
7. Create a new database for the application using the name you used for the username. Example: `gfi_demo`
8. <Add step about setting up user privleges>
9. Update the database config for the application at `client/clientdb.php` useing the user/database you just created and the ip `10.132.26.26` for the hostname.
10. Update the base_url for the application in `client/clientconfig.php`
11. Copy the apache configuration at `etc/apache2/sites-available/025-demo.gofunditsolutions.com.conf` to a new file which coresponds to the domain you set for the 'base_url'. Also edit this configuration update the server name and root directory.
12. Use `a2ensite` to enable this new configuration and then reload apache.
13. Copy the supervisord conf located at `/etc/supervisor/conf.d/gfi_demo.conf` to a new file which matches the slug you selected earlier. Example: `/etc/supervisor/conf.d/gfi_iwat.conf`
