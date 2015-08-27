<?php
/**
 * Created by PhpStorm.
 * User: sz
 * Date: 27.08.15
 * Time: 13:33
 */

namespace app\controllers;


use app\models\Authors;
use app\models\Books;
use app\models\search\BooksSearch;
use yii\helpers\Url;

class BookController extends Controller
{

    public function actionIndex(){
        $searchModel = new BooksSearch;
        $dataProvider = $searchModel->search(\Yii::$app->getRequest()->get());

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionUpdate($id){
        $model = $this->findModel($id);

        $params = \Yii::$app->getRequest()->get();
        if(isset($params['_csrf']))
            unset($params['_csrf']);
        if(isset($params['id']))
            unset($params['id']);
        if ($model->load(\Yii::$app->request->post()) && $model->save()) {
            $redirect = array_merge(['index'], $params);
            return $this->redirect($redirect);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionView($id){
        $model = $this->findModel($id);

        return $this->renderAjax('view', [
            'model' => $model,
        ]);
    }

    public function actionDelete($id){
        $model = $this->findModel($id);
        $model->delete();
        $this->redirect(Url::toRoute(['index']));
    }

    public function findModel($id){
        return $this->_findModel(Books::className(), $id);
    }
} 