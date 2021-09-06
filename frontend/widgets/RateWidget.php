<?php
namespace frontend\widgets;

use yii;
use yii\base\Widget;

class RateWidget extends Widget
{
    public $rating;

    public function run(): string
    {
        return $this->render('rate', [
            'rating' => $this->rating,
        ]);
    }
}