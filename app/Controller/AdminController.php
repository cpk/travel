<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

App::uses('AppController', 'Controller');

/**
 * CakePHP AdminController
 * @author Khoa
 */
class AdminController extends AppController {

    //public $helpers = array('Javascript');

    public function beforeFilter() {
        $this->layout = 'admin';
    }

    public function index() {
        $this->set('title_for_layout', 'Admin');
    }

    public function lists($type) {
        $dataTable = '';
        switch ($type) {
            case 'users':
                $dataTable = $this->users();
                break;
            case 'catalogs1':
                $dataTable = $this->catalogs1();
                break;
            case 'catalogs2':
                $dataTable = $this->catalogs2();
                break;
            case 'catalogs3':
                $dataTable = $this->catalogs3();
                break;
            case 'items':
                $dataTable = $this->items();
                break;
        }
        $this->set('dataTable', $dataTable);
        $this->set('type', $type);
    }

    public function show($type, $id) {
        $dataTable = '';
        switch ($type) {
            case 'users':
                $dataTable = $this->showUser($id);
                break;
            case 'catalogs1':
                $dataTable = $this->showCatalogs1($id);
                break;
            case 'catalogs2':
                $dataTable = $this->showCatalogs2($id);
                break;
            case 'catalogs3':
                $dataTable = $this->showCatalogs3($id);
                break;
            case 'items':
                $dataTable = $this->showItem($id);
                break;
        }
        $this->set('dataTable', $dataTable);
    }

    public function create($type, $id = null) {
        $dataTable = '';
        switch ($type) {
            case 'users':
                $dataTable = $this->createUser();
                break;
            case 'catalogs1':
                $dataTable = $this->createCatalogs1();
                break;
            case 'catalogs2':
                $dataTable = $this->createCatalogs2($id);
                break;
            case 'catalogs3':
                $dataTable = $this->createCatalogs3($id);
                break;
            case 'items':
                $dataTable = $this->createItem();
                break;
        }
        $this->set('dataTable', $dataTable);
    }

    public function edit($type, $id) {
        $dataTable = '';
        switch ($type) {
            case 'users':
                $dataTable = $this->editUser($id);
                break;
            case 'catalogs1':
                $dataTable = $this->editCatalogs1($id);
                break;
            case 'catalogs2':
                $dataTable = $this->editCatalogs2($id);
                break;
            case 'catalogs3':
                $dataTable = $this->editCatalogs3($id);
                break;
            case 'items':
                $dataTable = $this->editItem($id);
                break;
        }
        $this->set('dataTable', $dataTable);
    }

    public function delete($type, $id) {
        $dataTable = '';
        switch ($type) {
            case 'users':
                $dataTable = $this->deleteUser($id);
                break;
            case 'catalogs1':
                $dataTable = $this->deleteCatalogs1($id);
                break;
            case 'catalogs2':
                $dataTable = $this->deleteCatalogs2($id);
                break;
            case 'catalogs3':
                $dataTable = $this->deleteCatalogs3($id);
                break;
            case 'items':
                $dataTable = $this->deleteItem($id);
                break;
        }
        $this->set('dataTable', $dataTable);
    }

    public function users() {
        $this->set('title_for_layout', 'List Users');
        $this->set('subcat', '<a href="#">Users</a>');
        $this->loadModel('User');

        $this->User->virtualFields = array(
            'full_name' => 'CONCAT(User.first_name, " ", User.last_name)',
        );
        $options = array(
            'fields' => array('id', 'full_name', 'username', 'address', 'phone', 'email', 'level', 'actived'),
        );
        $users = $this->User->find('all', $options);

        $dataHeading = '<tr>';
        $dataHeading .= '<th width="20px" class="center">#</th>';
        $dataHeading .= '<th>Name</th>';
        $dataHeading .= '<th>Username</th>';
        $dataHeading .= '<th>Address</th>';
        $dataHeading .= '<th>Phone</th>';
        $dataHeading .= '<th>Email</th>';
        $dataHeading .= '<th>Account Type</th>';
        $dataHeading .= '<th>Status</th>';
        $dataHeading .= '<th width="220px">Actions</th>';
        $dataHeading .= '</tr>';

        $dataRows = '';

        // Generate data rows for data table
        for ($i = 0; $i < count($users); $i++) {
            $dataRows .= '<td class="center">' . ($i + 1) . '</td>';
            $dataRows .= '<td class="data">' . $users[$i]['User']['full_name'] . '</td>';
            $dataRows .= '<td class="data username">' . $users[$i]['User']['username'] . '</td>';
            $dataRows .= '<td class="data">' . $users[$i]['User']['address'] . '</td>';
            $dataRows .= '<td class="data">' . $users[$i]['User']['phone'] . '</td>';
            $dataRows .= '<td class="data">' . $users[$i]['User']['email'] . '</td>';
            $actived = $users[$i]['User']['actived'];
            $dataRows .= '<td class="data">' . ($actived == 0 ? 'User' : 'Admin') . '</td>';
            $status = $users[$i]['User']['actived'];
            $dataRows .= '<td class="data">' . ($status == 0 ? 'Inactived' : 'Actived') . '</td>';
            $dataRows .= '<td class="center">';
            $dataRows .= '<a action="view" href="' . Router::url(array('controller' => 'admin', 'action' => 'show', 'users', $users[$i]['User']['id'])) . '" class="btn btn-success"><i class="icon-zoom-in icon-white"></i>View</a> ';
            $dataRows .= '<a action="edit" href="' . Router::url(array('controller' => 'admin', 'action' => 'edit', 'users', $users[$i]['User']['id'])) . '" class="btn btn-info"><i class="icon-edit icon-white"></i>Edit</a> ';
            $dataRows .= '<a action="delete" href="' . Router::url(array('controller' => 'admin', 'action' => 'delete', 'users', $users[$i]['User']['id'])) . '" class="btn btn-danger"><i class="icon-trash icon-white"></i>Delete</a>';
            $dataRows .= '</td>';
            $dataRows .= '</tr>';
        }

        $dataTable = '<table class="table table-striped table-bordered bootstrap-datatable datatable" id="dynamic"><thead>' . $dataHeading . '</thead><tbody>' . $dataRows . '</tbody></table>';
        return $dataTable;
    }

    public function showUser($id) {
        if (isset($id)) {
            $this->set('page_title', 'Show Users - ' . $id);
            $this->set('type', 'users');
            $this->set('id', $id);
            $this->loadModel('User');
            $options = array(
                'conditions' => array(
                    'id' => $id
                )
            );
            $user = $this->User->find('first', $options);
            $dataRows = '<tr class="formRow">';
            $dataRows .= '<td width="100"><label for="first_name">First name</label></td><td width="150">' . $user['User']['first_name'] . '</td>';
            $dataRows .= '<td width="100"><label for="last_name">Last name</label></td><td width="150">' . $user['User']['last_name'] . '</td>';
            $dataRows .= '</tr>';
            $dataRows .= '<tr class="formRow">';
            $dataRows .= '<td width="100"><label for="email">Email</label></td><td width="150">' . $user['User']['email'] . '</td>';
            $dataRows .= '<td width="100"></td><td width="150"></td></tr>';
            $dataRows .= '<tr class="formRow">';
            $dataRows .= '<td width="100"><label for="username">Username</label></td><td width="150">' . $user['User']['username'] . '</td>';
            $dataRows .= '<td width="100"></td><td width="150"></td></tr>';
            $dataRows .= '<tr class="formRow">';
            $dataRows .= '<td width="100"><label for="address">Address</label></td><td width="150">' . $user['User']['address'] . '</td>';
            $dataRows .= '<td width="100"></td><td width="150"></td></tr>';
            $dataRows .= '<tr class="formRow">';
            $dataRows .= '<td width="100"><label for="phone">Cell Phone</label></td><td width="150">' . $user['User']['phone'] . '</td>';
            $dataRows .= '<td width="100"></td><td width="150"></td></tr>';
            $dataRows .= '<tr class="formRow">';
            $dataRows .= '<td width="100"><label for="level">Level</label></td><td width="150">' . ($user['User']['level'] == 1 ? 'Admin' : 'User') . '</td>';
            $dataRows .= '<td width="100"></td><td width="150"></td></tr>';
            $dataRows .= '<tr class="formRow">';
            $dataRows .= '<td width="100"><label for="actived">Active</label></td><td width="150">' . ($user['User']['actived'] == 0 ? 'Inactive' : 'Active') . '</td>';
            $dataRows .= '<td width="100"></td><td width="150"></td></tr>';
            $dataRows .= '<tr class="formRow">';
            $dataRows .= '<td width="100"><label for="decription">Decription</label></td><td colspan="3">' . $user['User']['decription'] . '</td>';
            $dataRows .= '</tr>';

            $dataTable = '<table class="tDefault">' . $dataRows . '</table>';
            return $dataTable;
        }
    }

