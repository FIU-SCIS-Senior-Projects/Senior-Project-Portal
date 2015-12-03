<?php

class AdminController extends Controller
{
	public function actionIndex()
	{
		$this->render('index');
	}
        
        public function actionAdmin()
        {
            $model = new PortalSites('search');
            $model->unsetAttributes();  // clear any default values
            if (isset($_GET['PortalSites']))
                $model->attributes = $_GET['PortalSites'];

            $this->render('admin', array('model' => $model));
        }
        
        public function actionAddSite()
        {
            $model = new PortalSites;

            if (isset($_POST['PortalSites']))
            {
                $user = $_POST['PortalSites'];
                
                //$this->render('siteCreate');
                

                $model->attributes = $_POST['PortalSites'];

                //Save site into database. 
                $model->save(false);
                $this->redirect('/SeniorPortal/index.php/admin/admin');
                return;
            }
            $error = '';
            $this->render('siteCreate', array('model' => $model, 'error' => $error));
        }
        
        public function actionVerifySiteCreate()
        {
            $user = $_POST['PortalSites'];
            $error = "";

            $name = $user['name'];
            $url = $user['url'];

            if (strlen($name) == 0)
            {
                $error .= "Site name must be longer than 0 characters<br />";
            }
            if (strlen($url) == 0)
            {
                $error .= "Url must be longer than 0 characters<br />";
            }
            if (PortalSites::model()->find("name=:name", array(':name' => $name)))
            {
                $error .= "Site name is taken<br />";
            }
            if (PortalSites::model()->find("url=:url", array(':url' => $url)))
            {
                $error .= "Url is taken<br />";
            }
            
            print $error;
            return $error;
        }
        
        // Admin function that adds a new site to the site list.
        public function actionCreateSite()
        {
            if(User::isAAdmin())
            {
                $model = new PortalSites;

                // Uncomment the following line if AJAX validation is needed
                // $this->performAjaxValidation($model);

                if (isset($_POST['PortalSites']))
                {
                    $model = $_POST['PortalSites'];

                    $this->actionAddSite();
                }
                
                //$this->render('siteCreate', array('model' => $model));
            }
        }
        
        /**
         * Updates a particular model.
         * If update is successful, the browser will be redirected to the 'view' page.
         * @param integer $id the ID of the model to be updated
         */
        public function actionUpdate($id)
        {
            $model = $this->loadModel($id);
            
            $confirmation = '';

            // Uncomment the following line if AJAX validation is needed
            // $this->performAjaxValidation($model);

            if(isset($_POST['PortalSites']))
            {
                $model->attributes = $_POST['PortalSites'];

                if($model->validate(array('name', 'url',)) && $model->save(false))
                {    //$this->redirect(array('admin', 'id' => $model->id));
                    // Show confirmation message.
                    $confirmation = 'Portal site list information updated successfully!';
                }
            }
            $this->render('update', array('model' => $model, 'confirmation'=>$confirmation));
        }
        
        /**
         * Deletes a particular model.
         * If deletion is successful, the browser will be redirected to the 'admin' page.
         * @param integer $id the ID of the model to be deleted
         */
        public function actionDelete($id)
        {
            $this->loadModel($id)->row_delete();


            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if (!isset($_GET['ajax']))
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
        }
        
         /**
         * Returns the data model based on the primary key given in the GET variable.
         * If the data model is not found, an HTTP exception will be raised.
         * @param integer $id the ID of the model to be loaded
         * @return User the loaded model
         * @throws CHttpException
         */
        public function loadModel($id)
        {
            $model = PortalSites::model()->findByPk($id);
            
            if($model === null)
                throw new CHttpException(404, 'The requested page does not exist.');
            
            return $model;
        }

	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}