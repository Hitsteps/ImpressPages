<h1>Hitsteps Realtime Analytics</h1><br />

<?php
if ($file = ipGetOption('Config.favIcon')) {

    if (!empty($file)) {

        $file_name = explode('.', $file);
        $options = array('type' => 'fit', 'width' => 114, 'height' => 114);
        $thumbnail_114x114 = ipReflection($file, $options, $file_name[0] . '-114x114.' . $file_name[1], true);
        ?>

        <div style="margin-bottom:20px;">
            <h3>Current FavIcon</h3>
            <img src="<?php echo ipFileUrl($thumbnail_114x114); ?>"/>
        </div>

        <?php
    }
}

echo $form->render();

?>
