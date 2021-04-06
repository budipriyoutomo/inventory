<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Requests extends Admin_Base_Controller
{

    public function __construct()
    {
        parent::__construct();
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

    public function additem_form(){

        $this->setOutputMode(NORMAL);

        if ($this->input->is_ajax_request()) {
            //$this->data['groups'] = $this->ion_auth->groups()->result();
            
            //$this->data['companys'] = json_decode(json_encode($this->Outlets_model->get_all()));
            $crud = $this->getGroceryCRUD('tbarang', 'barangs', 'All barangs', 'Manage All barangs');

            // data Grid view fields
            $crud->columns('id', 'itemcode', 'barcode','name','infokemasan', 'qty', 'reorderqty', 'idjenis', 'idsatuan');

            // $crud->unset_add()
            //      ->unset_export()
            //      ->unset_print()
            //      ->unset_delete();

            // Insert form
            $crud->add_fields('id', 'itemcode', 'barcode','name','infokemasan', 'qty', 'reorderqty', 'idjenis', 'idsatuan');

            // Update form
            $crud->edit_fields('id', 'itemcode', 'barcode','name','infokemasan', 'qty', 'reorderqty', 'idjenis', 'idsatuan');

            //File upload
            //$crud->set_field_upload('file_path', 'assets/images/credit');

            // Unset, hide fields
            $crud->change_field_type('cre_or_up_date', 'invisible')
                ->change_field_type('cre_or_up_by', 'invisible');

            // Unset, hide fields from view page
            $crud->unset_read_fields('cre_or_up_by');

            // Required fields
            $crud->required_fields('id', 'itemcode', 'barcode','name','infokemasan', 'qty', 'reorderqty', 'idjenis', 'idsatuan');

            // Rename field level
            $crud->display_as('id', ' ID Barang')
                ->display_as('itemcode', ' Itemcode')
                ->display_as('barcode', ' Barcode')
                ->display_as('name', ' Nama Barang')
                ->display_as('infokemasan', ' Info Kemasan')
                ->display_as('qty', ' Qty')
                ->display_as('reorderqty', ' Reorder Qty')
                ->display_as('idjenis', ' Jenis')
                ->display_as('idsatuan', ' Satuan');

                $crud->set_relation('idjenis','tjenis','namajenis')
                ->set_relation('idsatuan','tsatuan','namasatuan');
    

            // callback functions
            $crud->callback_column('status', array($this, '_callback_status'))
                ->callback_before_insert(array($this, 'custom_data_callback'))
                ->callback_before_update(array($this, 'custom_data_update_callback'))
                ->callback_read_field('file_path', array($this, '_callback_view_photo'))
                ->callback_read_field('status', array($this, '_callback_status'));

            // render output result
            $output = $crud->render();
            $view = $this->load->view('admin/barangs/v_barangs', (array) $output);


            //$view = $this->load->view('transaction/Requests/additem', $this->data, true);
            $this->output->set_output($view);
        } else {
            redirect('admin/dashboard');
        }
    }


}
