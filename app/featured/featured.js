'use strict';

angular.module('myApp.featured', ['ngSanitize'])

.controller('FeaturedCtrl', ['$scope', '$http', 
	function($scope, $http) {
  	$http.get('/featured.json').success(function(data) {
        $scope.featured = data.events[0].event;
        console.log($scope);
      });
}]);

