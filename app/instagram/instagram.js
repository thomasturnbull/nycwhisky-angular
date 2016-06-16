'use strict';

angular.module('myApp.instagram', [])

.factory("InstagramAPI", ['$http', function($http) {
  return {
    fetchPhotos: function(callback){
      // Go to https://instagram.com/developer/clients/manage/ 
      // and register your app to get a client ID.
      var access_token = '1576156466.1677ed0.08f8c9d651aa4a3ea10960fc0330e591';
      // To get your user ID go to http://jelled.com/instagram/lookup-user-id 
      // and enter your Instagram user name to get your user ID.
      var user_id = '1576156466';
      var endpoint = "https://api.instagram.com/v1/users/" + user_id + "/media/recent/?";
      endpoint += "count=9";
      endpoint += "&access_token=" + access_token;
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