    public function createUser() {
        $this->loadModel('User');
        $this->User->create();
        $id = $this->User->id;
        if ($this->request->is('post')) {
            if ($this->User->save($this->request->data)) {
                return $this->redirect(array('action' => 'show', 'users', $this->User->id));
            }
        }

        if (isset($id)) {
            $this->set('page_title', 'Create Users');
            $this->set('type', 'users');
            $this->set('id', $id);
            $dataRows = '<tr class="formRow">';
            $dataRows .= '<td width="100"><label for="first_name">First name</label></td><td width="150"><input type="text" name="first_name" class="first_name" id="first_name"/></td>';
            $dataRows .= '<td width="100"><label for="last_name">Last name</label></td><td width="150"><input type="text" name="last_name" class="last_name" id="last_name"/></td>';
            $dataRows .= '</tr>';
            $dataRows .= '<tr class="formRow">';
            $dataRows .= '<td width="100"><label for="email">Email</label></td><td width="150"><input type="text" name="email" class="email" id="email"/></td>';
            $dataRows .= '<td width="100"></td><td width="150"></td></tr>';
            $dataRows .= '<tr class="formRow">';
            $dataRows .= '<td width="100"><label for="username">Username</label></td><td width="150"><input required="" type="text" name="username" class="username" id="username"/></td>';
            $dataRows .= '<td width="100"></td><td width="150"></td></tr>';
            $dataRows .= '<tr class="formRow">';
            $dataRows .= '<td width="100"><label for="password">Password</label></td><td width="150"><input required="" type="password" name="password" class="password" id="password"/></td>';
            $dataRows .= '<td width="100"></td><td width="150"></td></tr>';
            $dataRows .= '<tr class="formRow">';
            $dataRows .= '<td width="100"><label for="address">Address</label></td><td width="150"><input type="text" name="address" class="address" id="address"/></td>';
            $dataRows .= '<td width="100"></td><td width="150"></td></tr>';
            $dataRows .= '<tr class="formRow">';
            $dataRows .= '<td width="100"><label for="phone">Cell Phone</label></td><td width="150"><input type="text" name="phone" class="phone" id="phone"/></td>';
            $dataRows .= '<td width="100"></td><td width="150"></td></tr>';
            $dataRows .= '<tr class="formRow">';
            $dataRows .= '<td width="100"><label for="level">Level</label></td><td width="150"><select name="level" class="level" id="level"> 
                                                                                                <option value="0">User</option>
                                                                                                <option value="1">Admin</option>
                                                                                              </select></td>';
            $dataRows .= '<td width="100"></td><td width="150"></td></tr>';
            $dataRows .= '<tr class="formRow">';
            $dataRows .= '<td width="100"><label for="actived">Active</label></td><td width="150"><select name="actived" class="actived" id="actived"> 
                                                                                                <option value="0">Inactive</option>
                                                                                                <option value="1">Active</option>
                                                                                              </select></td>';
            $dataRows .= '<td width="100"></td><td width="150"></td></tr>';
            $dataRows .= '<tr class="formRow">';
            $dataRows .= '<td width="100"><label for="decription">Decription</label></td><td colspan="3"><textarea name="decription" class="autogrow" id="decription" rows="4" cols="50"></textarea></td>';
            $dataRows .= '</tr>';
            $dataRows .= '<tr class="formRow">';
            $dataRows .= '<td width="100"></td><td width="150"><button type="submit" class="btn btn-primary" value="save">Save changes</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button type="reset" class="btn">Cancel</button></td>';
            $dataRows .= '<td width="100"></td><td width="150"></td></tr>';
            $dataRows .= '<tr class="formRow">';

            $dataTable = '<form name="input" action="" method="post"><table class="tDefault">' . $dataRows . '</table></form>';
            return $dataTable;
        }
    }

    public function editUser($id) {
        $this->loadModel('User');

        if ($this->request->is('post')) {
            $this->User->id = $id;
            if ($this->User->save($this->request->data)) {
                return $this->redirect(array('action' => 'show', 'users', $id));
            }
        }

        if (isset($id)) {
            $this->set('page_title', 'Edit Users - ' . $id);
            $this->set('type', 'users');
            $this->set('id', $id);
            $options = array(
                'conditions' => array(
                    'id' => $id
                )
            );
            $user = $this->User->find('first', $options);
            $dataRows = '<tr class="formRow">';
            $dataRows .= '<td width="100"><label for="first_name">First name</label></td><td width="150"><input type="text" name="first_name" class="first_name" id="first_name" value="' . $user['User']['first_name'] . '"/></td>';
            $dataRows .= '<td width="100"><label for="last_name">Last name</label></td><td width="150"><input type="text" name="last_name" class="last_name" id="last_name" value="' . $user['User']['last_name'] . '"/></td>';
            $dataRows .= '</tr>';
            $dataRows .= '<tr class="formRow">';
            $dataRows .= '<td width="100"><label for="email">Email</label></td><td width="150"><input type="text" name="email" class="email" id="email" value="' . $user['User']['email'] . '"/></td>';
            $dataRows .= '<td width="100"></td><td width="150"></td></tr>';
            $dataRows .= '<tr class="formRow">';
            $dataRows .= '<td width="100"><label for="username">Username</label></td><td width="150"><input required="" type="text" name="username" class="username" id="username" value="' . $user['User']['username'] . '"/></td>';
            $dataRows .= '<td width="100"></td><td width="150"></td></tr>';
            $dataRows .= '<tr class="formRow">';
            $dataRows .= '<td width="100"><label for="address">Address</label></td><td width="150"><input type="text" name="address" class="address" id="address" value="' . $user['User']['address'] . '"/></td>';
            $dataRows .= '<td width="100"></td><td width="150"></td></tr>';
            $dataRows .= '<tr class="formRow">';
            $dataRows .= '<td width="100"><label for="phone">Cell Phone</label></td><td width="150"><input type="text" name="phone" class="phone" id="phone" value="' . $user['User']['phone'] . '"/></td>';
            $dataRows .= '<td width="100"></td><td width="150"></td></tr>';
            $dataRows .= '<tr class="formRow">';
            $dataRows .= '<td width="100"><label for="level">Level</label></td><td width="150"><select name="level" class="level" id="level"> 
                                                                                                <option value="0" ' . ($user['User']['level'] == 0 ? 'selected="selected"' : '') . '>User</option>
                                                                                                <option value="1" ' . ($user['User']['level'] == 1 ? 'selected="selected"' : '') . '>Admin</option>
                                                                                              </select></td>';
            $dataRows .= '<td width="100"></td><td width="150"></td></tr>';
            $dataRows .= '<tr class="formRow">';
            $dataRows .= '<td width="100"><label for="actived">Active</label></td><td width="150"><select name="actived" class="actived" id="actived"> 
                                                                                                <option value="0" ' . ($user['User']['actived'] == 0 ? 'selected="selected"' : '') . '>Inactive</option>
                                                                                                <option value="1" ' . ($user['User']['actived'] == 1 ? 'selected="selected"' : '') . '>Active</option>
                                                                                              </select></td>';
            $dataRows .= '<td width="100"></td><td width="150"></td></tr>';
            $dataRows .= '<tr class="formRow">';
            $dataRows .= '<td width="100"><label for="decription">Decription</label></td><td colspan="3"><textarea name="decription" class="autogrow" id="decription" rows="4" cols="50">' . $user['User']['decription'] . '</textarea></td>';
            $dataRows .= '</tr>';
            $dataRows .= '<tr class="formRow">';
            $dataRows .= '<td width="100"></td><td width="150"><button type="submit" class="btn btn-primary" value="save">Save changes</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button type="reset" class="btn">Cancel</button></td>';
            $dataRows .= '<td width="100"></td><td width="150"></td></tr>';
            $dataRows .= '<tr class="formRow">';

            $dataTable = '<form name="input" action="" method="post"><table class="tDefault">' . $dataRows . '</table></form>';
            return $dataTable;
        }
    }

    public function deleteUser($id) {
        $this->loadModel('User');
        if (isset($id)) {
            $this->User->id = $id;
            if ($this->User->delete()) {
                return $this->redirect(array('action' => 'lists', 'users'));
            }
        }
    }

    public function catalogs1() {
        $this->set('title_for_layout', 'List Catalogs Level 1');
        $this->set('subcat', '<a href="#">Catalogs Level 1</a>');
        $this->loadModel('CatalogsLevel1');

        $options = array(
            'fields' => array('id', 'name', 'order', 'actived'),
        );
        $cat1 = $this->CatalogsLevel1->find('all', $options);

        $dataHeading = '<tr>';
        $dataHeading .= '<th width="20px" class="center">#</th>';
        $dataHeading .= '<th>Name</th>';
        $dataHeading .= '<th>Order</th>';
        $dataHeading .= '<th>Status</th>';
        $dataHeading .= '<th width="220px">Actions</th>';
        $dataHeading .= '</tr>';

        $dataRows = '';

        // Generate data rows for data table
        for ($i = 0; $i < count($cat1); $i++) {
            $dataRows .= '<td class="center">' . ($i + 1) . '</td>';
            $dataRows .= '<td class="data">' . $cat1[$i]['CatalogsLevel1']['name'] . '</td>';
            $dataRows .= '<td class="data username">' . $cat1[$i]['CatalogsLevel1']['order'] . '</td>';
            $status = $cat1[$i]['CatalogsLevel1']['actived'];
            $dataRows .= '<td class="data">' . ($status == 0 ? 'Inactived' : 'Actived') . '</td>';
            $dataRows .= '<td class="center">';
            $dataRows .= '<a action="view" href="' . Router::url(array('controller' => 'admin', 'action' => 'show', 'catalogs1', $cat1[$i]['CatalogsLevel1']['id'])) . '" class="btn btn-success"><i class="icon-zoom-in icon-white"></i>View</a> ';
            $dataRows .= '<a action="edit" href="' . Router::url(array('controller' => 'admin', 'action' => 'edit', 'catalogs1', $cat1[$i]['CatalogsLevel1']['id'])) . '" class="btn btn-info"><i class="icon-edit icon-white"></i>Edit</a> ';
            $dataRows .= '<a action="delete" href="' . Router::url(array('controller' => 'admin', 'action' => 'delete', 'catalogs1', $cat1[$i]['CatalogsLevel1']['id'])) . '" class="btn btn-danger"><i class="icon-trash icon-white"></i>Delete</a>';
            $dataRows .= '</td>';
            $dataRows .= '</tr>';
        }

        $dataTable = '<table class="table table-striped table-bordered bootstrap-datatable datatable" id="dynamic"><thead>' . $dataHeading . '</thead><tbody>' . $dataRows . '</tbody></table>';
        return $dataTable;
    }

