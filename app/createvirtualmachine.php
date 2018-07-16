<?php

session_start();

ini_set("max_execution_time", 0);
set_time_limit(0);

include 'connection.php';



if($_POST){

	$user_id = $_SESSION['user']['id'];
	$name = $_POST['name'];


	$query = 'SELECT * FROM misc';

	$statement = $conn->prepare($query);

	$statement->execute([]);

	$values = $statement->fetch(PDO::FETCH_ASSOC);

	$ip = $values['ip'];
	$port = $values['port'];
	
	$query = 'UPDATE misc SET ip=:ip, port=:port';

	$statement = $conn->prepare($query);

	$values = [
		':ip' => ((int)$ip + 1),
		':port' => ((int)$port + 1)
	];

	$statement->execute($values);

	$query = 'INSERT INTO machines (user_id,name,ip,port) VALUES (:user_id,:name,:ip,:port)';

	$statement = $conn->prepare($query);

	$values = [
		':user_id' => $user_id,
		':name' => $name,
		':ip' => $ip,
		':port' => $port
	];


	$statement->execute($values);



	exec('cd C:/workspace && mkdir ' . $name . ' && cd ' .$name. ' && mkdir projects');
	$myfile = fopen('C:/workspace/'.$name.'/Vagrantfile', 'w');


	$txt = "# -*- mode: ruby -*-
# vi: set ft=ruby :

# All Vagrant configuration is done below. The \"2\" in Vagrant.configure
# configures the configuration version (we support older styles for
# backwards compatibility). Please don't change it unless you know what
# you're doing.
Vagrant.configure(\"2\") do |config|
  # The most common configuration options are documented and commented below.
  # For a complete reference, please see the online documentation at
  # https://docs.vagrantup.com.

  # Every Vagrant development environment requires a box. You can search for
  # boxes at https://atlas.hashicorp.com/search.
  config.vm.box = \"arian\"

  # Disable automatic box update checking. If you disable this, then
  # boxes will only be checked for updates when the user runs
  # `vagrant box outdated`. This is not recommended.
  # config.vm.box_check_update = false

  # Create a forwarded port mapping which allows access to a specific port
  # within the machine from a port on the host machine. In the example below,
  # accessing \"localhost:8080\" will access port 80 on the guest machine.
  config.vm.network \"forwarded_port\", guest: 80, host:" . $port . " 

  # Create a private network, which allows host-only access to the machine
  # using a specific IP.
  config.vm.network \"private_network\", ip: \"192.168.33." . $ip . "\"

  # Create a public network, which generally matched to bridged network.
  # Bridged networks make the machine appear as another physical device on
  # your network.
  # config.vm.network \"public_network\"

  # Share an additional folder to the guest VM. The first argument is
  # the path on the host to the actual folder. The second argument is
  # the path on the guest to mount the folder. And the optional third
  # argument is a set of non-required options.
  # config.vm.synced_folder \"../data\", \"/vagrant_data\"

  # Provider-specific configuration so you can fine-tune various
  # backing providers for Vagrant. These expose provider-specific options.
  # Example for VirtualBox:
  #
  # config.vm.provider \"virtualbox\" do |vb|
  #   # Display the VirtualBox GUI when booting the machine
  #   vb.gui = true
  #
  #   # Customize the amount of memory on the VM:
  #   vb.memory = \"1024\"
  # end
  #
  # View the documentation for the provider you are using for more
  # information on available options.

  # Define a Vagrant Push strategy for pushing to Atlas. Other push strategies
  # such as FTP and Heroku are also available. See the documentation at
  # https://docs.vagrantup.com/v2/push/atlas.html for more information.
  # config.push.define \"atlas\" do |push|
  #   push.app = \"YOUR_ATLAS_USERNAME/YOUR_APPLICATION_NAME\"
  # end

  # Enable provisioning with a shell script. Additional provisioners such as
  # Puppet, Chef, Ansible, Salt, and Docker are also available. Please see the
  # documentation for more information about their specific syntax and use.
  # config.vm.provision \"shell\", inline: <<-SHELL
  #   apt-get update
  #   apt-get install -y apache2 php5 php5-dev
  # SHELL
end";


	fwrite($myfile, $txt);

	fclose($myfile);

  $myfile = fopen('C:/workspace/'.$name. '/projects/index.php','w');

  $txt = 'Hi!';

  fwrite($myfile, $txt);
  fclose($myfile);

	exec('cd C:/workspace/'. $name . ' && vagrant up');
	header('Location: ../machine.php?id=' . $_SESSION['user']['id']);

}