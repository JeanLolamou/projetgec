<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class LiveSearch extends Controller
{
    function index(){
 $rapport3 = DB::table('rapports')->where('supprimer',0)->orderBy('id','DESC')->get();

    	return view('paos.search',compact('rapport3'));
    }

    function action(Request $request)
    {
        if($request->ajax())
        {
            $query=$request->get('query');
            if($query != '')
            {
                    $data=DB::table('rapports')
                    ->where('date','like','%'.$query.'%')
                    ->orWhere('rapport','like','%'.$query.'%')
                    ->orderBy('id','desc')
                    ->get();
            }
            else{

            	$data=DB::table('rapports')
            	->orderBy('id','desc')
            	->get();
            }
            $total_row= $data->count();
            if($total_row >0 ){
                foreach($data as $row)
                {
                	$output.='
                	<tr>
                      <td>'.$row->date.'</td>
                       <td>'.$row->rapport.'</td>
                	</tr>
                 
                	';
                }
          } else{

            	$output='
                    <tr> <td align="center" colspan="5"> No data Found    </td>
                                                        </tr>
            	';
            }
            $data= array(

            	'table_data'  => $output,
                 'tatal_data' => $total_data);
            echo json_encode($data);

        }
            
    }
}