    public function showCatalogs1($id) {
        if (isset($id)) {
            $this->set('page_title', 'Show Catalog Level 1 - ' . $id);
            $this->set('type', 'catalogs1');
            $this->set('id', $id);
            $this->loadModel('CatalogsLevel1');
            $options = array(
                'conditions' => array(
                    'id' => $id
                )
            );
            $cat1 = $this->CatalogsLevel1->find('first', $options);
            $dataRows = '<tr class="formRow">';
            $dataRows .= '<td width="100"><label for="name">Name</label></td><td width="150">' . $cat1['CatalogsLevel1']['name'] . '</td>';
            $dataRows .= '<td width="100"></td><td width="150"></td>';
            $dataRows .= '</tr>';
            $dataRows .= '<tr class="formRow">';
            $dataRows .= '<td width="100"><label for="order">Order</label></td><td width="150">' . $cat1['CatalogsLevel1']['order'] . '</td>';
            $dataRows .= '<td width="100"></td><td width="150"></td></tr>';
            $dataRows .= '<tr class="formRow">';
            $dataRows .= '<td width="100"><label for="actived">Active</label></td><td width="150">' . ($cat1['CatalogsLevel1']['actived'] == 0 ? 'Inactive' : 'Active') . '</td>';
            $dataRows .= '<td width="100"></td><td width="150"></td></tr>';

            $dataTable = '<table class="tDefault">' . $dataRows . '</table>';
            return $dataTable;
        }
    }

    public function createCatalogs1() {
        $this->loadModel('CatalogsLevel1');
        $this->CatalogsLevel1->create();
        $id = $this->CatalogsLevel1->id;
        if ($this->request->is('post')) {
            if ($this->CatalogsLevel1->save($this->request->data)) {
                return $this->redirect(array('action' => 'show', 'catalogs1', $this->CatalogsLevel1->id));
            }
        }

        if (isset($id)) {
            $this->set('page_title', 'Show Catalogs Level 1');
            $this->set('type', 'catalogs1');
            $this->set('id', $id);
            $dataRows = '<tr class="formRow">';
            $dataRows .= '<td width="100"><label for="name">Name</label></td><td width="150"><input type="text" name="name" class="name" id="name"/></td>';
            $dataRows .= '<td width="100"></td><td width="150"></td>';
            $dataRows .= '</tr>';
            $dataRows .= '<tr class="formRow">';
            $dataRows .= '<td width="100"><label for="order">Order</label></td><td width="150"><input type="text" name="order" class="order" id="order"/></td>';
            $dataRows .= '<td width="100"></td><td width="150"></td></tr>';
            $dataRows .= '<tr class="formRow">';
            $dataRows .= '<td width="100"><label for="actived">Active</label></td><td width="150"><select name="actived" class="actived" id="actived"> 
                                                                                                <option value="0">Inactive</option>
                                                                                                <option value="1">Active</option>
                                                                                              </select></td>';
            $dataRows .= '<td width="100"></td><td width="150"></td></tr>';
            $dataRows .= '<tr class="formRow">';
            $dataRows .= '<td width="100"></td><td width="150"><button type="submit" class="btn btn-primary" value="save">Save changes</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button type="reset" class="btn">Cancel</button></td>';
            $dataRows .= '<td width="100"></td><td width="150"></td></tr>';
            $dataRows .= '<tr class="formRow">';

            $dataTable = '<form name="input" action="" method="post"><table class="tDefault">' . $dataRows . '</table></form>';
            return $dataTable;
        }
    }

    public function editCatalogs1($id) {
        $this->loadModel('CatalogsLevel1');

        if ($this->request->is('post')) {
            $this->CatalogsLevel1->id = $id;
            if ($this->CatalogsLevel1->save($this->request->data)) {
                return $this->redirect(array('action' => 'show', 'catalogs1', $id));
            }
        }

        if (isset($id)) {
            $this->set('page_title', 'Edit Catalogs Level 1 - ' . $id);
            $this->set('type', 'catalogs1');
            $this->set('id', $id);
            $options = array(
                'conditions' => array(
                    'id' => $id
                )
            );
            $cat1 = $this->CatalogsLevel1->find('first', $options);
            $dataRows = '<tr class="formRow">';
            $dataRows .= '<td width="100"><label for="name">Name</label></td><td width="150"><input type="text" name="name" class="name" id="name" value="' . $cat1['CatalogsLevel1']['name'] . '"/></td>';
            $dataRows .= '<td width="100"></td><td width="150"></td>';
            $dataRows .= '</tr>';
            $dataRows .= '<tr class="formRow">';
            $dataRows .= '<td width="100"><label for="order">Order</label></td><td width="150"><input type="text" name="order" class="order" id="order" value="' . $cat1['CatalogsLevel1']['order'] . '"/></td>';
            $dataRows .= '<td width="100"></td><td width="150"></td></tr>';
            $dataRows .= '<tr class="formRow">';
            $dataRows .= '<td width="100"><label for="actived">Active</label></td><td width="150"><select name="actived" class="actived" id="actived"> 
                                                                                                <option value="0" ' . ($cat1['CatalogsLevel1']['actived'] == 0 ? 'selected="selected"' : '') . '>Inactive</option>
                                                                                                <option value="1" ' . ($cat1['CatalogsLevel1']['actived'] == 1 ? 'selected="selected"' : '') . '>Active</option>
                                                                                              </select></td>';
            $dataRows .= '<td width="100"></td><td width="150"></td></tr>';
            $dataRows .= '<tr class="formRow">';
            $dataRows .= '<td width="100"></td><td width="150"><button type="submit" class="btn btn-primary" value="save">Save changes</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button type="reset" class="btn">Cancel</button></td>';
            $dataRows .= '<td width="100"></td><td width="150"></td></tr>';
            $dataRows .= '<tr class="formRow">';

            $dataTable = '<form name="input" action="" method="post"><table class="tDefault">' . $dataRows . '</table></form>';
            return $dataTable;
        }
    }

    public function deleteCatalogs1($id) {
        $this->loadModel('CatalogsLevel1');
        if (isset($id)) {
            $this->CatalogsLevel1->id = $id;
            if ($this->CatalogsLevel1->delete()) {
                return $this->redirect(array('action' => 'lists', 'catalogs1'));
            }
        }
    }

    public function catalogs2() {
        $this->set('title_for_layout', 'List Catalogs Level 2');
        $this->set('subcat', '<a href="#">Catalogs Level 2</a>');
        $this->loadModel('CatalogsLevel2');

        $options = array(
            'joins' => array(
                array('table' => 'catalogs_level1s', 'alias' => 'CatalogsLevel1', 'type' => 'inner', 'conditions' => array('CatalogsLevel2.catalog_level1s_id = CatalogsLevel1.id')),
            ),
            'fields' => array('id', 'name', 'order', 'actived', 'CatalogsLevel1.name'),
        );
        $cat2 = $this->CatalogsLevel2->find('all', $options);

        $dataHeading = '<tr>';
        $dataHeading .= '<th width="20px" class="center">#</th>';
        $dataHeading .= '<th>Name</th>';
        $dataHeading .= '<th>Catalog Level 1</th>';
        $dataHeading .= '<th>Order</th>';
        $dataHeading .= '<th>Status</th>';
        $dataHeading .= '<th width="220px">Actions</th>';
        $dataHeading .= '</tr>';

        $dataRows = '';

        // Generate data rows for data table
        for ($i = 0; $i < count($cat2); $i++) {
            $dataRows .= '<td class="center">' . ($i + 1) . '</td>';
            $dataRows .= '<td class="data">' . $cat2[$i]['CatalogsLevel2']['name'] . '</td>';
            $dataRows .= '<td class="data">' . $cat2[$i]['CatalogsLevel1']['name'] . '</td>';
            $dataRows .= '<td class="data">' . $cat2[$i]['CatalogsLevel2']['order'] . '</td>';
            $status = $cat2[$i]['CatalogsLevel2']['actived'];
            $dataRows .= '<td class="data">' . ($status == 0 ? 'Inactived' : 'Actived') . '</td>';
            $dataRows .= '<td class="center">';
            $dataRows .= '<a action="view" href="' . Router::url(array('controller' => 'admin', 'action' => 'show', 'catalogs2', $cat2[$i]['CatalogsLevel2']['id'])) . '" class="btn btn-success"><i class="icon-zoom-in icon-white"></i>View</a> ';
            $dataRows .= '<a action="edit" href="' . Router::url(array('controller' => 'admin', 'action' => 'edit', 'catalogs2', $cat2[$i]['CatalogsLevel2']['id'])) . '" class="btn btn-info"><i class="icon-edit icon-white"></i>Edit</a> ';
            $dataRows .= '<a action="delete" href="' . Router::url(array('controller' => 'admin', 'action' => 'delete', 'catalogs2', $cat2[$i]['CatalogsLevel2']['id'])) . '" class="btn btn-danger"><i class="icon-trash icon-white"></i>Delete</a>';
            $dataRows .= '</td>';
            $dataRows .= '</tr>';
        }

        $dataTable = '<table class="table table-striped table-bordered bootstrap-datatable datatable" id="dynamic"><thead>' . $dataHeading . '</thead><tbody>' . $dataRows . '</tbody></table>';
        return $dataTable;
    }

