'use strict';

angular.module('myApp.login', ['ngRoute'])

.config(['$routeProvider', function($routeProvider) {
  $routeProvider.when('/login', {
    templateUrl: 'login/login.html',
    controller: 'LoginCtrl'
  });
}])

.controller('LoginCtrl', [function() {
	var elementRect = document.getElementById("events").getBoundingClientRect();
	var bodyRect = document.body.getBoundingClientRect();
	var offset = (elementRect.top - bodyRect.top);
    window.scrollTo(0, offset);
}]);