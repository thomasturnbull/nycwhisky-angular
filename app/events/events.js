'use strict';

angular.module('myApp.events', ['ngRoute', 'ngSanitize'])

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
      angular.forEach($scope.events.events, function (event) {
        event.open = false;
      });
      this.event.open = open;
      console.log(this);
      // var eventcontainer = document.querySelector("#events");
      // console.log(eventcontainer);
      // eventcontainer.scrollTop = 0;
      // This isn't perfect due to sponsorship & day dividers.
      var scrolling = 82 + (107 * this.$index);
      //console.log(scrolling);
      document.body.scrollTop = scrolling;
      // var thiselem = document.getElementById("event-"+this.$index);
      // var thiselemoffset = thiselem.getBoundingClientRect().top;
      // console.log(thiselemoffset);
      // var bodyoffset = document.body.getBoundingClientRect().top;
      // console.log(bodyoffset);
      // var offset =  -bodyoffset + thiselemoffset;
      // console.log(offset);
      // //console.log(thiselem.getBoundingClientRect());
      // document.body.scrollTop = offset;

    }

    // Dates for calendar are coming through strangely. Fix.
    $scope.calendar = {
      get : function(original) {
        var components = original.split(" ");
        return components[0];
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