    public function showCatalogs2($id) {
        if (isset($id)) {
            $this->set('page_title', 'Show Catalog Level 2 - ' . $id);
            $this->set('type', 'catalogs2');
            $this->set('id', $id);
            $this->loadModel('CatalogsLevel2');
            $options = array(
                'joins' => array(
                    array('table' => 'catalogs_level1s', 'alias' => 'CatalogsLevel1', 'type' => 'inner', 'conditions' => array('CatalogsLevel2.catalog_level1s_id = CatalogsLevel1.id')),
                ),
                'conditions' => array(
                    'CatalogsLevel2.id' => $id
                ),
                'fields' => array('id', 'name', 'order', 'actived', 'CatalogsLevel1.name')
            );
            $cat2 = $this->CatalogsLevel2->find('first', $options);
            $dataRows = '<tr class="formRow">';
            $dataRows .= '<td width="100"><label for="name">Name</label></td><td width="150">' . $cat2['CatalogsLevel2']['name'] . '</td>';
            $dataRows .= '<td width="100"></td><td width="150"></td>';
            $dataRows .= '</tr>';
            $dataRows .= '<tr class="formRow">';
            $dataRows .= '<td width="100"><label for="catalog_level1">Catalog Level 1</label></td><td width="150">' . $cat2['CatalogsLevel1']['name'] . '</td>';
            $dataRows .= '<td width="100"></td><td width="150"></td>';
            $dataRows .= '</tr>';
            $dataRows .= '<tr class="formRow">';
            $dataRows .= '<td width="100"><label for="order">Order</label></td><td width="150">' . $cat2['CatalogsLevel2']['order'] . '</td>';
            $dataRows .= '<td width="100"></td><td width="150"></td></tr>';
            $dataRows .= '<tr class="formRow">';
            $dataRows .= '<td width="100"><label for="actived">Active</label></td><td width="150">' . ($cat2['CatalogsLevel2']['actived'] == 0 ? 'Inactive' : 'Active') . '</td>';
            $dataRows .= '<td width="100"></td><td width="150"></td></tr>';

            $dataTable = '<table class="tDefault">' . $dataRows . '</table>';
            return $dataTable;
        }
    }

    public function createCatalogs2($catalog1_id = null) {
        $this->loadModel('CatalogsLevel2');
        $this->loadModel('CatalogsLevel1');
        $this->CatalogsLevel2->create();
        $id = $this->CatalogsLevel2->id;
        if ($this->request->is('post')) {
            if ($this->CatalogsLevel2->save($this->request->data)) {
                return $this->redirect(array('action' => 'show', 'catalogs2', $this->CatalogsLevel2->id));
            }
        }


        $options = array(
            'conditions' => array(
                'actived' => 1
            ),
            'fields' => array('id', 'name')
        );
        $cat1 = $this->CatalogsLevel1->find('all', $options);

        if (isset($id)) {
            $this->set('page_title', 'Show Catalogs Level 2');
            $this->set('type', 'catalogs2');
            $this->set('id', $id);
            $dataRows = '<tr class="formRow">';
            $dataRows .= '<td width="100"><label for="name">Name</label></td><td width="150"><input type="text" name="name" class="name" id="name"/></td>';
            $dataRows .= '<td width="100"></td><td width="150"></td>';
            $dataRows .= '</tr>';
            $dataRows .= '<tr class="formRow">';
            $dataRows .= '<td width="100"><label for="name">Catalog Level 1</label></td><td width="150">';
            if (isset($catalog1_id)) {
                $dataRows .= '<input type="text" name="catalog_level1s_id" class="catalog_level1s_id" readonly="readonly" id="catalog_level1s_id" value="' . $catalog1_id . '"/>';
            } else {
                $dataRows .= '<select name="catalog_level1s_id" class="catalog_level1s_id" id="catalog_level1s_id">';
                for ($i = 0; $i < count($cat1); $i++) {
                    $dataRows .= '<option value="' . $cat1[$i]['CatalogsLevel1']['id'] . '">' . $cat1[$i]['CatalogsLevel1']['name'] . '</option>';
                }
                $dataRows .= '</select>';
            }
            $dataRows .= '</td>';
            $dataRows .= '<td width="100"></td><td width="150"></td>';
            $dataRows .= '</tr>';
            $dataRows .= '<tr class="formRow">';
            $dataRows .= '<td width="100"><label for="order">Order</label></td><td width="150"><input type="text" name="order" class="order" id="order"/></td>';
            $dataRows .= '<td width="100"></td><td width="150"></td></tr>';
            $dataRows .= '<tr class="formRow">';
            $dataRows .= '<td width="100"><label for="actived">Active</label></td><td width="150"><select name="actived" class="actived" id="actived"> 
                                                                                                <option value="0">Inactive</option>
                                                                                                <option value="1">Active</option>
                                                                                              </select></td>';
            $dataRows .= '<td width="100"></td><td width="150"></td></tr>';
            $dataRows .= '<tr class="formRow">';
            $dataRows .= '<td width="100"></td><td width="150"><button type="submit" class="btn btn-primary" value="save">Save changes</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button type="reset" class="btn">Cancel</button></td>';
            $dataRows .= '<td width="100"></td><td width="150"></td></tr>';
            $dataRows .= '<tr class="formRow">';

            $dataTable = '<form name="input" action="" method="post"><table class="tDefault">' . $dataRows . '</table></form>';
            return $dataTable;
        }
    }

    public function editCatalogs2($id) {
        $this->loadModel('CatalogsLevel2');
        $this->loadModel('CatalogsLevel1');

        if ($this->request->is('post')) {
            $this->CatalogsLevel2->id = $id;
            if ($this->CatalogsLevel2->save($this->request->data)) {
                return $this->redirect(array('action' => 'show', 'catalogs2', $id));
            }
        }

        if (isset($id)) {
            $this->set('page_title', 'Edit Catalogs Level 2 - ' . $id);
            $this->set('type', 'catalogs2');
            $this->set('id', $id);
            $options = array(
                'joins' => array(
                    array('table' => 'catalogs_level1s', 'alias' => 'CatalogsLevel1', 'type' => 'inner', 'conditions' => array('CatalogsLevel2.catalog_level1s_id = CatalogsLevel1.id')),
                ),
                'conditions' => array(
                    'CatalogsLevel2.id' => $id
                ),
                'fields' => array('id', 'name', 'order', 'actived', 'CatalogsLevel1.name')
            );
            $cat2 = $this->CatalogsLevel2->find('first', $options);
            $options = array(
                'conditions' => array(
                    'actived' => 1
                ),
                'fields' => array('id', 'name')
            );
            $cat1 = $this->CatalogsLevel1->find('all', $options);
            $dataRows = '<tr class="formRow">';
            $dataRows .= '<td width="100"><label for="name">Name</label></td><td width="150"><input type="text" name="name" class="name" id="name" value="' . $cat2['CatalogsLevel2']['name'] . '"/></td>';
            $dataRows .= '<td width="100"></td><td width="150"></td>';
            $dataRows .= '</tr>';
            $dataRows .= '<tr class="formRow">';
            $dataRows .= '<td width="100"><label for="name">Name</label></td><td width="150">';
            $dataRows .= '<select name="catalog_level1s_id" class="catalog_level1s_id" id="catalog_level1s_id">';
            for ($i = 0; $i < count($cat1); $i++) {
                $dataRows .= '<option value="' . $cat1[$i]['CatalogsLevel1']['id'] . '" ' . ($cat2['CatalogsLevel2']['actived'] == $cat1[$i]['CatalogsLevel1']['id'] ? 'selected="selected"' : '') . '>' . $cat1[$i]['CatalogsLevel1']['name'] . '</option>';
            }
            $dataRows .= '</select>';
            $dataRows .= '</td>';
            $dataRows .= '<td width="100"></td><td width="150"></td>';
            $dataRows .= '</tr>';
            $dataRows .= '<tr class="formRow">';
            $dataRows .= '<td width="100"><label for="order">Order</label></td><td width="150"><input type="text" name="order" class="order" id="order" value="' . $cat2['CatalogsLevel2']['order'] . '"/></td>';
            $dataRows .= '<td width="100"></td><td width="150"></td></tr>';
            $dataRows .= '<tr class="formRow">';
            $dataRows .= '<td width="100"><label for="actived">Active</label></td><td width="150"><select name="actived" class="actived" id="actived"> 
                                                                                                <option value="0" ' . ($cat2['CatalogsLevel2']['actived'] == 0 ? 'selected="selected"' : '') . '>Inactive</option>
                                                                                                <option value="1" ' . ($cat2['CatalogsLevel2']['actived'] == 1 ? 'selected="selected"' : '') . '>Active</option>
                                                                                              </select></td>';
            $dataRows .= '<td width="100"></td><td width="150"></td></tr>';
            $dataRows .= '<tr class="formRow">';
            $dataRows .= '<td width="100"></td><td width="150"><button type="submit" class="btn btn-primary" value="save">Save changes</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button type="reset" class="btn">Cancel</button></td>';
            $dataRows .= '<td width="100"></td><td width="150"></td></tr>';
            $dataRows .= '<tr class="formRow">';

            $dataTable = '<form name="input" action="" method="post"><table class="tDefault">' . $dataRows . '</table></form>';
            return $dataTable;
        }
    }

    public function deleteCatalogs2($id) {
        $this->loadModel('CatalogsLevel2');
        if (isset($id)) {
            $this->CatalogsLevel2->id = $id;
            if ($this->CatalogsLevel2->delete()) {
                return $this->redirect(array('action' => 'lists', 'catalogs2'));
            }
        }
    }

