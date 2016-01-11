'use strict';

angular.module('myApp.about', ['ngRoute'])

.config(['$routeProvider', function($routeProvider) {
  $routeProvider.when('/about', {
    templateUrl: 'about/about.html',
    controller: 'AboutCtrl'
  });
}])

.controller('AboutCtrl', [function() {
	var elementRect = document.getElementById("events").getBoundingClientRect();
	var bodyRect = document.body.getBoundingClientRect();
	var offset = (elementRect.top - bodyRect.top);
    window.scrollTo(0, offset);
}]);