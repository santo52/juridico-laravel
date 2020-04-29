var opcionesTblInforme = {
	"pagingType": "full_numbers",
	"language": {
		"lengthMenu": "<div class='input-group'>" +
			"<span class='input-group-addon'>" +
			"<span class='glyphicon glyphicon-eye-open'></span>" +
			"</span> " +
			"<select>" +
			"<option value='10' selected='selected'>10</option>" +
			"<option value='25'>25</option>" +
			"<option value='50'>50</option>" +
			"<option value='100'>100</option>" +
			"<option value='400'>400</option>" +
			"<option value='-1'>Todo</option>" +
			"</select>" +
			"</div>",
		"zeroRecords": "No se encontraron registros.",
		"info": "Mostrando del _START_ al _END_ (<b>_TOTAL_ en total</b>)",
		"infoEmpty": "",
		"infoFiltered": ". Filtrado de un total de _MAX_ registros",
		"sSearch": "",
		"oPaginate": {
			"sFirst": "Primera",
			"sLast": "Última",
			"sNext": "Siguiente",
			"sPrevious": "Anterior"
		},
		"decimal": ",",
		"thousands": ".",
		"deferRender": true
	},
	"bJQueryUI": true
};

var opcionesTblInformeAgrupado = {
	"pagingType": "full_numbers",
	"language": {
		"lengthMenu": "<div class='input-group'>" +
			"<span class='input-group-addon'>" +
			"<span class='glyphicon glyphicon-eye-open'></span>" +
			"</span> " +
			"<select>" +
			"<option value='10' selected='selected'>10</option>" +
			"<option value='25'>25</option>" +
			"<option value='50'>50</option>" +
			"<option value='100'>100</option>" +
			"<option value='400'>400</option>" +
			"<option value='-1'>Todo</option>" +
			"</select>" +
			"</div>",
		"zeroRecords": "No se encontraron registros.",
		"info": "Mostrando del _START_ al _END_ (<b>_TOTAL_ en total</b>)",
		"infoEmpty": "",
		"infoFiltered": ". Filtrado de un total de _MAX_ registros",
		"sSearch": "",
		"oPaginate": {
			"sFirst": "Primera",
			"sLast": "Última",
			"sNext": "Siguiente",
			"sPrevious": "Anterior"
		},
		"decimal": ",",
		"thousands": ".",
		"deferRender": true
	},
	"bJQueryUI": true,
	"fnDrawCallback": function (oSettings) {
		if (oSettings.aiDisplay.length == 0) {
			return;
		}
		var nTrs = jQuery('tbody tr', oSettings.nTable);
		var iColspan = nTrs[0].getElementsByTagName('td').length;
		var sLastGroup = "";
		for (var i = 0; i < nTrs.length; i++) {
			var iDisplayIndex = oSettings._iDisplayStart + i;
			var sGroup = oSettings.aoData[oSettings.aiDisplay[iDisplayIndex]]._aData[0];
			if (sGroup != sLastGroup) {
				var nGroup = document.createElement('tr');
				var nCell = document.createElement('td');
				nCell.colSpan = iColspan;
				nCell.className = "group";
				nCell.innerHTML = sGroup;
				nGroup.appendChild(nCell);
				nTrs[i].parentNode.insertBefore(nGroup, nTrs[i]);
				sLastGroup = sGroup;
			}
		}
	},
	"aoColumnDefs": [{
		"bVisible": false,
		"aTargets": [0]
	}],
	"aaSortingFixed": [[0, 'asc']],
	"aaSorting": []
};

var opcionesTblInformeNoPaginada = {
	"paging": false,
	"searching": false,
	"language": {
		"zeroRecords": "No se encontraron registros.",
		"info": "",
		"infoEmpty": "",
		"decimal": ",",
		"thousands": ".",
		"deferRender": true
	},
	"bJQueryUI": true
};

var tblInforme = jQuery('.tblInforme').dataTable(opcionesTblInforme);
var tblInformeAgrupado = jQuery('.tblInformeAgrupado').dataTable(opcionesTblInformeAgrupado);
var tblInformeNoPaginada = jQuery('.tblInformeNoPaginada').dataTable(opcionesTblInformeNoPaginada);

estiloDatatables();

function insertarDataScopeElemento(elemento, data, jsonOpcionesDatatables) {
	/* AngularJs: compila el $scope al que pertenece la tabla antes de mostrar los datos */
	var injector = $('[ng-app=appData]').injector();
	var $compile = injector.get('$compile');
	var linkFn = $compile(data);
	var $scope = angular.element('[ng-controller=bodyController]').scope();
	/* Obtiene la nueva data desde el $scope del elemento */
	var data = linkFn($scope);

	/* Añadir la data en el elemento del DOM */
	elemento.html(data);
	/* Aplicar los cambios al $scope al que pertenece el elemento del DOM dado */
	$scope.$apply();

	/* Datatables: ejecutar el plugin para la tabla */
	datatableScope = jQuery('.table').dataTable(jsonOpcionesDatatables);
	estiloDatatables();
}

function estiloDatatables() {
	jQuery('div.dataTables_filter input, div.dataTables_length select').addClass('form-control');
	jQuery('div.dataTables_filter input').attr('placeholder', 'Buscar...');
	jQuery('div.DTTT_container a').addClass('btn btn-info btn-sm btn-ejecutar');
	jQuery('div.DTTT_container a').removeClass('DTTT_button ui-button ui-state-default DTTT_button_collection');
}

function checkTodoDataTable(objDatatable) {
	if (jQuery('input', objDatatable.fnGetNodes()).prop('checked') == true)
		jQuery('input', objDatatable.fnGetNodes()).prop('checked', false);
	else
		jQuery('input', objDatatable.fnGetNodes()).prop('checked', true);
}

function marcarCheckboxPagina(objDatatable) {
	if (jQuery("input[type='checkbox']").prop('checked') == true)
		jQuery("input[type='checkbox']").prop('checked', false);
	else
		jQuery("input[type='checkbox']").prop('checked', true);
}
