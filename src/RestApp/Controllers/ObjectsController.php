<?php


namespace MySimple\RestApp\Controllers;

use MySimple\RestApp\Core\Controllers\Controller;
use MySimple\RestApp\Models\ObjectModel;
use MySimple\RestApp\Views\View;


class ObjectsController extends Controller
{
    public function listAction($page=1, $perPage=30)
    {
        $model = new ObjectModel($this->context->db);
        $data = $model->findAll($page, $perPage);

        $view = new View($this->getRenderType());
        return $view->render($data);
    }

    public function filterAction($param, $operator, $value, $page=1, $perPage=30, $orderBy='')
    {
        $model = new ObjectModel($this->context->db);
        $data = $model->findByParam($param, $operator, $value, $page, $perPage, $orderBy);

        $view = new View($this->getRenderType());
        return $view->render($data);
    }

    public function viewAction($id)
    {
        $model = $this->loadModel($id);
        $view = new View($this->getRenderType());
        return $view->render($model->toArray());
    }

    public function createAction()
    {
        $model = new ObjectModel($this->context->db);

        $method = $this->context->request->getMethod();
        if($method == 'POST') {
            $data = $this->context->request->getBody()->getContents();
            $data = json_decode($data);

            if($data) {
                $model->setAttributes((array)$data);
                $id = $model->save();
                $model = $this->loadModel($id);
            }
        }

        $view = new View($this->getRenderType());
        return $view->render($model->toArray());
    }

    public function updateAction($id)
    {
        $model = $this->loadModel($id);

        $method = $this->context->request->getMethod();
        if($method == 'PUT') {
            $data = $this->context->request->getBody()->getContents();
            $data = json_decode($data);
            if($data) {
                $model->setAttributes((array)$data);
                $model->update();
            }
        }

        $view = new View($this->getRenderType());
        return $view->render($model->toArray());
    }

    public function deleteAction($id)
    {
        $model = $this->loadModel($id);

        $method = $this->context->request->getMethod();
        if($method == 'DELETE') {
            $model->delete();
            $view = new View($this->getRenderType());
            return $view->render(array(
                'id' => $model->id
            ));
        }
    }

    private function loadModel($id)
    {
        $model = new ObjectModel($this->context->db);
        $model = $model->findById($id);
        if(false == $model) {
            header("HTTP/1.0 404 Not Found");
            exit;
        }

        return $model;
    }



}