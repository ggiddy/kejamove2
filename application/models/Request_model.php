<?php
/**
 * @author <nggitau@gmail.com>
 *
 */
class Request_model extends CI_Model
{
    /**
     * @var string table The database table name that this model operates on.
     */
    protected  $table = 'request';

    /**
     * @param array $data The array containing the data to save.
     */
    public function save($data)
    {
        //add a timestamp when saving the data
        $time = array('created' => time());

        //save the request
        $this->db->insert($this->table, array_merge($data, $time));

        return $this->db->insert_id();
    }

    /**
     * Get data from the database
     *
     * @param array $params The array containing the query parameters.
     */
    public function get($params = array())
    {
        if($params)
        {
            return $this->db->get_where($this->table, $params)->result_array()[0];
        } else {
            return $this->db->get($this->table)->result_array()[0];
        }
    }

    /**
     * Updates a request
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