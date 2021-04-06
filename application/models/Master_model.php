<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Master_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    public function getsupplier($idbrand)
    {
      $this->db->order_by('idsupplier');
      if ($idbrand!=99){
        $this->db->where('brand',$idbrand);
      }
      return $this->db->get('tsupplier')->result();
    }

    public function getsatuan()
    {
      $this->db->order_by('idsatuan');
      return $this->db->get ('tsatuan')->result();
    }

    public function getoutlet($idoutlet)
    {
      $this->db->order_by('idoutlet');
      if($idoutlet!=99){
        $this->db->where('idoutlet',$idoutlet);  
      }
      return $this->db->get ('toutlet')->result();
    }

    public function getoutletbyid($id)
    {
      $this->db->where('idoutlet', $id);
      return $this->db->get ('toutlet')->row();
    }
    
    public function getbarangall()
    {

      $this->db->select('tbarang.itemcode, tbarang.name, tbarang.infokemasan, tjenis.namajenis, tsatuan.namasatuan');
      $this->db->from('tbarang');
      $this->db->join('tjenis', 'tbarang.idjenis=tjenis.idjenis');
      $this->db->join('tsatuan', 'tbarang.idsatuan=tsatuan.idsatuan');
      $this->db->order_by('itemcode');
      return $this->db->get()->result();
    }

    public function getbarang($q)
    {
      $this->db->select('tbarang.itemcode, tbarang.name, tbarang.infokemasan, tjenis.namajenis, tsatuan.namasatuan');
      $this->db->from('tbarang');
      $this->db->join('tjenis', 'tbarang.idjenis=tjenis.idjenis');
      $this->db->join('tsatuan', 'tbarang.idsatuan=tsatuan.idsatuan');
      $this->db->order_by('itemcode');
      $this->db->where('itemcode', $q);
      return $this->db->get()->result();
    }

    public function getnopr()
    {
      $this->db->order_by('id');
      return $this->db->get('thpr')->result();
    }

    
    public function getno($table,$codeoutlet)
    {
      $this->db->order_by('id');
      $this->db->where('status',1);
      if ($table=='thri'){
        $this->db->where('mid(nodo,3,5)',$codeoutlet);
      }
      return $this->db->get($table)->result();
    }

    public function getnoprdata($q)
    {
      $this->db->select('thpr.nopr, thpr.outlet,toutlet.namaoutlet,  tdpr.itemcode, tdpr.qty, tsupplier.idsupplier, tsupplier.nama,  tsatuan.namasatuan, tbarang.name, tjenis.namajenis,  tbarang.infokemasan');
      $this->db->from('thpr');
      $this->db->join('tdpr', 'tdpr.nopr=thpr.nopr');
      $this->db->join('tsupplier', 'thpr.idsupplier = tsupplier.idsupplier ');
      $this->db->join('toutlet', 'thpr.outlet = toutlet.idoutlet');
      $this->db->join('tbarang', 'tdpr.itemcode = tbarang.itemcode');
      $this->db->join('tjenis', 'tbarang.idjenis = tjenis.idjenis');
      $this->db->join('tsatuan', 'tbarang.idsatuan = tsatuan.idsatuan');
      $this->db->where('thpr.nopr', $q);
      return $this->db->get()->result();

    }

    
    public function getnododata($q)
    {
      $this->db->select('thdo.nodo, thdo.outlet,toutlet.namaoutlet,  tddo.itemcode, tddo.qtypr,tddo.qtydo, tsupplier.idsupplier, tsupplier.nama,  tsatuan.namasatuan, tbarang.name, tjenis.namajenis,  tbarang.infokemasan');
      $this->db->from('thdo');
      $this->db->join('tddo', 'tddo.nodo=thdo.nodo');
      $this->db->join('tsupplier', 'thdo.idsupplier = tsupplier.idsupplier ');
      $this->db->join('toutlet', 'thdo.outlet = toutlet.idoutlet');
      $this->db->join('tbarang', 'tddo.itemcode = tbarang.itemcode');
      $this->db->join('tjenis', 'tbarang.idjenis = tjenis.idjenis');
      $this->db->join('tsatuan', 'tbarang.idsatuan = tsatuan.idsatuan');
      $this->db->where('thdo.nodo', $q);
      return $this->db->get()->result();

    }

}