    public function catalogs3() {
        $this->set('title_for_layout', 'List Catalogs Level 3');
        $this->set('subcat', '<a href="#">Catalogs Level 3</a>');
        $this->loadModel('CatalogsLevel3');

        $options = array(
            'fields' => array('id', 'name', 'order', 'actived'),
        );
        $cat3 = $this->CatalogsLevel3->find('all', $options);

        $dataHeading = '<tr>';
        $dataHeading .= '<th width="20px" class="center">#</th>';
        $dataHeading .= '<th>Name</th>';
        $dataHeading .= '<th>Order</th>';
        $dataHeading .= '<th>Status</th>';
        $dataHeading .= '<th width="220px">Actions</th>';
        $dataHeading .= '</tr>';

        $dataRows = '';

        // Generate data rows for data table
        for ($i = 0; $i < count($cat3); $i++) {
            $dataRows .= '<td class="center">' . ($i + 1) . '</td>';
            $dataRows .= '<td class="data">' . $cat3[$i]['CatalogsLevel3']['name'] . '</td>';
            $dataRows .= '<td class="data username">' . $cat3[$i]['CatalogsLevel3']['order'] . '</td>';
            $status = $cat3[$i]['CatalogsLevel3']['actived'];
            $dataRows .= '<td class="data">' . ($status == 0 ? 'Inactived' : 'Actived') . '</td>';
            $dataRows .= '<td class="center">';
            $dataRows .= '<a action="view" href="' . Router::url(array('controller' => 'admin', 'action' => 'show', 'catalogs3', $cat3[$i]['CatalogsLevel3']['id'])) . '" class="btn btn-success"><i class="icon-zoom-in icon-white"></i>View</a> ';
            $dataRows .= '<a action="edit" href="' . Router::url(array('controller' => 'admin', 'action' => 'edit', 'catalogs3', $cat3[$i]['CatalogsLevel3']['id'])) . '" class="btn btn-info"><i class="icon-edit icon-white"></i>Edit</a> ';
            $dataRows .= '<a action="delete" href="' . Router::url(array('controller' => 'admin', 'action' => 'delete', 'catalogs3', $cat3[$i]['CatalogsLevel3']['id'])) . '" class="btn btn-danger"><i class="icon-trash icon-white"></i>Delete</a>';
            $dataRows .= '</td>';
            $dataRows .= '</tr>';
        }

        $dataTable = '<table class="table table-striped table-bordered bootstrap-datatable datatable" id="dynamic"><thead>' . $dataHeading . '</thead><tbody>' . $dataRows . '</tbody></table>';
        return $dataTable;
    }

    public function showCatalogs3($id) {
        if (isset($id)) {
            $this->set('page_title', 'Show Catalog Level 3 - ' . $id);
            $this->set('type', 'catalogs3');
            $this->set('id', $id);
            $this->loadModel('CatalogsLevel3');
            $this->loadModel('CatalogsLevel2');
            $this->loadModel('CatalogsLevel1');
            $options = array(
                'joins' => array(
                    array('table' => 'catalogs_level2s', 'alias' => 'CatalogsLevel2', 'type' => 'inner', 'conditions' => array('CatalogsLevel3.catalog_level2s_id = CatalogsLevel2.id')),
                    array('table' => 'catalogs_level1s', 'alias' => 'CatalogsLevel1', 'type' => 'inner', 'conditions' => array('CatalogsLevel2.catalog_level1s_id = CatalogsLevel1.id')),
                ),
                'conditions' => array(
                    'CatalogsLevel3.id' => $id
                ),
                'fields' => array('id', 'name', 'order', 'actived', 'CatalogsLevel2.name', 'CatalogsLevel1.name')
            );
            $cat3 = $this->CatalogsLevel3->find('first', $options);
            $dataRows = '<tr class="formRow">';
            $dataRows .= '<td width="100"><label for="name">Name</label></td><td width="150">' . $cat3['CatalogsLevel3']['name'] . '</td>';
            $dataRows .= '<td width="100"></td><td width="150"></td>';
            $dataRows .= '</tr>';
            $dataRows .= '<tr class="formRow">';
            $dataRows .= '<td width="100"><label for="name">Catalog Level 2</label></td><td width="150">' . $cat3['CatalogsLevel2']['name'] . '</td>';
            $dataRows .= '<td width="100"></td><td width="150"></td>';
            $dataRows .= '</tr>';
            $dataRows .= '<tr class="formRow">';
            $dataRows .= '<td width="100"><label for="name">Catalog Level 1</label></td><td width="150">' . $cat3['CatalogsLevel1']['name'] . '</td>';
            $dataRows .= '<td width="100"></td><td width="150"></td>';
            $dataRows .= '</tr>';
            $dataRows .= '<tr class="formRow">';
            $dataRows .= '<td width="100"><label for="order">Order</label></td><td width="150">' . $cat3['CatalogsLevel3']['order'] . '</td>';
            $dataRows .= '<td width="100"></td><td width="150"></td></tr>';
            $dataRows .= '<tr class="formRow">';
            $dataRows .= '<td width="100"><label for="actived">Active</label></td><td width="150">' . ($cat3['CatalogsLevel3']['actived'] == 0 ? 'Inactive' : 'Active') . '</td>';
            $dataRows .= '<td width="100"></td><td width="150"></td></tr>';

            $dataTable = '<table class="tDefault">' . $dataRows . '</table>';
            return $dataTable;
        }
    }

    public function createCatalogs3($catalog2_id = null) {
        $this->loadModel('CatalogsLevel3');
        $this->loadModel('CatalogsLevel2');
        $this->loadModel('CatalogsLevel1');
        $this->CatalogsLevel3->create();
        $id = $this->CatalogsLevel3->id;
        if ($this->request->is('post')) {
            if ($this->CatalogsLevel3->save($this->request->data)) {
                return $this->redirect(array('action' => 'show', 'catalogs3', $this->CatalogsLevel3->id));
            }
        }


        if (isset($catalog2_id)) {
            $options = array(
                'conditions' => array(
                    'actived' => 1,
                    'id' => $catalog2_id
                ),
                'fields' => array('id', 'name', 'catalog_level1s_id')
            );
            $cat2 = $this->CatalogsLevel2->find('first', $options);

            $options = array(
                'conditions' => array(
                    'actived' => 1,
                    'CatalogsLevel1.id' => $cat2['CatalogsLevel2']['catalog_level1s_id']
                ),
                'fields' => array('id', 'name')
            );
            $cat1 = $this->CatalogsLevel1->find('first', $options);
        } else {
            $options = array(
                'conditions' => array(
                    'actived' => 1
                ),
                'fields' => array('id', 'name')
            );
            $cat1 = $this->CatalogsLevel1->find('all', $options);

            $options = array(
                'conditions' => array(
                    'actived' => 1,
                    'catalog_level1s_id' => $cat1[0]['CatalogsLevel1']['id']
                ),
                'fields' => array('id', 'name', 'catalog_level1s_id')
            );
            $cat2 = $this->CatalogsLevel2->find('all', $options);
        }

        if (isset($id)) {
            $this->set('page_title', 'Show Catalogs Level 3');
            $this->set('type', 'catalogs3');
            $this->set('id', $id);
            $dataRows = '<tr class="formRow">';
            $dataRows .= '<td width="100"><label for="name">Name</label></td><td width="150"><input type="text" name="name" class="name" id="name"/></td>';
            $dataRows .= '<td width="100"></td><td width="150"></td>';
            $dataRows .= '</tr>';
            $dataRows .= '<tr class="formRow">';
            $dataRows .= '<td width="100"><label for="name">Catalog Level 1</label></td><td width="150">';
            if (isset($catalog2_id)) {
                $dataRows .= '<input type="text" name="catalog_level1s_id" class="catalog_level1s_id" readonly="readonly" id="catalog_level1s_id" value="' . $cat1['CatalogsLevel1']['id'] . '"/>';
            } else {
                $dataRows .= '<select name="catalog_level1s_id" class="catalog_level1s_id" id="catalog_level1s_id">';
                for ($i = 0; $i < count($cat1); $i++) {
                    $dataRows .= '<option value="' . $cat1[$i]['CatalogsLevel1']['id'] . '">' . $cat1[$i]['CatalogsLevel1']['name'] . '</option>';
                }
                $dataRows .= '</select>';
            }
            $dataRows .= '</td>';
            $dataRows .= '<td width="100"></td><td width="150"></td>';
            $dataRows .= '</tr>';
            $dataRows .= '<tr class="formRow">';
            $dataRows .= '<td width="100"><label for="name">Catalog Level 2</label></td><td width="150" id="catelogs2">';
            if (isset($catalog2_id)) {
                $dataRows .= '<input type="text" name="catalog_level2s_id" class="catalog_level2s_id" readonly="readonly" id="catalog_level2s_id" value="' . $catalog2_id . '"/>';
            } else {
                if (count($cat2) > 0) {
                    $dataRows .= '<select name="catalog_level2s_id" class="catalog_level2s_id" id="catalog_level2s_id">';
                    for ($i = 0; $i < count($cat2); $i++) {
                        $dataRows .= '<option value="' . $cat2[$i]['CatalogsLevel2']['id'] . '">' . $cat2[$i]['CatalogsLevel2']['name'] . '</option>';
                    }
                    $dataRows .= '</select>';
                } else {
                    $dataRows .= 'Catalog level 2 is empty!<br />Click <a href="' . Router::url(array('controller' => 'admin', 'action' => 'create', 'catalogs2', $cat1[0]['CatalogsLevel1']['id'])) . '">here</a> to add';
                }
            }
            $dataRows .= '</td>';
            $dataRows .= '<td width="100"></td><td width="150"></td>';
            $dataRows .= '</tr>';
            $dataRows .= '<tr class="formRow">';
            $dataRows .= '<td width="100"><label for="order">Order</label></td><td width="150"><input type="text" name="order" class="order" id="order"/></td>';
            $dataRows .= '<td width="100"></td><td width="150"></td></tr>';
            $dataRows .= '<tr class="formRow">';
            $dataRows .= '<td width="100"><label for="actived">Active</label></td><td width="150"><select name="actived" class="actived" id="actived"> 
                                                                                                <option value="0">Inactive</option>
                                                                                                <option value="1">Active</option>
                                                                                              </select></td>';
            $dataRows .= '<td width="100"></td><td width="150"></td></tr>';
            $dataRows .= '<tr class="formRow">';
            $dataRows .= '<td width="100"></td><td width="150"><button type="submit" class="btn btn-primary" value="save">Save changes</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button type="reset" class="btn">Cancel</button></td>';
            $dataRows .= '<td width="100"></td><td width="150"></td></tr>';
            $dataRows .= '<tr class="formRow">';

            $dataTable = '<form name="input" action="" method="post"><table class="tDefault">' . $dataRows . '</table></form>';
            return $dataTable;
        }
    }

