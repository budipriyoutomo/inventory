<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Requests extends Admin_Base_Controller
{

    public function __construct()
    {
        parent::__construct();
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

}
