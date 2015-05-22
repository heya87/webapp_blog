'use strict';

/**
 * @ngdoc function
 * @name blogApp.controller:MainCtrl
 * @description
 * # MainCtrl
 * Controller of the blogApp
 */
angular.module('blogApp')
  .controller('MainCtrl', function ($scope, $http, $localStorage) {

    function createUnknownError(status) {
      return {
        status: status,
        statusText: 'Internal Server Error',
        description: 'No details available'
      };
    }

    $http({method: 'GET', url: '/api/index.php/blogs'}).
      success(function (data) {
      $scope.blogs = data;
    });


  });

