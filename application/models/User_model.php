<?php
/**
 * User_model
 * Handles storage and retrieval of user data.
 *
 * @author <nggitau@gmail.com>
 */

class User_model extends CI_Model
{
    /**
     * @var string table The database table name that this model operates on.
     */
    protected  $table = 'user';

    /**
     * Save a user to the database.
     *
     * @param array $data The data to save.
     * @return int The id of the inserted row.
     */
    public function save($data = array())
    {
        $time = array('created' => time());

        //save the user
        $this->db->insert($this->table, array_merge($data, $time));

        return $this->db->insert_id();
    }

    /**
     * Get a user from the database using the given parameter
     *
     * @param array $params The parameters to search by.
     * @return array The users found.
     */
    public function get($params = array())
    {
        if($params)
        {
            if($user = $this->db->get_where($this->table, $params)->result_array())
            {
                return $user[0];
            } else {
                return array();
            }

        } else {
            return $this->db->get($this->table)->result_array()[0];
        }
    }

    /**
     * Updates a user
     *
     * @param array $params Where to update.
     * @param array $data The data to be written.
     * @return array The updated row.
     */
    public function update($params, $data)
    {
        $this->db->where($params);
        $this->db->update($this->table, $data);

        return $this->get($params);
    }
}