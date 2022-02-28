<?php

/* 
 * Scripts de création des lignes html de chargement des CSS et JS
 */
?>
<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('load_css'))
{
      
    /*
     * créé la ligne html de chargement des fichiers CSS envoyés dans le array
     */
    function load_css($file)
    {
        if(!empty($file)){
            $element ="";
            foreach($file as $css) {
                $element.= link_tag($css);     
            }
        }
        return $element;
    }
}


if ( ! function_exists('load_js'))
{
    /*
     * créé la ligne html de chargement des fichiers JS envoyés dans le array
     */
    function load_js($file)
    {
        if(!empty($file)){
            $element ="";
            foreach($file as $js) {
                $element.= script_tag($js);
            }
        }
        return $element;
    }
}

