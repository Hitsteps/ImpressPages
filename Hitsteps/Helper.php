<?php
namespace Plugin\Hitsteps;


class Helper
{

    public static function apicode()
    {
		    $manual_apicode = ipGetOption('Hitsteps.apicode');
			if ($manual_apicode==""){
				$manual_apicode=ipConfig()->get('hitsteps_apicode');
			}
			return $manual_apicode;
    }

    public static function indexCreateForm()
    {

        $form = new \Ip\Form();



                //$apicode = ipGetOption('Hitsteps.apicode');
                $apicode = Helper::apicode();
          

        $field = new \Ip\Form\Field\Text(
            array(
                'name' => 'apicode',
                'label' => __('Hitsteps API Code', 'hitsteps'),
                'hint' => __('Please input your Hitsteps API code here. You can get your Hitsteps API code by registering your website in hitsteps.com and looking at Setting page of your website in Hitsteps Dashboard.', 'hitsteps'),
                'value' =>  $apicode
            ));
        $form->addField($field);



        $field = new \Ip\Form\Field\Hidden(
            array(
                'name' => 'aa',
                'value' => 'Hitsteps.indexSave',
            ));

        $form->addField($field);
        $form->addField(new \Ip\Form\Field\Submit(array('value' => 'Save')));

        return $form;
    }

}