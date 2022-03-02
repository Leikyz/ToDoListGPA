<?php
//Définition du fudeau horaire
setlocale(LC_TIME, 'fr', 'fr_FR', 'fr_FR.ISO8859-1');

// Chargement des fichier css de grocery
if (isset($output)){
    foreach($output->css_files as $file){
       echo "<link type='text/css' rel='stylesheet' href='".$file."'/>";
    }    
}

foreach ($scripts as $script) {
    //----------------------------------------------------------------------------------------//
    //-------------------------------------BOOTSTRAP------------------------------------------//
    //----------------------------------------------------------------------------------------//
    if ($script === 'bootstrap'){
        echo "<link rel='stylesheet' href='".base_url('/assets/plugins/bootstrap/css/bootstrap-theme.min.css')."'/>
              <link rel='stylesheet' href='".base_url('/assets/plugins/bootstrap/css/bootstrap.min.css')."'/>
			  <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.0.13/css/all.css' />
              <link rel='stylesheet' href='".base_url('/assets/plugins/bootstrap/css/font-awesome.min.css')."'/>";
    } 
	
	elseif ($script == 'wysihtml5'){
        echo "<link rel='stylesheet' href='".base_url('/assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css')."'/>";
    }
	
	

	
	 //----------------------------------------------------------------------------------------//
    //-------------------------------------SELECT2------------------------------------------//
    //----------------------------------------------------------------------------------------//
	if ($script == 'select2'){
        echo "<link rel='stylesheet' href='".base_url('/assets/plugins/select2/css/select2.min.css')."'/>";
    }
    	 //----------------------------------------------------------------------------------------//
    //-------------------------------------SELECT2 V 4------------------------------------------//
    //----------------------------------------------------------------------------------------//
	if ($script == 'select2-4'){
        echo "<link rel='stylesheet' href='".base_url('/assets/plugins/select2-4/css/select2.css')."'/>";
    }
	//----------------------------------------------------------------------------------------//
    //-------------------------------------JQUERY-UI------------------------------------------//
    //----------------------------------------------------------------------------------------//
	if ($script == 'jqueryui'){
		echo "<link rel='stylesheet' href='".base_url('/assets/plugins/jquery/ui/jquery-ui.css')."'/>";
	}
    
	if ($script == 'jquery2_header'){
	    echo "<script src='".base_url('/assets/plugins/jquery/js/jquery-2.1.4.min.js')."'></script>";
	}
        
        if ($script == 'jquery3.6.0_header'){
	    echo "<script src='".base_url('/assets/plugins/jquery/js/jquery-3.6.0.min.js')."'></script>";
	}
    //----------------------------------------------------------------------------------------//
    //------------------------------------AUTOCOMPLETE----------------------------------------//
    //----------------------------------------------------------------------------------------//
    else if ($script === 'autocomplete'){
        echo "<link rel='stylesheet' href='".base_url('/assets/plugins/autocomplete/css/token-input.css')."'/>
              <link rel='stylesheet' href='".base_url('/assets/plugins/autocomplete/css/token-input-custom.css')."'/>";
    }
	
	//----------------------------------------------------------------------------------------//
    //---------------------------------------CHOSEN-------------------------------------------//
    //----------------------------------------------------------------------------------------//
    else if ($script === 'chosen'){
        echo "<link rel='stylesheet' href='".base_url('/assets/plugins/grocery_crud/css/jquery_plugins/chosen/chosen.css')."'/>";
		echo "<style>
		.chosen-mini{
			width: 100px !important;
		}
		</style>";
    }
    
    //----------------------------------------------------------------------------------------//
    //---------------------------------------LTE ADMIN----------------------------------------//
    //----------------------------------------------------------------------------------------//
    else if ($script === 'lte'){
        echo "<link rel='stylesheet' href='".base_url('/assets/plugins/lteadmin/css/AdminLTE.min.css')."'/>";
		echo "<link rel='stylesheet' href='".base_url('/assets/plugins/lteadmin/css/skins/skin-blue.min.css')."'/>";
    } 
	
	//----------------------------------------------------------------------------------------//
    //------------------------------------SWEETALERT------------------------------------------//
    //----------------------------------------------------------------------------------------//
	else if ($script == 'sweetalert'){
		echo "<link rel='stylesheet' href='".base_url('/assets/plugins/sweetalert/sweetalert.css')."'/>";
	}
    
    //----------------------------------------------------------------------------------------//
    //---------------------------------------DATEPICKER---------------------------------------//
    //----------------------------------------------------------------------------------------//
    else if ($script == 'datepicker' || $script == 'timepicker' || $script == 'daterangepicker'){
        echo "<link rel='stylesheet' href='".base_url('/assets/plugins/datepicker/css/datepicker3.css')."'/>
              <link rel='stylesheet' href='".base_url('/assets/plugins/datepicker/css/daterangepicker-bs3.css')."'/>";
    }
        //----------------------------------------------------------------------------------------//
    //---------------------------------------CLOCKPICKER---------------------------------------//
    //----------------------------------------------------------------------------------------//
    else if ($script == 'clockpicker'){
        echo "<link rel='stylesheet' href='".base_url('/assets/plugins/clockpicker/dist/jquery-clockpicker.css')."'/>";
    }  
    //----------------------------------------------------------------------------------------//
    //---------------------------------------DATATABLES---------------------------------------//
    //----------------------------------------------------------------------------------------//
    else if ($script == 'datatables' or $script == 'datatables_ajax'){
        echo "<link rel='stylesheet' type='text/css' href='".base_url('/assets/plugins/datatables/src/RowGroup-1.0.0/css/rowGroup.bootstrap.min.css')."'/>
			<link rel='stylesheet' type='text/css' href='".base_url('/assets/plugins/datatables/src/Buttons-1.2.4/css/buttons.bootstrap.min.css')."'/>
			<link rel='stylesheet' type='text/css' href='".base_url('/assets/plugins/datatables/src/DataTables-1.10.13/css/dataTables.bootstrap.min.css')."'/>
			<link rel='stylesheet' type='text/css' href='".base_url('/assets/plugins/datatables/src/Buttons-1.2.4/css/buttons.bootstrap.min.css')."'/>
			<link rel='stylesheet' type='text/css' href='".base_url('/assets/plugins/datatables/src/ColReorder-1.3.2/css/colReorder.bootstrap.min.css')."'/>
			<link rel='stylesheet' type='text/css' href='".base_url('/assets/plugins/datatables/src/FixedColumns-3.2.2/css/fixedColumns.bootstrap.min.css')."'/>
			<link rel='stylesheet' type='text/css' href='".base_url('/assets/plugins/datatables/src/FixedHeader-3.1.2/css/fixedHeader.bootstrap.min.css')."'/>
			<link rel='stylesheet' type='text/css' href='".base_url('/assets/plugins/datatables/src/KeyTable-2.2.0/css/keyTable.bootstrap.min.css')."'/>
			<link rel='stylesheet' type='text/css' href='".base_url('/assets/plugins/datatables/src/Responsive-2.1.0/css/responsive.bootstrap.min.css')."'/>
                        
			<link rel='stylesheet' type='text/css' href='".base_url('/assets/plugins/datatables/src/RowReorder-1.2.0/css/rowReorder.bootstrap.min.css')."'/>
			<link rel='stylesheet' type='text/css' href='".base_url('/assets/plugins/datatables/src/Scroller-1.4.2/css/scroller.bootstrap.min.css')."'/>
			<link rel='stylesheet' type='text/css' href='".base_url('/assets/plugins/datatables/src/Select-1.2.0/css/select.bootstrap.min.css')."'/>";
    }
    else if ($script == 'datatables_custom'){
        include "/assets/plugins/datatables/css/datatables_css.php";
    }
	
	//----------------------------------------------------------------------------------------//
    //----------------------------------COLORSELECTOR-----------------------------------------//
    //----------------------------------------------------------------------------------------//
	else if ($script == 'colorselector'){
		echo "<link rel='stylesheet' type='text/css' href='".base_url('/assets/plugins/colorselector/css/bootstrap-colorselector.min.css')."'/>";
	}
	
	//----------------------------------------------------------------------------------------//
	//----------------------------------MESSAGERIE IMPRESSION-----------------------------------------//
	//----------------------------------------------------------------------------------------//
	else if ($script == 'cssImpression'){
	    echo "<link rel='stylesheet' type='text/css' media='print' href='".base_url('/assets/plugins/Messagerie/cssImpression/Impression.css')."'/>";
	}
	else if($script == 'jsMessagerieHeader')
	{
	    echo "<script src='" . base_url('/assets/plugins/Messagerie/jsMessagerie/alert.js') . "'></script>";
	}
	else if($script == 'cssChargement')
	{
	    echo "<link rel='stylesheet' type='text/css' href='".base_url('/assets/plugins/Messagerie/cssMessagerie/Chargement.css')."'/>";
	}
    //----------------------------------------------------------------------------------------//
	//----------------------------------SURVEY-----------------------------------------//
	//----------------------------------------------------------------------------------------//
	else if ($script == 'survey'){
            echo "<link rel='stylesheet' type='text/css'  href='".base_url('/assets/plugins/survey/surveyeditor.css')."'/>";
            echo "<link rel='stylesheet' type='text/css'  href='".base_url('/assets/plugins/survey/surveyeditor.min.css')."'/>";
	    echo "<link rel='stylesheet' type='text/css'  href='".base_url('/assets/plugins/survey/survey.min.css')."'/>";
    }
    //----------------------------------------------------------------------------------------//
	//----------------------------------FULLCALENDAR-----------------------------------------//
	//----------------------------------------------------------------------------------------//
	if ($script == 'qtip'){
        echo "<link href='".base_url('/assets/plugins/qtip/jquery.qtip.min.css')."' rel='stylesheet' />";
    }
    //----------------------------------------------------------------------------------------//
	//----------------------------------FULLCALENDAR-----------------------------------------//
	//----------------------------------------------------------------------------------------//
	if ($script == 'fullcalendar'){
        echo "<link href='".base_url('/assets/plugins/fullcalendar/core/main.css')."' rel='stylesheet' />";
        echo "<link href='".base_url('/assets/plugins/fullcalendar/daygrid/main.css')."' rel='stylesheet' />";
        echo "<link href='".base_url('/assets/plugins/fullcalendar/timegrid/main.css')."' rel='stylesheet' />";
    }
    //----------------------------------------------------------------------------------------//
	//----------------------------------------JEXCEL------------------------------------------//
	//----------------------------------------------------------------------------------------//
	if ($script == 'jexcel'){
        echo '<link rel="stylesheet" href="' . base_url('/assets/plugins/jexcel/jexcel.css') . '" type="text/css" />';
        echo '<link rel="stylesheet" href="' . base_url('/assets/plugins/jexcel/jsuites.css') . '" type="text/css" />';

       //echo '<link rel="stylesheet" href="https://bossanova.uk/jspreadsheet/v4/jexcel.css" type="text/css" />';
      // echo '<link rel="stylesheet" href="https://jsuites.net/v4/jsuites.css" type="text/css" />';
        
       // echo "<script src='" . base_url('/assets/plugins/jexcel/jsuites.css') . "'> </script>";
        //echo ' <link rel="stylesheet" href="https://bossanova.uk/jexcel/v3/jexcel.css" type="text/css" />';
       //echo '<link rel="stylesheet" href="https://bossanova.uk/jsuites/v2/jsuites.css" type="text/css" />';
    }
    // ----------------------------------------------------------------------------------------//
    // ------------------------------------INSI------------------------------------------//
    // ----------------------------------------------------------------------------------------//
    if ($script == 'insi') {
        echo "<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />";
        echo "<script type='text/javascript' src='" . base_url()."assets/plugins/dmpconnect/examples_common_parameters.js'> </script>";
        echo "<script type='text/javascript' src='" . base_url()."assets/plugins/dmpconnect/dmpconnect.js'> </script>";
        echo "<script type='text/javascript' src='" . base_url()."assets/plugins/dmpconnect/dmpconnect_dmp.js'> </script>";
        echo "<script type='text/javascript' src='" . base_url()."assets/plugins/dmpconnect/dmpconnect_insi.js'> </script>";
        echo "<script type='text/javascript' src='" . base_url()."assets/plugins/dmpconnect/commun.js'> </script>";
        echo "<script type='text/javascript' src='" . base_url()."assets/plugins/dmpconnect/exemples_dmp.js'> </script>";
        echo "<script type='text/javascript' src='" . base_url()."assets/plugins/dmpconnect/insi.js'> </script>";
        echo "<link href='" . base_url()."assets/plugins/dmpconnect/exemples.css' rel='stylesheet'>";
    }
    // ----------------------------------------------------------------------------------------//
    // ------------------------------------VITALE------------------------------------------//
    // ----------------------------------------------------------------------------------------//
    if ($script == 'vitale') {
        echo "<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />";
        echo "<script type='text/javascript' src='" . base_url()."assets/plugins/dmpconnect/examples_common_parameters.js'> </script>";
        echo "<script type='text/javascript' src='" . base_url()."assets/plugins/dmpconnect/dmpconnect.js'> </script>";
        echo "<script type='text/javascript' src='" . base_url()."assets/plugins/dmpconnect/dmpconnect_dmp.js'> </script>";
        echo "<script type='text/javascript' src='" . base_url()."assets/plugins/dmpconnect/dmpconnect_insi.js'> </script>";
       // echo "<script type='text/javascript' src='" . base_url()."assets/plugins/dmpconnect/commun.js'> </script>";
        echo "<script type='text/javascript' src='" . base_url()."assets/plugins/dmpconnect/examples_dmp.js'> </script>";
        echo "<script type='text/javascript' src='" . base_url()."assets/plugins/dmpconnect/vitale.js'> </script>";
        echo "<link href='" . base_url()."assets/plugins/dmpconnect/examples.css' rel='stylesheet'>";
    }
}
//echo '<script type = "text/javascript" src="'.base_url()."'/assets/plugins/sisyphus/sisyphus.min.js').'"></script>';
?>
<style>
    body{/*correction bug ios iframe responsive*/
    max-width: 100vw !important;
    }
    .dataTables_scrollBody thead tr[role="row"]{ /*empèche affichage 2ème ligne de recherche dans tableaux*/
    visibility: collapse !important;
}
</style>
      </head>
      
    <body>