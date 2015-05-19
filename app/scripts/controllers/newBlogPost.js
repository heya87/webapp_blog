'use strict';

/**
 * @ngdoc function
 * @name blogApp.controller:MainCtrl
 * @description
 * # MainCtrl
 * Controller of the blogApp
 */
 angular.module('blogApp')
 .controller('NewBlogPostCtrl', function ($scope, $http, $routeParams, $location, $localStorage) {

  $scope.selected = {};

  $http({method: 'GET', url: '/api/index.php/blogsbyuser/' + $localStorage.currentUser}).
    success(function (data) {
      console.log(data);

    $scope.myBlogs = data;
  });

  $scope.newPost={};
  $scope.doCreate = function (newPost) {

    $scope.newPost.blogId =  $routeParams.blogId;






    var now = new Date().toISOString().slice(0, 19).replace('T', ' ');
    $scope.newPost.dateTime = now;

    var config = {headers:  {
            'username': $localStorage.currentUser,
            'token': $localStorage.token
        }
    };



    var res = $http.post('/api/index.php/newPost', newPost, config);
    res.success(function(data, status, headers, config) {

      if($scope.images.length > 0) {
        var index;
        for (index = 0; index < $scope.images.length; ++index) {
          $scope.images[index].postId = data.idPost;
          $http.post('/api/index.php/newImage', $scope.images[index]);

        }
      }
      $location.path('/blogs/' + $routeParams.blogId + '/posts' + data.idPost);

    }).error(function(data, status, headers, config) {
        if(status == 401) {
          window.alert("You are not logged in, please log in first.");
          $location.path('/login');
        } else if (status == 500){
          window.alert("Not your blog, FUCK OFF!!");
        } else {
          window.alert("Error with status: " + status);
        }
    });
  };

  $scope.images=[]
  $scope.newImage={};
  $scope.addImage = function (newImage) {
    console.log($scope.selected);
    $scope.images.push({
      name: $scope.newImage.name,
      link: $scope.newImage.link
    });

    $scope.newImage.name = "";
    $scope.newImage.link= "";
  };

  $scope.deleteImage = function (idx) {
    $scope.images.splice(idx, 1); 
  };

  $scope.changed = function() {
    console.log($scope.selected);
}


});

