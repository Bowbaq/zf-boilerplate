require_recipe "php"
require_recipe "php::module_mysql"
require_recipe "php::module_apc"
require_recipe "php::module_memcache"
require_recipe "php::module_curl"

# Discover some channels
%w{ pear.phpunit.de components.ez.no pear.symfony-project.com
    pear.phpmd.org pear.pdepend.org pear.docblox-project.org 
    pear.michelf.com doc.php.net }.each do |channel|
  php_pear_channel channel do
    action :discover
  end
end

# Install some additional dependencies
%w{ phpunit php5-xsl graphviz php5-sqlite }.each do |pkg|
  package pkg do
    action :install
  end
end

# Install the php packages we need
## Upgrade existing packages
execute "PEAR: upgrade all packages" do
  command "pear upgrade-all"
end

%w{ phpmd/PHP_PMD pdepend/PHP_Depend PHP_CodeSniffer-1.3.0 
    phpunit/phploc phpunit/phpcpd docblox/DocBlox 
    doc.php.net/PhD }.each do |mod|
  php_pear mod do
    action :install
  end
end

# Install xDebug
php_pear "xdebug" do
  # Specify that xdebug.so must be loaded as a zend extension
  zend_extensions ['xdebug.so']
  action :install
end