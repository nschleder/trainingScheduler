angular.module('trainingScheduler').controller('PageController', ['$http', '$scope', 'ngDialog', '$modal', '$data', function ($http, $scope, ngDialog, $modal, $data) {
	$scope.request = {};
	$scope.request.date = moment().format('YYYY-MM-DD');
	$scope.request.training = 'FCE';
	$scope.request.location = '3rd Floor Conference Room';
	
	$data.read.grabRequests().then(function(resp) {
		$scope.requests = resp.results;
	});
	
	$scope.request = {};
	$scope.attendance = {};

	$scope.submitRequest = function(request) {
		$data.write.submitRequest(request).then(function(result) {
			$data.read.grabAttendance(request.date).then(function(result) {
				$scope.attendance = result.results;
				console.log($scope.attendance);
			});
		});
	};
	
	$scope.$watch('request.date', function () {
		$data.read.grabAttendance($scope.request.date).then(function(result) {
			$scope.attendance = result.results;
			console.log($scope.attendance);
		});
	});

	$scope.deleteRequest = function(id, key) {
		$data.write.deleteRequest(id).then(function(result) {
			if (result.data.result === 1) {
				delete $scope.attendance[key][id];
			}
		});
	};
	
	$scope.locCount= function(ob) {
		return Object.keys(ob).length;
	};

}]);