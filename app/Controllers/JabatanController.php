<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\JabatanModel;
use App\Models\PegawaiModel;

class JabatanController extends BaseController
{
    protected $modelJabatan;
    public function __construct()
    {
        $this->modelJabatan = new JabatanModel();
    }
    
    public function index()
    {
      $data['jabatan'] = $this->modelJabatan->findAll();
      return view('jabatan/index', $data);
    }
    
    public function show($id)
    {
        //
    }
    
    public function create()
    {
        return view('jabatan/create');
    }
    
    public function store()
    {
        
        $rules = [
            'nama_jabatan' => 'required',
            'deskripsi_jabatan' => 'required',
          ];
          
        $errors = [
            'nama_jabatan' => [
                'required' => 'Nama jabatan wajib diisi.'
              ],
            'deskripsi_jabatan' => [
                'required' => 'Deskripsi jabatan wajib diisi.'
              ],
          ];
        // validsi 
        $valData = $this->validate($rules, $errors);
          
          if(!$valData){
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
          }
      
        // nangkep inputan form
        $data = [
            'nama_jabatan' => $this->request->getPost('nama_jabatan'),
            'deskripsi_jabatan' => $this->request->getPost('deskripsi_jabatan'),
          ];
          
          // nyimpen data
          $this->modelJabatan->save($data);
          // flqsh data buat alert
          session()->setFlashdata('sukses', 'Data Jabatan berhasil ditambahkan.');
          return redirect()->to('jabatan');
    }
    
    public function edit($id)
    {
        $data['jabatan'] = $this->modelJabatan->find($id);
        return view('jabatan/edit', $data);
    }
    
    public function update($id)
    {
      
        $rules = [
            'nama_jabatan' => 'required',
            'deskripsi_jabatan' => 'required',
          ];
          
        $errors = [
            'nama_jabatan' => [
                'required' => 'Nama jabatan wajib diisi.'
              ],
            'deskripsi_jabatan' => [
                'required' => 'Deskripsi jabatan wajib diisi.'
              ],
          ];
        // validsi 
        $valData = $this->validate($rules, $errors);
          
          if(!$valData){
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
          }
          
        $data = [
            'id' => $id,
            'nama_jabatan' => $this->request->getPost('nama_jabatan'),
            'deskripsi_jabatan' => $this->request->getPost('deskripsi_jabatan'),
          ];
          
          $this->modelJabatan->save($data);
          return redirect()->to('jabatan')->with('sukses', 'Data Jabatan berhasil diedit.');
    }
    
    public function delete($id)
    {
        $modelPegawai = new PegawaiModel();
        $cekPegawai = $modelPegawai->where('jabatan_id', $id)->countAllResults();
        
        if($cekPegawai > 0){
          return redirect()->to('jabatan')->with('gagal', 'data jabatan tdak dapat dihapus saat sedang digunakan di data pegawai.');
        }
        
        $this->modelJabatan->delete($id);
        return redirect()->to('jabatan')->with('sukses', 'Data Jabatan berhasil dihapus.');
    }
}
