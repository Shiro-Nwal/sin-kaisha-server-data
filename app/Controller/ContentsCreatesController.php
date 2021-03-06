<?php
App::uses('AppController', 'Controller');
App::uses('UrlUtil', 'Lib/Util');
/**
 * CategoriesCreates Controller
 *
 * @property CategoriesCreate $CategoriesCreate
 * @property PaginatorComponent $Paginator
 */
class ContentsCreatesController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');
	
	public function index(){
			$ctl		        = $this;
            $model		        = $ctl->ContentsCreate;
            $session            = $ctl->Session;
            $request            = $ctl->request;
			$model->setInputFormParams();
            $model->setSessionToRequestData($request, $session);
			$ctl->layout = false;
	}
	
	
	public function beforeFilter() {
            // Authコンポーネントの設定
            //self::_authSetting($this->Auth);
            $this->Auth->allow();
			$this->Security->unlockedActions = array(
			'index','contentcategoryinsert'
		);
            return parent::beforeFilter();
        }
		public function contentcategoryinsert($flgSetAction = false){
			$ctl		        = $this;
            $model		        = $ctl->ContentsCreate;
            $session            = $ctl->Session;
            $request            = $ctl->request;
			$model->setSessionToRequestData($request, $session);
			
			if ($request->is('post') && $flgSetAction === false) {
                $model->set($request->data);
                if ($model->validates()) {
                    $model->setRequestToSessionData($session, $request);
					if (!empty($request->data) && $model->saveContentCategory($request->data) ) {
						$model->deleteRequestSessionData($session);
						$session->setFlash(__('大カテゴリを作成しました'));
						return;
					}
                } else {
                    $session->setFlash(__('入力内容を確認して下さい'));
                }
            }
			$ctl->autoRender = false;
		}
}