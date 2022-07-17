<?php
class Pencatatan_model extends CI_Model
{
    public $table='pencatatan';
    public $id='pencatatan.id';
    public function get($id = null)
    {
        
        $this->db->select('p.*,b.nama_barang as Nama_Barang'); 
        $this->db->from('pencatatan p'); 
        $this->db->join('barang b', 'p.id_barang = b.id');
        $query=$this->db->get();
        return $query->result();
    }
    public function delete($id){
        $this->db->delete($this->table,['id'=>$id]);
        return $this->db->affected_rows();
    }
    public function insert($data){
        $this->db->insert($this->table,$data);
        return $this->db->insert_id();
    }
    public function update($data,$id){
        $this->db->update($this->table,$data,['id'=>$id]);
        return $this->db->affected_rows();
    }
   
    public function grafika()
    {
        
        $this->db->select('p.*,b.nama_barang as Nama_Barang,sum(p.jumlah) as jumm'); 
        $this->db->from('pencatatan p'); 
        $this->db->join('barang b', 'p.id_barang = b.id');
        $this->db->group_by('p.id');
        $query=$this->db->get();
        return $query->result_array();
    }
}
?>