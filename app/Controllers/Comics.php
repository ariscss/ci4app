<?php

namespace App\Controllers;

use App\Models\ComicsModel;

class Comics extends BaseController
{
    protected $comicModel;
    public function __construct()
    {
        $this->comicModel = new ComicsModel();
    }

    public function index()
    {
        // $comic = $this->comicModel->findAll();

        $data = [
            'title' => 'Daftar Komik',
            'komik' => $this->comicModel->getComic()
        ];

        return view('comics/index', $data);
    }

    public function detail($slug)
    {
        $data = [
            'title' => "Detail Komik",
            'komik' => $this->comicModel->getComic($slug)
        ];

        // Jika komik tidak ada di tabel
        if (empty($data['komik'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Judul Komik ' . $slug . ' tidak ditemukan.');
        }

        return view('comics/detail', $data);
    }

    public function create()
    {
        // session(); // mengaktifkan session untuk menangani validation
        $data = [
            'title' => 'Form Tambah Data',
            'validation' => \Config\Services::validation()
        ];

        return view('comics/create', $data);
    }

    public function save()
    {
        // validasi Input
        if (!$this->validate([
            // 'judul' => 'required|is_unique[komik.judul]' //judul berasal dari name pada form input
            'judul' => [
                'rules' => 'required|is_unique[komik.judul]',
                'errors' => [
                    'required' => '{field} komik harus diisi.',
                    'is_unique' => '{field} komik sudah tersedia'
                ]
            ]

        ])) {
            $validation = \Config\Services::validation();
            return \redirect()->to('/comics/create')->withInput()->with('validation', $validation);
        }

        $slug = url_title($this->request->getVar('judul'), '-', true);
        $this->comicModel->save([
            'judul' => $this->request->getVar('judul'),
            'slug' => $slug,
            'penulis' => $this->request->getVar('penulis'),
            'penerbit' => $this->request->getVar('penerbit'),
            'sampul' => $this->request->getVar('sampul')
        ]);

        session()->setFlashdata('pesan', 'Data berhasil ditambahkan.');

        return redirect()->to('/comics');
    }

    public function delete($id)
    {
        $this->comicModel->delete($id);
        session()->setFlashdata('pesan', 'Data berhasil dihapus.');
        return redirect()->to('/comics');
    }

    public function edit($slug)
    {
        $data = [
            'title' => 'Form Ubah Data',
            'validation' => \Config\Services::validation(),
            'komik' => $this->comicModel->getComic($slug)
        ];

        return view('comics/edit', $data);
    }

    public function update($id)
    {
        // cek judul
        $komikLama = $this->comicModel->getComic($this->request->getVar('slug'));
        if ($komikLama['judul'] == $this->request->getVar('judul')) {
            $rule_judul = 'required';
        } else {
            $rule_judul = 'required|is_unique[komik.judul]';
        }

        // validasi Update
        if (!$this->validate([
            // 'judul' => 'required|is_unique[komik.judul]' //judul berasal dari name pada form input
            'judul' => [
                'rules' => $rule_judul,
                'errors' => [
                    'required' => '{field} komik harus diisi.',
                    'is_unique' => '{field} komik sudah tersedia'
                ]
            ]

        ])) {
            $validation = \Config\Services::validation();
            return \redirect()->to('/comics/edit/' . $this->request->getVar('slug'))->withInput()->with('validation', $validation);
        }

        $slug = url_title($this->request->getVar('judul'), '-', true);
        $this->comicModel->save([
            'id' => $id,
            'judul' => $this->request->getVar('judul'),
            'slug' => $slug,
            'penulis' => $this->request->getVar('penulis'),
            'penerbit' => $this->request->getVar('penerbit'),
            'sampul' => $this->request->getVar('sampul')
        ]);

        session()->setFlashdata('pesan', 'Data berhasil diubah.');

        return redirect()->to('/comics');
    }
}
