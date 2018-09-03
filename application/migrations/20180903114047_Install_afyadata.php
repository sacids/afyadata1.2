<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Install_afyadata extends CI_Migration
{
    private $tables;

    public function __construct()
    {
        parent::__construct();
        $this->load->dbforge();

        $this->load->config('ion_auth', TRUE);
        $this->tables = $this->config->item('tables', 'ion_auth');
    }

    public function up()
    {
        // Drop table 'groups' if it exists
        $this->dbforge->drop_table($this->tables['groups'], TRUE);

        // Table structure for table 'groups'
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'MEDIUMINT',
                'constraint' => '8',
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'name' => array(
                'type' => 'VARCHAR',
                'constraint' => '20',
            ),
            'description' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
            )
        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table($this->tables['groups']);

        // Dumping data for table 'groups'
        $data = array(
            array(
                'id' => '1',
                'name' => 'admin',
                'description' => 'Administrator'
            ),
            array(
                'id' => '2',
                'name' => 'members',
                'description' => 'General User'
            )
        );
        $this->db->insert_batch($this->tables['groups'], $data);

        // Drop table 'users' if it exists
        $this->dbforge->drop_table($this->tables['users'], TRUE);

        // Table structure for table 'users'
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'MEDIUMINT',
                'constraint' => '8',
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'ip_address' => array(
                'type' => 'VARCHAR',
                'constraint' => '45'
            ),
            'username' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
            ),
            'password' => array(
                'type' => 'VARCHAR',
                'constraint' => '80',
            ),
            'salt' => array(
                'type' => 'VARCHAR',
                'constraint' => '40',
                'null' => TRUE
            ),
            'email' => array(
                'type' => 'VARCHAR',
                'constraint' => '254'
            ),
            'activation_code' => array(
                'type' => 'VARCHAR',
                'constraint' => '40',
                'null' => TRUE
            ),
            'forgotten_password_code' => array(
                'type' => 'VARCHAR',
                'constraint' => '40',
                'null' => TRUE
            ),
            'forgotten_password_time' => array(
                'type' => 'INT',
                'constraint' => '11',
                'unsigned' => TRUE,
                'null' => TRUE
            ),
            'remember_code' => array(
                'type' => 'VARCHAR',
                'constraint' => '40',
                'null' => TRUE
            ),
            'created_on' => array(
                'type' => 'INT',
                'constraint' => '11',
                'unsigned' => TRUE,
            ),
            'last_login' => array(
                'type' => 'INT',
                'constraint' => '11',
                'unsigned' => TRUE,
                'null' => TRUE
            ),
            'active' => array(
                'type' => 'TINYINT',
                'constraint' => '1',
                'unsigned' => TRUE,
                'null' => TRUE
            ),
            'first_name' => array(
                'type' => 'VARCHAR',
                'constraint' => '50',
                'null' => TRUE
            ),
            'last_name' => array(
                'type' => 'VARCHAR',
                'constraint' => '50',
                'null' => TRUE
            ),
            'company' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => TRUE
            ),
            'phone' => array(
                'type' => 'VARCHAR',
                'constraint' => '20',
                'null' => TRUE
            )

        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table($this->tables['users']);

        // Dumping data for table 'users'
        $data = array(
            'id' => '1',
            'ip_address' => '127.0.0.1',
            'username' => 'administrator',
            'password' => '$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo36',
            'salt' => '',
            'email' => 'admin@admin.com',
            'activation_code' => '',
            'forgotten_password_code' => NULL,
            'created_on' => '1268889823',
            'last_login' => '1268889823',
            'active' => '1',
            'first_name' => 'Admin',
            'last_name' => 'istrator',
            'company' => 'ADMIN',
            'phone' => '0',
        );
        $this->db->insert($this->tables['users'], $data);


        // Drop table 'users_groups' if it exists
        $this->dbforge->drop_table($this->tables['users_groups'], TRUE);

        // Table structure for table 'users_groups'
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'MEDIUMINT',
                'constraint' => '8',
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'user_id' => array(
                'type' => 'MEDIUMINT',
                'constraint' => '8',
                'unsigned' => TRUE
            ),
            'group_id' => array(
                'type' => 'MEDIUMINT',
                'constraint' => '8',
                'unsigned' => TRUE
            )
        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table($this->tables['users_groups']);

        // Dumping data for table 'users_groups'
        $data = array(
            array(
                'id' => '1',
                'user_id' => '1',
                'group_id' => '1',
            ),
            array(
                'id' => '2',
                'user_id' => '1',
                'group_id' => '2',
            )
        );
        $this->db->insert_batch($this->tables['users_groups'], $data);


        // Drop table 'login_attempts' if it exists
        $this->dbforge->drop_table($this->tables['login_attempts'], TRUE);

        // Table structure for table 'login_attempts'
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'MEDIUMINT',
                'constraint' => '8',
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'ip_address' => array(
                'type' => 'VARCHAR',
                'constraint' => '45'
            ),
            'login' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => TRUE
            ),
            'time' => array(
                'type' => 'INT',
                'constraint' => '11',
                'unsigned' => TRUE,
                'null' => TRUE
            )
        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table($this->tables['login_attempts']);

        // Drop table 'app_version' if it exists
        $this->dbforge->drop_table($this->tables['app_version'], true);

        //table structure
        $this->dbforge->add_field(
            array(
                'id' => array(
                    'type' => 'INT',
                    'constraint' => 11,
                    'unsigned' => TRUE,
                    'auto_increment' => TRUE
                ),
                'name' => array(
                    'type' => 'VARCHAR',
                    'constraint' => 255
                ),
                'version' => array(
                    'type' => 'VARCHAR',
                    'constraint' => 25
                ),
                'status' => array(
                    'type' => 'ENUM("active", "inactive")',
                    'default' => 'inactive',
                    'null' => FALSE,
                ),
            )
        );

        $this->dbforge->add_key('id', true);
        $this->dbforge->create_table($this->tables['app_version']);

        // Drop table 'projects' if it exists
        $this->dbforge->drop_table($this->tables['projects'], TRUE);

        //table structure
        $this->dbforge->add_field(
            array(
                'id' => array(
                    'type' => 'INT',
                    'constraint' => 11,
                    'unsigned' => TRUE,
                    'auto_increment' => TRUE
                ),
                'title' => array(
                    'type' => 'VARCHAR',
                    'constraint' => 255
                ),
                'description' => array(
                    'type' => 'TEXT',
                    'null' => TRUE
                ),
                'code' => array(
                    'type' => 'VARCHAR',
                    'constraints' => 10,
                ),
                'created_at' => array(
                    'type' => 'DATETIME'
                ),
                'update_at' => array(
                    'type' => 'DATETIME',
                    'default' => 'CURRENT_TIMESTAMP'
                ),
                'created_by' => array(
                    'type' => 'INT',
                    'constraint' => 11
                ),
                'updated_by' => array(
                    'type' => 'INT',
                    'constraint' => 11
                ),
                'perms' => array(
                    'type' => 'TEXT'
                )
            )
        );

        $this->dbforge->add_key("id", TRUE);
        $this->dbforge->create_table($this->tables['projects']);


        // Drop table 'xforms' if it exists
        $this->dbforge->drop_table($this->tables['xforms'], TRUE);

        //table structure
        $this->dbforge->add_field(
            array(
                'id' => array(
                    'type' => 'INT',
                    'constraint' => 11,
                    'unsigned' => TRUE,
                    'auto_increment' => TRUE
                ),
                'title' => array(
                    'type' => 'VARCHAR',
                    'constraint' => 255
                ),
                'description' => array(
                    'type' => 'TEXT'
                ),
                'project_id' => array(
                    'type' => 'INT',
                    'constraint' => 11
                ),
                'form_id' => array(
                    'type' => 'VARCHAR',
                    'constraint' => 255
                ),
                'access' => array(
                    'type' => 'ENUM("public", "private")',
                    'default' => 'public',
                    'null' => FALSE,
                ),
                'status' => array(
                    'type' => 'ENUM("draft", "published", "inactive")',
                    'default' => 'draft',
                    'null' => FALSE,
                ),
                'created_at' => array(
                    'type' => 'DATETIME'
                ),
                'created_by' => array(
                    'type' => 'INT',
                    'constraint' => 11
                ),
                'attachment' => array(
                    'type' => 'VARCHAR',
                    'constraint' => 255
                ),
                'perms' => array(
                    'type' => 'TEXT'
                )
            )
        );
        $this->dbforge->add_key("id", TRUE);
        $this->dbforge->create_table($this->tables['xforms']);

        // Drop table 'xform_config' if it exists
        $this->dbforge->drop_table($this->tables['xform_config'], TRUE);

        //table structure
        $this->dbforge->add_field(
            array(
                'id' => array(
                    'type' => 'INT',
                    'constraint' => 11,
                    'unsigned' => TRUE,
                    'auto_increment' => TRUE
                ),
                'form_id' => array(
                    'type' => 'INT',
                    'constraint' => 11,
                ),
                'push' => array(
                    'type' => 'INT',
                    'constraint' => 11,
                    'default' => 0
                ),
                'has_feedback' => array(
                    'type' => 'INT',
                    'constraint' => 11,
                    'default' => 0
                ),
                'use_ohkr' => array(
                    'type' => 'INT',
                    'constraint' => 11,
                    'default' => 0
                ),
                'has_map' => array(
                    'type' => 'INT',
                    'constraint' => 11,
                    'default' => 0
                ),
                'has_charts' => array(
                    'type' => 'INT',
                    'constraint' => 11,
                    'default' => 0
                ),
                'allow_dhis' => array(
                    'type' => 'INT',
                    'constraint' => 11,
                    'default' => 0
                ),
            )
        );

        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table($this->tables['xform_config']);

        // Drop table 'xform_field_map' if it exists
        $this->dbforge->drop_table($this->tables['xform_field_map'], TRUE);

        //table structure
        $this->dbforge->add_field(
            array(
                'id' => array(
                    'type' => 'INT',
                    'constraint' => 11,
                    'unsigned' => TRUE,
                    'auto_increment' => TRUE
                ),
                'table_name' => array(
                    'type' => 'VARCHAR',
                    'constraint' => 255
                ),
                'col_name' => array(
                    'type' => 'VARCHAR',
                    'constraint' => 300
                ),
                'field_name' => array(
                    'type' => 'VARCHAR',
                    'constraint' => 300
                ),
                'field_label' => array(
                    'type' => 'VARCHAR',
                    'constraint' => 100
                ),
                'field_type' => array(
                    'type' => 'VARCHAR',
                    'constraint' => 45
                ),
                'hide' => array(
                    'type' => 'TINYINT',
                    'constraint' => 1,
                    'default' => 0
                ),
                'chart_use' => array(
                    'type' => 'TINYINT',
                    'constraint' => 1,
                    'default' => 0
                ),
            )
        );

        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table($this->tables['xform_field_map']);

        // Drop table 'xform_submission' if it exists
        $this->dbforge->drop_table($this->tables['xform_submission'], TRUE);

        //table structure
        $this->dbforge->add_field(
            array(
                'id' => array(
                    'type' => 'INT',
                    'constraint' => 11,
                    'unsigned' => TRUE,
                    'auto_increment' => TRUE
                ),
                'filename' => array(
                    'type' => 'TEXT'
                ),
                'created_at' => array(
                    'type' => 'DATETIME'
                ),
                'created_by' => array(
                    'type' => 'INT',
                    'constraint' => 11
                )
            )
        );

        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table($this->tables['xform_submission']);

        //Drop table 'ohkr_species' if it exists
        $this->dbforge->drop_table($this->tables['ohkr_species'], true);

        //table structure
        $this->dbforge->add_field(
            array(
                'id' => array(
                    'type' => 'INT',
                    'constraint' => 11,
                    'unsigned' => TRUE,
                    'auto_increment' => TRUE
                ),
                'title' => array(
                    'type' => 'VARCHAR',
                    'constraint' => 255
                ),
                'created_at' => array(
                    'type' => 'DATETIME'
                ),
                'created_by' => array(
                    'type' => 'INT',
                    'constraint' => 11
                ),
            )
        );

        $this->dbforge->add_key('id', true);
        $this->dbforge->create_table($this->tables['ohkr_species']);

        //Drop table 'ohkr_diseases' if it exists
        $this->dbforge->drop_table($this->tables['ohkr_diseases'], true);

        //table structure
        $this->dbforge->add_field(
            array(
                'id' => array(
                    'type' => 'INT',
                    'constraint' => 11,
                    'unsigned' => TRUE,
                    'auto_increment' => TRUE
                ),
                'title' => array(
                    'type' => 'VARCHAR',
                    'constraint' => 255,
                ),
                'description' => array(
                    'type' => 'TEXT'
                ),
                'specie' => array(
                    'type' => 'VARCHAR',
                    'constraint' => 100,
                ),
                'created_at' => array(
                    'type' => 'DATETIME'
                ),
                'created_by' => array(
                    'type' => 'INT',
                    'constraint' => 11
                )
            )
        );

        $this->dbforge->add_key('id', true);
        $this->dbforge->create_table($this->tables['ohkr_diseases']);

        //Drop table 'ohkr_symptoms' if it exists
        $this->dbforge->drop_table($this->tables['ohkr_symptoms'], true);

        //table structure
        $this->dbforge->add_field(
            array(
                'id' => array(
                    'type' => 'INT',
                    'constraint' => 11,
                    'unsigned' => TRUE,
                    'auto_increment' => TRUE
                ),
                'title' => array(
                    'type' => 'VARCHAR',
                    'constraint' => 255,
                ),
                'code' => array(
                    'type' => 'VARCHAR',
                    'constraint' => 10,
                ),
                'description' => array(
                    'type' => 'TEXT'
                ),
                'created_at' => array(
                    'type' => 'DATETIME'
                ),
                'created_by' => array(
                    'type' => 'INT',
                    'constraint' => 11
                )
            )
        );

        $this->dbforge->add_key('id', true);
        $this->dbforge->create_table($this->tables['ohkr_symptoms']);


        //Drop table 'ohkr_disease_symptoms' if it exists
        $this->dbforge->drop_table($this->tables['ohkr_disease_symptoms'], true);

        //table structure
        $this->dbforge->add_field(
            array(
                'id' => array(
                    'type' => 'INT',
                    'constraint' => 11,
                    'unsigned' => TRUE,
                    'auto_increment' => TRUE
                ),
                'disease_id' => array(
                    'type' => 'INT',
                    'constraint' => 11,
                ),
                'symptom_id' => array(
                    'type' => 'INT',
                    'constraint' => 11,
                ),
                'specie_id' => array(
                    'type' => 'INT',
                    'constraint' => 11,
                ),
                'importance' => array(
                    'type' => 'DOUBLE'
                ),
                'created_at' => array(
                    'type' => 'DATETIME'
                ),
                'created_by' => array(
                    'type' => 'INT',
                    'constraint' => 11
                )
            )
        );

        $this->dbforge->add_key('id', true);
        $this->dbforge->create_table($this->tables['ohkr_disease_symptoms']);

        //Drop table 'ohkr_detected_diseases' if it exists
        $this->dbforge->drop_table($this->tables['ohkr_detected_diseases'], true);

        //table structure
        $this->dbforge->add_field(
            array(
                'id' => array(
                    'type' => 'INT',
                    'constraint' => 11,
                    'unsigned' => TRUE,
                    'auto_increment' => TRUE
                ),
                'table_name' => array(
                    'type' => 'VARCHAR',
                    'constraint' => 255
                ),
                'instance_id' => array(
                    'type' => 'INT',
                    'constraint' => 11
                ),
                'disease_id' => array(
                    'type' => 'INT',
                    'constraint' => 11
                ),
                'reported_at' => array(
                    'type' => 'DATETIME'
                ),
                'reported_user_id' => array(
                    'type' => 'INT',
                    'constraint' => 11
                )
            )
        );

        $this->dbforge->add_key('id', true);
        $this->dbforge->create_table($this->tables['ohkr_detected_diseases']);

    }

    public function down()
    {
        $this->dbforge->drop_table($this->tables['users'], TRUE);
        $this->dbforge->drop_table($this->tables['groups'], TRUE);
        $this->dbforge->drop_table($this->tables['users_groups'], TRUE);
        $this->dbforge->drop_table($this->tables['login_attempts'], TRUE);

        $this->dbforge->drop_table($this->tables['app_version'], TRUE);
        $this->dbforge->drop_table($this->tables['projects'], TRUE);
        $this->dbforge->drop_table($this->tables['xforms'], TRUE);
        $this->dbforge->drop_table($this->tables['xform_config'], TRUE);
        $this->dbforge->drop_table($this->tables['xform_field_map'], TRUE);
        $this->dbforge->drop_table($this->tables['xform_submission'], TRUE);
        $this->dbforge->drop_table($this->tables['ohkr_species'], TRUE);
        $this->dbforge->drop_table($this->tables['ohkr_diseases'], TRUE);
        $this->dbforge->drop_table($this->tables['ohkr_symptoms'], TRUE);
        $this->dbforge->drop_table($this->tables['ohkr_disease_symptoms'], TRUE);
        $this->dbforge->drop_table($this->tables['ohkr_detected_diseases'], TRUE);

    }
}
