<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelKategori;

class Kategori extends BaseController
{
    public function __construct()
    {
        $this->kategori = new ModelKategori();
    }

    public function index()
    {
        $submit = $this->request->getPost('submit');
        $keyword = $this->request->getPost('keyword');

        if (isset($submit) && $keyword) {
            $query = $this->kategori->search($keyword)->paginate(5, 'kategori');
            session()->setFlashdata('keyword', $keyword);
        } else {
            $query = $this->kategori->paginate(5, 'kategori');
            session()->setFlashdata('keyword', '');
        }

        $pageCount = $this->request->getVar('page_kategori') ? $this->request->getVar('page_kategori') : 1;

        $data = [
            'kategori' => $query,
            'pager' => $this->kategori->pager,
            'pageCount' => $pageCount
        ];
        return view('kategori/viewKategori', $data);
    }

    public function tambah()
    {
        return view('kategori/tambah');
    }

    public function save()
    {
        $namaKategori = $this->request->getVar('namakategori');

        $validation = \Config\Services::validation();
        $valid = $this->validate([
            'namakategori' => [
                'rules' => 'required',
                'label' => 'Nama Kategori',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ]
        ]);

        if (!$valid) {
            $pesan = [
                'errorNamaKategori' => '<br><div class="alert alert-danger">' . $validation->getError() . '</div>'
            ];

            session()->setFlashdata($pesan);

            return redirect()->to('/kategori/tambah');
        } else {
            $this->kategori->insert([
                'katnama' => $namaKategori
            ]);

            $pesan = [
                'success' =>
                '
                <div class="alert alert-success alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <h5><i class="icon fas fa-check"></i> Alert!</h5>
                  Selamat! Kategori Berhasil Nambah???
                </div>
                '
            ];

            session()->setFlashdata($pesan);

            return redirect()->to('/kategori/index');
        }
    }

    public function formEdit($id)
    {
        $data = [
            'kategori' => $this->kategori->find($id)
        ];
        return view('kategori/edit', $data);
    }

    public function update()
    {
        $id = $this->request->getVar('id');
        $namaKategori = $this->request->getVar('namakategori');

        $validation = \Config\Services::validation();
        $valid = $this->validate([
            'namakategori' => [
                'rules' => 'required',
                'label' => 'Nama Kategori',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ]
        ]);

        if (!$valid) {
            $pesan = [
                'errorNamaKategori' => '<br><div class="alert alert-danger">' . $validation->getError() . '</div>'
            ];

            session()->setFlashdata($pesan);

            return redirect()->to('/kategori/edit' . $id);
        } else {
            $this->kategori->update($id, [
                'katnama' => $namaKategori
            ]);

            $pesan = [
                'success' =>
                '
                <div class="alert alert-success alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <h5><i class="icon fas fa-check"></i> Alert!</h5>
                  Selamat! Kategori Berhasil Diubah???
                </div>
                '
            ];

            session()->setFlashdata($pesan);

            return redirect()->to('/kategori/index');
        }
    }

    public function hapus($id)
    {
        $data = $this->kategori->find($id);

        if ($data) {
            $this->kategori->delete($id);

            $pesan = [
                'success' =>
                '
                <div class="alert alert-danger alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <h5><i class="icon fas fa-ban"></i> Alert!</h5>
                  Yah dihapus deh???
                </div>
                '
            ];

            session()->setFlashdata($pesan);
            return redirect()->to('/kategori/index');
        } else {
            exit('Data tidak ditemukan');
        }
    }

    public function coba()
    {
        echo "<img src='" . base_url() . "/happy-happy-anime.gif'>";
        echo "<style>body{background:black;}</style><h1 style='font-size:90px; color:red; position:absolute; top:30%; left:20%'>Jangan Coba-coba yaa kamu, para hacker gaje..</h1>";
    }
}
