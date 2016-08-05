<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class App
 *
 * @author <nggitau@gmail.com>
 *
 */
class App extends CI_Controller
{
    /**
     * Class constructor function.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Loads the home page.
     */
    public function index()
    {
        $data['content'] = 'public/home';
        $this->load->view('public/common/template', $data);
    }

    /**
     * Handles requests.
     */
    public function post_request()
    {
        //load required models
        $this->load->model('user_model', 'user');
        $this->load->model('request_model', 'request');

        //get data from the form
        if (isset($_POST['submit_request'])) {
            $moving_from = $this->input->post('moving_from');
            $moving_to = $this->input->post('moving_to');
            $bedrooms = $this->input->post('bedrooms');
            $phone_number = $this->input->post('phone');
            $distance = $this->input->post('distance');

        } else {}

        //Get the details of the user making the request
        $user = $this->get_user($phone_number);

        //save the user related info for this request
        $request_id = $this->request->save(array(
            'phone_number' => $phone_number,
            'user_id' => $user['id']
        ));

        //save the request
        $request_data = array(
            'phone_number' => $phone_number,
            'moving_from' => $moving_from,
            'moving_to' => $moving_to,
            'house_size' => $bedrooms,
            'distance' => $distance
        );

        //Get the request details
        $request = $this->request->update(array('id' => $request_id), $request_data);


        $uid = $request['user_id'];
        $rid = $request['id'];

        redirect(base_url("app/show_quote/$uid/$rid"));
    }

    /**
     * This method shows a specific quote for a specific user.
     *
     * @param $uid The user id
     * @param $rid The request id
     */
    public function show_quote($uid, $rid)
    {
        $this->load->model('request_model', 'request');

        $data['content'] = 'public/show_quote';
        $data['request'] = $this->request->get(array('id' => $rid));

        $this->load->view('public/common/template', $data);
    }

    /**
     * Processes quotation.
     *
     */
    public function post_dispatch()
    {
        //load required models
        $this->load->model('request_model', 'request');

        //load email config files
        $this->config->load('send_mail');

        //get required form contents
        $dispatch = $this->input->post('dispatch');
        if(isset($dispatch))
        {
            $house_cleaning = $this->input->post('house_cleaning');
            $interior_decorator = $this->input->post('interior_decorator');
            $request_id = $this->input->post('request_id');
            $user_id = $this->input->post('user_id');
            $email_checkbox = $this->input->post('email_quote');
            $email_address = $this->input->post('email_address');
            $house_size = $this->input->post('house_size');
            $mpesa_conf_code = $this->input->post('confirmation_code');
        }

        //change checkbox fields to the required format
        if(isset($house_cleaning) && !empty($house_cleaning)){$house_cleaning=1;} else {$house_cleaning=0;}
        if(isset($interior_decorator) && !empty($interior_decorator)) {$interior_decorator=1;} else {$interior_decorator=0;}

        //get the request
        $request = $this->request->get(array('id' => $request_id));

        //subtotal
        $subtotal = $this->calculate_total_cost($house_size,$request['distance'], $house_cleaning, $interior_decorator);

        //update db
        $addons = array(
            'house_cleaning' => $house_cleaning,
            'interior_dec' => $interior_decorator,
            'mpesa_conf' => strtoupper($mpesa_conf_code),
            'total_cost' => $subtotal
        );

        //Insert customer email
        if(isset($email_checkbox))
        {
            $this->load->model('user_model', 'user');
            $email_address = $this->input->post('client_email');

            //insert email address
            $user = $this->user->update(array('id' => $user_id), array('email_address' => $email_address));
        }

        $request = $this->request->update(array('id' => $request_id), $addons);

        if(isset($user) && !empty($user)){
            $request = array_merge($user, $request);
        }
        //send email to kejamove
        $email_to = $this->config->item('recepient_email');

        $sent = $this->send_mail($request, 'nggitau@gmail.com', 'New Move Request', 'email/request');

        if($sent){ redirect('app/success'); } else { echo 'Not Sent';}
    }

