<?php

use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;

class $className$Controller extends ControllerBase
{

    /**
     * Index action
     */
    public function indexAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Searches for $plural$
     */
    public function searchAction()
    {

        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, "$className$", $_POST);
            $this->persistent->parameters = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = array();
        }
        $parameters["order"] = "$pk$";

        $pluralVar$ = $className$::find($parameters);
        if (count($pluralVar$) == 0) {
            $this->flash->notice("The search did not find any $plural$");

            return $this->dispatcher->forward(array(
                "controller" => "$plural$",
                "action" => "index"
            ));
        }

        $paginator = new Paginator(array(
            "data" => $pluralVar$,
            "limit"=> 10,
            "page" => $numberPage
        ));

        $this->view->page = $paginator->getPaginate();
    }

    /**
     * Displayes the creation form
     */
    public function newAction()
    {

    }

    /**
     * Edits a $singular$
     *
     * @param string $pkVar$
     */
    public function editAction($pkVar$)
    {

        if (!$this->request->isPost()) {

            $singularVar$ = $className$::findFirstBy$pk$($pkVar$);
            if (!$singularVar$) {
                $this->flash->error("$singular$ was not found");

                return $this->dispatcher->forward(array(
                    "controller" => "$plural$",
                    "action" => "index"
                ));
            }

            $this->view->$pk$ = $singularVar$->$pk$;

            $assignTagDefaults$
        }
    }

    /**
     * Creates a new $singular$
     */
    public function createAction()
    {

        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(array(
                "controller" => "$plural$",
                "action" => "index"
            ));
        }

        $singularVar$ = new $className$();

        $assignInputFromRequestCreate$

        if (!$singularVar$->save()) {
            foreach ($singularVar$->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "controller" => "$plural$",
                "action" => "new"
            ));
        }

        $this->flash->success("$singular$ was created successfully");

        return $this->dispatcher->forward(array(
            "controller" => "$plural$",
            "action" => "index"
        ));

    }

    /**
     * Saves a $singular$ edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(array(
                "controller" => "$plural$",
                "action" => "index"
            ));
        }

        $pkVar$ = $this->request->getPost("$pk$");

        $singularVar$ = $className$::findFirstBy$pk$($pkVar$);
        if (!$singularVar$) {
            $this->flash->error("$singular$ does not exist " . $pkVar$);

            return $this->dispatcher->forward(array(
                "controller" => "$plural$",
                "action" => "index"
            ));
        }

        $assignInputFromRequestUpdate$

        if (!$singularVar$->save()) {

            foreach ($singularVar$->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "controller" => "$plural$",
                "action" => "edit",
                "params" => array($singularVar$->$pk$)
            ));
        }

        $this->flash->success("$singular$ was updated successfully");

        return $this->dispatcher->forward(array(
            "controller" => "$plural$",
            "action" => "index"
        ));

    }

    /**
     * Deletes a $singular$
     *
     * @param string $pkVar$
     */
    public function deleteAction($pkVar$)
    {

        $singularVar$ = $className$::findFirstBy$pk$($pkVar$);
        if (!$singularVar$) {
            $this->flash->error("$singular$ was not found");

            return $this->dispatcher->forward(array(
                "controller" => "$plural$",
                "action" => "index"
            ));
        }

        if (!$singularVar$->delete()) {

            foreach ($singularVar$->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "controller" => "$plural$",
                "action" => "search"
            ));
        }

        $this->flash->success("$singular$ was deleted successfully");

        return $this->dispatcher->forward(array(
            "controller" => "$plural$",
            "action" => "index"
        ));
    }

}
