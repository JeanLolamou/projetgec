<?php

namespace App\Exports;

use App\Rapport;
// use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Support\Facades\DB;

class RapportExport implements FromView
{
	protected $data;

	public function __construct($data)
	{
		$this->data = $data;
	}

    public function view(): View
    {
    	$data = $this->data;
        return view('exports.hebdo', compact('data'));
    }
}