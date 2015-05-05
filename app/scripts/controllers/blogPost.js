'use strict';

/**
 * @ngdoc function
 * @name blogApp.controller:MainCtrl
 * @description
 * # MainCtrl
 * Controller of the blogApp
 */
angular.module('blogApp')
  .controller('BlogPostCtrl', function ($scope, $http, $routeParams) {

    var url = '/api/index.php/blogs/' + $routeParams.blogId + '/posts/' + $routeParams.postId;
    $http({method: 'GET', url: url}).
      success(function (data) {
      $scope.blogPost = data[0];
    });

	$http({method: 'GET', url: '/api/index.php/blogs/' + $routeParams.blogId}).
      success(function (data) {
      $scope.blog = data[0];
    });
  });



