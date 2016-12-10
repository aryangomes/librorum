<?php
/**
 * Created by PhpStorm.
 * User: aryan
 * Date: 10/12/16
 * Time: 09:37
 */

namespace app\models;

use Yii;

class Busca extends \yii\db\ActiveRecord
{
    public static $filtros = [
        'cdd'=>'CDD',
        'autor'=>'Autor(es)',
        'titulo'=> 'Título',
        'editora'=>'Editora',
        'tipo_material_idtipo_material'=>'Tipo do Material',
        ];

    public $filtro;

    public function attributeLabels()
    {
        return [

            'cdd' => Yii::t('app', 'CDD'),
            'autor' => Yii::t('app', 'Autor(es)'),
            'titulo' => Yii::t('app', 'Título'),
            'editora' => Yii::t('app', 'Editora'),

            'tipo_material_idtipo_material' => Yii::t('app', 'Tipo do Material'),

        ];
    }

}