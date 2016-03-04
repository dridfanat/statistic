<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of qeryOtchet
 *
 * @author xdoom88@gmail.com
 */
class Fireberd_cc {
    
public $host = '78.46.249.110:/opt/naumen/nauphone/spool/naubuddyd/naulog.gdb';
public $username="sysdba";
public $password="masterkey";    
public $query;    
public $base;
public $datein;
public $dateto;
public $data;
public function __construct() {
   $this->base = ibase_connect($this->host, $this->username, $this->password);
}

public function query() {
    
$sql = 'select a.login, b.cnt_in, a.cnt_out, (b.cnt_in+a.cnt_out), cast(b.dur_in*1440*60 as integer), cast(a.dur_out*1440*60 as integer),'
        . ' cast((b.dur_in+a.dur_out)*1440*60 as integer) from ( select login as login, sum(cnt_out) as cnt_out, sum(dur_out) '
        . 'as dur_out from ( select src_abonent as login, count(*) as cnt_out, sum(ended-connected) '
        . 'as dur_out from call_legs where created between'
        . ' '."'".$this->datein."'".' '
        . 'and '."'".$this->dateto."'".' and incoming = 1 and src_abonent is not null group '
        . 'by src_abonent union select login as login, 0 as cnt_out, 0 as dur_out from abonents ) group by login )'
        . ' a join ( select login as login, sum(cnt_in) as cnt_in, sum(dur_in) as dur_in from ( select dst_abonent '
        . 'as login, count(*) as cnt_in, sum(ended-connected) as dur_in from call_legs where '
        . 'created between '."'".$this->datein."'".' '
        . 'and '."'".$this->dateto."'".' and incoming = 0 and dst_abonent is not null '
        . 'group by dst_abonent union select login as login, 0 as cnt_in, 0 as dur_in from abonents ) '
        . 'group by login ) b on a.login = b.login where a.cnt_out+b.cnt_in > 0 and '.$this->query.'order by 1';
//echo $sql;
$base = ibase_query($this->base, $sql) or die(ibase_errmsg());
   while ($row_table_names = ibase_fetch_object($base))
{
 //echo "". $row_table_names->LOGIN ."|". $row_table_names->CNT_IN ."|". $row_table_names->CNT_OUT ."|". $row_table_names->FIELD_00 ."|". $row_table_names->CAST ."|". $row_table_names->CAST_01 ."|". $row_table_names->CAST_02 ."\n" ;

 $this->data=array('LOGIN'=>$row_table_names->LOGIN,'CNT_IN'=>$row_table_names->CNT_IN,'CNT_OUT'=>$row_table_names->CNT_OUT,'CAST'=>$row_table_names->CAST,'CAST_01'=>$row_table_names->CAST_01,'CAST_02'=>$row_table_names->CAST_02,'key'=>'test');
}  
    
}


public function __destruct() {
    ibase_close($this->base);
}
}
