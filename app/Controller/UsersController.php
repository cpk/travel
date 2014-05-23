<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

App::uses('AppController', 'Controller');

/**
 * CakePHP usersController
 * @author Khoa
 */
class usersController extends AppController {

    public function beforeFilter() {
        
    }

    public function index() {
        
    }

    public function login() {
        $this->layout = 'login';
    }

}
