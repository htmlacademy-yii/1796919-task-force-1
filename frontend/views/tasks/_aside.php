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
            'enableClientValidation' => false,
            'options' => [
                'class' => 'search-task__form'
            ],
            'fieldConfig' => [
                'options' => [
                    'tag' => false,
                ],
            ],
        ]); ?>
            <fieldset class="search-task__categories">
              <legend>Категории</legend>
                <?=$form->field($filter, 'categories')->checkboxList($categories, [
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
                <?=$form->field($filter, 'no_worker', [
                    'checkboxTemplate' => '<label class="checkbox__legend">{input}<span>{labelTitle}</span></label>'
                ])->checkbox([
                    'class' => 'visually-hidden checkbox__input'
                ])?>
                <?=$form->field($filter, 'remote_task', [
                    'checkboxTemplate' => '<label class="checkbox__legend">{input}<span>{labelTitle}</span></label>'
                ])->checkbox([
                    'class' => 'visually-hidden checkbox__input'
                ])?>
            </fieldset>
            <div class="field-container">
                <?=$form->field($filter, 'period', [
                    'labelOptions' => ['class' => 'search-task__name']
                ])->dropDownList(TaskFilterForm::PERIOD_ARRAY, [
                    'class' => 'multiple-select input'
                ])?>
            </div>
            <div class="field-container">
                <?= $form->field($filter, 'title', [
                    'labelOptions' => ['class' => 'search-task__name']
                ])->textInput(['class' => 'input-middle input', 'placeholder'=>'']) ?>
            </div>
        <?php echo Html::submitButton('Искать', ['class' => 'button']) ?>
        <?php ActiveForm::end(); ?>
    </div>
</section>
