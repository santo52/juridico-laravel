if (jQuery('#menu').exists()) {
	appData.controller('NavController', function ($scope, $http) {
		showLoading();
		$http({
			method: 'POST',
			url: jQuery('#BASE_URL').val() + 'tmp/menu_' + jQuery('#session_id').val() + '.json',
			responseType: 'json'
		}).success(function (data, status, headers, config) {
			$scope.modulos = data;
			hideLoading();
		});
	});

} else {
	appData.controller('NavController', function ($scope, $http) { });
}

if (jQuery('#menu').exists()) {
	appData.controller('bodyController', function ($scope, $http) {
		showLoading();
		$http({
			method: 'POST',
			url: jQuery('#BASE_URL').val() + 'tmp/accion_' + jQuery('#session_id').val() + '.json',
			responseType: 'json'
		}).success(function (data, status, headers, config) {
			$scope.accion = data;
			hideLoading();
		});
	});

} else {
	appData.controller('bodyController', function ($scope, $http) { });
}
