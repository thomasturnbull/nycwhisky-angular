'use strict';

angular.module('myApp.events', ['ngRoute', 'ngSanitize'])

.config(['$routeProvider', function($routeProvider) {
  $routeProvider.when('/events', {
    templateUrl: 'events/events.html',
    controller: 'EventsCtrl'
  });
}])

.controller('EventsCtrl', ['$scope', '$http', 
	function($scope, $http) {
  	$http.get('/events.json').success(function(data) {
        $scope.events = data;
      });

    $scope.toggle = function (open) {
      angular.forEach($scope.events.events, function (event) {
        event.open = false;
      });
      this.event.open = open;
    }

    // The old site asked people to enter event titles in the format
    // event @ venue
    // This strips out the @ venue.
    $scope.title = {
      get : function(original) {
        if (!original) {
          return;
        }
        var re = /@.*$/;
        return original.replace(re, "");
      }
    }
}]);


