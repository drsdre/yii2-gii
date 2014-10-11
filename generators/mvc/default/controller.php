<?php
/**
 * This is the template for generating a controller class file.
 */

use yii\helpers\Inflector;
use yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $generator mdm\gii\generators\mvc\Generator */

echo "<?php\n";
?>

namespace <?= StringHelper::dirname(ltrim($generator->controllerClass, '\\')) ?>;

use Yii;

/**
*
*/
class <?= $generator->getControllerClass() ?> extends <?= '\\' . trim($generator->baseControllerClass, '\\') . "\n" ?>
{
<?php foreach ($generator->getActionIDs() as $action): ?>
<?php if($generator->isFormAction($action)):?>

    public function action<?= Inflector::id2camel($action) ?>()
    {
        $model = new <?= $generator->modelClass ?><?= empty($generator->scenarioName) ? "()" : "(['scenario' => '{$generator->scenarioName}'])" ?>;

        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                // form inputs are valid, do something here
                return;
            }
        }

        return $this->render('<?= $action ?>', [
            'model' => $model,
        ]);
    }
<?php else:?>

    public function action<?= Inflector::id2camel($action) ?>()
    {
        return $this->render('<?= $action ?>');
    }
<?php endif;?>
<?php endforeach; ?>
}