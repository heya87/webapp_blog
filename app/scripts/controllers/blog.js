'use strict';

/**
 * @ngdoc function
 * @name blogApp.controller:MainCtrl
 * @description
 * # MainCtrl
 * Controller of the blogApp
 */
angular.module('blogApp')
  .controller('BlogCtrl', function ($scope, $http, $routeParams, $location, $localStorage) {
    

    $http({method: 'GET', url: '/api/index.php/blogs/1'}).
      success(function (data) {
      $scope.blog = data[0];
    });

	$http({method: 'GET', url: '/api/index.php/blogs/1/posts'}).
      success(function (data) {
      $scope.posts = data;
    });


    $scope.newBlog={};
    $scope.doCreate = function (newBlog) {

        var config = {headers:  {
                'username': $localStorage.currentUser,
                'token': $localStorage.token
            }
        };

        console.log($localStorage.currentUser);
        console.log($localStorage.token);

        var res = $http.post('/api/index.php/newBlog', newBlog ,config);
        res.success(function(data, status, headers, config) {
          $location.path('/blogs/' + data.idBlog);

          console.log(data);
        }).
          error(function(data, status, headers, config) {

            if(status == 401) {
              window.alert("You are not logged in, please log in first.");
              $localStorage.$reset();
              $location.path('/login');
            } else {
              window.alert("Error with status: " + status);
            }
        });
    };

    $scope.goToNewPost = function () {
      $location.path('/blogs/'+ $scope.blog.idBlog + '/newPost');
    };

    $scope.isLoggedIn = function () {
      if($localStorage.currentUser) {
        return true;
      }
      return false;
    };


  });


