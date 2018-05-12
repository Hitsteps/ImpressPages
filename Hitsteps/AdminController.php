<?php

namespace Plugin\Hitsteps;

class AdminController
{


    /**
     * @ipSubmenu Configuration
     */
    public function index(){

        $form = Helper::indexCreateForm();
        $data['form'] = $form;

        $renderedHtml = ipView('view/index.php', $data)->render();
        return $renderedHtml;

    }


    public function indexSave()
    {

        $form = Helper::indexCreateForm();

        $postData = ipRequest()->getPost();
        $errors = $form->validate($postData);

        if ($errors) {
            // Validation error
            $status = array('status' => 'error', 'errors' => $errors);

            return new \Ip\Response\Json($status);
        } else {
            // Success

            $apicode = ipRequest()->getPost('apicode');


            
                ipRemoveOption('Hitsteps.apicode');
                ipSetOption('Hitsteps.apicode', $apicode);



           $actionUrl = ipActionUrl(array('aa' => 'Hitsteps.index'));
           $status = array('redirectUrl' => $actionUrl);
           return new \Ip\Response\Json($status);
        }

    }



}