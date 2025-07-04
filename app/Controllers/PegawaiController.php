<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\PegawaiModel;
use App\Models\JabatanModel;

class PegawaiController extends BaseController
{
    protected $modelPegawai;
    public function __construct()
    {
        $this->modelPegawai = new PegawaiModel();
    }
    
    public function index()
    {
      $perPage = 10; // jumlah data per halaman
      $page = $this->request->getVar('page') ?? 1; // halaman saat ini, default ke 1

      // ambil data pegawai 
      // $data['pegawai'] = $this->modelPegawai->paginate($perPage,'default', $page);

      $data['pegawai'] = $this->modelPegawai->getPegawaiWithJabatan($perPage, $page);
      $data['pager'] = $this->modelPegawai->pager; // untuk pagination
      return view('pegawai/index', $data);
    }
    
    public function show($id)
    {
        $data['pegawai'] = $this->modelPegawai->getPegawaiWithJabatanWhere($id);
      return view('pegawai/show', $data);
    }
    
    public function create()
    {
        $modelJabatan = new JabatanModel;
        $data['jabatan'] = $modelJabatan->findAll();
        return view('pegawai/create', $data);
    }
    
    public function store()
    {
        $rules = [
            'nama_pegawai' => 'required',
            'alamat' => 'required',
            'telepon' => 'required',
            'jabatan_id' => 'required|numeric',
            'file_foto' => 'uploaded[file_foto]|is_image[file_foto]|mime_in[file_foto,image/jpg,image/png,image/jpeg]|max_size[file_foto,1024]',
          ];
          
        $errors = [
            'nama_pegawai' => [
                'required' => 'Nama pegawai wajib diisi'
              ],
            'alamat' => [
                'required' => 'Alamat pegawai wajib diisi'
              ],
            'telepon' => [
                'required' => 'No telepon pegawai wajib diisi'
              ],
            'jabatan_id' => [
                'required' => 'Jabatan pegawai wajib diisi',
                'numeric' => 'Jabatan id harus berupa angka/numeric'
              ],
            'file_foto' => [
                'uploaded' => 'Foto pegawai wajib diupload',
                'is_image' => 'Foto pegawai harus gambar',
                'mime_in' => 'Foto pegawai harus JPG, JPEG, atau PNG',
                'max_size' => 'Foto pegawai tidak boleh lebih dari 1MB',
              ],
          ];
          
        $valData = $this->validate($rules, $errors);
          
          if(!$valData){
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
          }
        
        $data = [
            'nama_pegawai' => $this->request->getPost('nama_pegawai'),
            'alamat' => $this->request->getPost('alamat'),
            'telepon' => $this->request->getPost('telepon'),
            'jabatan_id' => $this->request->getPost('jabatan_id'),
          ];
          
          // handle foto
          $fileFoto = $this->request->getFile('file_foto');
          if($fileFoto && $fileFoto->isValid() && !$fileFoto->hasMoved()){
            $namaFile = $fileFoto->getRandomName();
            $fileFoto->move('uploads', $namaFile);
            $data['foto_pegawai'] = $namaFile;
          }
          
          $this->modelPegawai->save($data);
          session()->setFlashdata([
              'swal_icon' => 'success',
              'swal_title' => 'Sukses!',
              'swal_text' => 'Data pegawai berhasil ditambahkan.',
            ]);
          return redirect()->to('pegawai');
    }
    
    public function edit($id)
    {
        $modelJabatan = new JabatanModel;
        $data['jabatan'] = $modelJabatan->findAll();
        $data['pegawai'] = $this->modelPegawai->find($id);
        return view('pegawai/edit', $data);
    }
    
    public function update($id)
    {
        $data = [
            'id' => $id,
            'nama_pegawai' => $this->request->getPost('nama_pegawai'),
            'alamat' => $this->request->getPost('alamat'),
            'telepon' => $this->request->getPost('telepon'),
            'jabatan_id' => $this->request->getPost('jabatan_id'),
          ];
          
          // handle foto
          $fileFoto = $this->request->getFile('file_foto');
          if($fileFoto && $fileFoto->isValid() && !$fileFoto->hasMoved()){
            $namaFile = $fileFoto->getRandomName();
            $fileFoto->move('uploads', $namaFile);
            $data['foto_pegawai'] = $namaFile;
            
            //hpus fto lama
            $fotoLama = $this->request->getPost('foto_lama');
            if(!empty($fotoLama)){
            $filePath = 'uploads/'. $fotoLama;
            if(is_file($filePath)){
              unlink($filePath);
            }
          }
          }
          
          $this->modelPegawai->save($data);
          session()->setFlashdata([
              'swal_icon' => 'success',
              'swal_title' => 'Sukses!',
              'swal_text' => 'Data pegawai berhasil diupdate.',
            ]);
          return redirect()->to('pegawai');
    }
    
    public function delete($id)
    {
        // $this->modelPegawai->delete($id);

        if (session()->get('role') != 'admin') {
          return redirect()->to('401')->with('error', 'Anda tidak memiliki hak akses untuk menghapus data pegawai.');
        }
        
        $pegawai = $this->modelPegawai->find($id);
        if($pegawai){
          if(!empty($pegawai->foto_pegawai)){
            $filePath = 'uploads/'. $pegawai->foto_pegawai;
            if(is_file($filePath)){
              unlink($filePath);
            }
          }
          $this->modelPegawai->delete($id);
        }
        session()->setFlashdata([
              'swal_icon' => 'success',
              'swal_title' => 'Sukses!',
              'swal_text' => 'Data pegawai berhasil dihapus.',
            ]);
        return redirect()->to('pegawai');
    }
}
