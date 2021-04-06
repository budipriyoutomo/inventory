<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Requests extends Admin_Base_Controller
{

    public function __construct()
    {
        parent::__construct();
<<<<<<< HEAD
        $this->load->library('grocery_CRUD');
        $this->setTemplateFile('grocery_view');
        $this->load->model('requests_model');

    }

    public function index()
    {
        redirect('transaction/Requests/all_requests/');
    }

    public function all_requests()
    {
        // Grocery Outlets getGroceryCRUD( $TableName, $Subject, $PageTitle, $Breadcrumbs )
        $crud = $this->getGroceryCRUD('thpr', 'Requests', 'Purchase Request', 'Manage PR');

        $crud->columns('id', 'nopr', 'tanggal','idsupplier','status', 'outlet', 'keterangan');
        $crud->unset_edit();
        $crud->add_action('Edit', '', 'admin/book', 'fa-book');
        $output = $crud->render();
        $this->load->view('transaction/requests/v_requests', (array) $output);
    }

    // initial setup of grocery crud by table name, theme   and others
    public function getGroceryCRUD($TableName, $Subject, $PageTitle, $Breadcrumbs)
    {
        $crud = new grocery_CRUD();
        $this->data['title'] = $PageTitle;
        $this->data['breadcrumbs'] = $Breadcrumbs;
        $crud->set_theme('bootstrap');
        $crud->set_table($TableName);
        $crud->set_subject($Subject);

        return $crud;
    }

=======
        $this->load->model('Requests_model');

        // check librarians groups or not
        $group = 'admin';
        if (!$this->ion_auth->in_group($group)) {
            $this->session->set_flashdata('message', 'You must be a admin to view this page.');
            redirect('admin/dashboard/access_denied');
        }
    }

    public function index()
    { 
        $this->data['title'] = 'Manage Purchase Request';
        $this->data['breadcrumbs'] = 'Manage Purchase Request';
        $this->load->view('transaction/requests/manage', $this->data);

    }
// get all records
    public function get_all()
    {
        $this->setOutputMode(NORMAL);
        if ($this->input->is_ajax_request()) {
            $this->data['all'] = $this->Requests_model->get_all();
            $view = $this->load->view('transaction/requests/all', $this->data, true);
            $this->output->set_output($view);
        } else {
            redirect('transaction/dashboard');
        }
    }

    // delete a record
    public function delete()
    {
        header('Content-Type: application/json');
        $this->setOutputMode(NORMAL);
        if ($this->input->is_ajax_request()) {
            $id = $this->input->post('id');

            $result = $this->ion_auth->delete_user($id);

            if ($result) {

                $this->ion_auth->remove_from_group('', $id);

                $response_array['type'] = 'success';
                $response_array['message'] = '<div class="alert alert-success alert-dismissable"><i class="icon fa fa-check"></i> Successfully Deleted. </div>';
                echo json_encode($response_array);
            } else {
                $response_array['type'] = 'danger';
                $response_array['message'] = '<div class="alert alert-danger alert-dismissable"><i class="icon fa fa-times"></i> Sorry! Failed.</div>';
                echo json_encode($response_array);
            }
        }
    }

    public function create() {
        $id = $this->ion_auth->get_user_id();
        $user = $this->ion_auth->user($id)->row();
        $outletcode = $this->Master_model->getoutletbyid($user->company);
        $nopr  = $this->dbkeygenerator->getNewKey("thpr","nopr","PR". $outletcode->code);

        $data = array(
            'button' => 'Save',
            'breadcrumbs' => "Create Purchase Request",
            'id' => set_value('id'),
            'nopr' => $nopr,
            'tanggal' => mdate('%Y-%m-%d'),
            'idsupplier' => $this->Master_model->getsupplier($outletcode->idbrand),
            'status' => 1,
            'outlet'=>$this->Master_model->getoutletbyid($outletcode->idoutlet),
            'keterangan' => set_value('id')
        );

        $view = $this->load->view('transaction/requests/add', $data, true);
        $this->output->set_output($view);        

    }


>>>>>>> 65d88cf3a94cd9cd213bd2b70a41adad88dee01a
}
