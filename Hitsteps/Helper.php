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



        $field = new \Ip\Form\Field\Radio(
            array(
                'name' => 'floatingchat',
                'label' => __('Show Floating Chat Widget', 'hitsteps'),
                'hint' => __('It will show a small floating chat button allowing your visitors to contact you and send you a message', 'hitsteps'),
                'value' =>  ipGetOption('Hitsteps.floatingchat') ? ipGetOption('Hitsteps.floatingchat') : 0,
                'values' => array(
								array('0', 'No'),
								array('1', 'Yes')
							)
            ));
        $form->addField($field);

        $field = new \Ip\Form\Field\Select(
            array(
                'name' => 'floatingchatpos',
                'label' => __('Floating Chat Widget Position', 'hitsteps'),
                'hint' => __('You can choose location of floating chat widget', 'hitsteps'),
                'value' =>  ipGetOption('Hitsteps.floatingchatpos') ? ipGetOption('Hitsteps.floatingchatpos') : 'bottomright',
                'values' => array(
								array('bottomright', 'Bottom right'),
								array('bottomleft', 'Bottom Left'),
								array('topright', 'Top Right'),
								array('topleft', 'Top Left'),
							)
            ));
        $form->addField($field);
        
        $field = new \Ip\Form\Field\Select(
            array(
                'name' => 'chatlang',
                'label' => __('Default language for chat window', 'hitsteps'),
                'hint' => __('It can be auto, or you can choose it here', 'hitsteps'),
                'value' =>  ipGetOption('Hitsteps.chatlang') ? ipGetOption('Hitsteps.chatlang') : 'auto',
                'values' => array(
								array('auto', 'Auto-Detect'),
								array('en', 'English'),
								array('es', 'Español'),
								array('fr', 'Français'),
								array('de', 'Deutsch'),
								array('fa', 'فارسی'),
								array('tr', 'Türkçe'),
							)
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