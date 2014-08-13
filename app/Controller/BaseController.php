<?php
App::uses('AppController', 'Controller');
App::uses('AuthComponent', 'Component');

abstract class BaseController extends AppController {
    public $components = Array(
        'Auth' => Array(      // AuthComponent
             'authenticate' => Array(
                'Form' => Array(
                    'fields' => Array(
                        'username' => 'user_id'
                        ,'password' => 'passwd'
                        )
                    , 'userModel' => 'User'
                    , 'scope' => Array(
                        'del_flg' => 0
                        )
                    )
                )
        )
        ,'Cookie'
    );

    public function beforeFilter() {
        parent::beforeFilter();
        // 権限設定
        //$this->Auth->authorize = array('Controller');
        //AuthComponent::$sessionKey = 'Auth.User';
    }


}
