angular.module('trainingScheduler').controller('PageController', ['$http', '$scope', 'ngDialog', '$modal', '$data', function ($http, $scope, ngDialog, $modal, $data) {
	$scope.request = {};
<<<<<<< HEAD
	$data.read.grabRequests().then(function(resp) {
		$scope.requests = resp.results;
	});
=======
>>>>>>> origin/master
}]);