    public function editCatalogs3($id) {
        $this->loadModel('CatalogsLevel3');
        $this->loadModel('CatalogsLevel2');
        $this->loadModel('CatalogsLevel1');

        if ($this->request->is('post')) {
            $this->CatalogsLevel3->id = $id;
            if ($this->CatalogsLevel3->save($this->request->data)) {
                return $this->redirect(array('action' => 'show', 'catalogs3', $id));
            }
        }

        $options = array(
            'conditions' => array(
                'actived' => 1
            ),
            'fields' => array('id', 'name')
        );
        $cat1 = $this->CatalogsLevel1->find('all', $options);

        $options = array(
            'conditions' => array(
                'actived' => 1,
                'catalog_level1s_id' => $cat1[0]['CatalogsLevel1']['id']
            ),
            'fields' => array('id', 'name')
        );
        $cat2 = $this->CatalogsLevel2->find('all', $options);

        if (isset($id)) {
            $this->set('page_title', 'Edit Catalogs Level 3 - ' . $id);
            $this->set('type', 'catalogs3');
            $this->set('id', $id);
            $options = array(
                'conditions' => array(
                    'id' => $id
                )
            );
            $cat3 = $this->CatalogsLevel3->find('first', $options);
            $dataRows = '<tr class="formRow">';
            $dataRows .= '<td width="100"><label for="name">Name</label></td><td width="150"><input type="text" name="name" class="name" id="name" value="' . $cat3['CatalogsLevel3']['name'] . '"/></td>';
            $dataRows .= '<td width="100"></td><td width="150"></td>';
            $dataRows .= '</tr>';
            $dataRows .= '<tr class="formRow">';
            $dataRows .= '<td width="100"><label for="name">Catalog Level 1</label></td><td width="150"><select name="catalog_level1s_id" class="catalog_level1s_id" id="catalog_level1s_id">';
            for ($i = 0; $i < count($cat1); $i++) {
                $dataRows .= '<option value="' . $cat1[$i]['CatalogsLevel1']['id'] . '">' . $cat1[$i]['CatalogsLevel1']['name'] . '</option>';
            }
            $dataRows .= '</select></td>';
            $dataRows .= '<td width="100"></td><td width="150"></td>';
            $dataRows .= '</tr>';
            $dataRows .= '<tr class="formRow">';
            $dataRows .= '<td width="100"><label for="name">Catalog Level 2</label></td><td width="150" id="catelogs2">';
            if (count($cat2) > 0) {
                $dataRows .= '<select name="catalog_level2s_id" class="catalog_level2s_id" id="catalog_level2s_id">';
                for ($i = 0; $i < count($cat2); $i++) {
                    $dataRows .= '<option value="' . $cat2[$i]['CatalogsLevel2']['id'] . '">' . $cat2[$i]['CatalogsLevel2']['name'] . '</option>';
                }
                $dataRows .= '</select>';
            } else {
                $dataRows .= 'Catalog level 2 is empty!<br />Click <a href="' . Router::url(array('controller' => 'admin', 'action' => 'create', 'catalogs2', $cat1[0]['CatalogsLevel1']['id'])) . '">here</a> to add';
            }
            $dataRows .= '</td>';
            $dataRows .= '<td width="100"></td><td width="150"></td>';
            $dataRows .= '</tr>';
            $dataRows .= '<tr class="formRow">';
            $dataRows .= '<td width="100"><label for="order">Order</label></td><td width="150"><input type="text" name="order" class="order" id="order" value="' . $cat3['CatalogsLevel3']['order'] . '"/></td>';
            $dataRows .= '<td width="100"></td><td width="150"></td></tr>';
            $dataRows .= '<tr class="formRow">';
            $dataRows .= '<td width="100"><label for="actived">Active</label></td><td width="150"><select name="actived" class="actived" id="actived"> 
                                                                                                <option value="0" ' . ($cat3['CatalogsLevel3']['actived'] == 0 ? 'selected="selected"' : '') . '>Inactive</option>
                                                                                                <option value="1" ' . ($cat3['CatalogsLevel3']['actived'] == 1 ? 'selected="selected"' : '') . '>Active</option>
                                                                                              </select></td>';
            $dataRows .= '<td width="100"></td><td width="150"></td></tr>';
            $dataRows .= '<tr class="formRow">';
            $dataRows .= '<td width="100"></td><td width="150"><button type="submit" class="btn btn-primary" value="save">Save changes</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button type="reset" class="btn">Cancel</button></td>';
            $dataRows .= '<td width="100"></td><td width="150"></td></tr>';
            $dataRows .= '<tr class="formRow">';

            $dataTable = '<form name="input" action="" method="post"><table class="tDefault">' . $dataRows . '</table></form>';
            return $dataTable;
        }
    }

    public function deleteCatalogs3($id) {
        $this->loadModel('CatalogsLevel3');
        if (isset($id)) {
            $this->CatalogsLevel3->id = $id;
            if ($this->CatalogsLevel3->delete()) {
                return $this->redirect(array('action' => 'lists', 'catalogs3'));
            }
        }
    }

    public function items() {
        $this->set('title_for_layout', 'List Items');
        $this->set('subcat', '<a href="#">Items</a>');
        $this->loadModel('Item');

        $options = array(
            'fields' => array('id', 'title', 'image', 'catalog_level1s_id', 'catalog_level2s_id', 'catalog_level3s_id', 'content', 'price', 'price_promotion', 'promotion_info', 'actived'),
        );
        $items = $this->Item->find('all', $options);

        $dataHeading = '<tr>';
        $dataHeading .= '<th width="20px" class="center">#</th>';
        $dataHeading .= '<th>Title</th>';
        $dataHeading .= '<th>Image</th>';
        $dataHeading .= '<th>Catalog Level 1</th>';
        $dataHeading .= '<th>Catalog Level 2</th>';
        $dataHeading .= '<th>Catalog Level 3</th>';
        $dataHeading .= '<th>Content</th>';
        $dataHeading .= '<th>Price</th>';
        $dataHeading .= '<th>Price Promotion</th>';
        $dataHeading .= '<th>Promotion Infomation</th>';
        $dataHeading .= '<th>Status</th>';
        $dataHeading .= '<th width="220px">Actions</th>';
        $dataHeading .= '</tr>';

        $dataRows = '';

        // Generate data rows for data table
        for ($i = 0; $i < count($items); $i++) {
            $dataRows .= '<td class="center">' . ($i + 1) . '</td>';
            $dataRows .= '<td class="data">' . $items[$i]['Item']['title'] . '</td>';
            $dataRows .= '<td class="data">' . $items[$i]['Item']['image'] . '</td>';
            $dataRows .= '<td class="data">' . $items[$i]['Item']['catalog_level1s_id'] . '</td>';
            $dataRows .= '<td class="data">' . $items[$i]['Item']['catalog_level2s_id'] . '</td>';
            $dataRows .= '<td class="data">' . $items[$i]['Item']['catalog_level3s_id'] . '</td>';
            $dataRows .= '<td class="data">' . $items[$i]['Item']['content'] . '</td>';
            $dataRows .= '<td class="data">' . $items[$i]['Item']['price'] . '</td>';
            $dataRows .= '<td class="data">' . $items[$i]['Item']['price_promotion'] . '</td>';
            $dataRows .= '<td class="data">' . $items[$i]['Item']['promotion_info'] . '</td>';
            $status = $items[$i]['Item']['actived'];
            $dataRows .= '<td class="data">' . ($status == 0 ? 'Inactived' : 'Actived') . '</td>';
            $dataRows .= '<td class="center">';
            $dataRows .= '<a action="view" href="' . Router::url(array('controller' => 'admin', 'action' => 'show', 'items', $items[$i]['Item']['id'])) . '" class="btn btn-success"><i class="icon-zoom-in icon-white"></i>View</a> ';
            $dataRows .= '<a action="edit" href="' . Router::url(array('controller' => 'admin', 'action' => 'edit', 'items', $items[$i]['Item']['id'])) . '" class="btn btn-info"><i class="icon-edit icon-white"></i>Edit</a> ';
            $dataRows .= '<a action="delete" href="' . Router::url(array('controller' => 'admin', 'action' => 'delete', 'items', $items[$i]['Item']['id'])) . '" class="btn btn-danger"><i class="icon-trash icon-white"></i>Delete</a>';
            $dataRows .= '</td>';
            $dataRows .= '</tr>';
        }

        $dataTable = '<table class="table table-striped table-bordered bootstrap-datatable datatable" id="dynamic"><thead>' . $dataHeading . '</thead><tbody>' . $dataRows . '</tbody></table>';
        return $dataTable;
    }

