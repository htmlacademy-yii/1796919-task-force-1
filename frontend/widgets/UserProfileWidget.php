<?php
namespace frontend\widgets;

use yii;
use yii\base\Widget;

class UserProfileWidget extends Widget
{
    public $template = 'user_profile_reviews';
    public $quantity;

    public function run(): string
    {
        return $this->render($this->template, [
            'quantity' => $this->quantity,
        ]);
    }
}