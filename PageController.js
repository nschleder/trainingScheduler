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
	$scope.emp = [
		"John Smith",
		"Micky Mouse",
		"Luke Skywalker",
		"John Shapered",
		"Gordon Freemen",
		"Lele Freewalker",
		"Jessie SeeFar",
		"Tarzan Jungal`Lard",
		"Jerry Schossow",
		"Nick Schleder",
		"Ahn Tran",
		"Gino Appelbaum",
		"Queen Lafountain",
		"Eleni Witcher",
		"Nola Macarthur",
		"Jaessa Zahm",
		"Elwood Spaulding",
		"Dedra Kicklighter",
		"Jere Gerdts",
		"Matt Kaye",
		"Thomes Elbert",
		"Janeth Almanzar",
		"Keren Liu",
		"Emily Armor",
		"Merissa Asaro",
		"Zada Barter",
		"Margot Minton"
	];

	$scope.submitRequest = function(request) {
		$data.write.submitRequest(request).then(function(result) {
		});
	};
	
	$scope.$watch('request.date', function () {
		$data.read.grabAttendance($scope.request.date).then(function(result) {
			$scope.attendance = result.results;
			console.log($scope.attendance);
		});
	});
}]);