<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_base_all extends CI_Migration {

	public function up() {

		## Create Table app_version
		$this->db->query('CREATE TABLE `app_version` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `version` varchar(25) NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'inactive',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8');

		## Create Table groups
		$this->db->query('CREATE TABLE `groups` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8');
		### Insert data into table groups ##
		$data	= array(
			array(
				'id' => '1',
				'name' => 'admin',
				'description' => 'Administrator',
			),
			array(
				'id' => '2',
				'name' => 'members',
				'description' => 'General User',
			),
			array(
				'id' => '3',
				'name' => 'sample 3',
				'description' => 'desc of sample 3',
			),
			array(
				'id' => '4',
				'name' => 'AfyaMoja=1',
				'description' => 'Afya Moja 1',
			),
			array(
				'id' => '5',
				'name' => 'Malinyi',
				'description' => 'Malinyi description',
			),
			array(
				'id' => '6',
				'name' => 'Research',
				'description' => 'Research ',
			),
		);
		$this->db->insert_batch("groups",$data);

		## Create Table login_attempts
		$this->db->query('CREATE TABLE `login_attempts` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(45) NOT NULL,
  `login` varchar(100) DEFAULT NULL,
  `time` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8');

		## Create Table migrations
		$this->db->query('CREATE TABLE `migrations` (
  `version` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8');
		### Insert data into table migrations ##
		$data	= array(
			array(
				'version' => '20180903114047',
			),
		);
		$this->db->insert_batch("migrations",$data);

		## Create Table ohkr_detected_diseases
		$this->db->query('CREATE TABLE `ohkr_detected_diseases` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `table_name` varchar(255) NOT NULL,
  `instance_id` int(11) NOT NULL,
  `disease_id` int(11) NOT NULL,
  `reported_at` datetime NOT NULL,
  `reported_user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8');

		## Create Table ohkr_disease_symptoms
		$this->db->query('CREATE TABLE `ohkr_disease_symptoms` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `disease_id` int(11) NOT NULL,
  `symptom_id` int(11) NOT NULL,
  `specie_id` int(11) NOT NULL,
  `importance` double NOT NULL,
  `created_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8');

		## Create Table ohkr_diseases
		$this->db->query('CREATE TABLE `ohkr_diseases` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `specie` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8');

		## Create Table ohkr_species
		$this->db->query('CREATE TABLE `ohkr_species` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8');

		## Create Table ohkr_symptoms
		$this->db->query('CREATE TABLE `ohkr_symptoms` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `code` varchar(10) NOT NULL,
  `description` text NOT NULL,
  `created_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8');

		## Create Table perm_config
		$this->db->query('CREATE TABLE `perm_config` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `perm_tree_id` int(11) NOT NULL,
  `category` varchar(20) NOT NULL,
  `description` text NOT NULL,
  `filters` text NOT NULL,
  `perms` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=latin1');
		### Insert data into table perm_config ##
		$data	= array(
			array(
				'id' => '39',
				'perm_tree_id' => '20',
				'category' => 'add',
				'description' => '',
				'filters' => '',
				'perms' => 'xxP1P,xxP2P',
			),
			array(
				'id' => '40',
				'perm_tree_id' => '20',
				'category' => 'add',
				'description' => '',
				'filters' => '',
				'perms' => 'xxP1P,xxP2P',
			),
			array(
				'id' => '41',
				'perm_tree_id' => '20',
				'category' => 'add',
				'description' => '',
				'filters' => '',
				'perms' => 'xxP1P,xxP2P,xxG1G',
			),
			array(
				'id' => '42',
				'perm_tree_id' => '20',
				'category' => 'add',
				'description' => '',
				'filters' => '',
				'perms' => 'xxP1P,xxP2P,xxG1G',
			),
			array(
				'id' => '43',
				'perm_tree_id' => '20',
				'category' => 'delete',
				'description' => '',
				'filters' => '',
				'perms' => 'xxP1P,xxP2P,xxG1G,xxG2G',
			),
			array(
				'id' => '44',
				'perm_tree_id' => '25',
				'category' => 'add',
				'description' => '',
				'filters' => '',
				'perms' => 'P1P,G1G',
			),
			array(
				'id' => '45',
				'perm_tree_id' => '25',
				'category' => 'delete',
				'description' => '',
				'filters' => '',
				'perms' => 'P1P,G1G',
			),
			array(
				'id' => '46',
				'perm_tree_id' => '25',
				'category' => 'tab',
				'description' => '',
				'filters' => '78,79',
				'perms' => 'G2G',
			),
		);
		$this->db->insert_batch("perm_config",$data);

		## Create Table perm_filter
		$this->db->query('CREATE TABLE `perm_filter` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(150) NOT NULL,
  `description` text NOT NULL,
  `table_name` varchar(300) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1');

		## Create Table perm_filter_config
		$this->db->query('CREATE TABLE `perm_filter_config` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `perm_filter_id` int(11) NOT NULL,
  `field_name` varchar(150) NOT NULL,
  `oper` varchar(50) NOT NULL,
  `field_value` varchar(300) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `perm_tree_id` (`perm_filter_id`),
  CONSTRAINT `futaYatima_filter` FOREIGN KEY (`perm_filter_id`) REFERENCES `perm_filter` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1');

		## Create Table perm_module
		$this->db->query('CREATE TABLE `perm_module` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `icon` varchar(50) NOT NULL,
  `perms` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1');
		### Insert data into table perm_module ##
		$data	= array(
			array(
				'id' => '1',
				'title' => 'Administration',
				'icon' => '',
				'perms' => 'P1P,P2P',
			),
			array(
				'id' => '10',
				'title' => 'AfyaData',
				'icon' => 'icon-hammer-wrench',
				'perms' => 'P1P',
			),
		);
		$this->db->insert_batch("perm_module",$data);

		## Create Table perm_tables
		$this->db->query('CREATE TABLE `perm_tables` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `module_id` int(11) NOT NULL,
  `label` varchar(100) NOT NULL,
  `table_name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=latin1');
		### Insert data into table perm_tables ##
		$data	= array(
			array(
				'id' => '1',
				'module_id' => '1',
				'label' => 'Manage Permissions',
				'table_name' => 'perm_tree',
				'description' => 'Perm tree',
			),
			array(
				'id' => '2',
				'module_id' => '1',
				'label' => 'Edit Opt Permission',
				'table_name' => 'perm_tree',
				'description' => 'Editing opt permission for manage permissions',
			),
			array(
				'id' => '3',
				'module_id' => '1',
				'label' => 'manage tables',
				'table_name' => 'perm_tables',
				'description' => 'manage tables',
			),
			array(
				'id' => '4',
				'module_id' => '5',
				'label' => 'module',
				'table_name' => 'perm_module',
				'description' => 'Listing all Users jjj',
			),
			array(
				'id' => '5',
				'module_id' => '1',
				'label' => 'Users',
				'table_name' => 'users',
				'description' => '',
			),
			array(
				'id' => '6',
				'module_id' => '1',
				'label' => 'Groups',
				'table_name' => 'groups',
				'description' => '',
			),
			array(
				'id' => '7',
				'module_id' => '1',
				'label' => 'New Filter',
				'table_name' => 'perm_filter',
				'description' => 'Adding new filter',
			),
			array(
				'id' => '8',
				'module_id' => '1',
				'label' => 'Perm filter config',
				'table_name' => 'perm_filter_config',
				'description' => '',
			),
			array(
				'id' => '9',
				'module_id' => '1',
				'label' => 'Users in group',
				'table_name' => 'users_groups',
				'description' => 'list users in group',
			),
			array(
				'id' => '10',
				'module_id' => '1',
				'label' => 'Groups users',
				'table_name' => 'users_groups',
				'description' => 'list groups user is belonged to',
			),
			array(
				'id' => '38',
				'module_id' => '1',
				'label' => 'New User',
				'table_name' => 'users',
				'description' => 'New users',
			),
			array(
				'id' => '61',
				'module_id' => '10',
				'label' => 'Projects',
				'table_name' => 'projects',
				'description' => 'Projects',
			),
		);
		$this->db->insert_batch("perm_tables",$data);

		## Create Table perm_tables_conf
		$this->db->query('CREATE TABLE `perm_tables_conf` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `table_id` int(11) NOT NULL,
  `field_name` varchar(150) NOT NULL,
  `field_property` varchar(150) NOT NULL,
  `field_value` varchar(150) NOT NULL,
  `validation` varchar(300) NOT NULL,
  `display_posn` int(2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `table_id` (`table_id`),
  CONSTRAINT `futaYatima` FOREIGN KEY (`table_id`) REFERENCES `perm_tables` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=260 DEFAULT CHARSET=latin1');
		### Insert data into table perm_tables_conf ##
		$data	= array(
			array(
				'id' => '20',
				'table_id' => '2',
				'field_name' => 'perm_type',
				'field_property' => 'hidden',
				'field_value' => '',
				'validation' => '',
				'display_posn' => '0',
			),
			array(
				'id' => '21',
				'table_id' => '2',
				'field_name' => 'perm_data',
				'field_property' => 'hidden',
				'field_value' => 'gghh',
				'validation' => '',
				'display_posn' => '0',
			),
			array(
				'id' => '22',
				'table_id' => '5',
				'field_name' => 'ip_address',
				'field_property' => 'hidden',
				'field_value' => '',
				'validation' => '',
				'display_posn' => '0',
			),
			array(
				'id' => '24',
				'table_id' => '1',
				'field_name' => 'perm_target',
				'field_property' => 'dropdown',
				'field_value' => 'detail_wrp,list_wrp',
				'validation' => '',
				'display_posn' => '0',
			),
			array(
				'id' => '25',
				'table_id' => '1',
				'field_name' => 'parent_id',
				'field_property' => 'hidden',
				'field_value' => '0',
				'validation' => '',
				'display_posn' => '0',
			),
			array(
				'id' => '26',
				'table_id' => '1',
				'field_name' => 'module_id',
				'field_property' => 'hidden',
				'field_value' => '3',
				'validation' => '',
				'display_posn' => '0',
			),
			array(
				'id' => '28',
				'table_id' => '1',
				'field_name' => 'perm_type',
				'field_property' => 'dropdown',
				'field_value' => 'table,controller',
				'validation' => '',
				'display_posn' => '0',
			),
			array(
				'id' => '29',
				'table_id' => '1',
				'field_name' => 'perms',
				'field_property' => 'hidden',
				'field_value' => '',
				'validation' => '',
				'display_posn' => '0',
			),
			array(
				'id' => '30',
				'table_id' => '1',
				'field_name' => 'perm_data',
				'field_property' => 'hidden',
				'field_value' => '',
				'validation' => '',
				'display_posn' => '0',
			),
			array(
				'id' => '31',
				'table_id' => '1',
				'field_name' => 'module_id',
				'field_property' => 'db_dropdown',
				'field_value' => 'perm_module:id:title',
				'validation' => '',
				'display_posn' => '0',
			),
			array(
				'id' => '33',
				'table_id' => '7',
				'field_name' => 'table_name',
				'field_property' => 'CI db_func',
				'field_value' => 'name=select_tables',
				'validation' => '',
				'display_posn' => '0',
			),
			array(
				'id' => '34',
				'table_id' => '7',
				'field_name' => 'description',
				'field_property' => 'textarea',
				'field_value' => '',
				'validation' => '',
				'display_posn' => '0',
			),
			array(
				'id' => '35',
				'table_id' => '8',
				'field_name' => 'oper',
				'field_property' => 'dropdown',
				'field_value' => '>,=,<',
				'validation' => '',
				'display_posn' => '0',
			),
			array(
				'id' => '36',
				'table_id' => '2',
				'field_name' => 'parent_id',
				'field_property' => 'hidden',
				'field_value' => '',
				'validation' => '',
				'display_posn' => '0',
			),
			array(
				'id' => '37',
				'table_id' => '2',
				'field_name' => 'module_id',
				'field_property' => 'hidden',
				'field_value' => '',
				'validation' => '',
				'display_posn' => '0',
			),
			array(
				'id' => '38',
				'table_id' => '2',
				'field_name' => 'title',
				'field_property' => 'hidden',
				'field_value' => '',
				'validation' => '',
				'display_posn' => '0',
			),
			array(
				'id' => '39',
				'table_id' => '2',
				'field_name' => 'icon_font',
				'field_property' => 'hidden',
				'field_value' => '',
				'validation' => '',
				'display_posn' => '0',
			),
			array(
				'id' => '41',
				'table_id' => '2',
				'field_name' => 'perm_target',
				'field_property' => 'hidden',
				'field_value' => '',
				'validation' => '',
				'display_posn' => '0',
			),
			array(
				'id' => '44',
				'table_id' => '5',
				'field_name' => 'ip_address',
				'field_property' => 'hidden',
				'field_value' => '',
				'validation' => '',
				'display_posn' => '0',
			),
			array(
				'id' => '46',
				'table_id' => '5',
				'field_name' => 'salt',
				'field_property' => 'hidden',
				'field_value' => '',
				'validation' => '',
				'display_posn' => '0',
			),
			array(
				'id' => '47',
				'table_id' => '5',
				'field_name' => 'activation_code',
				'field_property' => 'hidden',
				'field_value' => '',
				'validation' => '',
				'display_posn' => '0',
			),
			array(
				'id' => '48',
				'table_id' => '5',
				'field_name' => 'forgotten_password_code',
				'field_property' => 'hidden',
				'field_value' => '',
				'validation' => '',
				'display_posn' => '0',
			),
			array(
				'id' => '53',
				'table_id' => '5',
				'field_name' => 'password',
				'field_property' => 'password_dblcheck',
				'field_value' => '',
				'validation' => '',
				'display_posn' => '0',
			),
			array(
				'id' => '62',
				'table_id' => '3',
				'field_name' => 'module_id',
				'field_property' => 'db_dropdown',
				'field_value' => 'perm_module:id:title',
				'validation' => '',
				'display_posn' => '0',
			),
			array(
				'id' => '63',
				'table_id' => '3',
				'field_name' => 'table_name',
				'field_property' => 'CI db_func',
				'field_value' => 'name=select_tables',
				'validation' => '',
				'display_posn' => '0',
			),
			array(
				'id' => '64',
				'table_id' => '4',
				'field_name' => 'tables',
				'field_property' => 'CI db_func',
				'field_value' => 'name=list_tables',
				'validation' => '',
				'display_posn' => '0',
			),
			array(
				'id' => '65',
				'table_id' => '9',
				'field_name' => 'group_id',
				'field_property' => 'hidden',
				'field_value' => '',
				'validation' => '',
				'display_posn' => '0',
			),
			array(
				'id' => '66',
				'table_id' => '9',
				'field_name' => 'user_id',
				'field_property' => 'db_dropdown',
				'field_value' => 'ob_users:id:username',
				'validation' => '',
				'display_posn' => '0',
			),
			array(
				'id' => '67',
				'table_id' => '10',
				'field_name' => 'user_id',
				'field_property' => 'hidden',
				'field_value' => '',
				'validation' => '',
				'display_posn' => '0',
			),
			array(
				'id' => '68',
				'table_id' => '10',
				'field_name' => 'group_id',
				'field_property' => 'db_dropdown',
				'field_value' => 'ob_groups:id:name',
				'validation' => '',
				'display_posn' => '0',
			),
			array(
				'id' => '191',
				'table_id' => '38',
				'field_name' => 'ip_address',
				'field_property' => 'hidden',
				'field_value' => '',
				'validation' => '',
				'display_posn' => '0',
			),
			array(
				'id' => '192',
				'table_id' => '38',
				'field_name' => 'digest_password',
				'field_property' => 'hidden',
				'field_value' => '',
				'validation' => '',
				'display_posn' => '0',
			),
			array(
				'id' => '193',
				'table_id' => '38',
				'field_name' => 'salt',
				'field_property' => 'hidden',
				'field_value' => '',
				'validation' => '',
				'display_posn' => '0',
			),
			array(
				'id' => '194',
				'table_id' => '38',
				'field_name' => 'activation_code',
				'field_property' => 'hidden',
				'field_value' => '',
				'validation' => '',
				'display_posn' => '0',
			),
			array(
				'id' => '195',
				'table_id' => '38',
				'field_name' => 'forgotten_password_code',
				'field_property' => 'hidden',
				'field_value' => '',
				'validation' => '',
				'display_posn' => '0',
			),
			array(
				'id' => '196',
				'table_id' => '38',
				'field_name' => 'forgotten_password_time',
				'field_property' => 'hidden',
				'field_value' => '',
				'validation' => '',
				'display_posn' => '0',
			),
			array(
				'id' => '197',
				'table_id' => '38',
				'field_name' => 'remember_code',
				'field_property' => 'hidden',
				'field_value' => '',
				'validation' => '',
				'display_posn' => '0',
			),
			array(
				'id' => '198',
				'table_id' => '38',
				'field_name' => 'created_on',
				'field_property' => 'hidden',
				'field_value' => '',
				'validation' => '',
				'display_posn' => '0',
			),
			array(
				'id' => '199',
				'table_id' => '38',
				'field_name' => 'last_login',
				'field_property' => 'hidden',
				'field_value' => '',
				'validation' => '',
				'display_posn' => '0',
			),
			array(
				'id' => '200',
				'table_id' => '38',
				'field_name' => 'active',
				'field_property' => 'hidden',
				'field_value' => '',
				'validation' => '',
				'display_posn' => '0',
			),
			array(
				'id' => '201',
				'table_id' => '38',
				'field_name' => 'phone',
				'field_property' => 'hidden',
				'field_value' => '',
				'validation' => '',
				'display_posn' => '0',
			),
			array(
				'id' => '202',
				'table_id' => '38',
				'field_name' => 'country_code',
				'field_property' => 'hidden',
				'field_value' => '',
				'validation' => '',
				'display_posn' => '0',
			),
			array(
				'id' => '203',
				'table_id' => '38',
				'field_name' => 'password',
				'field_property' => 'password',
				'field_value' => '',
				'validation' => '',
				'display_posn' => '0',
			),
			array(
				'id' => '236',
				'table_id' => '38',
				'field_name' => 'profile_pic',
				'field_property' => 'hidden',
				'field_value' => '',
				'validation' => '',
				'display_posn' => '0',
			),
			array(
				'id' => '237',
				'table_id' => '38',
				'field_name' => 'address',
				'field_property' => 'hidden',
				'field_value' => '',
				'validation' => '',
				'display_posn' => '0',
			),
			array(
				'id' => '257',
				'table_id' => '61',
				'field_name' => 'created_at',
				'field_property' => 'hidden',
				'field_value' => '__current_date',
				'validation' => '',
				'display_posn' => '0',
			),
			array(
				'id' => '258',
				'table_id' => '61',
				'field_name' => 'created_by',
				'field_property' => 'hidden',
				'field_value' => '__user_id',
				'validation' => '',
				'display_posn' => '0',
			),
			array(
				'id' => '259',
				'table_id' => '61',
				'field_name' => 'perms',
				'field_property' => 'hidden',
				'field_value' => '__my_perm',
				'validation' => '',
				'display_posn' => '0',
			),
		);
		$this->db->insert_batch("perm_tables_conf",$data);

		## Create Table perm_tabs
		$this->db->query('CREATE TABLE `perm_tabs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `table_id` int(11) NOT NULL,
  `title` varchar(150) NOT NULL,
  `icon` varchar(50) NOT NULL,
  `table_action_id` int(11) NOT NULL,
  `args` text NOT NULL,
  `perms` text NOT NULL,
  `sort_order` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `table_action_id` (`table_action_id`),
  KEY `table_id` (`table_id`),
  CONSTRAINT `table_id_cascades` FOREIGN KEY (`table_id`) REFERENCES `perm_tables` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=80 DEFAULT CHARSET=latin1');
		### Insert data into table perm_tabs ##
		$data	= array(
			array(
				'id' => '9',
				'table_id' => '1',
				'title' => 'edit',
				'icon' => 'icon-pencil7',
				'table_action_id' => '1',
				'args' => '{"match":"id","oper":"=","to":"id","rend":"edit"}',
				'perms' => '',
				'sort_order' => '0',
			),
			array(
				'id' => '10',
				'table_id' => '3',
				'title' => 'edit',
				'icon' => 'icon-pencil7',
				'table_action_id' => '3',
				'args' => '{"match":"id","oper":"like","to":"id","rend":"edit"}',
				'perms' => '',
				'sort_order' => '0',
			),
			array(
				'id' => '11',
				'table_id' => '3',
				'title' => 'setup',
				'icon' => 'icon-cog2',
				'table_action_id' => '0',
				'args' => 'api/aplus/setup_table',
				'perms' => 'perm/setup_table',
				'sort_order' => '0',
			),
			array(
				'id' => '12',
				'table_id' => '3',
				'title' => 'tabs',
				'icon' => 'tab',
				'table_action_id' => '0',
				'args' => 'api/aplus/set_table_actions',
				'perms' => '',
				'sort_order' => '0',
			),
			array(
				'id' => '13',
				'table_id' => '1',
				'title' => 'setup',
				'icon' => 'icon-cog2',
				'table_action_id' => '0',
				'args' => 'api/aplus/setup_perms',
				'perms' => '',
				'sort_order' => '0',
			),
			array(
				'id' => '17',
				'table_id' => '7',
				'title' => 'Filter',
				'icon' => 'filter_list',
				'table_action_id' => '0',
				'args' => 'api/aplus/filter_config',
				'perms' => '',
				'sort_order' => '0',
			),
			array(
				'id' => '19',
				'table_id' => '1',
				'title' => 'List Perms',
				'icon' => 'icon-list',
				'table_action_id' => '0',
				'args' => 'api/aplus/set_list_perms',
				'perms' => '',
				'sort_order' => '0',
			),
			array(
				'id' => '20',
				'table_id' => '1',
				'title' => 'Tab Perms',
				'icon' => 'view_quilt',
				'table_action_id' => '0',
				'args' => 'api/aplus/set_tab_perms',
				'perms' => '',
				'sort_order' => '0',
			),
			array(
				'id' => '21',
				'table_id' => '1',
				'title' => 'Option Perms',
				'icon' => 'perm_identity',
				'table_action_id' => '0',
				'args' => 'api/aplus/set_option_perms',
				'perms' => '',
				'sort_order' => '0',
			),
			array(
				'id' => '24',
				'table_id' => '1',
				'title' => 'Add Perms ',
				'icon' => 'control_point',
				'table_action_id' => '0',
				'args' => 'api/aplus/set_add_perms',
				'perms' => '',
				'sort_order' => '0',
			),
			array(
				'id' => '25',
				'table_id' => '1',
				'title' => 'Del Perms',
				'icon' => 'delete',
				'table_action_id' => '0',
				'args' => 'api/aplus/set_del_perms',
				'perms' => '',
				'sort_order' => '0',
			),
			array(
				'id' => '30',
				'table_id' => '5',
				'title' => 'Groups',
				'icon' => 'icon-users4',
				'table_action_id' => '10',
				'args' => '{"match":"id","oper":"=","to":"user_id","rend":"list"}',
				'perms' => '',
				'sort_order' => '0',
			),
			array(
				'id' => '32',
				'table_id' => '6',
				'title' => 'users',
				'icon' => 'account_circle',
				'table_action_id' => '9',
				'args' => '{"match":"id","oper":"=","to":"group_id","rend":"list"}',
				'perms' => '',
				'sort_order' => '0',
			),
			array(
				'id' => '41',
				'table_id' => '4',
				'title' => 'Edit',
				'icon' => 'icon-pencil7',
				'table_action_id' => '4',
				'args' => '{"match":"id","oper":"=","to":"id","rend":"edit"}',
				'perms' => '',
				'sort_order' => '0',
			),
			array(
				'id' => '72',
				'table_id' => '5',
				'title' => 'Profile',
				'icon' => 'icon-vcard',
				'table_action_id' => '36',
				'args' => '{"match":"id","oper":"like","to":"user_id","rend":"list"}',
				'perms' => '',
				'sort_order' => '1',
			),
			array(
				'id' => '75',
				'table_id' => '38',
				'title' => 'Edit',
				'icon' => 'icon-pencil7',
				'table_action_id' => '38',
				'args' => '{"match":"id","oper":"=","to":"id","rend":"edit"}',
				'perms' => '',
				'sort_order' => '0',
			),
			array(
				'id' => '77',
				'table_id' => '5',
				'title' => 'Set Password',
				'icon' => 'icon-lock',
				'table_action_id' => '0',
				'args' => 'auth/set_password',
				'perms' => '',
				'sort_order' => '3',
			),
			array(
				'id' => '78',
				'table_id' => '61',
				'title' => 'Members',
				'icon' => 'icon-users4',
				'table_action_id' => '0',
				'args' => 'project/members',
				'perms' => '',
				'sort_order' => '0',
			),
			array(
				'id' => '79',
				'table_id' => '61',
				'title' => 'Forms',
				'icon' => 'icon-stack-text',
				'table_action_id' => '0',
				'args' => 'project/listForms',
				'perms' => '',
				'sort_order' => '0',
			),
		);
		$this->db->insert_batch("perm_tabs",$data);

		## Create Table perm_tree
		$this->db->query('CREATE TABLE `perm_tree` (
  `id` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(5) unsigned NOT NULL,
  `module_id` int(5) unsigned NOT NULL,
  `title` varchar(150) NOT NULL,
  `icon_font` varchar(50) NOT NULL,
  `perm_type` varchar(50) NOT NULL,
  `perm_target` varchar(50) NOT NULL,
  `perm_data` text,
  `perms` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8');
		### Insert data into table perm_tree ##
		$data	= array(
			array(
				'id' => '19',
				'parent_id' => '1',
				'module_id' => '1',
				'title' => 'Permissions',
				'icon_font' => 'icon-lock',
				'perm_type' => 'table',
				'perm_target' => 'list_wrp',
				'perm_data' => '{"table_id":"1","controller":"Perm/manage_table","add_controller":""}',
				'perms' => 'P1P, P2P',
			),
			array(
				'id' => '20',
				'parent_id' => '1',
				'module_id' => '1',
				'title' => 'Filters',
				'icon_font' => 'icon-filter3',
				'perm_type' => 'table',
				'perm_target' => 'list_wrp',
				'perm_data' => '{"table_id":"7","controller":"Perm/manage_table","add_controller":""}',
				'perms' => 'P1P,P2P',
			),
			array(
				'id' => '21',
				'parent_id' => '1',
				'module_id' => '1',
				'title' => 'Tables',
				'icon_font' => 'icon-table2',
				'perm_type' => 'table',
				'perm_target' => 'list_wrp',
				'perm_data' => '{"table_id":"3","controller":"Perm/manage_table","add_controller":""}',
				'perms' => 'P1P,P2P',
			),
			array(
				'id' => '22',
				'parent_id' => '1',
				'module_id' => '1',
				'title' => 'Users',
				'icon_font' => 'icon-users',
				'perm_type' => 'table',
				'perm_target' => 'list_wrp',
				'perm_data' => '{"table_id":"5","controller":"Perm/manage_table","add_controller":""}',
				'perms' => 'P1P,P2P',
			),
			array(
				'id' => '23',
				'parent_id' => '1',
				'module_id' => '1',
				'title' => 'Groups',
				'icon_font' => 'icon-users4',
				'perm_type' => 'table',
				'perm_target' => 'list_wrp',
				'perm_data' => '{"table_id":"6","controller":"Perm/manage_table","add_controller":""}',
				'perms' => 'P1P,P2P',
			),
			array(
				'id' => '24',
				'parent_id' => '1',
				'module_id' => '1',
				'title' => 'Modules',
				'icon_font' => 'icon-grid-alt',
				'perm_type' => 'table',
				'perm_target' => 'list_wrp',
				'perm_data' => '{"table_id":"4","controller":"Perm/manage_table","add_controller":""}',
				'perms' => 'P1P,P2P',
			),
			array(
				'id' => '25',
				'parent_id' => '0',
				'module_id' => '10',
				'title' => 'Projects',
				'icon_font' => 'icon-stack3',
				'perm_type' => 'table',
				'perm_target' => 'detail_wrp',
				'perm_data' => '{"table_id":"61","controller":"aplus\/manage_table","action":"list","add_controller":"api\/project\/add"}',
				'perms' => 'P1P,G1G',
			),
		);
		$this->db->insert_batch("perm_tree",$data);

		## Create Table projects
		$this->db->query('CREATE TABLE `projects` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` text,
  `code` varchar(10) NOT NULL,
  `created_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `perms` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `group_id` (`group_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8');
		### Insert data into table projects ##
		$data	= array(
			array(
				'id' => '1',
				'title' => 'AfyaData',
				'description' => 'AfyaData main project',
				'code' => 'AFYADATA',
				'created_at' => '2018-11-28 10:29:56',
				'created_by' => '1',
				'group_id' => '3',
				'perms' => 'P1P,G3G',
			),
			array(
				'id' => '2',
				'title' => 'Research',
				'description' => 'Research Students',
				'code' => 'Research',
				'created_at' => '2018-11-28 11:26:37',
				'created_by' => '1',
				'group_id' => '6',
				'perms' => 'P1P,G6G',
			),
			array(
				'id' => '13',
				'title' => 'AfyaMoja=1',
				'description' => 'Afya Moja 1',
				'code' => 'Afya1',
				'created_at' => '2018-12-03 13:12:37',
				'created_by' => '1',
				'group_id' => '4',
				'perms' => 'P1P,G4G',
			),
			array(
				'id' => '14',
				'title' => 'Malinyi',
				'description' => 'Malinyi description',
				'code' => 'MALINYI',
				'created_at' => '2018-12-06 07:12:33',
				'created_by' => '1',
				'group_id' => '5',
				'perms' => 'P1P,G5G',
			),
		);
		$this->db->insert_batch("projects",$data);

		## Create Table users
		$this->db->query('CREATE TABLE `users` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(45) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(80) NOT NULL,
  `salt` varchar(40) DEFAULT NULL,
  `email` varchar(254) NOT NULL,
  `activation_code` varchar(40) DEFAULT NULL,
  `forgotten_password_code` varchar(40) DEFAULT NULL,
  `forgotten_password_time` int(11) unsigned DEFAULT NULL,
  `remember_code` varchar(40) DEFAULT NULL,
  `created_on` int(11) unsigned NOT NULL,
  `last_login` int(11) unsigned DEFAULT NULL,
  `active` tinyint(1) unsigned DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8');
		### Insert data into table users ##
		$data	= array(
			array(
				'id' => '1',
				'ip_address' => '127.0.0.1',
				'username' => 'ericbeda@gmail.com',
				'password' => '$2y$08$ij/w5Vo/WdVD1E/ObGlRU.D9EP0a/p8ZMMI1vNzNlzJqAuI4vyy..',
				'salt' => '',
				'email' => 'ericbeda@gmail.com',
				'activation_code' => '',
				'forgotten_password_code' => '',
				'forgotten_password_time' => '',
				'remember_code' => '',
				'created_on' => '1543386956',
				'last_login' => '1544531037',
				'active' => '1',
				'first_name' => 'Eric',
				'last_name' => 'Mutagahywa',
				'company' => 'Box 3297, SACIDS',
				'phone' => '',
			),
		);
		$this->db->insert_batch("users",$data);

		## Create Table users_groups
		$this->db->query('CREATE TABLE `users_groups` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` mediumint(8) unsigned NOT NULL,
  `group_id` mediumint(8) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8');
		### Insert data into table users_groups ##
		$data	= array(
			array(
				'id' => '1',
				'user_id' => '1',
				'group_id' => '1',
			),
			array(
				'id' => '2',
				'user_id' => '1',
				'group_id' => '2',
			),
			array(
				'id' => '3',
				'user_id' => '2',
				'group_id' => '2',
			),
			array(
				'id' => '4',
				'user_id' => '1',
				'group_id' => '6',
			),
		);
		$this->db->insert_batch("users_groups",$data);

		## Create Table xform_config
		$this->db->query('CREATE TABLE `xform_config` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `form_id` int(11) NOT NULL,
  `push` int(11) NOT NULL DEFAULT '0',
  `has_feedback` int(11) NOT NULL DEFAULT '0',
  `use_ohkr` int(11) NOT NULL DEFAULT '0',
  `has_map` int(11) NOT NULL DEFAULT '0',
  `has_charts` int(11) NOT NULL DEFAULT '0',
  `allow_dhis` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8');

		## Create Table xform_field_map
		$this->db->query('CREATE TABLE `xform_field_map` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `table_name` varchar(255) NOT NULL,
  `col_name` varchar(300) NOT NULL,
  `field_name` varchar(300) NOT NULL,
  `field_label` varchar(100) NOT NULL,
  `field_type` varchar(45) NOT NULL,
  `hide` tinyint(1) NOT NULL DEFAULT '0',
  `chart_use` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8');

		## Create Table xform_submission
		$this->db->query('CREATE TABLE `xform_submission` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `filename` text NOT NULL,
  `created_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8');

		## Create Table xforms
		$this->db->query('CREATE TABLE `xforms` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `project_id` int(11) NOT NULL,
  `form_id` varchar(255) NOT NULL,
  `access` enum('public','private') NOT NULL DEFAULT 'public',
  `status` enum('draft','published','inactive') NOT NULL DEFAULT 'draft',
  `created_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `attachment` varchar(255) NOT NULL,
  `perms` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8');
		### Insert data into table xforms ##
		$data	= array(
			array(
				'id' => '1',
				'title' => 'CHR Mifugo',
				'description' => 'Form to collect animal data',
				'project_id' => '2',
				'form_id' => 'ad_build_Dalili_mifugo_Skolls_A_146771170218',
				'access' => 'private',
				'status' => 'published',
				'created_at' => '2018-08-14 14:28:13',
				'created_by' => '1',
				'attachment' => '90a6f1fd177a26ffde544528a43e6660.xml',
				'perms' => 'P1P,G6G',
			),
		);
		$this->db->insert_batch("xforms",$data);

	 }

	public function down()	{
		### Drop table app_version ##
		$this->dbforge->drop_table("app_version", TRUE);
		### Drop table groups ##
		$this->dbforge->drop_table("groups", TRUE);
		### Drop table login_attempts ##
		$this->dbforge->drop_table("login_attempts", TRUE);
		### Drop table migrations ##
		$this->dbforge->drop_table("migrations", TRUE);
		### Drop table ohkr_detected_diseases ##
		$this->dbforge->drop_table("ohkr_detected_diseases", TRUE);
		### Drop table ohkr_disease_symptoms ##
		$this->dbforge->drop_table("ohkr_disease_symptoms", TRUE);
		### Drop table ohkr_diseases ##
		$this->dbforge->drop_table("ohkr_diseases", TRUE);
		### Drop table ohkr_species ##
		$this->dbforge->drop_table("ohkr_species", TRUE);
		### Drop table ohkr_symptoms ##
		$this->dbforge->drop_table("ohkr_symptoms", TRUE);
		### Drop table perm_config ##
		$this->dbforge->drop_table("perm_config", TRUE);
		### Drop table perm_filter ##
		$this->dbforge->drop_table("perm_filter", TRUE);
		### Drop table perm_filter_config ##
		$this->dbforge->drop_table("perm_filter_config", TRUE);
		### Drop table perm_module ##
		$this->dbforge->drop_table("perm_module", TRUE);
		### Drop table perm_tables ##
		$this->dbforge->drop_table("perm_tables", TRUE);
		### Drop table perm_tables_conf ##
		$this->dbforge->drop_table("perm_tables_conf", TRUE);
		### Drop table perm_tabs ##
		$this->dbforge->drop_table("perm_tabs", TRUE);
		### Drop table perm_tree ##
		$this->dbforge->drop_table("perm_tree", TRUE);
		### Drop table projects ##
		$this->dbforge->drop_table("projects", TRUE);
		### Drop table users ##
		$this->dbforge->drop_table("users", TRUE);
		### Drop table users_groups ##
		$this->dbforge->drop_table("users_groups", TRUE);
		### Drop table xform_config ##
		$this->dbforge->drop_table("xform_config", TRUE);
		### Drop table xform_field_map ##
		$this->dbforge->drop_table("xform_field_map", TRUE);
		### Drop table xform_submission ##
		$this->dbforge->drop_table("xform_submission", TRUE);
		### Drop table xforms ##
		$this->dbforge->drop_table("xforms", TRUE);

	}
}