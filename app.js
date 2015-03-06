(function() {
	var app = angular.module('trainingScheduler', ['angular-growl', 'ngAnimate', 'ngDialog', 'angularMoment', 'mm.foundation', '720kb.datepicker', 'pickadate'])
		.factory('$data', ['$http', 'pickadateUtils', function($http, pickadateUtils) {
			return {
				check: {
					ifFull: function(arg) {
						return $http.post('/wp-content/themes/twentyeleven-child/trainingScheduler/server.php?handler=Check if Full', arg).
							then(function(resp) {
								return resp.data;
							});
					}
				},
				read: {
<<<<<<< HEAD
					grabRequestsForDate: function(arg) {
						return $http.get('/wp-content/themes/twentyeleven-child/trainingScheduler/server.php?handler=Grab Requests for Date', arg).
							then(function(resp) {
								return resp.data;
							});
					},
					grabRequests: function() {
						return $http.get('/wp-content/themes/twentyeleven-child/trainingScheduler/server.php?handler=Grab Requests').
							then(function(resp) {
								return resp.data;
							});
					},
					countForDate: function(date) {
						return $http.get('/wp-content/themes/twentyeleven-child/trainingScheduler/server.php?handler=Count For Date', date).
=======
>>>>>>> origin/master
							then(function(resp) {
								return resp.data;
							});
					}
				},
				write: {
					updateRequest: function(request) {
						return $http.post('/wp-content/themes/twentyeleven-child/trainingScheduler/server.php?handler=Update Request', request).
							then(function(resp) {
								return resp;
							});
					},
					test: function(test) {
						return test;
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
		.config(['growlProvider', '$httpProvider', '$locationProvider', function(growlProvider, $httpProvider, $locationProvider) {
			growlProvider.globalDisableCloseButton(true);
			growlProvider.globalDisableIcons(true);
			growlProvider.globalPosition('bottom-right');
			growlProvider.globalDisableCountDown(true);
			growlProvider.globalTimeToLive(2500);
			
			$httpProvider.interceptors.push(growlProvider.serverMessagesInterceptor);
			
			$locationProvider.html5Mode({
				enabled: true
			});
		}]);
})();
