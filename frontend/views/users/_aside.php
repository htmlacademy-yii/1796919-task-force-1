<?php
/* @var $filter object */
/* @var $categories array */
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use frontend\models\form\TaskFilterForm;

?>
<section class="search-task">
  <div class="search-task__wrapper">
      <?php
      $form = ActiveForm::begin([
          'options' => [
              'class' => 'search-task__form'
          ],
          'fieldConfig' => [
              'template' => "{label}\n{input}\n",
              'options' => [
                  'tag' => false,
              ],
          ],

      ]); ?>
    <fieldset class="search-task__categories">
      <legend>Категории</legend>
        <?=$form->field($filter, 'category')->checkboxList($categories, [
            'tag' => false,
            'itemOptions' => [
                'template' => '{label}\n{input}'
            ],
            'item' => function ($index, $label, $name, $checked, $value) {
                $html = Html::input('checkbox', $name, $value, [
                    'class' => 'visually-hidden checkbox__input',
                    'checked' => $checked
                ]);
                $html .= Html::tag('span', $label);
                $html = Html::tag('label', $html, [
                    'class' => 'checkbox__legend'
                ]);
                return $html;
            }
        ])->label(false); ?>
    </fieldset>
    <fieldset class="search-task__categories">
      <legend>Дополнительно</legend>
        <?php
        foreach (['user_free', 'user_online', 'user_has_reviews', 'user_has_favorite'] as $key) {
            echo $form
                ->field($filter, $key, ['checkboxTemplate' => '<label class="checkbox__legend">{input}<span>{labelTitle}</span></label>'])
                ->checkbox([
                'class' => 'visually-hidden checkbox__input'
            ]);
        }
        ?>
    </fieldset>
      <?= $form->field($filter, 'username', [
          'labelOptions' => ['class' => 'search-task__name']
      ])->textInput(['class' => 'input-middle input']) ?>
      <?= Html::submitButton('Искать', ['class' => 'button']) ?>
      <?php ActiveForm::end(); ?>
  </div>
</section>
