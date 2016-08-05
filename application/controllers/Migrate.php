<?php

/**
 * Class Migrate
 *
 * @author <nggitau@gmail.com>
 */
class Migrate extends CI_Controller
{
    /**
     * Run the current migration.
     */
    public function index()
    {
        $this->load->library('migration');

        if ($this->migration->current() === FALSE)
        {
            show_error($this->migration->error_string());
        }
    }
}