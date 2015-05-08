'use strict';

/**
 * @ngdoc function
 * @name blogApp.controller:MainCtrl
 * @description
 * # MainCtrl
 * Controller of the blogApp
 */
angular.module('blogApp')
  .controller('BlogCtrl', function ($scope, $http, $routeParams, $location) {

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
        console.log(newBlog.title);
        console.log(newBlog.description);
        console.log(newBlog.destination);

        console.log(newBlog);

        var res = $http.post('/api/index.php/newBlog', newBlog);
        res.success(function(data, status, headers, config) {
          $location.path('/blogs/' + data.idBlog);

          console.log(data);
        });
    };

  });



