(function() {
	var app = angular.module('trainingScheduler', ['angular-growl', 'ngAnimate', 'ngDialog', 'ngRoute', 'angularMoment', 'mm.foundation', '720kb.datepicker', 'pickadate'])
		.factory('$data', ['$http', function($http) {
			return {
				read: {
					grabEmployeeRequests: function() {
						return $http.get('/wp-content/themes/twentyeleven-child/leaveManagement/server.php?handler=Grab Employee Requests').
							then(function(resp) {
								return resp.data;
							});
					}
				},
				write: {
					updateRequest: function(request) {
						return $http.post('/wp-content/themes/twentyeleven-child/leaveManagement/server.php?handler=Update Request', request).
							then(function(resp) {
								return resp;
							});
					},
					submitRequest: function(request) {
						return $http.post('/wp-content/themes/twentyeleven-child/trainingScheduler/server.php?handler=Submit Request', request).
							then(function(resp) {
								return resp;
							});
					}
				}
			}
		}])
		.config(['growlProvider', '$httpProvider', '$routeProvider', '$locationProvider', function(growlProvider, $httpProvider, $routeProvider, $locationProvider) {
			growlProvider.globalDisableCloseButton(true);
			growlProvider.globalDisableIcons(true);
			growlProvider.globalPosition('bottom-right');
			growlProvider.globalDisableCountDown(true);
			growlProvider.globalTimeToLive(2500);
			
			$httpProvider.interceptors.push(growlProvider.serverMessagesInterceptor);
			
			$locationProvider.html5Mode({
				enabled: true
			});
			
			// $routeProvider.
				// when('/profile', {
					// templateUrl: '/wp-content/themes/twentyeleven-child/leaveManagement/views/profile.html',
					// controller: 'ProfileController as ProfileCtrl'
				// }).
				// when('/manager', {
					// templateUrl: '/wp-content/themes/twentyeleven-child/leaveManagement/views/manager-view.html',
					// controller: 'ManagerController as ManagerCtrl'
				// }).
				// otherwise({
					// redirectTo: '/profile'
				// });
		}]);
})();
