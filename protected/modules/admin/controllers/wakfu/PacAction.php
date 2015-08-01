<?php
/**
 * File: PacAction.php
 * User: daijianhao(toruneko@outlook.com)
 * Date: 15/6/3 11:20
 * Description: 
 */
class PacAction extends RedAction{

    public function run(){
        $query = $this->request->getPost('Service', array());
        $model = Service::model();
        $model->attributes = $query;
        $condition = $this->createSearchCriteria($query);
        $pager = new CPagination($model->count($condition));
        $pager->setPageSize(20);
        $condition['offset'] = $pager->getOffset();
        $condition['limit'] = $pager->getLimit();
        $condition['order'] = 'uid asc';
        $data = $model->findAll($condition);
        $this->render('pac', array(
            'data' => new RedArrayDataProvider($data),
            'pager' => $pager,
            'model' => $model,
        ));
    }
}