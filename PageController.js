angular.module('trainingScheduler').controller('PageController', ['$http', '$scope', 'ngDialog', '$modal', '$data', function ($http, $scope, ngDialog, $modal, $data) {
	$scope.request = {};
<<<<<<< HEAD
	$data.read.grabRequests().then(function(resp) {
		$scope.requests = resp.results;
	});
=======
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
	$scope.complete=function(){
      console.log($scope.emp);
    $( "#emp;" ).autocomplete({
      source: $scope.emp
    });
    } 

	
	$scope.submitRequest = function(request) {
		$data.write.submitRequest(request).then(function(result) {
		});
	};
>>>>>>> origin/master
}]);