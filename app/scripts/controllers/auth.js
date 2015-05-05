'use strict';

/**
 * @ngdoc function
 * @name blogApp.controller:MainCtrl
 * @description
 * # MainCtrl
 * Controller of the blogApp
 */
angular.module('blogApp')
  .controller('AuthCtrl', function ($scope, $http, $routeParams) {
 //initially set those objects to null to avoid undefined error
    $scope.userName= {};
    $scope.password= {};
    $scope.doLogin = function (user) {
        console.log(user.userName);
        console.log(user.password)
    };
    $scope.userName= {};
    $scope.password= {};
    $scope.password2= {};
    $scope.doSignup = function (user) {
        console.log(user.username);
        console.log(user.password);
        console.log(user.password2);
    };
    $scope.logout = function () {
    }
});

