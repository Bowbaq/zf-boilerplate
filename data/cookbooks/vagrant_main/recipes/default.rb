require_recipe "apt"
require_recipe "build-essential"
require_recipe "networking_basic"
require_recipe "apache2"
include_recipe "apache2::mod_php5"
include_recipe "apache2::mod_rewrite"
include_recipe "apache2::mod_deflate"
require_recipe "mysql::server"
require_recipe "php"
require_recipe "php::module_mysql"
require_recipe "php::module_apc"
require_recipe "php::module_memcache"
require_recipe "php::module_curl"
require_recipe "elasticsearch"
require_recipe "ant"
require_recipe "memcached"

# Install mysql gem
gem_package "mysql" do
  action :install
end

ruby_block "Create database + execute grants" do
  block do
    require 'rubygems'
    Gem.clear_paths
    require 'mysql'
    m = Mysql.new("localhost", "root", "")
    m.query("CREATE DATABASE IF NOT EXISTS app CHARACTER SET utf8")
    m.reload
  end
end
