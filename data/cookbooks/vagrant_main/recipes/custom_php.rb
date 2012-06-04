require_recipe "php"
require_recipe "php::module_mysql"
require_recipe "php::module_apc"
require_recipe "php::module_memcache"
require_recipe "php::module_curl"

# # Discover some channels
# %w{ pear.phpunit.de components.ez.no pear.symfony-project.com
#     pear.phpmd.org pear.pdepend.org pear.docblox-project.org 
#     pear.michelf.com doc.php.net }.each do |channel|
#   php_pear_channel channel do
#     action :discover
#   end
# end
# 
# # Install some additional dependencies
# %w{ phpunit php5-xsl graphviz php5-sqlite }.each do |pkg|
#   package pkg do
#     action :install
#   end
# end
# 
# # Install the php packages we need
# execute "PEAR: upgrade all packages" do
#   command "pear upgrade-all"
# end
# 
# %w{ PHP_PMD PHP_Depend PHP_CodeSniffer-1.3.0 
#     phploc-1.5.0 xdebug phpcpd docblox PhD }.each do |mod|
#   php_pear mod do
#     action :install
#   end
# end

package "php-pear" do
  action :install
end

php_pear_channel "pear.phpunit.de" do
  action :discover
end

php_pear_channel "components.ez.no" do
  action :discover
end

php_pear_channel "pear.symfony-project.com" do
  action :discover
end

php_pear_channel "pear.phpmd.org" do
  action :discover
end

php_pear_channel "pear.pdepend.org" do
  action :discover
end

php_pear_channel "pear.docblox-project.org" do
  action :discover
end

php_pear_channel "pear.michelf.com" do
  action :discover
end

# using apt
package "phpunit" do
  action :install
end

# XSL needed by DocBlox
package "php5-xsl" do
  action :install
end

# Graphviz needed by DocBlox
package "graphviz" do
  action :install
end

# Sqlite needed by PHD (Docbook)
package "php5-sqlite" do
  action :install
end

# Using PEAR installer
execute "PEAR: upgrade all packages" do
  command "pear upgrade-all"
end

execute "PEAR: install phpmd/PHP_PMD" do
  command "pear install -f phpmd/PHP_PMD"
end

execute "PEAR: install pdepend/PHP_Depend" do
  command "pear install -f pdepend/PHP_Depend"
end

execute "PEAR: install PHP_CodeSniffer-1.3.0" do
  command "pear install -f PHP_CodeSniffer-1.3.0"
end

execute "PEAR: install phploc-1.5.0" do
  command "pear install -f phpunit/phploc"
end

execute "PECL: install xdebug" do
  command "pecl install xdebug"
end

execute "PEAR: install phpcpd" do
  command "pear install -f phpunit/phpcpd"
end

execute "PEAR: install docblox" do
  command "pear install -f docblox/DocBlox"
end

execute "PEAR: install PhD" do
  command "pear install -f --alldeps doc.php.net/PhD"
end