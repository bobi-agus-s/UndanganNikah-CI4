<?php

namespace App\Controllers;

use App\Models\GroupsModel;
use App\Models\KontakModel;
use CodeIgniter\RESTful\ResourceController;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


class Kontak extends ResourceController
{
    public function __construct() {
        $this->kontak = new KontakModel();
        $this->group = new GroupsModel();
    }

    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    public function index()
    {
        $keyword = $this->request->getGet('keyword');
        // $data['kontak'] = $this->kontak->findAll();
        $data= $this->kontak->getPaginated(10, $keyword);
        // $data['keyword'] = $keyword;
        return view('kontak/index', $data);
    }
 
    /**
     * Return the properties of a resource object
     *
     * @return mixed
     */
    public function show($id = null)
    {
        //
    }

    /**
     * Return a new resource object, with default properties
     *
     * @return mixed
     */
    public function new()
    {
        $data['group'] = $this->group->findAll();
        return view('kontak/new', $data);
    }

    /**
     * Create a new resource object, from "posted" parameters
     *
     * @return mixed
     */
    public function create()
    {
        // if (!$validate('userRules')) {
        //     return view('users/update', [
        //         'errors' => $this->validator->getErrors()
        //     ]);
        // }

        $data = $this->request->getPost();
        // $this->kontak->insert($data);
        // yang atas langsung tanpa validasi yang bawah pakek validasi
        if (!$this->kontak->insert($data)) {
            return redirect()->back()->withInput()->with('errors', $this->kontak->errors());
        } else {
            return redirect()->to(site_url('kontak'))->with('success', 'data berhasil disimpan');
        }
    }

    /**
     * Return the editable properties of a resource object
     *
     * @return mixed
     */
    public function edit($id = null)
    {
        $kontak = $this->kontak->find($id);

        if(is_object($kontak)) {
            $data = [
                'kontak' => $kontak,
                'group' => $this->group->findAll(),
            ];
            return view('kontak/edit', $data);
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

    }

    /**
     * Add or update a model resource, from "posted" properties
     *
     * @return mixed
     */
    public function update($id = null)
    {
        $data = $this->request->getPost();
        unset($data['_method']);

        if (!$this->kontak->update($id, $data)){
            return redirect()->back()->withInput()->with('errors', $this->kontak->errors());
        } else {
            return redirect()->to(site_url('kontak'))->with('success', 'data berhasil diubah');
        }
    }

    /**
     * Delete the designated resource object from the model
     *
     * @return mixed
     */ 
    public function delete($id = null)
    {
        $this->kontak->delete($id);
        return redirect()->to(site_url('kontak'))->with('success', 'data kontak berhasil dihapus');
    }

    public function export() {
        $filename = "kontak-". date('ymd'). ".xlsx";
        
        // $kontak = $this->kontak->findAll();
        $keyword = $this->request->getGet('keyword');
        $db = \Config\Database::connect();
        $builder = $db->table('kontak');
        $builder->join('groups', 'groups.id_group = kontak.id_group');
        if ($keyword != '') {
            $builder->like('nama_kontak', $keyword);
            $builder->orLike('phone', $keyword);
            $builder->orLike('nama_group', $keyword);
            $filename = "kontak-filter-". date('ymd'). ".xlsx";

        }
        $query = $builder->get();
        $kontak = $query->getResult();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'Nama');
        $sheet->setCellValue('C1', 'Telepon');
        $sheet->setCellValue('D1', 'Nama Group');

        $column = 2; //kolom start
        foreach ($kontak as $key => $row) {
            $sheet->setCellValue('A'. $column, ($column-1));
            $sheet->setCellValue('B'. $column, $row->nama_kontak);
            $sheet->setCellValue('C'. $column, $row->phone);
            $sheet->setCellValue('D'. $column, $row->nama_group);
            $column++;
        }

        // custom tampilan 

        // warna judul kolom
        $sheet->getStyle('A1:D1')->getFont()->setBold(true);
        $sheet->getStyle('A1:D1')->getFill()
            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()->setARGB('FFFFFF00');

        // border
        $styleArray = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => 'FF000000']
                ]
            ]
        ];
        $sheet->getStyle('A1:D'.($column-1))->applyFromArray($styleArray);

        // set auto size
        $sheet->getColumnDimension('A')->setAutoSize(true);
        $sheet->getColumnDimension('B')->setAutoSize(true);
        $sheet->getColumnDimension('C')->setAutoSize(true);
        $sheet->getColumnDimension('D')->setAutoSize(true);



        $writer = new Xlsx($spreadsheet);
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename='.$filename);
        header('Cache-Control: max-age=0');
        $writer->save('php://output');
        exit();
    }
}
