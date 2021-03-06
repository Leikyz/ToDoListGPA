<?php
foreach ($scripts as $script) {
    //----------------------------------------------------------------------------------------//
    //------------------------------------JQUERY----------------------------------------------//
    //----------------------------------------------------------------------------------------//
    if ($script == 'jquery3') {
        echo "<script src='" . base_url('/assets/plugins/jquery/js/jquery-3.2.1.min.js') . "'></script>";
    } else if ($script == 'jquery2') {
        echo "<script src='" . base_url('/assets/plugins/jquery/js/jquery-2.1.4.min.js') . "'></script>";
    } else if ($script == 'jquery1') {
        echo "<script src='" . base_url('/assets/plugins/jquery/js/jquery-1.11.1.min.js') . "'></script>";
    } else if ($script == 'jquery3.6.0') {
        echo "<script src='" . base_url('/assets/plugins/jquery/js/jquery-3.6.0.min.js') . "'></script>";
    } /* else if ($script == 'jquery4'){
      echo "<script src='".base_url('/assets/plugins/jquery/js/jquery-1.8.3.min.js')."'></script>";
      } */



    if ($script == 'jqueryui') {
        echo "<script src='" . base_url('/assets/plugins/jquery/ui/jquery-ui.js') . "'></script>";
    }

    if ($script == 'jqscroll') {
        echo "<script src='" . base_url('/assets/plugins/jquery/ui/jquery.ui.autocomplete.scroll') . "'</script>";
        echo "<script src='" . base_url('/assets/plugins/jquery/ui/jquery.ui.autocomplete.scroll.min') . "'</script>";
    }

    //----------------------------------------------------------------------------------------//
    //------------------------------------SELECT2----------------------------------------------//
    //----------------------------------------------------------------------------------------//

    if ($script == 'select2') {
        echo "<script src='" . base_url('/assets/plugins/select2/js/select2.min.js') . "'></script>";
    }
        //----------------------------------------------------------------------------------------//
    //------------------------------------SELECT2 V 4----------------------------------------------//
    //----------------------------------------------------------------------------------------//

    if ($script == 'select2-4') {
        echo "<script src='" . base_url('/assets/plugins/select2-4/js/select2.min.js') . "'></script>";
    }
    //----------------------------------------------------------------------------------------//
    //--------------------------------------CHOSEN--------------------------------------------//
    //----------------------------------------------------------------------------------------//
    else if ($script == 'chosen') {
        echo "<script src='" . base_url('/assets/plugins/grocery_crud/js/jquery_plugins/jquery.chosen.min.js') . "'></script>
			  <script src='" . base_url('/assets/plugins/grocery_crud/js/jquery_plugins/config/jquery.chosen.config.js') . "'></script>";
        if (isset($custom_chosen)) {
            echo $custom_chosen;
        }
    }

    //----------------------------------------------------------------------------------------//
    //-------------------------------------BOOTSTRAP------------------------------------------//
    //----------------------------------------------------------------------------------------//
    else if ($script == 'bootstrap') {
        echo "<script src='" . base_url('/assets/plugins/bootstrap/js/bootstrap.min.js') . "'></script>";
    }

    if ($script == 'wysihtml5') {
        echo "<script src='" . base_url('/assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') . "'></script>";
    }

    //----------------------------------------------------------------------------------------//
    //------------------------------------AUTOHEIGHT------------------------------------------//
    //----------------------------------------------------------------------------------------//
    else if ($script == 'autoheight') {
        echo "<script src='" . base_url('/assets/plugins/autoheight/jquery-iframe-auto-height.min.js') . "'></script>";
        echo "<script src='" . base_url('/assets/plugins/autoheight/jquery.browser.min.js') . "'></script>";
    }

    //----------------------------------------------------------------------------------------//
    //-------------------------------------LTE-ADMIN------------------------------------------//
    //----------------------------------------------------------------------------------------//
    else if ($script == 'lte') {
        echo "<script src='" . base_url('/assets/plugins/lteadmin/js/app.min.js') . "'></script>";
        echo "<script src='" . base_url('/assets/plugins/input-mask/jquery.inputmask.js') . "'></script>";
        echo "<script src='" . base_url('/assets/plugins/input-mask/jquery.inputmask.extensions.js') . "'></script>";
        echo "<script src='" . base_url('/assets/plugins/input-mask/jquery.inputmask.date.extensions.js') . "'></script>";
    }

    //----------------------------------------------------------------------------------------//
    //--------------------------------------LAZYLOAD------------------------------------------//
    //----------------------------------------------------------------------------------------//
    else if ($script == 'lazyload') {
        echo "<script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/lazysizes/1.3.1/lazysizes.min.js'></script>";
    }

    //----------------------------------------------------------------------------------------//
    //------------------------------------AUTOCOMPLETE----------------------------------------//
    //----------------------------------------------------------------------------------------//
    else if ($script == 'autocomplete') {
        echo "<script src='" . base_url('/assets/plugins/autocomplete/js/jquery.tokeninput.js') . "'></script>";
        foreach ($autocomplete as $item) {
            echo "<script>
                $(function() {
                $( '#" . $item[0] . "' ).tokenInput('" . base_url('/index.php/autocomplete/Autocomplete') . "',{
                    tokenLimit : " . $item[2] . ",
                    hintText : 'Tapez pour rechercher',
                    noResultsText : \"<span class='pas-de-resultat'>Pas de r&eacute;sultats <i class='fa fa-exclamation'></i></span><a href='http://localhost/sapadv1/framework/index.php/sapad/C_enseignant/index/add' target='_blank'>test</a><button class='btn btn-info pull-right' onclick='ajouter_ville()' ><i class='fa fa-plus'></i></button>\",
                    searchingText : 'Recherche..',
                    animateDropdown : false});
                });</script>";
        }
    }
    //----------------------------------------------------------------------------------------//
    //------------------------------------CLOCKPCIKER----------------------------------------//
    //----------------------------------------------------------------------------------------//
    //Passer variable $data['clocks'] en array avec le liste des id de champs ?? utiliser pour le clock//
    else if ($script == 'clockpicker') {
        echo "<script type='text/javascript' src='" . base_url('/assets/plugins/clockpicker/dist/bootstrap-clockpicker.min.js') . "'></script>";
        foreach ($clocks as $clock) {
            echo "<script>
                    $( '#" . $clock . "' ).clockpicker( {
                    placement: 'top', // clock popover placement
                    align: 'bottom', // popover arrow align
                    donetext: 'Valider', // done button text
                    autoclose: true,
                    vibrate: true // vibrate the device when dragging clock hand
                    } )
	</script>";
        }
    }
    //----------------------------------------------------------------------------------------//
    //---------------------------------------DATATABLES---------------------------------------//
    //----------------------------------------------------------------------------------------//
    else if ($script == 'datatables' or $script == 'datatables_ajax') {
        echo "<script type='text/javascript' src='" . base_url('/assets/plugins/datatables/src/JSZip-2.5.0/jszip.min.js') . "'></script>
		 	<script type='text/javascript' src='" . base_url('/assets/plugins/datatables/src/pdfmake-0.1.18/build/pdfmake.min.js') . "'></script>
	  		<script type='text/javascript' src='" . base_url('/assets/plugins/datatables/src/pdfmake-0.1.18/build/vfs_fonts.js') . "'></script>
			<script type='text/javascript' src='" . base_url('/assets/plugins/datatables/src/DataTables-1.10.13/js/jquery.dataTables.min.js') . "'></script>
			<script type='text/javascript' src='" . base_url('/assets/plugins/datatables/src/DataTables-1.10.13/js/dataTables.bootstrap.min.js') . "'></script>
			<script type='text/javascript' src='" . base_url('/assets/plugins/datatables/src/Buttons-1.2.4/js/dataTables.buttons.min.js') . "'></script>
			<script type='text/javascript' src='" . base_url('/assets/plugins/datatables/src/Buttons-1.2.4/js/buttons.bootstrap.min.js') . "'></script>
			<script type='text/javascript' src='" . base_url('/assets/plugins/datatables/src/Buttons-1.2.4/js/buttons.colVis.min.js') . "'></script>
			<script type='text/javascript' src='" . base_url('/assets/plugins/datatables/src/Buttons-1.2.4/js/buttons.flash.min.js') . "'></script>
			<script type='text/javascript' src='" . base_url('/assets/plugins/datatables/src/Buttons-1.2.4/js/buttons.html5.min.js') . "'></script>
			<script type='text/javascript' src='" . base_url('/assets/plugins/datatables/src/Buttons-1.2.4/js/buttons.print.min.js') . "'></script>
			<script type='text/javascript' src='" . base_url('/assets/plugins/datatables/src/ColReorder-1.3.2/js/dataTables.colReorder.min.js') . "'></script>
			<script type='text/javascript' src='" . base_url('/assets/plugins/datatables/src/FixedColumns-3.2.2/js/dataTables.fixedColumns.min.js') . "'></script>
			<script type='text/javascript' src='" . base_url('/assets/plugins/datatables/src/FixedHeader-3.1.2/js/dataTables.fixedHeader.min.js') . "'></script>
			<script type='text/javascript' src='" . base_url('/assets/plugins/datatables/src/KeyTable-2.2.0/js/dataTables.keyTable.min.js') . "'></script>
			<script type='text/javascript' src='" . base_url('/assets/plugins/datatables/src/Responsive-2.1.0/js/dataTables.responsive.min.js') . "'></script>
			<script type='text/javascript' src='" . base_url('/assets/plugins/datatables/src/Responsive-2.1.0/js/responsive.bootstrap.min.js') . "'></script>
			<script type='text/javascript' src='" . base_url('/assets/plugins/datatables/src/RowReorder-1.2.0/js/dataTables.rowReorder.min.js') . "'></script>
			<script type='text/javascript' src='" . base_url('/assets/plugins/datatables/src/Scroller-1.4.2/js/dataTables.scroller.min.js') . "'></script>
			<script type='text/javascript' src='" . base_url('/assets/plugins/datatables/src/Select-1.2.0/js/dataTables.select.min.js') . "'></script>
			<script type='text/javascript' src='" . base_url('/assets/plugins/datatables/src/date-eu.js') . "'></script>
			<script type='text/javascript' src='" . base_url('/assets/plugins/datatables/src/date-uk.js') . "'></script>
			<script type='text/javascript' src='" . base_url('/assets/plugins/datatables/src/num-html.js') . "'></script>
			<script type='text/javascript' src='" . base_url('/assets/plugins/datatables/src/RowGroup-1.0.0/js/dataTables.rowGroup.min.js') . "'></script>
                        <script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.8.4/moment.min.js'></script>
                        <script type='text/javascript' src='https://cdn.datatables.net/plug-ins/1.10.16/sorting/datetime-moment.js'></script>";
        ?>
        <script>




        <?php
        (!isset($pdf_export)) ? $pdf_export = '' : '';
        (!isset($sort_col)) ? $sort_col = '' : '';
        (!isset($nb_show)) ? $nb_show = '25' : '';
        (!isset($script)) ? $script = '' : '';
        (!isset($text)) ? $text = "'print'" : '';
        (!isset($format)) ? $format = "
        {
                extend: 'print',
                                            exportOptions: {
                            columns: ':visible'
                            },
                text: 'Imprimer',
                message: '',
                footer:true,
							
        },
" : '';

        if ($script == 'datatables') {
            ?>
                $(document).ready(function() {
                    
                //change les br en /n/r
                var fixNewLine = {
                exportOptions: {
                format: {
                body: function (data, column, row) {
                return column === 5 ?
                        data.replace(/<br\s*\/?>/gi, '"' + "\r\n" + '"') :
                        data;
                }
                }
                }
                };
                moment.locale('fr');
                $.fn.dataTable.moment('DD/MM/YYYY');
                $('.datatable').DataTable({
                "autoWidth": true,
                        "iDisplayLength": <?php echo $nb_show; ?>,
                        "stateSave": true,
                        "lengthMenu": [[10, 25, 50, - 1], [10, 25, 50, "Tous"]],
                        "deferRender": true,



            <?php
            if (isset($custom_datatables)) {
                echo $custom_datatables;
            }
            ?>

                dom: 'Blfrtip',
            <?php echo $sort_col; ?>
                buttons: [
                {
                extend: 'excelHtml5',
                        exportOptions: {
                        columns: [ 0, ':visible' ]
                        }
                },
            //{
            //	extend: 'pdfHtml5',
            //	download: 'open',
            //	exportOptions: {
            //		columns: [ 0, ':visible' ]
            //	},
            //	
            <?php echo $pdf_export; ?>
            //},
                {
                extend: 'copyHtml5',
                        text: 'Copier',
                        //exportOptions: {
                        //	columns: [ 0, ':visible' ]
                        //}
                },
                {
                extend: 'colvis',
                        text: 'Colonnes',
                },
            <?php echo $format; ?>
                ],
                        language: {

                        buttons: {
                            
                        copyTitle: 'Ajout au presse-papiers',
                                copyKeys: 'Appuyez sur <i>ctrl</i> ou <i>\u2318</i> + <i>C</i> pour copier les donn??es du tableau ?? votre presse-papiers. <br><br>Pour annuler, cliquez sur ce message ou appuyez sur Echap.',
                                copySuccess: {
                                _: '%d lignes copi??es',
                                        1: '1 ligne copi??e'
                                }
                        }
                        }
                });
                });</script>


            <script>
                $.extend($.fn.dataTable.defaults, {
                fnInitComplete: function(oSettings, json) {

                // Add "Clear Filter" button to Filter
                var btnClear = $('<i class="far fa-times-circle btnClearDataTableFilter" style="color:LightGray;margin-left:5px"></i>');
                btnClear.appendTo($('#' + oSettings.sTableId).parents('.dataTables_wrapper').find('.dataTables_filter'));
                $('#' + oSettings.sTableId + '_wrapper .btnClearDataTableFilter').click(function () {
                $('#' + oSettings.sTableId).dataTable().fnFilter('');
                });
                }
                });
                //affichage champs de recherche dans les colonnes
                $(document).ready(function() {
                // Setup - add a text input to each header cell
                    $('.datatable thead th').each(function () {
                        var title = $(this).text();
                        if ($(this).text() != "Actions")//sauf age et Actions
                        {
                            $(this).append('<br><input type=\'search\' style=\'font-size:10px;font-weight:100;width:100%\' class=\''+ title +'\' />'); 
                        } else{
                            $(this).append('<br><br>');
                        }
                        
                        
                        
                        
                });
                //Changement couleur recherche si texte dans colonnes au chargement
                 //a finir
                $('.datatable thead th input').each(function () {
                    $(this).css('border-color', 'rgb(210, 214, 222)');   
                    $(this).css('border-style', 'solid');
                    $(this).css('border-width', '1px'); 
                    $(this).css('color', 'orange'); 
                    $(this).css('font-weight', 'bold'); 
                  });   
                /*
                //Changement couleur recherches colonnes
                */
                
                // DataTable
                var table = $('.datatable').DataTable();
                // Restore state
                var state = table.state.loaded();
                //console.log("state="+state);
                if (state) {
                    table.columns().eq(0).each(function (colIdx) {
                    var colSearch = state.columns[colIdx].search;
                    if (colSearch.search) {
                        var str = colSearch.search;
                        $('input', table.column(colIdx).header()).val(str.replace(/\|/g, "+"));
                        //$( 'input', table.column( colIdx ).header() ).css( 'border-color', 'orange' );
                        //$( 'input', table.column( colIdx ).header() ).css( 'color', 'orange' );
                    }
                });
                table.draw();
                }
                

                // Apply the search
                table.columns().every(function () {
                
                    var that = this;
                    
                    $('input', this.header()).on('keyup change', function () {  
                        if (that.search() !== this.value)  {
                        that
                                //.search( "^"+this.value.replace(/(;|,|\+)\s?/g, "$|^")+"$",true, false ).draw();
                                //.search( this.value )
                                
                                .search (this.value.replace(/\+/g, "|"), true, false)
                                //.search(this.value, false, true, true)
                                .draw();
                        }
                    });
                    
                    
   
                });

                //Filtre le tableau 
                $("#bouton_cherche").click(function () {
                    var vide = "^$";
                    var col = $('#bouton_cherche').val();
                    //$('#bouton_cherche').val();
                    //document.getElementsByClassName( col )[0].value = vide;
                    table
                        .columns( col )
                        .search( vide )
                        .draw();
                    
                })
                //ex de bouton dans le fichier  : <button class="btn btn-default" id="bouton_cherche" value="11">Pr??sents</button>

                });
            </script>
            <script type='text/javascript'>
                //colorisation de la zone de recherche
                $(document).ready(function () {

                if ($('.dataTables_filter input[type=search]').val() == '') { //Si champs recherche vide au chargement - > contour gris

                $('.dataTables_filter input[type=search]').css('border-color', 'rgb(210, 214, 222)');
                }
                else{
                $('.dataTables_filter input[type=search]').css('border-color', 'orange'); //Si champs recherche non vide au chargement - > contour orange
                $('.dataTables_filter input[type=search]').css('color', 'orange');
                }
                $('.dataTables_filter input[type=search]').on('focus blur keyup', function () { //Sur modif champs recherche non vide au chargement - > contour gris
                if ($('.dataTables_filter input[type=search]').val() == '') {

                $('.dataTables_filter input[type=search]').css('border-color', 'rgb(210, 214, 222)');
                }
                else{
                $('.dataTables_filter input[type=search]').css('border-color', 'orange'); //Sur modif champs recherche non vide au chargement - > contour orange
                $('.dataTables_filter input[type=search]').css('color', 'orange');
                }



                }
                )

                });</script>

            <?php
        } else if ($script == 'datatables_ajax') {
            ?>
            $(document).ready(function() {

            moment.locale('fr');
            $.fn.dataTable.moment( 'DD/MM/YYYY' );
            $.fn.dataTable.moment('DD/MM/YYYY HH:mm');
            $('.datatable').DataTable( {
            "processing": true,
            "serverSide": true,
            "scrollX": true,
            "ajax":{
            "url": "<?php echo $ajax_source; ?>",
            "dataType": "json",
            "type": "POST"
            },
            "autoWidth": true,
            "iDisplayLength": <?php echo $nb_show; ?>,
            "stateSave": true,
            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "Tous"]],
            "deferRender": true,

            <?php
            if (isset($custom_datatables)) {
                echo $custom_datatables;
            }
            ?>

            dom: 'Blfrtip',
            <?php echo $sort_col; ?>
            buttons: [
            {
            extend: 'excelHtml5',
            exportOptions: {
            columns: ':visible'
            }
            },
            //{
            //	extend: 'pdfHtml5',
            //	download: 'open',
            //	exportOptions: {
            //		columns: ':visible'
            //	},
            //	<?php echo $pdf_export; ?>
            //},
            {
            extend: 'copyHtml5',
            text: 'Copier',
            exportOptions: {
            columns: ':visible'
            }
            },
            {
            extend: 'colvis',
            text: 'Colonnes',
            },
            <?php echo $format; ?>
            ],
            language: {
            buttons: {
            copyTitle: 'Ajout au presse-papiers',
            copyKeys: 'Appuyez sur <i>ctrl</i> ou <i>\u2318</i> + <i>C</i> pour copier les donn??es du tableau ?? votre presse-papiers. <br><br>Pour annuler, cliquez sur ce message ou appuyez sur Echap.',
            copySuccess: {
            _: '%d lignes copi??es',
            1: '1 ligne copi??e'
            }
            }
            }
            } );
            } );
            </script>
            <script>
                $.extend($.fn.dataTable.defaults, {
                fnInitComplete: function(oSettings, json) {

                // Add "Clear Filter" button to Filter
                var btnClear = $('<i class="far fa-times-circle btnClearDataTableFilter" style="color:LightGray;margin-left:5px"></i>');
                btnClear.appendTo($('#' + oSettings.sTableId).parents('.dataTables_wrapper').find('.dataTables_filter'));
                $('#' + oSettings.sTableId + '_wrapper .btnClearDataTableFilter').click(function () {
                $('#' + oSettings.sTableId).dataTable().fnFilter('');
                });
                }
                });


            </script>

            <?php
        }
    }

    //----------------------------------------------------------------------------------------//
    //---------------------------------------DATERANGEPICKER----------------------------------//
    //----------------------------------------------------------------------------------------//
    else if ($script == 'daterangepicker') {
        echo "<script src='" . base_url('/assets/plugins/datepicker/js/moment.js') . "'></script>";
        echo "<script>
		moment.locale('fr');";
        if (isset($periode) && $periode == 'civile') {
            $tab_tri= trimestre();
            echo "var pickerRanges = { 
				   'Aujourd\'hui': [moment(), moment()],
				   'Hier': [moment().subtract('days', 1), moment().subtract('days', 1)],
				   'Mois en cours': [moment().startOf('month'), moment().endOf('month')],
				   'Mois pr??cedent':  [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
				   'Dernier trimestre':  ['" . date("d/m/Y", mktime(0, 0, 0, $tab_tri['date_mois1_tri'], 1, $tab_tri['annee'])) . "', '" . date("d/m/Y", mktime(0, 0, 0, $tab_tri['date_mois3_tri'], date("t", $tab_tri['date_mois3_tri_date']), $tab_tri['annee'])) . "'],
				   'Ann??e en cours':  [moment().startOf('year'), moment().endOf('year')],
				   'Ann??e derni??re':  [moment().subtract(1, 'year').startOf('year'), moment().subtract(1, 'year').endOf('year')]
				};";
        } else if (isset($periode) && $periode == 'scolaire') {
            if (mktime(0, 0, 0, date('n'), date('j'), date('Y')) < mktime(0, 0, 0, 8, 1, date('Y'))) {
                echo "var pickerRanges = {
					   'Ann??e derni??re': ['" . date("d/m/Y", mktime(0, 0, 0, 9, 1, date("Y") - 2)) . "', '" . date("d/m/Y", mktime(0, 0, 0, 6, 30, date("Y") - 1)) . "'],
					   'Cette Ann??e': ['" . date("d/m/Y", mktime(0, 0, 0, 9, 1, date("Y") - 1)) . "', '" . date("d/m/Y", mktime(0, 0, 0, 6, 30, date("Y"))) . "'],
					   'Ann??e prochaine':  ['" . date("d/m/Y", mktime(0, 0, 0, 9, 1, date("Y"))) . "', '" . date("d/m/Y", mktime(0, 0, 0, 6, 30, date("Y") + 1)) . "']
					};";
            } else {
                echo "var pickerRanges = {
					   'Ann??e derni??re': ['" . date("d/m/Y", mktime(0, 0, 0, 9, 1, date("Y") - 1)) . "', '" . date("d/m/Y", mktime(0, 0, 0, 6, 30, date("Y"))) . "'],
					   'Cette Ann??e': ['" . date("d/m/Y", mktime(0, 0, 0, 9, 1, date("Y"))) . "', '" . date("d/m/Y", mktime(0, 0, 0, 6, 30, date("Y") + 1)) . "'],
					   'Ann??e prochaine':  ['" . date("d/m/Y", mktime(0, 0, 0, 9, 1, date("Y") + 1)) . "', '" . date("d/m/Y", mktime(0, 0, 0, 6, 30, date("Y") + 2)) . "']
					};";
            }
        } else if (isset($periode) && $periode == 'base') {
            echo "var pickerRanges = {
				   'Aujourd\'hui': [moment(), moment()],
				   'Hier': [moment().subtract('days', 1), moment().subtract('days', 1)],
				   'Semaine pr??cedente':  [moment().subtract(1, 'week').startOf('week'), moment().subtract(1, 'week').endOf('week')],
				   'Semaine en cours': [moment().startOf('week'), moment().endOf('week')],
				   'Semaine suivante': [moment().add(1, 'week').startOf('week'), moment().add(1, 'week').endOf('week')]
				};";
        } else {
            echo "var pickerRanges = null";
        }
        echo "
		var pickerLocale = {
					applyLabel: 'OK',
					cancelLabel: 'Annuler',
					fromLabel: 'Entre',
					toLabel: 'et',
					autoUpdateInput: false,
					customRangeLabel: 'P&eacuteriode personnalis&eacutee',
					daysOfWeek: moment().locale('fr')._weekdaysMin,
					monthNames: moment().locale('fr')._months,
					firstDay: 1
				};
        $(document).ready(function() {
			$('.daterange').daterangepicker(
				{
					  'alwaysShowCalendars': true,
                                          'showWeekNumbers': true,
					  format: 'DD/MM/YYYY',
					  ranges: pickerRanges,
					  separator: ' - ',
					  'opens': 'left',
					  'autoApply': true,
					  locale: pickerLocale,
					  autoUpdateInput: false
				});
			   $('.daterange').on('apply.daterangepicker', function(ev, picker) {
				  $(this).val(picker.startDate.format('DD/MM/YYYY') + ' - ' + picker.endDate.format('DD/MM/YYYY'));
			  });
		});</script>";
        echo "<script src='" . base_url('/assets/plugins/datepicker/js/daterangepicker.js') . "'></script>";
    }

    //----------------------------------------------------------------------------------------//
    //---------------------------------------DATEPICKER---------------------------------------//
    //----------------------------------------------------------------------------------------//
    else if ($script == 'datepicker') {
        echo "<script src='" . base_url('/assets/plugins/input-mask/jquery.inputmask.js') . "'></script>";
        echo "<script src='" . base_url('/assets/plugins/input-mask/jquery.inputmask.extensions.js') . "'></script>";
        echo "<script src='" . base_url('/assets/plugins/input-mask/jquery.inputmask.date.extensions.js') . "'></script>";
        echo "<script src='" . base_url('/assets/plugins/datepicker/js/moment.js') . "'></script>";
        echo "<script src='" . base_url('/assets/plugins/datepicker/js/moment.js') . "'></script>";
        echo "<script>
			moment.locale('fr');
			var pickerLocale = {
					applyLabel: 'OK',
					cancelLabel: 'Annuler',
					fromLabel: 'Entre',
					toLabel: 'et',
					autoUpdateInput: false,
					customRangeLabel: 'P&eacuteriode personnalis&eacutee',
					daysOfWeek: moment().locale('fr')._weekdaysMin,
					monthNames: moment().locale('fr')._months,
					firstDay: 1
				};
			$(document).ready(function() {
				$(':input').inputmask();
				$('.datepicker').daterangepicker(
				   {
					  singleDatePicker: true,
					  showDropdowns: true,
					  format: 'DD/MM/YYYY',
					  autoUpdateInput: false,
					  locale: pickerLocale
				   }
			   );
			   $('.datepicker').on('apply.daterangepicker', function(ev, picker) {
				  $(this).val(picker.startDate.format('DD/MM/YYYY'));
			   });
			});
            </script>";
        echo "<script src='" . base_url('/assets/plugins/datepicker/js/daterangepicker.js') . "'></script>";
    }

    //----------------------------------------------------------------------------------------//
    //---------------------------------------TIMEPICKER---------------------------------------//
    //----------------------------------------------------------------------------------------//
    else if ($script == 'timepicker') {
        echo "<script src='" . base_url('/assets/plugins/datepicker/js/moment.js') . "'></script>
           <script>
           moment.locale('fr');
var pickerLocale = {
applyLabel: 'OK',
cancelLabel: 'Annuler',
fromLabel: 'Entre',
toLabel: 'et',
autoUpdateInput: false,
customRangeLabel: 'P&eacuteriode personnalis&eacutee',
daysOfWeek: moment().locale('fr')._weekdaysMin,
monthNames: moment().locale('fr')._months,
firstDay: 1
};
               //On teste l'existance de cette variable si on veut remplir le champ de l'heure quand on clique sur l'input
               if (typeof date_time_value !== 'undefined' )
               {               
                   $(document).ready(function() {
                       $('.datepicker').daterangepicker(
                       {
                           useCurrent: false,
                           singleDatePicker: true,
                           timePicker: true,
                           timePicker24Hour: true,
                           startDate: moment(date_time_value,'DD-MM-YYYY H:mm'),
                           showDropdowns: true,
                           format: 'DD/MM/YYYY H:mm',
                           autoUpdateInput: false,
           locale: pickerLocale,
                       });
                       $('.datepicker').on('apply.daterangepicker', function(ev, picker) {
                           $(this).val(picker.startDate.format('DD/MM/YYYY H:mm'));
       });
                   });
               }
               else
               {                  
                   $(document).ready(function() {
                       $('.datepicker').daterangepicker(
                       {
                           useCurrent: false,
                           singleDatePicker: true,
                           timePicker: true,
                           timePicker24Hour: true,
                           showDropdowns: true,
                           format: 'DD/MM/YYYY H:mm',
                           autoUpdateInput: false,
           locale: pickerLocale,
                       });
                   $('.datepicker').on('apply.daterangepicker', function(ev, picker) {
                          $(this).val(picker.startDate.format('DD/MM/YYYY H:mm'));
   });
                  });
               }
           </script>";
        echo "<script src='" . base_url('/assets/plugins/datepicker/js/daterangepicker.js') . "'></script>";
    }

    //----------------------------------------------------------------------------------------//
    //------------------------------------SWEETALERT------------------------------------------//
    //----------------------------------------------------------------------------------------//
    else if ($script == 'sweetalert') {
        echo "<script src='" . base_url('/assets/plugins/sweetalert/sweetalert.min.js') . "'></script>";
        echo "<script>
			function archiver(href)
			{
				swal({
					title: 'Vous ??tes sur le point d\'archiver cet ??l??ment',
					type: 'warning',
					showCancelButton: true,
  					confirmButtonColor: '#3085d6',
					cancelButtonColor: '#d33',
					cancelButtonText: 'Annuler',
					confirmButtonText: 'Continuer'
				}, function(){ window.location.replace(href); });
			}
			
			function desarchiver(href)
			{
				swal({
					title: 'Vous ??tes sur le point de d??sarchiver cet ??l??ment',
					type: 'warning',
					showCancelButton: true,
  					confirmButtonColor: '#3085d6',
					cancelButtonColor: '#d33',
					cancelButtonText: 'Annuler',
					confirmButtonText: 'Continuer'
				}, function(){ window.location.replace(href); });
			}
			
			function supprimer(href)
			{
				swal({
					title: 'Vous ??tes sur le point de supprimer cet ??l??ment',
					type: 'warning',
					showCancelButton: true,
  					confirmButtonColor: '#3085d6',
					cancelButtonColor: '#d33',
					cancelButtonText: 'Annuler',
					confirmButtonText: 'Continuer'
				}, function(){ window.location.replace(href); });
			}</script>";
    }
    //----------------------------------------------------------------------------------------//
    //---------------------------------------MODAL--------------------------------------------//
    //----------------------------------------------------------------------------------------//
    else if ($script == 'modal') {
        echo "<script>
			$(function() {
				 $(document).on('click','a.big_modal', function (e) {
						e.preventDefault();
						var page = $(this).attr('href');
						var pagetitle = $(this).attr('title');
						var dialog = $('<div></div>')
						.html(\"<iframe style='border: 0px;' src='\" + page + \"' width='98%' height='98%'></iframe>\")
						.dialog({
							autoOpen: false,
							modal: true,
							height: 750,
							width: '500px',
							title: pagetitle,
							close: function(event, ui) { window.location.reload(true); }
						});
						dialog.dialog('open');
					});
					$(document).on('click','a.extrem_modal', function (e) {
						e.preventDefault();
						var page = $(this).attr('href');
						var pagetitle = $(this).attr('title');
						var string = $(this).attr('class');
						var close_var = null;
						if (string.indexOf('reload') !== -1){
							close_var = function(event, ui) { window.location.reload(true); }
						}
						var dialog = $('<div></div>')
						.html(\"<iframe style='border: 0px;' src='\" + page + \"' width='98%' height='98%'></iframe>\")
						.dialog({
							autoOpen: false,
							modal: true,
							height: 800,
							width: '900',
							title: null,
							close: close_var
						});
						dialog.dialog('open');
					});
				});
			</script>
			";
    }

    //----------------------------------------------------------------------------------------//
    //----------------------------------COLORSELECTOR-----------------------------------------//
    //----------------------------------------------------------------------------------------//
    else if ($script == 'colorselector') {
        echo "<script src='" . base_url('/assets/plugins/colorselector/js/bootstrap-colorselector.min.js') . "'></script>
			  <script>$(document).ready(function(){ $('.colorselector').colorselector(); });</script>";
    }

    // ----------------------------------------------------------------------------------------//
    // ----------------------------------MSSAGERIE-----------------------------------------//
    // ----------------------------------------------------------------------------------------//
    else if ($script == 'jsMessagerieFooter') {
        echo "<script src='" . base_url('/assets/plugins/Messagerie/jsMessagerie/fonctions.js') . "'></script>";
    } else if ($script == 'refresh') {
        echo '<script type="text/javascript">
        
        var update = function() {
            $.ajax({
                url : "C_affiche_nb_message",
                context: document.body,
		        success: function(result){
                   $("#nbmessage").html(result);
                },
            });
        };
        update();
        setInterval("update()", 2000);
        </script>';
        // Pour les 5mins il faut mett
    }
    // ----------------------------------------------------------------------------------------//
    // ----------------------------------Sisyphus-----------------------------------------//
    // ----------------------------------------------------------------------------------------//
    else if ($script == 'sisyphus') {
        echo '<script type = "text/javascript" src="' . base_url('/assets/plugins/sisyphus/sisyphus.min.js') . '">';
        echo '  $(window).load(function() {
                    $("form").sisyphus(); 
			    });';
        echo '</script>';
    }
    // ----------------------------------------------------------------------------------------//
    // ----------------------------------Survey-----------------------------------------//
    // ----------------------------------------------------------------------------------------//
    else if ($script == 'survey') {
       
        echo '<script type = "text/javascript" src="' . base_url('/assets/plugins/knockout/knockout-3.4.2.js') . '"></script>';
        echo '<script type = "text/javascript" src="' . base_url('/assets/plugins/survey/survey.jquery.min.js') . '"></script>';
        echo '<script type = "text/javascript" src="' . base_url('/assets/plugins/survey/surveyeditor.min.js') . '"></script>';
        echo '<script type = "text/javascript" src="' . base_url('/assets/plugins/survey/survey.jquery.min.js') . '"></script>';
    }

    // ----------------------------------------------------------------------------------------//
    // ----------------------------------Chart-----------------------------------------//
    // ----------------------------------------------------------------------------------------//
    else if ($script == 'chart') {
       
        echo '<script type = "text/javascript" src="' . base_url('/assets/plugins/chart/chart.min.js') . '"></script>';
        echo '<script type = "text/javascript" src="' . base_url('/assets/plugins/chart/chartjs-plugin-colorschemes.min.js') . '"></script>';
    }

    // ----------------------------------------------------------------------------------------//
    // ----------------------------------Qtip-----------------------------------------//
    // ----------------------------------------------------------------------------------------//
    else if ($script == 'qtip') {
       
        echo '<script type = "text/javascript" src="' . base_url('/assets/plugins/qtip/jquery.qtip.min.js') . '"></script>';
        echo "<script>
            $(function () {
                $('span[title]').qtip();
            });
            </script>
            ";
            
    }

    // ----------------------------------------------------------------------------------------//
    // ----------------------------------Fullcalendar-----------------------------------------//
    // ----------------------------------------------------------------------------------------//
    if ($script == 'fullcalendar') {
       
        echo '<script type = "text/javascript" src="' . base_url('/assets/plugins/fullcalendar/core/main.js') . '"></script>';
        echo '<script type = "text/javascript" src="' . base_url('/assets/plugins/fullcalendar/daygrid/main.js') . '"></script>';
        echo '<script type = "text/javascript" src="' . base_url('/assets/plugins/fullcalendar/timegrid/main.js') . '"></script>';
        echo '<script type = "text/javascript" src="' . base_url('/assets/plugins/fullcalendar/core/locales/fr.js') . '"></script>';
        echo "
        <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');

            var calendar = new FullCalendar.Calendar(calendarEl, {
            plugins: [ 'timeGrid','dayGrid' ],
            header: {
                left: 'prev,next',
                center: 'title',
                right: 'timeGridWeek,dayGridMonth'
              },
            locale: 'fr',
            //height: 650,
            //contentHeight: 600,
            //aspectRatio: 3,
            defaultView: 'dayGridMonth',
            minTime: '08:00',
            maxTime: '18:00',
            weekends: false,
            nowIndicator: true,
            allDaySlot: false,
            events: [";
            if(isset($fullcalendar_events_array)){ echo $fullcalendar_events_array; }
            echo "]

            });

            calendar.render();
        });
        </script>
        
        ";
    }

    // ----------------------------------------------------------------------------------------//
    // ------------------Gestion de la selection du num d'onglet par URL-----------------------//
    // ----------------------------------------------------------------------------------------//
    if ($script == 'tab_pane_hash') {
        echo "<script>
        $(function () {
        var activeTab = $('[href=' + location.hash + ']');
        activeTab && activeTab.tab('show');
        });
        </script>
        ";
    }

    // ----------------------------------------------------------------------------------------//
    // ----------------------------------------JEXCEL------------------------------------------//
    // ----------------------------------------------------------------------------------------//
    if ($script == 'jexcel') {
        echo "<script src='" . base_url('/assets/plugins/jexcel/index.js') . "'> </script>";
        echo "<script src='" . base_url('/assets/plugins/jexcel/jsuites.js') . "'> </script>";
        //echo '<script src="https://bossanova.uk/jspreadsheet/v4/jexcel.js"></script>';
        //echo '<script src="https://jsuites.net/v4/jsuites.js"></script>';
       echo "<script>

        tableau = jexcel(document.getElementById('jexcel_sheet'), {
            data: [".$donnees."],
            columns:[".$columns."],
            ".$custom.",
            text:{
                'noRecordsFound':'Aucune donn??e trouv??e',
                'showingPage':'Afficher la page {0} sur {1}',
                'show':'Afficher ',
                'entries':'lignes',
                'insertANewColumnBefore':'Ins??rer une nouvelle colonne avant',
                'insertANewColumnAfter':'Ins??rer une nouvelle colonne apr??s',
                'deleteSelectedColumns':'Supprimer les colonnes s??lectionn??es',
                'renameThisColumn':'Renommer la colonne',
                'orderAscending':'Trier par ordre croissant',
                'orderDescending':'Trier par ordre d??croissant',
                'insertANewRowBefore':'Ins??rer une nouvelle ligne avant',
                'insertANewRowAfter':'Ins??rer une nouvelle ligne apr??s',
                'deleteSelectedRows':'Supprimer les lignes s??lectionn??es',
                'editComments':'Modifier le commentaire',
                'addComments':'Ajouter un commentaire',
                'comments':'Commentaire',
                'clearComments':'Supprimer le commentaire',
                'copy':'Copier ...',
                'paste':'Coller ...',
                'saveAs':'Enregistrer sous ...',
                'about': 'A propos',
                'search': 'Rechercher',
                'areYouSureToDeleteTheSelectedRows':'Etes vous sur de vouloir supprimer les lignes s??lectionn??es ?',
                'areYouSureToDeleteTheSelectedColumns':'Etes vous sur de vouloir supprimer les colonnes s??lectionn??es ?',
                'thisActionWillDestroyAnyExistingMergedCellsAreYouSure':'Cette action d??truira toutes les cellules fusionn??es existantes. Voulez vous continuer ?',
                'thisActionWillClearYourSearchResultsAreYouSure':'Cette action effacera votre recherche. Voulez-vous continuer ?',
                'thereIsAConflictWithAnotherMergedCell':'Il y a un conflit avec une autre cellule fusionn??e',
                'invalidMergeProperties':'Propri??t??s de fusion invalides',
                'cellAlreadyMerged':'Cellule d??j?? fusionn??e',
                'noCellsSelected':'Aucune cellule s??lectionn??e'
        }
        });
        
       


        </script>";
    }
    
    // ----------------------------------------------------------------------------------------//
    // ------------------------------------EMODAL------------------------------------------//
    // ----------------------------------------------------------------------------------------//
    if ($script == 'emodal') {
    echo "<script src='" . base_url('/assets/plugins/emodal/eModal.min.js') . "'></script>  ";
    }
    
        // ----------------------------------------------------------------------------------------//
    // ------------------------------------JSONEDITOR------------------------------------------//
    // ----------------------------------------------------------------------------------------//
    if ($script == 'jsoneditor') {
    echo "<script src='" . base_url('/assets/plugins/jsoneditor/jsoneditor.min.js') . "'></script>  ";
    }
    
    // ----------------------------------------------------------------------------------------//
    // ------------------------------------DMPCONNECT------------------------------------------//
    // ----------------------------------------------------------------------------------------//
    if ($script == 'dmpconnect') {
        /*echo "<script src='" . base_url('/assets/plugins/dmpconnect/wrapperjs/dmpconnect.js') . "'> </script>";
        echo "<script src='" . base_url('/assets/plugins/dmpconnect/wrapperjs/dmpconnect_dmp.js') . "'> </script>";
        echo "<script src='" . base_url('/assets/plugins/dmpconnect/wrapperjs/dmpconnect_insi.js') . "'> </script>";
        echo "<script src='" . base_url('/assets/plugins/dmpconnect/exemples.js') . "'> </script>";
        echo "<script src='" . base_url('/assets/plugins/dmpconnect/exemples_dmp.js') . "'> </script>";
        echo "<script src='" . base_url('/assets/plugins/dmpconnect/exemples_insi.js') . "'> </script>";*/
    }
}

// Custom script
if (isset($custom_script)) {
    echo $custom_script;
}

// Chargement des scripts pour le crud
if (isset($output)) {
    foreach ($output->js_files as $file) {
        echo "<script src='" . $file . "'></script>";
    }
}