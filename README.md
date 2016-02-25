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
