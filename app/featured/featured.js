'use strict';

angular.module('myApp.featured', ['ngSanitize'])

.controller('FeaturedCtrl', ['$scope', '$http', 
	function($scope, $http) {
  	$http.get('/featured.json').success(function(data) {
        $scope.featured = data.events[0].event;
      });

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

