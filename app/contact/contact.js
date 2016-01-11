'use strict';

angular.module('myApp.contact', ['ngRoute'])

.config(['$routeProvider', function($routeProvider) {
  $routeProvider.when('/contact', {
    templateUrl: 'contact/contact.html',
    controller: 'ContactCtrl'
  });
}])

.controller('ContactCtrl', [function() {
	var elementRect = document.getElementById("events").getBoundingClientRect();
	var bodyRect = document.body.getBoundingClientRect();
	var offset = (elementRect.top - bodyRect.top);
    window.scrollTo(0, offset);
}]);