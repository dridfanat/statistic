<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Game extends CFormModel
{
    
 public function ftdcount($id) {
    $sql='SELECT SUM(ftd) AS FtdTotal  FROM statistic WHERE user='.$id;  
    $row = Yii::app()->db->createCommand($sql)->queryAll();  
    return($row[0]['FtdTotal']);  
  }  
    

  
  public function ftdrender($id) {
      
      $img=' ';
      for ($index = 0; $index < Game::ftdcount($id); $index++) {
      $img .= CHtml::image(Yii::app()->request->baseUrl.'/images/game/ftd.png','', array('align'=>'texttop'));     
      }
      return $img;
      
      }
  
      public function blackrender($id) {

        // $results = Statistic::model()->findByAttributesAll(array('user'=>'3',));
        $results = Statistic::model()->findAll(array('condition' => 'user =' . $id));

        $efficiency = 0;
        foreach ($results as $model) {
            if ((int) $model->efficiency() <= 0.81)
                $efficiency++;
        }
        $img = '';
        for ($index = 0; $index < $efficiency - Game::ftdcount($id); $index++) {

            $img .= CHtml::image(Yii::app()->request->baseUrl . '/images/game/ftdmetca.png', '', array('align' => 'texttop'));
        }

        return $img;
    }

}