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
        $data = [
            'kategori' => $this->kategori->findAll()
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
                'success' => '<div class="alert alert-success">Kategori Berhasil Ditambahkan...</div>'
            ];

            session()->setFlashdata($pesan);

            return redirect()->to('/kategori/index');
        }
    }
}
