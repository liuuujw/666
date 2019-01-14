<?php
namespace frontend\models;

use yii;

class Es extends \yii\elasticsearch\ActiveRecord{

    public function getOne(){
        return 'one';
    }

    public static function mapping(){

        return [
            static::type() => [
                'properties' => [
                    'name' => ['type'=>'string'],
                    'author_name' => ['type'=>'string'],
                    'publish_name' => ['type'=>'string'],
                    'created_at' => ['type'=>'long'],
                    'updated_at' => ['type'=>'long'],
                    'status' => ['type'=>'long'],
                ]
            ]
        ];

    }

    public static function updateMapping(){
        $db = static::getDb();
        $query = $db->createCommand();
        $query->setMapping(static::index(), static::type(), static::mapping());
    }

    public static function createIndex(){
        $db = static::getDb();
        $command = $db->createCommand();
        $command->createIndex(static::index(), [
            'settings' => [ /* ... */ ],
            'mappings' => static::mapping(),
        ]);

    }
    public static function deleteIndex()
    {
        $db = static::getDb();
        $command = $db->createCommand();
        $command->deleteIndex(static::index(), static::type());
    }

}