    /**
     * Mails quote to client.
     *
     * @param string $client_email The client's email address.
     */
    public function mail_client()
    {
        //load required models
        $this->load->model('request_model', 'request');
        $this->load->model('user_model', 'user');

        //get required form contents
        $house_cleaning = $this->input->post('house_cleaning');
        $interior_decorator = $this->input->post('interior_decorator');
        $request_id = $this->input->post('request_id');
        $user_id = $this->input->post('user_id');
        $email_address = $this->input->post('email_address');
        $house_size = $this->input->post('house_size');

        //save client email
        $this->user->update(array('id' => $user_id), array('email_address' => $email_address));

        //query db to get the request info
        $request = $this->request->get(array('id' => $request_id, 'user_id' => $user_id));

        //change checkbox fields to the required format (boolean)
        if(isset($house_cleaning) && !empty($house_cleaning)) {$house_cleaning=1;} else {$house_cleaning=0;}
        if(isset($interior_decorator) && !empty($interior_decorator)) {$interior_decorator=1;} else {$interior_decorator=0;}

        //Addons charge
        $request['house_cleaning'] = $house_cleaning;
        $request['interior_decorator'] = $interior_decorator;

        //base charge
        $request['base_charge'] = $this->calculate_base_charge($house_size)
            + $this->calculate_packaging_cost($house_size)
            + $this->calc_helper_charges($house_size);


        //distance charge
        $request['distance_charge'] = $this->calc_distance_charge($request['distance']);

        //subtotal
        $subtotal = $this->calculate_total_cost($house_size,$request['distance'], $house_cleaning, $interior_decorator);
        $request['total_cost'] = $subtotal;

        //send email to client
        $sent = $this->send_mail($request, $email_address, 'Move Request Quotation', 'email/client_mail');

        if($sent)
        {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('success' => false));
        }
    }

    /**
     * Gets the user who makes the request.
     *
     * @param string $phone_number The phone number to be used to get the user.
     * @return array $user The user details.
     */
    private function get_user($phone_number)
    {
        //load user model
        $this->load->model('User_model', 'user');

        //query database for user who submitted request
        $user = $this->user->get(array('phone_number' => $phone_number));

        //check if user is in db if not add to db
        if (!$user) {
            //user with that number not found so add user
            $this->user->save(array('phone_number' => $phone_number));

            $user = $this->user->get(array('phone_number' => $phone_number));
        }

        return $user;
    }


    /**
     * Loads the success page
     *
     * @param array $request The request data
     */
    public function success($request=array())
    {
        $data['content'] = 'public/success_page';
        $this->load->view('public/common/template', $data);
    }


    /**
     * This method sends emails
     *
     * @param array $request The whole request data from db.
     * @param string $email_to The email address to send to
     * @param string $subject The email subject.
     * @param string $email_template The html template to style the email
     * @return bool
     */
    private function send_mail($request, $email_to, $subject, $email_template)
    {
        //set configurations
        $config['useragent'] = 'Kejahunt';
        $config['protocol']    = 'smtp';
        $config['smtp_host']    = 'ssl://server.kejahunt.com';
        $config['smtp_port']    = '465';
        $config['smtp_timeout'] = '7';
        $config['smtp_user']    = 'info@kejahunt.com';
        $config['smtp_pass'] = 'kejahunt2014!';
        $config['charset'] = 'utf-8';
        $config['wordwrap'] = TRUE;
        $config['crlf'] = '\r\n';
        $config['newline'] = '\r\n';
        $config['mailtype'] = 'html';

        //load email library
        $this->load->library('email');
        $this->email->initialize($config);

        //prepare mail
        $this->email->from('nggitau@gmail.com', 'Giddy');
        $this->email->to($email_to);
        $this->email->subject($subject);
        $message = $this->load->view($email_template, array('request'=>$request), TRUE);
        $this->email->message($message);

        //return true if sending is successful false othewise
        return $this->email->send() ? TRUE : FALSE;
    }

    /**
     * This method calculates the total moving cost.
     *
     * @param $house_size
     * @param $distance
     * @param $house_cleaning
     * @param $interior_decorator
     */
    private function calculate_total_cost($house_size, $distance, $house_cleaning, $interior_decorator)
    {
        //base charge + distance charge + packaging material + house cleaning + interior dec
        return $total_cost = $this->calculate_base_charge($house_size)
            + $this->calc_helper_charges($house_size)
            + $this->calc_distance_charge($distance)
            + $this->calculate_packaging_cost($house_size)
            + $this->calculate_house_cleaning_cost($house_cleaning)
            + $this->calculate_interior_dec_cost($interior_decorator);
    }

    /**
     * This method returns the base charge for a given house
     *
     * @param $house_size
     * @return bool|int
     */
    private function calculate_base_charge($house_size)
    {
        switch($house_size){
            case '0': //pickup used
                return PICKUP_BASE_FARE;
            break;

            case '1':
                return CANTER_BASE_FARE;
            break;

            case '2':
                return FH_BASE_FARE;
            break;

            default:
                return false;
        }
    }

    /**
     * This method returns the cost of the packaging material.
     *
     * @param  string house_size The packaging material name.
     * @return integer The cost of the packaging material.
     */
    private function calculate_packaging_cost($house_size=null)
    {
        if($house_size == '0') {
            return PACKAGING_SMALL;
        } else if($house_size == '1') {
            return PACKAGING_NORMAL;
        } else if($house_size == '2') {
            return PACKAGING_BIG;
        } else if($house_size == '3') {
            return PACKAGING_JUMBO;
        }
    }

    /**
     * This function returns the cost of house cleaning.
     *
     * @param  integer $house_cleaning Whether house cleaning is selected.
     * @return integer  The cost of house cleaning.
     */
    private function calculate_house_cleaning_cost($house_cleaning=0)
    {
        if ($house_cleaning == 1) {
            return HOUSE_CLEANING;
        } else {
            return 0;
        }
    }

    /**
     * This function returns the cost of interior decoration.
     *
     * @param  integer $interior_dec Whether interior dec is selected.
     * @return integer  The cost of interior decoration.
     */
    private function calculate_interior_dec_cost($interior_dec=0)
    {
        if ($interior_dec == 1) {
            return INTERIOR_DECORATOR;
        } else {
            return 0;
        }
    }

    /**
     * This method returns helper charges for a particular house size.
     *
     * @param $house_size
     * @return int
     */
    private function calc_helper_charges($house_size)
    {
        switch($house_size){
            case '0':
                return PICKUP_HELPERS*HELPER_CHARGE;
            break;

            case '1':
                return CANTER_HELPERS*HELPER_CHARGE;
            break;

            case '2':
                return FH_HELPERS*HELPER_CHARGE;
            break;
        }
    }

    /**
     * This function calculates the distance cost.
     *
     * @param integer $distance The distance.
     * @return integer The distance cost.
     */
    private function calc_distance_charge($distance)
    {
        $distance = intval($distance);
        if($distance < 3)
        {
            $distance = 3;
        }

        $distance_cost=0;
        $dis = 0;
        while($dis <= $distance){
            $dis+=5;
            $distance_cost += 18085*pow($dis, -1.183);
        }

        return ceil($distance_cost);
    }

}

