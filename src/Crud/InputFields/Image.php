<?php

namespace Sandbox\Cms\Crud\InputFields;

class Image extends AbstractInputField  {

    use InputField;
    use withOptions;

    public function render($name, $data = null) {
        $template = '';
        if($data){
            if(strpos($data, 'http')){
                $source = $data;
            }

            if(isset($this->options['root'])){
                $source = $this->options['root'] . $data;
            }else {
                $source = $data;
            }
            $height = '200px';
            if(isset($this->options['height'])){
                $height = $this->options['height'];
            }
            $csrfToken = csrf_token();
            $attributeName = $this->attribute->name;
            $id = $this->crud->modelInstance->id;
            $template = "<br>
                <div style='position:relative'>
                    </form>
                    <form name='image-field-delete-$attributeName' method='POST' action='/admin/blogs/$id' enctype='multipart/form-data'>
                        <input type='hidden' name='_method' value='PUT'>
                        <input type='hidden' name='_token' value='$csrfToken'>
                        <input type='hidden' name='$attributeName' value=''>
                        <button type='submit' title='Delete Image' style='position:absolute;top:20px;right:10px;cursor:pointer;background-color:#fff;padding:2px 5px;border: none;'>X</button>
                        <img src='$source' class='img-thumbnail mb-2' style='height:$height;'>
                    </form>
                </div>
                ";
        }
        $template .= "<input name='$name' type='file' class='form-control-file'>";
        return $template;
    }
}