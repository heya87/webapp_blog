'use strict';

/**
 * @ngdoc function
 * @name blogApp.controller:MainCtrl
 * @description
 * # MainCtrl
 * Controller of the blogApp
 */
angular.module('blogApp')
  .controller('BlogCtrl', function ($scope, $http, $routeParams) {

    $http({method: 'GET', url: '/api/index.php/blogs/1'}).
      success(function (data) {
      $scope.blog = data[0];
    });

	$http({method: 'GET', url: '/api/index.php/blogs/1/posts'}).
      success(function (data) {
      $scope.posts = data;
    });
  });



