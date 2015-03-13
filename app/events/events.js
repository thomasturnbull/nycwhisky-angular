'use strict';

angular.module('myApp.events', ['ngRoute'])

.config(['$routeProvider', function($routeProvider) {
  $routeProvider.when('/events', {
    templateUrl: 'events/events.html',
    controller: 'EventsCtrl'
  });
}])

.controller('EventsCtrl', ['$scope', '$http', 
	function($scope, $http) {
    // TODO(Thomas): Update events.json to point to the live json output.
	$http.get('events.json').success(function(data) {
      $scope.events = data;
      // TODO(Thomas): Remove logging.  
      console.log(data);
    });
}]);