    public function showItem($id) {
        if (isset($id)) {
            $this->set('page_title', 'Show Item - ' . $id);
            $this->set('type', 'items');
            $this->set('id', $id);
            $this->loadModel('Item');
            $options = array(
                'joins' => array(
                    array('table' => 'catalogs_level3s', 'alias' => 'CatalogsLevel3', 'type' => 'inner', 'conditions' => array('CatalogsLevel3.id = Item.catalog_level3s_id')),
                    array('table' => 'catalogs_level2s', 'alias' => 'CatalogsLevel2', 'type' => 'inner', 'conditions' => array('CatalogsLevel2.id = Item.catalog_level2s_id')),
                    array('table' => 'catalogs_level1s', 'alias' => 'CatalogsLevel1', 'type' => 'inner', 'conditions' => array('CatalogsLevel1.id = Item.catalog_level1s_id')),
                ),
                'conditions' => array(
                    'Item.id' => $id
                ),
                'fields' => array('id', 'title', 'image', 'content', 'price', 'price_promotion', 'promotion_info', 'actived', 'CatalogsLevel3.name', 'CatalogsLevel2.name', 'CatalogsLevel1.name')
            );
            $item = $this->Item->find('first', $options);
            $dataRows = '<tr class="formRow">';
            $dataRows .= '<td width="100"><label for="title">Title</label></td><td width="150">' . $item['Item']['title'] . '</td>';
            $dataRows .= '<td width="100"><label for="image">Image</label></td><td width="150">' . $item['Item']['image'] . '</td>';
            $dataRows .= '</tr>';
            $dataRows .= '<tr class="formRow">';
            $dataRows .= '<td width="100"><label for="catalog1">Catalog level 1</label></td><td width="150">' . $item['CatalogsLevel1']['name'] . '</td>';
            $dataRows .= '<td width="100"></td><td width="150"></td></tr>';
            $dataRows .= '<tr class="formRow">';
            $dataRows .= '<td width="100"><label for="catalog2">Catalog level 2</label></td><td width="150">' . $item['CatalogsLevel2']['name'] . '</td>';
            $dataRows .= '<td width="100"></td><td width="150"></td></tr>';
            $dataRows .= '<tr class="formRow">';
            $dataRows .= '<td width="100"><label for="catalog3">Catalog level 3</label></td><td width="150">' . $item['CatalogsLevel3']['name'] . '</td>';
            $dataRows .= '<td width="100"></td><td width="150"></td></tr>';
            $dataRows .= '<tr class="formRow">';
            $dataRows .= '<td width="100"><label for="content">Content</label></td><td width="150">' . $item['Item']['content'] . '</td>';
            $dataRows .= '<td width="100"></td><td width="150"></td></tr>';
            $dataRows .= '<tr class="formRow">';
            $dataRows .= '<td width="100"><label for="price">Price</label></td><td width="150">' . $item['Item']['price'] . '</td>';
            $dataRows .= '<td width="100"></td><td width="150"></td></tr>';
            $dataRows .= '<tr class="formRow">';
            $dataRows .= '<td width="100"><label for="price_promotion">Price Promotion</label></td><td width="150">' . $item['Item']['price_promotion'] . '</td>';
            $dataRows .= '<td width="100"></td><td width="150"></td></tr>';
            $dataRows .= '<tr class="formRow">';
            $dataRows .= '<td width="100"><label for="promotion_info">Promotion Infomation</label></td><td width="150">' . $item['Item']['promotion_info'] . '</td>';
            $dataRows .= '<td width="100"></td><td width="150"></td></tr>';
            $dataRows .= '<tr class="formRow">';
            $dataRows .= '<td width="100"><label for="actived">Active</label></td><td width="150">' . ($item['Item']['actived'] == 0 ? 'Inactive' : 'Active') . '</td>';
            $dataRows .= '<td width="100"></td><td width="150"></td></tr>';

            $dataTable = '<table class="tDefault">' . $dataRows . '</table>';
            return $dataTable;
        }
    }

    public function createItem() {
        $this->loadModel('Item');
        $this->loadModel('CatalogsLevel3');
        $this->loadModel('CatalogsLevel2');
        $this->loadModel('CatalogsLevel1');
        $this->Item->create();
        $id = $this->Item->id;
        if ($this->request->is('post')) {
            if ($this->Item->save($this->request->data)) {
                return $this->redirect(array('action' => 'show', 'items', $this->Item->id));
            }
        }

        $options = array(
            'conditions' => array(
                'actived' => 1
            ),
            'fields' => array('id', 'name')
        );
        $cat1 = $this->CatalogsLevel1->find('all', $options);

        $options = array(
            'conditions' => array(
                'actived' => 1,
                'catalog_level1s_id' => $cat1[0]['CatalogsLevel1']['id']
            ),
            'fields' => array('id', 'name')
        );
        $cat2 = $this->CatalogsLevel2->find('all', $options);

        $options = array(
            'conditions' => array(
                'actived' => 1,
                'catalog_level2s_id' => $cat2[0]['CatalogsLevel2']['id']
            ),
            'fields' => array('id', 'name')
        );
        $cat3 = $this->CatalogsLevel3->find('all', $options);


        if (isset($id)) {
            $this->set('page_title', 'Create Item');
            $this->set('type', 'items');
            $this->set('id', $id);
            $dataRows = '<tr class="formRow">';
            $dataRows .= '<td width="100"><label for="title">Title</label></td><td width="150"><input type="text" name="title" class="title" id="title"/></td>';
            $dataRows .= '<td width="100"></td><td width="150"></td>';
            $dataRows .= '</tr>';
            $dataRows .= '<tr class="formRow">';
            $dataRows .= '<td width="100"><label for="image">Image</label></td><td width="150"><input class="input-file uniform_on" name="image" id="fileInput" type="file" size="19" style="opacity: 0;"><span class="filename">No file selected</span><span class="action">Choose File</span></td>';
            $dataRows .= '<td width="100"></td><td width="150"></td></tr>';
            $dataRows .= '<tr class="formRow">';
            $dataRows .= '<td width="100"><label for="catalog_level1s_id">Catalog Level 1</label></td><td width="150"><select name="catalog_level1s_id" class="catalog_level1s_id" id="catalog_level1s_id">';
            for ($i = 0; $i < count($cat1); $i++) {
                $dataRows .= '<option value="' . $cat1[$i]['CatalogsLevel1']['id'] . '">' . $cat1[$i]['CatalogsLevel1']['name'] . '</option>';
            }
            $dataRows .= '</select></td>';
            $dataRows .= '<td width="100"></td><td width="150"></td></tr>';
            $dataRows .= '<tr class="formRow">';
            $dataRows .= '<td width="100"><label for="catalog_level2s_id">Catalog Level 2</label></td><td width="150" id="catelogs2">';
            if (count($cat2) > 0) {
                $dataRows .= '<select name="catalog_level2s_id" class="catalog_level2s_id" id="catalog_level2s_id">';
                for ($i = 0; $i < count($cat2); $i++) {
                    $dataRows .= '<option value="' . $cat2[$i]['CatalogsLevel2']['id'] . '">' . $cat2[$i]['CatalogsLevel2']['name'] . '</option>';
                }
                $dataRows .= '</select>';
            } else {
                $dataRows .= 'Catalog level 2 is empty!<br />Click <a href="' . Router::url(array('controller' => 'admin', 'action' => 'create', 'catalogs2', $cat1[0]['CatalogsLevel1']['id'])) . '">here</a> to add';
            }
            $dataRows .= '</td>';
            $dataRows .= '<td width="100"></td><td width="150"></td></tr>';
            $dataRows .= '<tr class="formRow">';
            $dataRows .= '<td width="100"><label for="catalog_level3s_id">Catalog Level 3</label></td><td width="150" id="catelogs3">';
            if (count($cat3) > 0) {
                $dataRows .= '<select name="catalog_level3s_id" class="catalog_level3s_id" id="catalog_level3s_id">';
                for ($i = 0; $i < count($cat3); $i++) {
                    $dataRows .= '<option value="' . $cat3[$i]['CatalogsLevel3']['id'] . '">' . $cat3[$i]['CatalogsLevel3']['name'] . '</option>';
                }
                $dataRows .= '</select>';
            } else {
                $dataRows .= 'Catalog level 3 is empty!<br />Click <a href="' . Router::url(array('controller' => 'admin', 'action' => 'create', 'catalogs2', $cat2[0]['CatalogsLevel2']['id'])) . '">here</a> to add';
            }
            $dataRows .= '</td>';
            $dataRows .= '<td width="100"></td><td width="150"></td></tr>';
            $dataRows .= '<tr class="formRow">';
            $dataRows .= '<td width="100"><label for="content">Content</label></td><td width="150"><textarea type="text" name="content" class="cleditor" id="content"></textarea></td>';
            $dataRows .= '<td width="100"></td><td width="150"></td></tr>';
            $dataRows .= '<tr class="formRow">';
            $dataRows .= '<td width="100"><label for="price">Price</label></td><td width="150"><input type="text" name="price" class="price" id="price"/></td>';
            $dataRows .= '<td width="100"></td><td width="150"></td></tr>';
            $dataRows .= '<tr class="formRow">';
            $dataRows .= '<td width="100"><label for="price_promotion">Price Promotion</label></td><td width="150"><input type="text" name="price_promotion" class="price_promotion" id="price_promotion"/></td>';
            $dataRows .= '<td width="100"></td><td width="150"></td></tr>';
            $dataRows .= '<tr class="formRow">';
            $dataRows .= '<td width="100"><label for="promotion_info">Promotion Information</label></td><td width="150"><input type="text" name="promotion_info" class="promotion_info" id="promotion_info"/></td>';
            $dataRows .= '<td width="100"></td><td width="150"></td></tr>';
            $dataRows .= '<tr class="formRow">';
            $dataRows .= '<td width="100"><label for="actived">Active</label></td><td width="150"><select name="actived" class="actived" id="actived"> 
                                                                                                <option value="0">Inactive</option>
                                                                                                <option value="1">Active</option>
                                                                                              </select></td>';
            $dataRows .= '<td width="100"></td><td width="150"></td></tr>';
            $dataRows .= '<tr class="formRow">';
            $dataRows .= '<td width="100"></td><td width="150"><button type="submit" class="btn btn-primary" value="save">Save changes</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button type="reset" class="btn">Cancel</button></td>';
            $dataRows .= '<td width="100"></td><td width="150"></td></tr>';
            $dataRows .= '<tr class="formRow">';

            $dataTable = '<form name="input" action="" method="post"><table class="tDefault">' . $dataRows . '</table></form>';
            return $dataTable;
        }
    }

