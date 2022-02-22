<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelBarang;
use App\Models\ModelKategori;
use App\Models\ModelSatuan;


class Barang extends BaseController
{
    public function __construct()
    {
        $this->Mbarang = new ModelBarang();
        $this->Mkategori = new ModelKategori();
        $this->ModelSatuan = new ModelSatuan();
    }

    public function index()
    {
        $submit = $this->request->getPost('submit');
        $keyword = $this->request->getPost('keyword');

        if (isset($submit) && $keyword) {
            $query = $this->Mbarang->getBarang()->search($keyword)->paginate(5, 'barang');
            session()->setFlashdata('keyword', $keyword);
        } else {
            $query = $this->Mbarang->getBarang()->paginate(5, 'barang');
            session()->setFlashdata('keyword', '');
        }

        $pageCount = $this->request->getVar('page_barang') ? $this->request->getVar('page_barang') : 1;

        $data = [
            'barang' => $query,
            'pager' => $this->Mbarang->pager,
            'pageCount' => $pageCount
        ];
        return view('barang/viewBarang', $data);
    }

    public function tambah()
    {
        $data = [
            'kategori' => $this->Mkategori->findAll(),
            'satuan' => $this->ModelSatuan->findAll()
        ];
        return view('barang/tambah', $data);
    }

    public function save()
    {
        $field = $this->request->getVar();
        // dd($field);
        $validation = \Config\Services::validation();
        $valid = $this->validate([
            'kode' => [
                'rules' => 'required',
                'label' => 'Kode Barang',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ],
            'nama' => [
                'rules' => 'required',
                'label' => 'Nama Barang',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ],
            'katid' => [
                'rules' => 'required',
                'label' => 'Kategori Barang',
                'errors' => [
                    'required' => '{field} Wajib dipilih'
                ]
            ],
            'satid' => [
                'rules' => 'required',
                'label' => 'Satuan Barang',
                'errors' => [
                    'required' => '{field} Wajib dipilih'
                ]
            ],
            'harga' => [
                'rules' => 'required',
                'label' => 'Harga Barang',
                'errors' => [
                    'required' => '{field} Wajib di isi'
                ]
            ],
            'stok' => [
                'rules' => 'required',
                'label' => 'Stok Barang',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ]
        ]);

        if (!$valid) {
            $pesan = [
                // 'errorKode' => '<br><div class="alert alert-danger">' . $validation->getError('kode') . '</div>',
                // 'errorNama' => '<br><div class="alert alert-danger">' . $validation->getError('nama') . '</div>',
                // 'errorSatuan' => '<br><div class="alert alert-danger">' . $validation->getError('satuan') . '</div>',
                // 'errorKategori' => '<br><div class="alert alert-danger">' . $validation->getError('kategori') . '</div>',
                // 'errorHarga' => '<br><div class="alert alert-danger">' . $validation->getError('harga') . '</div>',
                // 'errorStok' => '<br><div class="alert alert-danger">' . $validation->getError('stok') . '</div>',
            ];

            session()->setFlashdata($pesan);

            return redirect()->to('/barang/tambah');
        } else {
            $this->Mbarang->insert([
                'brgkode' => $field['kode'],
                'brgnama' => $field['nama'],
                'brgkatid' => $field['katid'],
                'brgsatid' => $field['satid'],
                'brgharga' => $field['harga'],
                'brgstok' => $field['stok'],
            ]);

            $pesan = [
                'success' =>
                '
                <div class="alert alert-success alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <h5><i class="icon fas fa-check"></i> Alert!</h5>
                  Selamat! Barang Berhasil Nambah???
                </div>
                '
            ];

            session()->setFlashdata($pesan);

            return redirect()->to('/barang');
        }
    }
}
