<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Barangs extends Admin_Base_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('grocery_CRUD');
        $this->setTemplateFile('grocery_view');
        $this->load->model('barangs_model');

        // check librarians groups or not
        $group = 'admin';
        if (!$this->ion_auth->in_group($group)) {
            $this->session->set_flashdata('message', 'You must be a admin to view this page.');
            redirect('admin/dashboard/access_denied');
        }
    }

    public function index()
    {
        redirect('admin/barangs/all_barangs/');
    }

    public function all_barangs()
    {
        try {

            // Grocery Outlets getGroceryCRUD( $TableName, $Subject, $PageTitle, $Breadcrumbs )
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
            $this->load->view('admin/barangs/v_barangs', (array) $output);

            // error handle
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }

    // add and update cre_or_up_date & cre_or_up_date value
    public function custom_data_callback($post_array)
    {
        $post_array['cre_or_up_date'] = date('Y-m-d');
        $created_by = $this->ion_auth->get_user_id();
        $post_array['cre_or_up_by'] = $created_by;

        return $post_array;
    }

    // add and update cre_or_up_date & cre_or_up_date value
    public function custom_data_update_callback($post_array)
    {
        $post_array['cre_or_up_date'] = date('Y-m-d');
        $created_by = $this->ion_auth->get_user_id();
        $post_array['cre_or_up_by'] = $created_by;

        return $post_array;
    }

    // Change the color of status like active and deactive users
    public function _callback_status($value, $row)
    {
        return $value == '1' ? "<strong style='color: #67bf7e'>ACTIVE</strong>" : "<strong style='color: #e66f57'>INACTIVE</strong>";
    }

    // view user image in column
    public function _callback_view_photo($value, $row)
    {
        $image_url = base_url('assets/images/credit/' . $value);
        return "<a href=$image_url class='fancybox'><img class='img-responsive img-thumbnail' src=$image_url  width='100px'/></a>";
    }

    // initial setup of grocery crud by table name, theme and others
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
