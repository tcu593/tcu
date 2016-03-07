<div>
<table id="infoPersonal" class="display nowrap" cellspacing="0" width="100%">
</table>
</div>
<script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
<script src="https://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/t/dt/pdfmake-0.1.18,dt-1.10.11,b-1.1.2,b-flash-1.1.2,b-html5-1.1.2,b-print-1.1.2,cr-1.3.1,r-2.0.2,rr-1.1.1,sc-1.4.1,se-1.1.2/datatables.min.css"/>
 
<script type="text/javascript" src="https://cdn.datatables.net/t/dt/pdfmake-0.1.18,dt-1.10.11,b-1.1.2,b-flash-1.1.2,b-html5-1.1.2,b-print-1.1.2,cr-1.3.1,r-2.0.2,rr-1.1.1,sc-1.4.1,se-1.1.2/datatables.min.js"></script>


	<script type="text/javascript">
		var t = $(document).ready(function() {
            $('#infoPersonal').dataTable( {
				"dom": 'Bfrtip',
				"buttons": [
					'copy', 'csv', 'excel', 'pdf', 'print'
				],
                "bServerSide":false,
                "bProcessing":true,				
				"scrollX": true,
                "sAjaxDataProp": "feed.entry",
                "sAjaxSource": "https://spreadsheets.google.com/feeds/list/1TMTWGNX-04tBIJ7cogGMuNug_0tXrxAyQBMukb8ga48/1/public/values?alt=json",
				"fnCreatedRow": function (row, data, index) {
					$('td', row).eq(0).html(index + 1);
				},
				"aoColumns": [
					{ "sTitle": "Index", "mDataProp": "gsx$timestamp.$t"},
                    { "sTitle": "Nombre", "mDataProp": "gsx$nombre.$t" },					
					{ "sTitle": "Primer Apellido", "mDataProp": "gsx$primerapellido.$t" },					
					{ "sTitle": "Segundo Apellido", "mDataProp": "gsx$segundoapellido.$t" },
                    { "sTitle": "Fecha de Nacimiento", "mDataProp": "gsx$fechadenacimiento.$t" },					
					{ "sTitle": "Sexo", "mDataProp": "gsx$sexo.$t" },					
					{ "sTitle": "Provincia", "mDataProp": "gsx$provincia.$t" },					
					{ "sTitle": "Cantón", "mDataProp": "gsx$cantón.$t" },					
					{ "sTitle": "Distrito", "mDataProp": "gsx$distrito.$t" },					
					{ "sTitle": "Otras señas", "mDataProp": "gsx$otrasseñas.$t" },					
					{ "sTitle": "Tel casa", "mDataProp": "gsx$télefonocasa.$t" },					
					{ "sTitle": "Tel trabajo", "mDataProp": "gsx$télefonotrabajo.$t" },					
					{ "sTitle": "Tel móvil", "mDataProp": "gsx$télefonomóvil.$t" },					
					{ "sTitle": "Correo", "mDataProp": "gsx$direcciónelectrónica.$t" },
					{ "sTitle": "Lugar de trabajo", "mDataProp": "gsx$lugardetrabajo.$t" },
					{ "sTitle": "Actividades que desarrolla", "mDataProp": "gsx$especifiqueeltipodeactividadesquedesarrolla.$t" },
				],
				
				"language": {					
					"lengthMenu": "Mostrando _MENU_ registros por página",					
					"info": "Mostrando página _PAGE_ de _PAGES_",					
					"infoEmpty": "No hay registros disponibles",					
					"loadingRecords": "Cargando...",					
					"processing":     "Procesando...",					
					"search":         "Buscar:",					
					"zeroRecords":    "No se encontraron resultados",					
					"paginate": {						
						"first":      "Primero",						
						"last":       "Último",						
						"next":       "Siguiente",						
						"previous":   "Anterior"					
					},					
					"infoFiltered": "(filtrado de un total de _MAX_ registros)",					
					"aria": {						
						"sortAscending":  ": Activar para ordenar la columna de manera ascendente",						
						"sortDescending": ": Activar para ordenar la columna de manera descendente"					
					}				
				}
				
            } );
			t.on( 'order.dt search.dt', function () {
				t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
					cell.innerHTML = i+1;
				} );
			} ).draw();
        } );
	</script>