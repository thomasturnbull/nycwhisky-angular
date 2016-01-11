'use strict';

angular.module('myApp.events', ['ngRoute', 'ngSanitize', 'jshor.angular-addtocalendar', 'ui.bootstrap'])

.config(['$routeProvider', function($routeProvider) {
  $routeProvider.when('/events', {
    templateUrl: 'events/events.html',
    controller: 'EventsCtrl'
  });
}])

.controller('EventsCtrl', ['$scope', '$http', '$sanitize',
	function($scope, $http, $sanitize) {
  	$http.get('/events.json').success(function(data) {
        $scope.events = data;
      });

    $scope.toggle = function (open) {
      // Keep track of which event was expanded
      var i = 0;
      var expandedeventindex = 0;
      var expandedeventheight = 0;
      angular.forEach($scope.events.events, function (event) {
        // if event is open, log it's position and size
        if (event.open) {
          expandedeventindex = i;
          expandedeventheight = document.getElementById("event-"+i).getBoundingClientRect().height;
          event.open = false;
        }
        i++;
      });
      this.event.open = open;

      var thiselem = document.getElementById("event-"+this.$index);
      var thiselemoffset = thiselem.getBoundingClientRect().top;
      var bodyoffset = document.body.getBoundingClientRect().top;
      var offset =  -bodyoffset + thiselemoffset;
      // Deal with collapse of expanded.
      if (expandedeventheight > 0 && expandedeventindex < this.$index) {
        offset = offset - expandedeventheight + 107;
      }
      document.body.scrollTop = offset;
    }

    // Dates for calendar are coming through strangely. Fix.
    $scope.calendar = {
      get : function(original) {
        var components = original.split(" ");
        var datestring = components[0];
        return datestring.substring(0, datestring.length - 1);
      }
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
        return $sanitize(original.replace(re, ""));
      }
    }

    // Set the class for events, specifically if the day changes.
    $scope.getEventClass = function(index, event) {
      var eventclass = "event";
      // Deal with date separation.
      var currentdate = event.event.day + event.event.dayofmonth;
      if (index == 0) {
        $scope.date = currentdate;
        eventclass += " firstevent";
      }
      else if ($scope.date != currentdate) {
        $scope.date = event.event.day + event.event.dayofmonth;;
        eventclass += " newday";
      }
      else { 
        eventclass += " sameday";
      }
      // Deal with sponsorship.
      if (event.event.sponsorship) {
        eventclass += " sponsored";
      }
      return eventclass;
    }
}]);
