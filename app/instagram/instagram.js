'use strict';

angular.module('myApp.instagram', [])

.factory("InstagramAPI", ['$http', function($http) {
  return {
    fetchPhotos: function(callback){
      // Go to https://instagram.com/developer/clients/manage/ 
      // and register your app to get a client ID.
      var client_id = '5b6af0f3af004abd93806c68abe9e6ff';
      // To get your user ID go to http://jelled.com/instagram/lookup-user-id 
      // and enter your Instagram user name to get your user ID.
      var user_id = '1576156466';
      var endpoint = "https://api.instagram.com/v1/users/" + user_id + "/media/recent/?";
      endpoint += "count=9";
      endpoint += "&client_id=" + client_id;
      endpoint += "&callback=JSON_CALLBACK";
      $http.jsonp(endpoint).success(function(response){
        callback(response.data);
      });
    }
  }
}])

.controller('ShowImages', function($scope, InstagramAPI){
  $scope.layout = 'grid';
  $scope.data = {};
  $scope.pics = [];
    
  InstagramAPI.fetchPhotos(function(data){
    $scope.pics = data;
  });
});
