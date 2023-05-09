<?php

namespace App\Http\Controllers;

use Codedge\Fpdf\Fpdf\Fpdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class pdfCOntroller extends Controller
{
    protected $fpdf;
    private $total = 0;
    public function __construct()
    {
        $this->fpdf = new Fpdf;
    }

    public function index($id)
    {   
        $data = DB::table('tugas')
            ->select('*')
            ->where([
                ['id_siswa', '=', $id],
            ])
            ->get();


            $this->fpdf->SetFont('Arial', 'B', 14);
            $this->fpdf->AddPage('P', 'A4');
    
            //Cell(width , height , text , border , end line , [align] )
    
            $this->fpdf->Cell(130, 5, 'RAPOR', 0, 0);
            $this->fpdf->Cell(59, 5, 'NAMA', 0, 1); //end of line
    
            //set font to arial, regular, 12pt
            $this->fpdf->SetFont('Arial', '', 12);
    
            $this->fpdf->Cell(130, 5, 'LES PRIVATE TERPADU', 0, 0);
            $this->fpdf->Cell(59, 5, '', 0, 1); //end of line
    
            $this->fpdf->Cell(130, 5, 'JAKARTA, INDONESIA, 90909', 0, 0);
            $this->fpdf->Cell(25, 5, 'Date', 0, 0);
            $this->fpdf->Cell(34, 5, date("Y/m/d"), 0, 1); //end of line
    
            $this->fpdf->Cell(130, 5, 'Phone +62888624921', 0, 0); //end of line
            $this->fpdf->Cell(25, 5, 'Customer ID', 0, 0);
            $this->fpdf->Cell(34, 5, auth()->id(), 0, 1); //end of line
    
            //make a dummy empty cell as a vertical spacer
            $this->fpdf->Cell(189, 10, '', 0, 1); //end of line
    
            //billing address
    
            //make a dummy empty cell as a vertical spacer
            $this->fpdf->Cell(189, 10, '', 0, 1); //end of line
    
            //invoice contents
            $this->fpdf->SetFont('Arial', 'B', 12);
    
            $this->fpdf->Cell(94, 5, 'Nama Tugas', 1, 0);
            $this->fpdf->Cell(94, 5, 'Nilai', 1, 0);
            $this->fpdf->ln();
    
            $this->fpdf->SetFont('Arial', '', 12);
    
            //Numbers are right-aligned so we give 'R' after new line parameter
            foreach($data as $data){
                $this->fpdf->Cell(94, 5, $data->nama_tugas, 1, 0);
                $this->fpdf->Cell(94, 5, ($data->nilai==null?0:$data->nilai), 1, 0);
                $this->fpdf->ln();
            }
            //summary
            $this->fpdf->Output('D', 'Rapor.pdf');
    }
}