    public function editItem($id) {
        
        $this->loadModel('Item');
        $this->loadModel('CatalogsLevel3');
        $this->loadModel('CatalogsLevel2');
        $this->loadModel('CatalogsLevel1');

        if ($this->request->is('post')) {
            $this->User->id = $id;
            if ($this->User->save($this->request->data)) {
                return $this->redirect(array('action' => 'show', 'users', $id));
            }
        }

        $options = array(
            'conditions' => array(
                'actived' => 1
            ),
            'fields' => array('id', 'name')
        );
        $cat1 = $this->CatalogsLevel1->find('all', $options);

        $options = array(
            'conditions' => array(
                'actived' => 1,
                'catalog_level1s_id' => $cat1[0]['CatalogsLevel1']['id']
            ),
            'fields' => array('id', 'name')
        );
        $cat2 = $this->CatalogsLevel2->find('all', $options);

        $options = array(
            'conditions' => array(
                'actived' => 1,
                'catalog_level2s_id' => $cat2[0]['CatalogsLevel2']['id']
            ),
            'fields' => array('id', 'name')
        );
        $cat3 = $this->CatalogsLevel3->find('all', $options);

        if (isset($id)) {
            $this->set('page_title', 'Edit Item - ' . $id);
            $this->set('type', 'items');
            $this->set('id', $id);
            $options = array(
                'conditions' => array(
                    'id' => $id
                )
            );
            $item = $this->Item->find('first', $options);
            
             $dataRows = '<tr class="formRow">';
            $dataRows .= '<td width="100"><label for="title">Title</label></td><td width="150"><input type="text" name="title" class="title" id="title" value="'.$item['Item']['title'].'"/></td>';
            $dataRows .= '<td width="100"></td><td width="150"></td>';
            $dataRows .= '</tr>';
            $dataRows .= '<tr class="formRow">';
            $dataRows .= '<td width="100"><label for="image">Image</label></td><td width="150"><input class="input-file uniform_on" name="image" id="fileInput" type="file" size="19" style="opacity: 0;"><span class="filename">No file selected</span><span class="action">Choose File</span><br /><img class="charisma_qr center" src="'.Router::url('/', true).'webroot/img/uploads/'.$item['Item']['image'].'"></td>';
            $dataRows .= '<td width="100"></td><td width="150"></td></tr>';
            $dataRows .= '<tr class="formRow">';
            $dataRows .= '<td width="100"><label for="catalog_level1s_id">Catalog Level 1</label></td><td width="150"><select name="catalog_level1s_id" class="catalog_level1s_id" id="catalog_level1s_id">';
            for ($i = 0; $i < count($cat1); $i++) {
                $dataRows .= '<option value="' . $cat1[$i]['CatalogsLevel1']['id'] . '" '.(($cat1[$i]['CatalogsLevel1']['id']==$item['Item']['catalog_level1s_id'])?'selected="selected"':'').'>' . $cat1[$i]['CatalogsLevel1']['name'] . '</option>';
            }
            $dataRows .= '</select></td>';
            $dataRows .= '<td width="100"></td><td width="150"></td></tr>';
            $dataRows .= '<tr class="formRow">';
            $dataRows .= '<td width="100"><label for="catalog_level2s_id">Catalog Level 2</label></td><td width="150" id="catelogs2">';
            if (count($cat2) > 0) {
                $dataRows .= '<select name="catalog_level2s_id" class="catalog_level2s_id" id="catalog_level2s_id">';
                for ($i = 0; $i < count($cat2); $i++) {
                    $dataRows .= '<option value="' . $cat2[$i]['CatalogsLevel2']['id'] . '" '.(($cat2[$i]['CatalogsLevel2']['id']==$item['Item']['catalog_level2s_id'])?'selected="selected"':'').'>' . $cat2[$i]['CatalogsLevel2']['name'] . '</option>';
                }
                $dataRows .= '</select>';
            } else {
                $dataRows .= 'Catalog level 2 is empty!<br />Click <a href="' . Router::url(array('controller' => 'admin', 'action' => 'create', 'catalogs2', $cat1[0]['CatalogsLevel1']['id'])) . '">here</a> to add';
            }
            $dataRows .= '</td>';
            $dataRows .= '<td width="100"></td><td width="150"></td></tr>';
            $dataRows .= '<tr class="formRow">';
            $dataRows .= '<td width="100"><label for="catalog_level3s_id">Catalog Level 3</label></td><td width="150" id="catelogs3">';
            if (count($cat3) > 0) {
                $dataRows .= '<select name="catalog_level3s_id" class="catalog_level3s_id" id="catalog_level3s_id">';
                for ($i = 0; $i < count($cat3); $i++) {
                    $dataRows .= '<option value="' . $cat3[$i]['CatalogsLevel3']['id'] . '" '.(($cat3[$i]['CatalogsLevel3']['id']==$item['Item']['catalog_level3s_id'])?'selected="selected"':'').'>' . $cat3[$i]['CatalogsLevel3']['name'] . '</option>';
                }
                $dataRows .= '</select>';
            } else {
                $dataRows .= 'Catalog level 3 is empty!<br />Click <a href="' . Router::url(array('controller' => 'admin', 'action' => 'create', 'catalogs2', $cat2[0]['CatalogsLevel2']['id'])) . '">here</a> to add';
            }
            $dataRows .= '</td>';
            $dataRows .= '<td width="100"></td><td width="150"></td></tr>';
            $dataRows .= '<tr class="formRow">';
            $dataRows .= '<td width="100"><label for="content">Content</label></td><td width="150"><textarea type="text" name="content" class="cleditor" id="content">'.$item['Item']['content'].'</textarea></td>';
            $dataRows .= '<td width="100"></td><td width="150"></td></tr>';
            $dataRows .= '<tr class="formRow">';
            $dataRows .= '<td width="100"><label for="price">Price</label></td><td width="150"><input type="text" name="price" class="price" id="price" value="'.$item['Item']['price'].'"/></td>';
            $dataRows .= '<td width="100"></td><td width="150"></td></tr>';
            $dataRows .= '<tr class="formRow">';
            $dataRows .= '<td width="100"><label for="price_promotion">Price Promotion</label></td><td width="150"><input type="text" name="price_promotion" class="price_promotion" id="price_promotion" value="'.$item['Item']['price_promotion'].'"/></td>';
            $dataRows .= '<td width="100"></td><td width="150"></td></tr>';
            $dataRows .= '<tr class="formRow">';
            $dataRows .= '<td width="100"><label for="promotion_info">Promotion Information</label></td><td width="150"><input type="text" name="promotion_info" class="promotion_info" id="promotion_info" value="'.$item['Item']['promotion_info'].'"/></td>';
            $dataRows .= '<td width="100"></td><td width="150"></td></tr>';
            $dataRows .= '<tr class="formRow">';
            $dataRows .= '<td width="100"><label for="actived">Active</label></td><td width="150"><select name="actived" class="actived" id="actived"> 
                                                                                                <option value="0" ' . ($item['Item']['actived'] == 0 ? 'selected="selected"' : '') . '>Inactive</option>
                                                                                                <option value="1" ' . ($item['Item']['actived'] == 1 ? 'selected="selected"' : '') . '>Active</option>
                                                                                              </select></td>';
            $dataRows .= '<td width="100"></td><td width="150"></td></tr>';
            $dataRows .= '<tr class="formRow">';
            $dataRows .= '<td width="100"></td><td width="150"><button type="submit" class="btn btn-primary" value="save">Save changes</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button type="reset" class="btn">Cancel</button></td>';
            $dataRows .= '<td width="100"></td><td width="150"></td></tr>';
            $dataRows .= '<tr class="formRow">';

            $dataTable = '<form name="input" action="" method="post"><table class="tDefault">' . $dataRows . '</table></form>';
            return $dataTable;
        }
    }

    public function deleteItem($id) {
        $this->loadModel('Item');
        if (isset($id)) {
            $this->Item->id = $id;
            if ($this->Item->delete()) {
                return $this->redirect(array('action' => 'lists', 'items'));
            }
        }
    }

    public function galaries() {
        $this->set('title_for_layout', 'List Galaries');
    }

    public function advertisings() {
        $this->set('title_for_layout', 'List Advertisings');
    }

    public function ajaxGetCatalogs2() {
        $this->layout = 'ajax';
        $this->autoRender = false;
        if (isset($_POST['catalogs_level1s_id'])) {
            $this->loadModel('CatalogsLevel2');
            $options = array(
                'conditions' => array(
                    'actived' => 1,
                    'catalog_level1s_id' => $_POST['catalogs_level1s_id']
                ),
                'fields' => array('id', 'name')
            );
            $cat2 = $this->CatalogsLevel2->find('all', $options);
            $json = array();
            for ($i = 0; $i < count($cat2); $i++) {
                $json[] = array(
                    'id' => $cat2[$i]['CatalogsLevel2']['id'],
                    'name' => $cat2[$i]['CatalogsLevel2']['name'],
                );
            }
            echo json_encode($json);
        }
    }

    public function ajaxGetCatalogs3() {
        $this->layout = 'ajax';
        $this->autoRender = false;
        if (isset($_POST['catalogs_level2s_id'])) {
            $this->loadModel('CatalogsLevel3');
            $options = array(
                'conditions' => array(
                    'actived' => 1,
                    'catalog_level2s_id' => $_POST['catalogs_level2s_id']
                ),
                'fields' => array('id', 'name')
            );
            $cat3 = $this->CatalogsLevel3->find('all', $options);
            $json = array();
            for ($i = 0; $i < count($cat3); $i++) {
                $json[] = array(
                    'id' => $cat3[$i]['CatalogsLevel3']['id'],
                    'name' => $cat3[$i]['CatalogsLevel3']['name'],
                );
            }
            echo json_encode($json);
        }
    }

}
