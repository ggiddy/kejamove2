<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Migration_Create_requests_table
 *
 */
class Migration_Create_requests_table extends CI_Migration {

    public function up()
    {
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'user_id' => array(
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => TRUE
            ),
            'phone_number' => array(
                'type' => 'VARCHAR',
                'constraint' => '10'
            ),
            'moving_from' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => TRUE,
            ),
            'moving_to' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => TRUE,
            ),
            'house_size' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => TRUE,
            ),
            'distance' => array(
                'type' => 'INT',
                'constraint' => '11',
                'unsigned' => TRUE
            ),
            'house_cleaning' => array(
                'type' => 'BOOLEAN',
                'default' => FALSE
            ),
            'interior_dec' => array(
                'type' => 'BOOLEAN',
                'default' => FALSE
            ),
            'mpesa_conf' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => TRUE,
            ),
            'total_cost' => array(
                'type' => 'INT',
                'constraint' => '7',
                'null' => TRUE,
            ),
            'created' => array(
                'type' => 'INT',
                'constraint' => '6',
                'null' => TRUE
            )
        ));

        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('request');
    }

    public function down()
    {
        $this->dbforge->drop_table('request');
    }
}