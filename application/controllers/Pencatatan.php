<?php
defined('BASEPATH') or exit ('No dirrect script access allowed');
require APPPATH . '/libraries/REST_Controller.php';

use Restserver\Libraries\REST_Controller;
class Pencatatan extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Pencatatan_Model','pcn');
        
    }
    public function index_get(){
        $id=$this->get('id');
        if($id == null){
            $catat=$this->pcn->get();
        }else{
            $catat=$this->pcn->get($id);
        }
        if($catat){
            $this->response([
                'status' => true,
                'data' => $catat
            ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status' => false,
                'message' => 'ID tidak ditemukan'
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }
    public function index_post(){
        $data=[
            'id_barang'=>$this->post('id_barang'),
            'jumlah'=>$this->post('jumlah'),
            'nama_pembeli'=>$this->post('nama_pembeli'),
            'total_bayar'=>$this->post('total_bayar'),
            'tanggal'=>$this->post('tanggal'),
            'alamat'=>$this->post('alamat'),
            'pembayaran'=>$this->post('pembayaran'),
            'status'=>$this->post('status')
        ];
        if($this->pcn->insert($data)>0){
            $this->response([
                'status'=>true,
                'message' => 'Data berhasil ditambahkan'
            ],REST_Controller::HTTP_CREATED);
        }else{
            $this->response([
                'status'=>false,
                'message' => 'Data gagal ditambahkan'
            ],REST_Controller::HTTP_NOT_FOUND);
        }
    }
    public function index_delete(){
        $id=$this->delete('id');
        if($id == null){
            $this->response([
                'status' => false,
                'message' => 'Masukkan ID'
            ], REST_Controller::HTTP_BAD_REQUEST);
        }else{
            if($this->pcn->delete($id)>0){
                $this->response([
                    'status' => true,
                    'id' => $id,
                    'message' => "Data berhasil dihapus"
                ], REST_Controller::HTTP_OK);
            }else{
                $this->response([
                    'status' => false,
                    'message' => 'ID tidak ditemukan'
                ], REST_Controller::HTTP_NOT_FOUND);
            }    
        }
        
    }
    public function grafika(){
        $id=$this->get('id');
        if($id == null){
            $catat=$this->pcn->get();
        }else{
            $catat=$this->pcn->get($id);
        }
        if($catat){
            $this->response([
                'status' => true,
                'data' => $catat
            ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status' => false,
                'message' => 'ID tidak ditemukan'
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }



















    
    public function index_put(){
       $id = $this->put('id');
       $data=[
            'id_barang'=>$this->put('id_barang'),
            'jumlah'=>$this->put('jumlah'),
            'nama_pembeli'=>$this->put('nama_pembeli'),
            'total_bayar'=>$this->put('total_bayar'),
            'tanggal'=>$this->put('tanggal'),
            'alamat'=>$this->put('alamat'),
            'pembayaran'=>$this->put('pembayaran'),
            'status'=>$this->put('status')
       ];

       if($this->pcn->update($data,$id)>0){
           $this->response([
               'status' => true,
               'message'=> 'data berhasil diubah'
           ],REST_Controller::HTTP_OK);
       }else{
        $this->response([
            'status' => false,
            'message'=> 'data gagal diubah'
        ],REST_Controller::HTTP_NOT_FOUND);
       }
    }

}
?>