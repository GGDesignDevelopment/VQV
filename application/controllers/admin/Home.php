<?php

class Home extends Admin_Controller {

    function __construct() {
        parent::__construct();
    }

    function edit() {
        $rules = $this->home_m->rules;
        $images = $this->alimentacion_m->get();
        $script = '<script type="text/javascript">$("#files").fileinput({
					uploadAsinc: false,
					showUpload: false,
					showRemove: false,
					overwriteInitial: false,
					overwrite:false,
					initialPreview: [';

        foreach ($images as $image) {
            $script .= "'<img src=" . '"' . site_url($this->imageDir . $image->imagen) . '" class="file-preview-image">' . "',";
        }
        $script .= '], initialPreviewConfig: [';

        foreach ($images as $image) {
            $script .= '{height:"120px", url:"' . site_url('admin/home/delete_alimentacion') . '/' . $image->id . '/' . $image->imagen . '"},';
        }

        $script .= ']})</script>;';
        $this->data['scripts'][] = $script;
        $this->form_validation->set_rules($rules);
        if ($this->form_validation->run() == TRUE) {
            $data = $this->home_m->array_from_post(array('linkFacebook', 'linkInstagram', 'txtWelcome', 'subAlimentacion', 'subReciclaje', 'subAbout', 'txtAbout','mailEnvio','mailVenta'));
            $this->home_m->save($data,['id'=>1]);

            if (!empty($_FILES['files'])) {
                $files = $_FILES['files'];
                $success = null;
                $paths = [];
                // get file names
                $filenames = $files['name'];

                // loop and process files
                for ($i = 0; $i < count($filenames); $i++) {
                    $ext = explode('.', basename($filenames[$i]));
                    $target = $this->imageDir . md5(uniqid()) . "." . array_pop($ext);
                    if (move_uploaded_file($files['tmp_name'][$i], $target)) {
                        $success = true;
                        $paths[] = $target;
                    } else {
                        $success = false;
                        break;
                    }
                }

                if ($success === true) {
                    // Guardar en BD
                    foreach ($paths as $file) {
                        $fileName = explode('/', $file);
                        $imageData = array();
                        $imageData['imagen'] = $fileName[1];
                        $this->alimentacion_m->save($imageData);
                    }
                } else {
                    // delete any uploaded files
                    foreach ($paths as $file) {
                        unlink($file);
                    }
                }
            }

            redirect('admin/dashboard');
        }
        $this->data['subview'] = 'admin/home/edit';
        $this->load->view('admin/_layout_main', $this->data);
    }

    function delete_alimentacion($id, $imagen) {
        $this->alimentacion_m->delete(['id'=>$id]);
        unlink($this->imageDir . $imagen);
        echo 0;
    }

}
