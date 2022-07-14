<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\Writer\Word2007;

class Word extends CI_Controller {

	public function index()
	{
		// $phpWord = new PhpWord();
		// $section = $phpWord->addSection();
		// $section->addText('Hello World !');
		
		// $writer = new Word2007($phpWord);
		
		// $filename = 'simple';
		
		// header('Content-Type: application/msword');
        // header('Content-Disposition: attachment;filename="'. $filename .'.docx"'); 
		// header('Cache-Control: max-age=0');
		
		// $writer->save('php://output');

        $phpWord = new \PhpOffice\PhpWord\PhpWord();
        $template = $phpWord->loadTemplate('template.docx');

        $template->setValue('nama', 'Eka Samsiati Putri');
        $template->setValue('status', 'Single');
        $template->setValue('alamat', 'Kudus');

        $temp_filename = 'surat-kerja-praktek.docx';
        $template->saveAs($temp_filename);

        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename='.$temp_filename);
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Pragma: public');
        header('Content-Length: ' . filesize($temp_filename));
        flush();
        readfile($temp_filename);
        unlink($temp_filename);
        exit;        
	}
}