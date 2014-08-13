<?php
App::uses('BaseController', 'Controller');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');

class AuthController extends BaseController {



    public function beforeFilter() {
        parent::beforeFilter();
        // 認証不要
        $this->Auth->allow('login','do_action','logout');
    }

    public function login() {
        $this->autoRender = false;        
        $query_data = $this->params['data'];        
        
        $userid = $query_data['user_id'];
        $passwd = $query_data['passwd'];
        
        $this->log("userid = ".$userid, LOG_DEBUG);
        $this->log("passwd = ".$passwd, LOG_DEBUG);
        
        //データベース登録用のパスワードをログに出す
        $passwordHandler = new SimplePasswordHasher();

        $this->log("passwd = ".$passwordHandler->hash("a"), LOG_DEBUG);
        
        
        $this->request->data['User'] = array();
        $this->request->data['User']['user_id'] = $userid;
        $this->request->data['User']['passwd'] = $passwd;
        
        
        if($this->Auth->login()) {
            $this->log("認証OK", LOG_DEBUG);
            $result = "OK";
        } else {
            $this->log("認証NG", LOG_DEBUG);
            $result = "NG";            
        }
        
        return $result;
        
    }

    
    public function do_action() {
        $this->autoRender = false;          
        if ($this->Auth->loggedIn()) {
            $this->log("ログインOK", LOG_DEBUG);
            $result = "ログイン済み";            
        } else {
            $this->log("ログインNG", LOG_DEBUG);
            $result = "未ログイン";            
        }
        return $result;
    }
    
    public function logout() {
        $this->autoRender = false;           
        $this->Auth->logout();
    }    
    
    
    
    
}
