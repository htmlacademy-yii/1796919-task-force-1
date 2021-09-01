<?php
namespace frontend\widgets;

use yii;
use yii\base\Widget;

class TaskFilesWidget extends Widget
{
    public $files;
    public $filesList = [];

    public function init()
    {
        parent::init();
        foreach ($this->files as $file) {

            if(!file_exists($_SERVER['DOCUMENT_ROOT'].$file))
            {
                continue;
            }

            $this->filesList[] = [
                'url' => $file,
                'anchor' => basename($file)
            ];
        }
    }

    public function run(): string
    {
        return $this->render('task_files', [
            'filesList' => $this->filesList,
        ]);
    }
}