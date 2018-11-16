<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//Helper By Anand//
function to_excel($query, $filename='exceloutput',$fie=FALSE)
{
	//print_r($query->result());die();
     $headers = ''; // just creating the var for field headers to append to below
     $data = ''; // just creating the var for field data to append to below
     
     $obj =& get_instance();
      if ($query->num_rows()== 0) {
          echo '<p>The table appears to have no data.</p>';
     } else {
	 //if ($fie) {
          $fields = $query->list_fields();
		  //print_r($fields);die();
		  $i=1;
		  //print_r($fields);die();
		  foreach ($fields as $field) {
			if($i>3){
            	$headers .= ucfirst($field) . "\t";
			}else{
				$headers .=ucfirst(trim($field))."\t";	  
			}
			$i++;
          }
     	//}
	 
          
         
          foreach ($query->result() as $row) {
               $line = '';
               foreach($row as $value) {                                            
                    if ((!isset($value)) OR ($value == "")) {
                         $value = "\t";
                    } else {
                         $value = str_replace('"', '""', $value);
                         $value = '"' . $value . '"' . "\t";
                    }
                    $line .= $value;
               }
               $data .= trim($line)."\n";
          }
          
          $data = str_replace("\r","",$data);
           
          header("Content-type: application/x-msdownload");
          header("Content-Disposition: attachment; filename=$filename.xls");
          echo "$headers\n$data";  
     }
} 